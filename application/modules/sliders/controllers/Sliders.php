<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Sliders extends MX_Controller
{
  
function __construct() {
parent::__construct();
}

function _attempt_draw_slider() {
  $this->load->helper('url');

 $current_url = current_url();
 $query_ads = $this->get_where_custom('target_url', $current_url);
 $num_rows_ads = $query_ads->num_rows();
 if($num_rows_ads>0){
  $this->load->module('slides');
  foreach($query_ads->result() as $row){
    $parent_id = $row->id;
  }
  $data['query_slides'] = $this->slides->get_where_custom('parent_id', $parent_id);
  $this->load->view('slider', $data);
 }

 }
function delete($update_id)
    {

        if(!is_numeric($update_id)) {
    redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');
//$this->securite->_verify_admin();

$submit = $this->input->post('submit',TRUE);
if($submit=="Cancel"){
    redirect('sliders/create/'.$update_id);
}elseif ($submit="Oui") {
    $this->_process_delete($update_id);
$flash_msg="Le slider est supprimé.";
 $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
 $this->session->set_flashdata('item', $value);
redirect('sliders/manage');
}


    }

function _process_delete($update_id)
{

//suppression de tout les sliders associé avec cette slider

$this->load->module('slides');
$query= $this->slides->get_where_custom('parent_id', $update_id);
foreach($query->result() as $row){
  $this->slides->_process_delete($row->id);
}

//suppression du slider
$this->_delete($update_id);

}

function deleteconf($update_id)
{

       if(!is_numeric($update_id)) {
    redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');
//$this->securite->_verify_admin();
$data['headline'] = "Supprimer l'image";
  $data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');
    $data['view_file']="deleteconf";
    $this->load->module('templates');
    $this->templates->admin($data);

}

function _create_sortable_list(){


$mysql_query ="select * from sliders order by target_url";
$data['query'] = $this->_custom_query($mysql_query);
$this->load->view('sortable_list',$data);
 
}
function _create_offers()
{

  //creation des image dans la page d'accueil
  $data['query'] = $this->get('target_url');
  $num_rows = $data['query']->num_rows();
  if($num_rows>0){
    $this->load->view('homepage_offers', $data);
  }
}

function view($update_id)
{
          if(!is_numeric($update_id)) {
    redirect('securite/error');
}
$this->load->module('parametre_web');
$this->load->module('custom_pagination');

//fetch les details des produits

$data = $this->fetch_db($update_id);

//compter les details des produits qui correspondent a chaque catégorie
$use_limit = FALSE;
$mysql_query = $this->_generate_mysql_query($update_id, $use_limit);
$query = $this->_custom_query($mysql_query);
$total_items = $query->num_rows();

//fetch les produits pour cette page
$use_limit = TRUE;
$mysql_query = $this->_generate_mysql_query($update_id, $use_limit);

//$template, $target_base_url, $total_rows, $offset_segment, $limit
$pagination_data['template'] = 'main_page';
$pagination_data['target_base_url'] = $this->get_target_pagination_base_url();
$pagination_data['total_rows'] = $total_items;
$pagination_data['offset_segment'] = 4;
$pagination_data['limit'] = $this->get_limit();
$data['pagination'] = $this->custom_pagination->_generate_pagination($pagination_data);

$pagination_data['offset'] = $this->get_offset();
$data['showing_statement'] = $this->custom_pagination->get_showing_statement($pagination_data);

$data['item_segments'] = $this->parametre_web->_get_item_segments();
$data['query'] = $this->_custom_query($mysql_query);
  $data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');
$data['view_module']="sliders";
    $data['view_file']="view";
    $this->load->module('templates');
    $this->templates->main_page($data);

}
function get_target_pagination_base_url()
{
  $first_bit = $this->uri->segment(1);
  $second_bit = $this->uri->segment(2);
  $third_bit = $this->uri->segment(3);
  $target_base_url = base_url().$first_bit."/".$second_bit."/".$third_bit;
return $target_base_url;
}

function _generate_mysql_query($update_id, $use_limit)
{
//NB: use_limit peut etre TRUE ou FALSE


  $mysql_query="
SELECT
produits.nom_produit,
produits.url_produit,
produits.prix_produit,
produits.ancien_prix,
produits.image_mini
FROM
categorie_produit
INNER JOIN produits ON categorie_produit.id_produit = produits.id
WHERE categorie_produit.id_cat=$update_id and produits.status=1


";

if($use_limit==TRUE){
  $limit = $this->get_limit();
  $offset = $this->get_offset();
  $mysql_query.= " limit ".$offset.", ".$limit;
}
return $mysql_query;
}
//préciser la limite des  données qui vont etre affiché par page
function get_limit()
{
  $limit = 10;
  return $limit; 
}

function get_offset()
{
  //nombre de segment (liens)
  $offset = $this->uri->segment(4);
if(!is_numeric($offset)){
  $offset = 0;
}
return $offset;
}







function sort()
{
      $this->load->module('securite');
//$this->securite->_verify_admin();
$number = $this->input->post('number', TRUE);
for ($i=1; $i <= $number ; $i++) { 
  $update_id = $_POST['order'.$i];
  $data['priorite'] = $i;
  $this->_update($update_id, $data);
}
}

//retourne le nombre de sous catégories pour chaque catégorie
 function _get_title($update_id)
{
$title=$this->_get_titre_slider($update_id);
return $title;
}
function _get_titre_slider($update_id)
{
 $data = $this->fetch_db($update_id);
 $titre_slider = $data['titre_slider'];
 return $titre_slider;
}

function fetch_post(){

$data['titre_slider'] = $this->input->post('titre_slider',TRUE);
$data['target_url'] = $this->input->post('target_url',TRUE);
return $data;
}
function fetch_db($update_id){

    if(!is_numeric($update_id)){
        redirect('securite/error');
    }

$query =$this->get_where($update_id);
foreach ($query->result() as $row) {
    $data['titre_slider'] = $row->titre_slider;
    $data['target_url'] = $row->target_url;
  
      
    
    
}
if (!isset($data)){
    $data="";
}
return $data;
    
}

 function  create(){
$this->load->library('session');
$this->load->module('securite');
//$this->securite->_verify_admin();


  $update_id= $this->uri->segment(3);
       $submit =$this->input->post('submit',TRUE);
if($submit =="Cancel"){
    redirect('sliders/manage');
}


       if($submit=="Submit"){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titre_slider','Block Title','required|max_length[240]');
         $this->form_validation->set_rules('target_url','Target URL','required|max_length[240]');
         
         
           if($this->form_validation->run($this) ==TRUE){
            $data = $this->fetch_post();


            if (is_numeric($update_id)){
                //mettre a jour la categorie
                $this->_update($update_id,$data);
$flash_msg="l'image  est mise a jour avec succeés.";

                $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
           $this->session->set_flashdata('item', $value);
redirect('sliders/create/'.$update_id);


            }else{
                // insert new item


                $this->_insert($data);
$update_id =$this->get_max(); //recupere l'id du nouveau produit

$flash_msg="L'image est insérée avec succs.";
$value='<div class="alert alert-success" role="alert" >'.$flash_msg.'</div>';

$this->session->set_flashdata('item', $value);
redirect('sliders/create/'.$update_id);//remember the flash data

            }
           }
       }

       if((is_numeric($update_id)) && ($submit!="Submit")){
$data =$this->fetch_db($update_id);

       }else{
        $data =$this->fetch_post();

       }

       if(!is_numeric($update_id)){
    $data['headline'] ="Ajouter une nouvelle image";
       }else{
        $titre_slider = $this->_get_titre_slider($update_id);
        $data['headline'] ="Mettre à jour l'image :".$titre_slider;
       }



//test nb categorie
//echo $data['num_dropdown_options'];die();

$data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');
    
    $data['view_file']="create";
    $this->load->module('templates');
    $this->templates->admin($data);

    }



function  manage(){

        $this->load->library('session');
        $this->load->module('securite');

//$this->securite->_verify_admin();
$data['query']= $this->get('titre_slider');
$data['num_rows']= $data['query']->num_rows();
$data['sort_categ'] = TRUE;
 $data['flash'] = $this->session->flashdata('item');
$data['view_file']="manage";
$this->load->module('templates');
$this->templates->admin($data);

    }
function get($order_by) {
$this->load->model('mdl_sliders');
$query = $this->mdl_sliders->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_sliders');
$query = $this->mdl_sliders->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_sliders');
$query = $this->mdl_sliders->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_sliders');
$query = $this->mdl_sliders->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_sliders');
$this->mdl_sliders->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_sliders');
$this->mdl_sliders->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_sliders');
$this->mdl_sliders->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_sliders');
$count = $this->mdl_sliders->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_sliders');
$max_id = $this->mdl_sliders->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_sliders');
$query = $this->mdl_sliders->_custom_query($mysql_query);
return $query;
}

}