<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Blog extends MX_Controller
{

function __construct() {
parent::__construct();
$this->load->database();
    $this->load->library(array('ion_auth','form_validation'));
    $this->load->helper(array('url','language'));
    $this->load->library('email');
$this->email->set_newline("\r\n");

    $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

    $this->lang->load('auth');
}

function articles()
{
  $this->load->module('securite');

$data = $this->fetch_post();
  $data['flash'] = $this->session->flashdata('item');
 $this->load->helper('text');
$mysql_query="select * from blog order by date_publication desc limit 0,3";
$data['query'] = $this->_custom_query($mysql_query);
    $data['view_file']="articles";
    $this->load->module('templates');
    $this->templates->main_page($data);

}
function _draw_feed_hp()
{
  $this->load->helper('text');
$mysql_query="select * from blog order by date_publication desc limit 0,3";
$data['query'] = $this->_custom_query($mysql_query);
$this->load->view('feed_hp',$data);
}

function delete_image($update_id)
        {

            if(!is_numeric($update_id)) {
    redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){

$data = $this->fetch_db($update_id);
$image = $data['image'];

$product_image_path ='./blog_pics/'.$image;
$image_image_miniture = $image_image_mini_path =str_replace('.','_thumb.',$image );
$image_image_mini_path ='./blog_pics/'.$image_image_miniture;
//supprimer l'image si elle existe
if(file_exists($product_image_path)) {
unlink($product_image_path);

}
if(file_exists($image_image_mini_path)) {
    unlink($image_image_mini_path);
}
//mettre a jour la BDD
unset($data);
$data['image'] = "";
$this->_update($update_id, $data);
$flash_msg="L image de l'article est supprimée avec succes.";

                $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
           $this->session->set_flashdata('item', $value);
redirect('blog/create/'.$update_id);
}
}



function do_upload($update_id)
        {

            if(!is_numeric($update_id)) {
    redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){

$submit = $this->input->post('submit', TRUE);
if($submit == "Cancel"){
    redirect('blog/create/'.$update_id);
}


                $config['upload_path']          = './blog_pics/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 5000;
                $config['max_width']            = 12024;
                $config['max_height']           = 1268;
$config['file_name'] = $this->securite->generate_random_strings(16);


                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile'))
                {
                        $data['error'] = array('error' => $this->upload->display_errors("<p style='color: red;'>","</p>"));

                     $data['headline'] = "Erreur Import";
    $data['update_id']=$update_id;
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

  $raw_name = $upload_data['raw_name'];
  $file_ext = $upload_data['file_ext'];
  //generer le nom du thumbnail
$thumbnail_name = $raw_name."_thumb".$file_ext;


$file_name = $upload_data['file_name'];
$this->_generate_thumbnail($file_name, $thumbnail_name);


$update_data['image'] = $file_name;

$this->_update($update_id, $update_data);


    $data['headline'] = "Importation de l'image réussi";
    $data['update_id']=$update_id;
    $data['flash'] = $this->session->flashdata('item');
    $data['view_file']="upload_success";
    $this->load->module('templates');
    $this->templates->admin($data);

                      
 
    
                }
        }
      }


function _generate_thumbnail($file_name,$thumbnail_name)

{

$config['image_library'] = 'gd2';
$config['source_image'] = './blog_pics/'.$file_name;
$config['new_image'] = './blog_pics/'.$thumbnail_name;
$config['maintain_ratio'] = TRUE;
$config['width']         = 200;
$config['height']       = 200;

$this->load->library('image_lib', $config);

$this->image_lib->resize();


}


function  upload_image($update_id){
//si l'id est un numéro:astuce sécurité
if(!is_numeric($update_id)) {
    redirect('securite/error');
}

$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){



$data['headline'] = "Importer Une Image";
  $data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');
    
    $data['view_file']="upload_image";
    $this->load->module('templates');
    $this->templates->admin($data);

     }
    }

function test()
{
  $this->load->module('timedate');
  $nowtime = time();
  $datepicker_time = $this->timedate->get_date($nowtime,'datepicker_us');
  echo $datepicker_time;
  echo"<hr>";

$timestamp = $this->timedate->make_timestamp_from_datepicker_us($datepicker_time);
echo $timestamp;
echo "<hr>";
$nice_date = $this->timedate->get_date($timestamp, 'cool');
echo $nice_date;

}
function _process_delete($update_id)
{



//suppression de la page
$this->_delete($update_id);

}


 function delete($update_id)
    {

        if(!is_numeric($update_id)) {
    redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){

$submit = $this->input->post('submit',TRUE);
if($submit=="Cancel"){
    redirect('blog/create/'.$update_id);
}elseif ($submit="Oui") {
    $this->_process_delete($update_id);
$flash_msg="La page est supprimée avec succés.";
 $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
 $this->session->set_flashdata('item', $value);
redirect('blog/manage');
}


    }
}


function deleteconf($update_id)
{

       if(!is_numeric($update_id)) {
    redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
$data['headline'] = "Supprimer la page";
  $data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');
    $data['view_file']="deleteconf";
    $this->load->module('templates');
    $this->templates->admin($data);

}
}
 function  create(){
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){


  $update_id= $this->uri->segment(3);
       $submit =$this->input->post('submit',TRUE);

      $this->load->module('timedate');
      


if($submit =="Cancel"){
    redirect('blog/manage');
}


       if($submit=="Submit"){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titre_page','Page Title','required|max_length[250]');

          $this->form_validation->set_rules('date_publication','Date published','required');
           $this->form_validation->set_rules('contenu_page','Page content','required');
           



           if($this->form_validation->run($this) ==TRUE){
            $data = $this->fetch_post();

$data['url_page'] = url_title($data['titre_page']);

//convertir la date en variable unix timestamp

$data['date_publication'] = $this->timedate->make_timestamp_from_datepicker_us($data['date_publication']);
            if (is_numeric($update_id)){
                //update
             
                $this->_update($update_id,$data);
$flash_msg="La page  est mise à jour avec succeés.";

                $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
           $this->session->set_flashdata('item', $value);
redirect('blog/create/'.$update_id);


            }else{
                // inserer une nouvelle page
                $this->_insert($data);
$update_id =$this->get_max(); //recupere l'id du nouveau produit

$flash_msg="La page à été insérée avec succeés.";
$value='<div class="alert alert-success" role="alert" >'.$flash_msg.'</div>';

$this->session->set_flashdata('item', $value);
redirect('blog/create/'.$update_id);//remember the flash data

            }
           }
       }

       if((is_numeric($update_id)) && ($submit!="Submit")){
$data =$this->fetch_db($update_id);

       }else{
        $data =$this->fetch_post();
        
       }

       if(!is_numeric($update_id)){
    $data['headline'] ="Ajouter un nouveau Blog";
       }else{
        $data['headline'] ="Mettre a jour le Blog";
       }
if($data['date_publication']>0){
$data['date_publication'] = $this->timedate->get_date($data['date_publication'],'datepicker_us');

}
$data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');
    
    $data['view_file']="create";
    $this->load->module('templates');
    $this->templates->admin($data);

    }

}
//depuis le formulaire
function fetch_post(){

$data['titre_page'] = $this->input->post('titre_page',TRUE);
$data['motcle_page'] = $this->input->post('motcle_page',TRUE);
$data['description_page'] = $this->input->post('description_page',TRUE);
$data['contenu_page'] = $this->input->post('contenu_page',TRUE);
$data['date_publication'] = $this->input->post('date_publication',TRUE);
$data['auteur'] = $this->input->post('auteur',TRUE);
return $data;
}
//depuis la base de données
function fetch_db($update_id){

    if(!is_numeric($update_id)){
        redirect('securite/error');
    }

$query =$this->get_where($update_id);
foreach ($query->result() as $row) {
    $data['titre_page'] = $row->titre_page;
    $data['url_page'] = $row->url_page;
    $data['motcle_page'] = $row->motcle_page;
    $data['description_page'] = $row->description_page;
    $data['contenu_page'] = $row->contenu_page;
    $data['date_publication'] = $row->date_publication;
     $data['auteur'] = $row->auteur;
     $data['image'] = $row->image;
   
    
}
if (!isset($data)){
    $data="";
}
return $data;
    
}

function  manage(){

        $this->load->library('session');
        $this->load->module('securite');

if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
 $data['flash'] = $this->session->flashdata('item');

$data['query'] = $this->get('date_publication desc');
        //echo"Manage";

$data['view_file']="manage";
$this->load->module('templates');
$this->templates->admin($data);

    }
}
function get($order_by) {
$this->load->model('mdl_blog');
$query = $this->mdl_blog->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_blog');
$query = $this->mdl_blog->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_blog');
$query = $this->mdl_blog->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_blog');
$query = $this->mdl_blog->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_blog');
$this->mdl_blog->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_blog');
$this->mdl_blog->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_blog');
$this->mdl_blog->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_blog');
$count = $this->mdl_blog->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_blog');
$max_id = $this->mdl_blog->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_blog');
$query = $this->mdl_blog->_custom_query($mysql_query);
return $query;
}

}