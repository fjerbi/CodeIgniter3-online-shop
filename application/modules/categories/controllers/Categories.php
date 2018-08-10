<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Categories extends MX_Controller
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


function _get_complete_url_categorie($update_id)
{
$this->load->module('parametre_web');
$items_segments = $this->parametre_web->_get_items_segments();

$data = $this->fetch_db($update_id);

$url_categorie = $data['url_categorie'];
$complete_url_categorie = base_url().$items_segments.$url_categorie;
return $complete_url_categorie;
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
$data['view_module']="categories";
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
function _get_cat_id_from_url_categorie($url_categorie)
{
    $query = $this->get_where_custom('url_categorie',$url_categorie);
    foreach ($query->result() as $row) {

        $id_cat =$row->id;
    }
    if(!isset($id_cat)){
        $id_cat=0;
    }
    return $id_cat;
}

function _create_top_nav()
{
$mysql_query ="select * from categories where id_categorie_parent=0 order by priorite";
$query = $this->_custom_query($mysql_query);
foreach ($query->result() as $row) {
 $parent_categories[$row->id] = $row->nom_categorie;
}
$this->load->module('parametre_web');
$items_segments= $this->parametre_web->_get_items_segments();
$data['target_url_start'] = base_url().$items_segments;
$data['parent_categories']= $parent_categories;
 $this->load->view('top-nav',$data);
}

function _get_parent_nom_categorie($update_id)
{
  $data= $this->fetch_db($update_id);
  $id_categorie_parent=$data['id_categorie_parent'];
$parent_nom_categorie= $this->_get_nom_categorie($id_categorie_parent);
return $parent_nom_categorie;
}
function _get_all_sub_cats_dpdown()
{
//NB:utilisée dans la store_cat_assign
  $mysql_query="select * from categories where id_categorie_parent!=0 order by id_categorie_parent,nom_categorie";
$query = $this->_custom_query($mysql_query);
foreach ($query->result() as $row) {
  $parent_nom_categorie = $this->_get_nom_categorie($row->id_categorie_parent);
$sub_categories[$row->id] = $parent_nom_categorie."->".$row->nom_categorie;
}
if(!isset($sub_categories)){

  $sub_categories="";
}
return $sub_categories;
}

function sort()
{
      $this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){
$number = $this->input->post('number', TRUE);
for ($i=1; $i <= $number ; $i++) { 
  $update_id = $_POST['order'.$i];
  $data['priorite'] = $i;
  $this->_update($update_id, $data);
}
}
}
function _create_sortable_list($id_categorie_parent){


$mysql_query ="select * from categories where id_categorie_parent=$id_categorie_parent order by priorite";
$data['query'] = $this->_custom_query($mysql_query);
$this->load->view('sortable_list',$data);

}
//retourne le nombre de sous catégories pour chaque catégorie
function _count_sub_cats($update_id)
{
$query =$this->get_where_custom('id_categorie_parent',$update_id);

$num_rows = $query->num_rows();
return $num_rows;
}
function _get_nom_categorie($update_id)
{
 $data = $this->fetch_db($update_id);
 $nom_categorie = $data['nom_categorie'];
 return $nom_categorie;
}
function fetch_post(){

$data['nom_categorie'] = $this->input->post('nom_categorie',TRUE);
$data['id_categorie_parent'] = $this->input->post('id_categorie_parent',TRUE);
return $data;
}

function fetch_db($update_id){

    if(!is_numeric($update_id)){
        redirect('securite/error');
    }

$query =$this->get_where($update_id);
foreach ($query->result() as $row) {
    $data['nom_categorie'] = $row->nom_categorie;
    $data['url_categorie'] = $row->url_categorie;
      $data['id_categorie_parent'] = $row->id_categorie_parent;
    
    
}
if (!isset($data)){
    $data="";
}
return $data;
    
}
//fonction privée
function _get_dropdown_options($update_id)
{

  if(!is_numeric($update_id)){
    $update_id=0;
  }
 $options[''] = 'Veuillez Choisir une option';
//crée un tableau de toutes les catégories
  $mysql_query="select * from categories where id_categorie_parent=0 and id!=$update_id";
  $query=$this->_custom_query($mysql_query);
  foreach ($query->result() as $row) {
    $options[$row->id] =$row->nom_categorie;
  }
  return $options;

}
 function  create(){
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){

  $update_id= $this->uri->segment(3);
       $submit =$this->input->post('submit',TRUE);
if($submit =="Cancel"){
    redirect('categories/manage');
}


       if($submit=="Submit"){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nom_categorie','Category Title','required|max_length[240]');
         
           if($this->form_validation->run($this) ==TRUE){
            $data = $this->fetch_post();

 $data['url_categorie']= url_title($data['nom_categorie']);
            if (is_numeric($update_id)){
                //mettre a jour la categorie
                $this->_update($update_id,$data);
$flash_msg="la categorie  est mise a jour avec succes.";

                $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
           $this->session->set_flashdata('item', $value);
redirect('categories/create/'.$update_id);


            }else{
                // insert new item


                $this->_insert($data);
$update_id =$this->get_max(); //recupere l'id du nouveau produit

$flash_msg="La categorie est ins avec succs.";
$value='<div class="alert alert-success" role="alert" >'.$flash_msg.'</div>';

$this->session->set_flashdata('item', $value);
redirect('categories/create/'.$update_id);//remember the flash data

            }
           }
       }

       if((is_numeric($update_id)) && ($submit!="Submit")){
$data =$this->fetch_db($update_id);

       }else{
        $data =$this->fetch_post();

       }

       if(!is_numeric($update_id)){
    $data['headline'] ="Ajouter une nouvelle catégorie";
       }else{
        $data['headline'] ="Mettre a jour la catégorie";
       }


$data['options'] = $this->_get_dropdown_options($update_id);
$data['num_dropdown_options'] = count($data['options']);
//test nb categorie
//echo $data['num_dropdown_options'];die();

$data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');
    
    $data['view_file']="create";
    $this->load->module('templates');
    $this->templates->admin($data);

    }
}


function  manage(){

        $this->load->library('session');
        $this->load->module('securite');

if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){

$id_categorie_parent = $this->uri->segment(3);
if(!is_numeric($id_categorie_parent)){
  $id_categorie_parent = 0;
}
$data['sort_categ'] = TRUE;
$data['id_categorie_parent'] = $id_categorie_parent;
 $data['flash'] = $this->session->flashdata('item');
//charger les categories parent correctement
$data['query'] = $this->get_where_custom('id_categorie_parent', $id_categorie_parent);
        //echo"Manage";

$data['view_file']="manage";
$this->load->module('templates');
$this->templates->admin($data);

    }}
function get($order_by) {
$this->load->model('mdl_categories');
$query = $this->mdl_categories->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_categories');
$query = $this->mdl_categories->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_categories');
$query = $this->mdl_categories->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_categories');
$query = $this->mdl_categories->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_categories');
$this->mdl_categories->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_categories');
$this->mdl_categories->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_categories');
$this->mdl_categories->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_categories');
$count = $this->mdl_categories->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_categories');
$max_id = $this->mdl_categories->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_categories');
$query = $this->mdl_categories->_custom_query($mysql_query);
return $query;
}

}