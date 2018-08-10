<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Store_cat_assign extends MX_Controller
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


function delete($update_id)
{
	if(!is_numeric($update_id)){
		redirect('securite/error');
	}
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){

//fetch l'id du produit
$query = $this->get_where($update_id);
foreach ($query->result() as $row) {
	$id_produit = $row->id_produit;
}
$this->_delete($update_id);

$flas_msg="suppression réussite ";
$value='<div class="alert alert-success" role="alert">'.$flas_msg.'</div>';
$this->session->set_flashdata('item',$value);


redirect('store_cat_assign/update/'.$id_produit);
}
}
function submit($id_produit)
{
	if(!is_numeric($id_produit)){
		redirect('securite/error');
	}
		$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
$submit = $this->input->post('submit',TRUE);
$id_cat =trim($this->input->post('id_cat', TRUE));
if($submit=="Finished"){
	redirect('items/create/'.$id_produit);
}elseif ($submit=="Submit") {
	if($id_cat!=""){


		$data['id_produit'] = $id_produit;
		$data['id_cat'] = $id_cat;
		$this->_insert($data);

$this->load->module('categories');
$nom_categorie = $this->categories->_get_nom_categorie($id_cat);
		$flas_msg="le Produit a été Mise à jour dans la catégorie ".$nom_categorie;
		$value='<div class="alert alert-success" role="alert">'.$flas_msg.'</div>';
		$this->session->set_flashdata('item',$value);
	}
}
redirect('store_cat_assign/update/'.$id_produit);
}
}

function update($id_produit)
{
	if(!is_numeric($id_produit)){
		redirect('securite/error');
	}
	$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
	//recuperer un tableau de tout les sous catégories
$this->load->module('categories');
$sub_categories = $this->categories->_get_all_sub_cats_dpdown();


//recuperer un tableau de tous les catégories

$query=$this->get_where_custom('id_produit' ,$id_produit);
$data['query'] = $query;
$data['num_rows'] = $query->num_rows();
foreach ($query->result() as $row) {
	$nom_categorie= $this->categories->_get_nom_categorie($row->id_cat);
	$parent_nom_categorie = $this->categories->_get_parent_nom_categorie($row->id_cat);
	$assigned_categories[$row->id_cat] = $parent_nom_categorie.">".$nom_categorie;

}
if(!isset($assigned_categories)){
	$assigned_categories = "";
} else{
	//le produit a éte déja mis au moins dans une catégorie
$sub_categories = array_diff($sub_categories, $assigned_categories);
}

$data['options'] = $sub_categories;
$data['id_cat']= $this->input->post('id_cat', TRUE);
$data['headline'] ="Mettre à jour la catégorie du produit";
$data['id_produit']= $id_produit;
$data['flash'] = $this->session->flashdata('item');
$data['view_file']="update";
$this->load->module('templates');
$this->templates->admin($data);
//foreach ($sub_categories as $key => $value) {
	//echo $value."<br>";
//}
}
}
function get($order_by) {
$this->load->model('mdl_store_cat_assign');
$query = $this->mdl_store_cat_assign->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_store_cat_assign');
$query = $this->mdl_store_cat_assign->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_store_cat_assign');
$query = $this->mdl_store_cat_assign->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_store_cat_assign');
$query = $this->mdl_store_cat_assign->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_store_cat_assign');
$this->mdl_store_cat_assign->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_store_cat_assign');
$this->mdl_store_cat_assign->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_store_cat_assign');
$this->mdl_store_cat_assign->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_store_cat_assign');
$count = $this->mdl_store_cat_assign->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_store_cat_assign');
$max_id = $this->mdl_store_cat_assign->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_store_cat_assign');
$query = $this->mdl_store_cat_assign->_custom_query($mysql_query);
return $query;
}

}