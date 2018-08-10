<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home_offers extends MX_Controller
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

        if(!is_numeric($update_id)) {
    redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){

$submit = $this->input->post('submit',TRUE);
if($submit=="Cancel"){
    redirect('home_offers/create/'.$update_id);
}elseif ($submit="Oui") {
    $this->_process_delete($update_id);
$flash_msg="L'offre est supprimée avec succées.";
 $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
 $this->session->set_flashdata('item', $value);
redirect('home_offers/manage');
}


    }
}
function _process_delete($update_id)
{

//suppression de tout les produits associé avec cette offre

  $mysql_query = "delete from offres where block_id=$update_id";
  $query = $this->_custom_query($mysql_query);

//suppression de la page
$this->_delete($update_id);

}

function deleteconf($update_id)
{

       if(!is_numeric($update_id)) {
    redirect('securite/error');
}
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){
$data['headline'] = "Supprimer l'offre";
  $data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');
    $data['view_file']="deleteconf";
    $this->load->module('templates');
    $this->templates->admin($data);

}
}
function _create_sortable_list(){


$mysql_query ="select * from offre order by priorite";
$data['query'] = $this->_custom_query($mysql_query);
$this->load->view('sortable_list',$data);
 
}
function _create_offers()
{

  //creation des offre dans la page d'accueil
  $data['query'] = $this->get('priorite');
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
$data['view_module']="home_offers";
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
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){
$number = $this->input->post('number', TRUE);
for ($i=1; $i <= $number ; $i++) { 
  $update_id = $_POST['order'.$i];
  $data['priorite'] = $i;
  $this->_update($update_id, $data);
}
}
}

//retourne le nombre de sous catégories pour chaque catégorie

function _get_titre_block($update_id)
{
 $data = $this->fetch_db($update_id);
 $titre_block = $data['titre_block'];
 return $titre_block;
}

function fetch_post(){

$data['titre_block'] = $this->input->post('titre_block',TRUE);

return $data;
}
function fetch_db($update_id){

    if(!is_numeric($update_id)){
        redirect('securite/error');
    }

$query =$this->get_where($update_id);
foreach ($query->result() as $row) {
    $data['titre_block'] = $row->titre_block;
  
      
    
    
}
if (!isset($data)){
    $data="";
}
return $data;
    
}

 function  create(){
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){


  $update_id= $this->uri->segment(3);
       $submit =$this->input->post('submit',TRUE);
if($submit =="Cancel"){
    redirect('home_offers/manage');
}


       if($submit=="Submit"){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('titre_block','Block Title','required|max_length[240]');
         
           if($this->form_validation->run($this) ==TRUE){
            $data = $this->fetch_post();


            if (is_numeric($update_id)){
                //mettre a jour la categorie
                $this->_update($update_id,$data);
$flash_msg="l'offre  est mise a jour avec succeés.";

                $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
           $this->session->set_flashdata('item', $value);
redirect('home_offers/create/'.$update_id);


            }else{
                // insert new item


                $this->_insert($data);
$update_id =$this->get_max(); //recupere l'id du nouveau produit

$flash_msg="L'offre est insérée avec succs.";
$value='<div class="alert alert-success" role="alert" >'.$flash_msg.'</div>';

$this->session->set_flashdata('item', $value);
redirect('home_offers/create/'.$update_id);//remember the flash data

            }
           }
       }

       if((is_numeric($update_id)) && ($submit!="Submit")){
$data =$this->fetch_db($update_id);

       }else{
        $data =$this->fetch_post();

       }

       if(!is_numeric($update_id)){
    $data['headline'] ="Ajouter une nouvelle offre";
       }else{
        $titre_block = $this->_get_titre_block($update_id);
        $data['headline'] ="Mettre à jour l'offre :".$titre_block;
       }

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

if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){
$data['sort_categ'] = TRUE;
 $data['flash'] = $this->session->flashdata('item');
$data['view_file']="manage";
$this->load->module('templates');
$this->templates->admin($data);
}
    }
function get($order_by) {
$this->load->model('mdl_home_offers');
$query = $this->mdl_home_offers->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_home_offers');
$query = $this->mdl_home_offers->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_home_offers');
$query = $this->mdl_home_offers->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_home_offers');
$query = $this->mdl_home_offers->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_home_offers');
$this->mdl_home_offers->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_home_offers');
$this->mdl_home_offers->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_home_offers');
$this->mdl_home_offers->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_home_offers');
$count = $this->mdl_home_offers->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_home_offers');
$max_id = $this->mdl_home_offers->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_home_offers');
$query = $this->mdl_home_offers->_custom_query($mysql_query);
return $query;
}

}