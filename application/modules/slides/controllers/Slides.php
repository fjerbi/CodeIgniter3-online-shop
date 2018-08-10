<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Slides extends MX_Controller
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

function _get_parent_title($parent_id)
{
$parent_module_name='sliders';
$this->load->module($parent_module_name);
$parent_title=$this->$parent_module_name->_get_title($parent_id);
return $parent_title;
}
function _get_entity_name($type)
{
if($type=='singular'){
$entity_name='Image défilante';
}else{
$entity_name='Images défilantes';
}
return $entity_name;

}

function _get_update_group_headline($parent_id)
{
$parent_title = $this->_get_parent_title($parent_id);
$entity_name = $this->_get_entity_name('plural');
$headline='Mettre à jour'.' '.$entity_name.' '.'pour'.' '.$parent_title;
return $headline;
}
function update_group($parent_id)
{
//gérer les images défilantes qui appartiennet a un parent
$this->load->library('session');
$this->load->module('securite');


$data['parent_id']=$parent_id;
$data['flash'] = $this->session->flashdata('item');
$data['headline']= $this->_get_update_group_headline($parent_id);
$data['query'] = $this->get_where_custom('parent_id', $parent_id); 
$data['num_rows'] =$data['query']->num_rows();
$data['entity_name'] = $this->_get_entity_name('plural');
$data['parent_title'] = $this->_get_parent_title($parent_id);
$data['view_file']="update_group";
$this->load->module('templates');
$this->templates->admin($data);

}
function deleteconf($update_id)
{

       if(!is_numeric($update_id)) {
    redirect('securite/error');
}

$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){

	$entity_name=$this->_get_entity_name('singular');
$data['headline'] = "Supprimer".ucfirst($entity_name);
  $data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');
    $data['view_file']="deleteconf";
    $this->load->module('templates');
    $this->templates->admin($data);

}
}
 function delete($update_id)
    {

        if(!is_numeric($update_id)) {
    redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');


$submit = $this->input->post('submit',TRUE);
if($submit=="Cancel"){
    redirect('slides/view/'.$update_id);
}elseif ($submit="Oui") {
	$parent_id=$this->_get_parent_id($update_id);
    $this->_process_delete($update_id);
    $entity_name= $this->_get_entity_name('singular');
$flash_msg="Le ".$entity_name." est supprime avec succees.";
 $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
 $this->session->set_flashdata('item', $value);
redirect('slides/update_group/'.$parent_id);
}


    }

function _process_delete($update_id)
{
//suppression des images depuis hd_pics et nohd_pics
$data = $this->fetch_db($update_id);
$picture = $data['picture'];
$picture_path == './slider_img/'.$picture;

//supprimer l'image si elle existe
if(file_exists($picture_path)) {
unlink($picture_path);

}

//suppression de l'entité
$this->_delete($update_id);

}

function _create_modal($parent_id)
{
$data['parent_id']=$parent_id;
$data['form_location']= base_url().'slides/submit_create';
$this->load->view('create_modal',$data);
}

function submit_create()
{
$this->load->module('securite');

//$this->securite->_verify_admin();
$data['target_url'] = $this->input->post('target_url', TRUE);
$data['parent_id'] = $this->input->post('parent_id', TRUE);
$data['alt_text'] = $this->input->post('alt_text', TRUE);
$this->_insert($data);
$max_id= $this->get_max();
redirect('slides/view/'.$max_id);
}
function _get_parent_id()
{
$data=$this->fetch_db($update_id);
$parent_id=$data['parent_id'];
return $parent_id;
}
function fetch_post(){

$data['target_url'] = $this->input->post('target_url',TRUE);
$data['alt_text'] = $this->input->post('alt_text',TRUE);
$data['parent_id'] = $this->input->post('parent_id',TRUE);
$data['picture'] = $this->input->post('picture',TRUE);

return $data;
}

function fetch_db($update_id){

if(!is_numeric($update_id)){

}

$query =$this->get_where($update_id);
foreach ($query->result() as $row) {
$data['target_url'] = $row->target_url;
$data['alt_text'] = $row->alt_text;
$data['parent_id'] = $row->parent_id;
$data['picture'] = $row->picture;


}
if (!isset($data)){
$data="";
}
return $data;

}

function view ($update_id)
{

$this->load->library('session');

$update_id= $this->uri->segment(3);
$submit =$this->input->post('submit',TRUE);
if($submit =="Cancel"){
redirect('slides/update_group'.$parent_id);
}



if($submit!="Submit"){
$data =$this->fetch_db($update_id);

}else{
$data =$this->fetch_post();
$data['picture'] = "";
}


$data['headline'] ="Mettre a jour le slider";


$data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');

$data['view_file']="view";
$this->load->module('templates');
$this->templates->admin($data);


}
function _img_btn($update_id)
{
$data = $this->fetch_db($update_id);
$picture = $data['picture'];
if($picture==''){
$data['dispo_pic']= FALSE;
$data['btn_style']='';
$data['btn_info']=' pas d image ';
}else{
$data['dispo_pic']= TRUE;
$data['btn_style']="style='clear: both; margin-top 24px;'";
$data['btn_info']='L image importé';
$data['pic_path']= base_url().'slider_img/'.$picture;
}
$this->load->view('img_btn', $data);
}

function  upload_image($update_id){
//si l'id est un numéro:astuce sécurité

if(!is_numeric($update_id)){
redirect('securite/error');
}
$this->load->library('session');




$data['headline'] = "Importer Une Image";
$data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');

$data['view_file']="upload_image";
$this->load->module('templates');
$this->templates->admin($data);



}
function do_upload($update_id)
{

if(!is_numeric($update_id)) {
redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');


$submit = $this->input->post('submit', TRUE);
if($submit == "Cancel"){
$parent_id= $this->_get_parent_id($update_id);
redirect('slides/update_group/'.$parent_id);
}


$config['upload_path']          = './slider_img/';
$config['allowed_types']        = 'gif|jpg|png';
$config['max_size']             = 500;
$config['max_width']            = 1624;
$config['max_height']           = 1000;

$this->load->library('upload', $config);

if (!$this->upload->do_upload('userfile'))
{
        $data['error'] = array('error' => $this->upload->display_errors("<p style='color: red;'>","</p>"));

     $data['headline'] = "Erreur lors de l'importation de l'image";
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
$file_name = $upload_data['file_name'];



$update_data['picture'] = $file_name;

$this->_update($update_id, $update_data);

redirect('slides/view/'.$update_id);

      


}
}


function submit($update_id)
{
$submit = $this->input->post('submit', TRUE);
$target_url = $this->input->post('target_url', TRUE);
$alt_text = $this->input->post('alt_text', TRUE);

if($submit=='Cancel'){
	$parent_id = $this->_get_parent_id($update_id);
	redirect('slides/update_group/'.$parent_id);
}elseif ($submit=='Submit') {
	$data['target_url']= $target_url;
	$data['alt_text']= $alt_text;
	$this->_update($update_id, $data);
	redirect('slides/view/'.$update_id);
}
}

function get($order_by) {
$this->load->model('mdl_slides');
$query = $this->mdl_slides->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_slides');
$query = $this->mdl_slides->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_slides');
$query = $this->mdl_slides->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_slides');
$query = $this->mdl_slides->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_slides');
$this->mdl_slides->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_slides');
$this->mdl_slides->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_slides');
$this->mdl_slides->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_slides');
$count = $this->mdl_slides->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_slides');
$max_id = $this->mdl_slides->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_slides');
$query = $this->mdl_slides->_custom_query($mysql_query);
return $query;
}

}