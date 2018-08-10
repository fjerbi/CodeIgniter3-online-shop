<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cms_webpages extends MX_Controller
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
    redirect('cms_webpages/create/'.$update_id);
}elseif ($submit="Oui") {
    $this->_process_delete($update_id);
$flash_msg="La page est supprimée avec succés.";
 $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
 $this->session->set_flashdata('item', $value);
redirect('cms_webpages/manage');
}


    }


}
function deleteconf($update_id)
{

       if(!is_numeric($update_id)) {
    redirect('securite/error');
}elseif ($update_id<3) { //les alerter de supprimer la page d'accueil ou contact
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
if($submit =="Cancel"){
    redirect('cms_webpages/manage');
}


       if($submit=="Submit"){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titre_page','Page Title','required|max_length[250]');

         
           $this->form_validation->set_rules('contenu_page','Page content','required');
           if($this->form_validation->run($this) ==TRUE){
            $data = $this->fetch_post();

$data['url_page'] = url_title($data['titre_page']);

            if (is_numeric($update_id)){
                //update
              if($update_id<3){
                unset($data['url_page']);
              }
                $this->_update($update_id,$data);
$flash_msg="La page  est mise à jour avec succeés.";

                $value='<div class="alert alert-success" role="alert">Parfait</div>';
           $this->session->set_flashdata('item', $value);
redirect('cms_webpages/create/'.$update_id);


            }else{
                // inserer une nouvelle page
                $this->_insert($data);
$update_id =$this->get_max(); //recupere l'id du nouveau produit

$flash_msg="La page à été insérée avec succeés.";
$value='<div class="alert alert-success" role="alert" >'.$flash_msg.'</div>';

$this->session->set_flashdata('item', $value);
redirect('cms_webpages/create/'.$update_id);

            }
           }
       }

       if((is_numeric($update_id)) && ($submit!="Submit")){
$data =$this->fetch_db($update_id);

       }else{
        $data =$this->fetch_post();
        
       }

       if(!is_numeric($update_id)){
    $data['headline'] ="Ajouter une nouvelle page";
       }else{
        $data['headline'] ="Mettre a jour la page";
       }

$data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');
    
    $data['view_file']="create";
    $this->load->module('templates');
    $this->templates->admin($data);

    }
  }



function fetch_post(){

$data['titre_page'] = $this->input->post('titre_page',TRUE);
$data['motcle_page'] = $this->input->post('motcle_page',TRUE);
$data['description_page'] = $this->input->post('description_page',TRUE);
$data['contenu_page'] = $this->input->post('contenu_page',TRUE);

return $data;
}

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

$data['query'] = $this->get('url_page');
        //echo"Manage";

$data['view_file']="manage";
$this->load->module('templates');
$this->templates->admin($data);
}
    }

function get($order_by) {
$this->load->model('mdl_cms_webpages');
$query = $this->mdl_cms_webpages->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_cms_webpages');
$query = $this->mdl_cms_webpages->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_cms_webpages');
$query = $this->mdl_cms_webpages->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_cms_webpages');
$query = $this->mdl_cms_webpages->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_cms_webpages');
$this->mdl_cms_webpages->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_cms_webpages');
$this->mdl_cms_webpages->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_cms_webpages');
$this->mdl_cms_webpages->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_cms_webpages');
$count = $this->mdl_cms_webpages->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_cms_webpages');
$max_id = $this->mdl_cms_webpages->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_cms_webpages');
$query = $this->mdl_cms_webpages->_custom_query($mysql_query);
return $query;
}

}