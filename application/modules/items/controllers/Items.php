<?php
class Items extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    $this->load->library(array('ion_auth','form_validation'));
    $this->load->helper(array('url','language'));
    $this->load->library('email');
$this->email->set_newline("\r\n");

    $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

    $this->lang->load('auth');
    }
function num_items()
{
   $num = $this->db->query('SELECT * FROM produits');
echo $num->num_rows();
}

function testjson()
{
 
   $connect = mysqli_connect("localhost", "root", "", "technipackpfe");  
           $sql = "SELECT * FROM utilisateurs";  
           $result = mysqli_query($connect, $sql);  
           $json_array = array();  
           while($row = mysqli_fetch_assoc($result))  
           {  
                $json_array[] = $row;  
           }  
           echo '<pre>';  
           print_r(json_encode($json_array));  
           echo '</pre>';
           
}


function _get_item_id_from_item_url($url_produit)
{
    $query = $this->get_where_custom('url_produit',$url_produit);
    foreach ($query->result() as $row) {

        $item_id =$row->id;
    }
    if(!isset($item_id)){
        $item_id=0;
    }
    return $item_id;
}
function view($id_produit)
{
          if(!is_numeric($id_produit)) {
    redirect('securite/error');
}
//fetch les details des produits

$data = $this->fetch_db($id_produit);
  $data['id_produit']=$id_produit;


  //crée le breadcrumbs data array

  $breadcrumbs_data['template'] = 'main_page';
$breadcrumbs_data['current_page_title'] = $data['nom_produit'];
$breadcrumbs_data['breadcrumbs_array'] = $this->_generate_breadcrumbs_array($id_produit);
$data['breadcrumbs_data'] = $breadcrumbs_data;

$data['flash'] = $this->session->flashdata('item');
$data['view_module']="items";
    $data['view_file']="view";
    $this->load->module('templates');
    $this->templates->main_page($data);

}

function _generate_breadcrumbs_array($id_produit)
{
    $homepage_url = base_url();
    $breadcrumbs_array[$homepage_url] = 'Accueil';
//recuper l 'id de sous catégorie
   $sub_cat_id= $this->_get_sub_cat_id($id_produit);
  //echo $sub_cat_id;die();

  //recuêre le nom du catégorie
$this->load->module('categories');
$sub_nom_categorie = $this->categories->_get_nom_categorie($sub_cat_id);
//echo $sub_nom_categorie;die();
  
 //recupêre le URL de la catégorie
$sub_url_categorie = $this->categories->_get_complete_url_categorie($sub_cat_id);
   
$breadcrumbs_array[$sub_url_categorie] = $sub_nom_categorie;

    
    return $breadcrumbs_array;
}

function _get_sub_cat_id($id_produit)
{


if(!isset($_SERVER['HTTP_REFERER'])){
    $refer_url='';
}else{
    $refer_url = $_SERVER['HTTP_REFERER'];
}
   // echo $refer_url;die();
$this->load->module('parametre_web');
$this->load->module('store_cat_assign');
$this->load->module('categories');


$item_segments = $this->parametre_web->_get_items_segments();
$complete_url_categorie = base_url().$item_segments;
//echo $complete_url_categorie;die();

$url_categorie = str_replace($complete_url_categorie,'', $refer_url);

//echo $url_categorie;die();

$sub_cat_id= $this->categories->_get_cat_id_from_url_categorie($url_categorie);
if($sub_cat_id>0){
    return $sub_cat_id;
}else{
 

    //recuper l 'id de sous catéforie
   $sub_cat_id = $this->_get_complete_sub_cat_id($id_produit); 
 
}
return $sub_cat_id;

}

function _get_complete_sub_cat_id($id_produit){

//trouver la sous  catégorie qui a le plus de produits
   $query = $this->store_cat_assign->get_where_custom('id_produit', $id_produit);

foreach ($query->result() as  $row) {
$potential_sub_cats[] = $row->id_cat;
}   

//les nombres de fois qu'un produit c'est affiché dans cette catégorie
$num_sub_cats_for_item = count($potential_sub_cats);
if($num_sub_cats_for_item ==1){
    //leproduit apparait dans une seul catégorie
    $sub_cat_id = $potential_sub_cats['0'];
    
    return $sub_cat_id;
}else{
//on a plus que sous catégorie début
foreach ($potential_sub_cats as $key => $value) {
    $sub_cat_id = $value ; 
    $num_items_in_sub_cat = $this->store_cat_assign->count_where('id_cat', $sub_cat_id);
$num_items_count[$sub_cat_id] = $num_items_in_sub_cat;

}
$sub_cat_id = $this->get_best_array_key($num_items_count);
return $sub_cat_id;
//on a plus que sous catégorie fin
}

}


function get_best_array_key($target_array)
{
foreach ($target_array as $key => $value) {
  if(!isset($key_with_heighest_value)){
    $key_with_heighest_value = $key;
  }elseif ($value > $target_array[$key_with_heighest_value]) {
    $key_with_heighest_value = $key ;
  }
}
return $key_with_heighest_value;
}

function _process_delete($id_produit)
{
//suppression des images depuis hd_pics et nohd_pics
$data = $this->fetch_db($id_produit);
$image_produit = $data['image_produit'];
$image_mini = $data['image_mini'];
$product_image_path == './hd_pics/'.$image_produit;
$image_mini_path == './nohd_pics/'.$image_mini;
//supprimer l'image si elle existe
if(file_exists($product_image_path)) {
unlink($product_image_path);

}
if(file_exists($image_mini_path)) {
    unlink($image_mini_path);
}
//suppression de l'entité
$this->_delete($id_produit);

}

    function delete($id_produit)
    {

        if(!is_numeric($id_produit)) {
    redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){

$submit = $this->input->post('submit',TRUE);
if($submit=="Cancel"){
    redirect('items/create/'.$id_produit);
}elseif ($submit="Oui") {
    $this->_process_delete($id_produit);
$flash_msg="Le produit est supprime avec succees.";
 $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
 $this->session->set_flashdata('item', $value);
redirect('items/manage');
}


    }
}
//confirmation de la suppression d'une entité
function deleteconf($id_produit)
{

       if(!is_numeric($id_produit)) {
    redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){
$data['headline'] = "Supprimer le produit";
  $data['id_produit']=$id_produit;
$data['flash'] = $this->session->flashdata('item');
    $data['view_file']="deleteconf";
    $this->load->module('templates');
    $this->templates->admin($data);

}
}
   function delete_image($id_produit)
        {

            if(!is_numeric($id_produit)) {
    redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');

if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){
$data = $this->fetch_db($id_produit);
$image_produit = $data['image_produit'];
$image_mini = $data['image_mini'];

$product_image_path ='./hd_pics/'.$image_produit;
$image_mini_path = './nohd_pics/'.$image_mini;
//supprimer l'image si elle existe
if(file_exists($product_image_path)) {
unlink($product_image_path);

}
if(file_exists($image_mini_path)) {
    unlink($image_mini_path);
}
//mettre a jour la BDD
unset($data);
$data['image_produit'] = "";
$data['image_mini'] = "";
$this->_update($id_produit, $data);
$flash_msg="L image du produit est supprime avec succes.";

                $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
           $this->session->set_flashdata('item', $value);
redirect('items/create/'.$id_produit);
}}


function _generate_thumbnail($file_name)

{

$config['image_library'] = 'gd2';
$config['source_image'] = './hd_pics/'.$file_name;
$config['new_image'] = './nohd_pics/'.$file_name;
$config['maintain_ratio'] = TRUE;
$config['width']         = 200;
$config['height']       = 200;

$this->load->library('image_lib', $config);

$this->image_lib->resize();

}
   function do_upload($id_produit)
        {

            if(!is_numeric($id_produit)) {
    redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){

$submit = $this->input->post('submit', TRUE);
if($submit == "Cancel"){
    redirect('items/create/'.$id_produit);
}


                $config['upload_path']          = './hd_pics/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile'))
                {
                        $data['error'] = array('error' => $this->upload->display_errors("<p style='color: red;'>","</p>"));

                     $data['headline'] = "Erreur lors de l'importation de l'image";
    $data['id_produit']=$id_produit;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file']="upload_image";
    $this->load->module('templates');
    $this->templates->admin($data);

                }
                else
                {
                    //succes d'importation
     $data = array('upload_data' => $this->upload->data());    


$upload_data = $data['upload_data'];
$file_name = $upload_data['file_name'];
$this->_generate_thumbnail($file_name);


$update_data['image_produit'] = $file_name;
$update_data['image_mini'] = $file_name;
$this->_update($id_produit, $update_data);

//mettre a jour la BDD
    $data['headline'] = "Importation d'image réuissite";
    $data['id_produit']=$id_produit;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file']="upload_success";
    $this->load->module('templates');
    $this->templates->admin($data);

                      
 
    
                }
        }

}
    function  upload_image($id_produit){
//si l'id est un numéro:astuce sécurité
if(!is_numeric($id_produit)) {
    redirect('securite/error');
}

$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){



$data['headline'] = "Importer Une Image";
  $data['id_produit']=$id_produit;
$data['flash'] = $this->session->flashdata('item');
    
    $data['view_file']="upload_image";
    $this->load->module('templates');
    $this->templates->admin($data);

     
    }
  }

    function  create(){
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){


  $id_produit= $this->uri->segment(3);
       $submit =$this->input->post('submit',TRUE);
if($submit =="Cancel"){
    redirect('items/manage');
}


       if($submit=="Submit"){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nom_produit','Nom produit','required|max_length[240]|callback_item_check');
         $this->form_validation->set_rules('prix_produit','Prix produit','required|numeric');
         $this->form_validation->set_rules('quantite_produit','Quantite','required|numeric');
          $this->form_validation->set_rules('ancien_prix','Acien prix','numeric');
          $this->form_validation->set_rules('status','Statut','required|numeric');
           $this->form_validation->set_rules('shipping','Frais livraison','required|numeric');
           $this->form_validation->set_rules('description_produit',' Description','required');
           if($this->form_validation->run($this) ==TRUE){
            $data = $this->fetch_post();

$data['url_produit'] = url_title($data['nom_produit']);

            if (is_numeric($id_produit)){
                //update
                $this->_update($id_produit,$data);
$flash_msg="Le produit est mise a jour avec succes.";

                $value='<div class="alert alert-success" role="alert">Parfait</div>';
           $this->session->set_flashdata('item', $value);
redirect('items/create/'.$id_produit);


            }else{
                // insert new item
                $this->_insert($data);
$id_produit =$this->get_max(); //recupere l'id du nouveau produit

$flash_msg="Le produit est ins avec succs.";
$value='<div class="alert alert-success" role="alert" >'.$flash_msg.'</div>';

$this->session->set_flashdata('item', $value);
redirect('items/create/'.$id_produit);//remember the flash data

            }
           }
       }

       if((is_numeric($id_produit)) && ($submit!="Submit")){
$data =$this->fetch_db($id_produit);

       }else{
        $data =$this->fetch_post();
        $data['image_produit'] = "";
       }

       if(!is_numeric($id_produit)){
    $data['headline'] ="Ajouter un nouveau produit";
       }else{
        $data['headline'] ="Mettre à jour le produit";
       }

$data['id_produit']=$id_produit;
$data['flash'] = $this->session->flashdata('item');
    
    $data['view_file']="create";
    $this->load->module('templates');
    $this->templates->admin($data);

    }
}


//gérer les produits
    function  manage(){

        $this->load->library('session');
        $this->load->module('securite');

if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){
 $data['flash'] = $this->session->flashdata('item');

$data['query'] = $this->get('nom_produit');
        //echo"Manage";

$data['view_file']="manage";
$this->load->module('templates');
$this->templates->admin($data);

    }
  }
function fetch_post(){

$data['nom_produit'] = $this->input->post('nom_produit',TRUE);
$data['prix_produit'] = $this->input->post('prix_produit',TRUE);
$data['quantite_produit'] = $this->input->post('quantite_produit',TRUE);
$data['ancien_prix'] = $this->input->post('ancien_prix',TRUE);
$data['description_produit'] = $this->input->post('description_produit',TRUE);
$data['status'] = $this->input->post('status',TRUE);
$data['shipping'] = $this->input->post('shipping',TRUE);
return $data;
}

function fetch_db($id_produit){

    if(!is_numeric($id_produit)){
        redirect('securite/error');
    }

$query =$this->get_where($id_produit);
foreach ($query->result() as $row) {
    $data['nom_produit'] = $row->nom_produit;
    $data['url_produit'] = $row->url_produit;
    $data['prix_produit'] = $row->prix_produit;
     $data['quantite_produit'] = $row->quantite_produit;
    $data['description_produit'] = $row->description_produit;
    $data['image_produit'] = $row->image_produit;
    $data['image_mini'] = $row->image_mini;
    $data['ancien_prix'] = $row->ancien_prix;
    $data['status'] = $row->status;
    $data['shipping'] = $row->shipping;
    
}
if (!isset($data)){
    $data="";
}
return $data;
    
}

        function get($order_by)
        {
            $this->load->model('mdl_items');
            $query = $this->mdl_items->get($order_by);
            return $query;
        }

        function get_with_limit($limit, $offset, $order_by)
        {
            $this->load->model('mdl_items');
            $query = $this->mdl_items->get_with_limit($limit, $offset, $order_by);
            return $query;
        }

        function get_where($id)
        {
            $this->load->model('mdl_items');
            $query = $this->mdl_items->get_where($id);
            return $query;
        }

        function get_where_custom($col, $value)
        {
            $this->load->model('mdl_items');
            $query = $this->mdl_items->get_where_custom($col, $value);
            return $query;
        }

        function _insert($data)
        {
            $this->load->model('mdl_items');
            $this->mdl_items->_insert($data);
        }

        function _update($id, $data)
        {
            $this->load->model('mdl_items');
            $this->mdl_items->_update($id, $data);
        }

        function _delete($id)
        {
            $this->load->model('mdl_items');
            $this->mdl_items->_delete($id);
        }

        function count_where($column, $value)
        {
            $this->load->model('mdl_items');
            $count = $this->mdl_items->count_where($column, $value);
            return $count;
        }

        function get_max()
        {
            $this->load->model('mdl_items');
            $max_id = $this->mdl_items->get_max();
            return $max_id;
        }

        function _custom_query($mysql_query)
        {
            $this->load->model('mdl_items');
            $query = $this->mdl_items->_custom_query($mysql_query);
            return $query;
        }

function item_check($str){
$url_produit = url_title($str);
$mysql_query = "select * from produits where nom_produit='$str' and url_produit='$url_produit'";
    $id_produit = $this->uri->segment(3);
if (is_numeric($id_produit)) {
//c'est une mise à jour
$mysql_query.=" and id!=$id_produit";
}

$query = $this->_custom_query($mysql_query);
$num_rows = $query->num_rows();

    if ($num_rows >0)
    {
        $this->form_validation->set_message('item_check','Le nom du produit n est pas disponible');
        return FALSE;
    }
    else
    {
        return TRUE;
    }
}
}
