<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Homepage_offer extends MX_Controller
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


function _draw_offers($data)
{


$block_id = $data['block_id'];
$theme = $data['theme'];
$item_segments = $data['item_segments'];
$mysql_query ="

SELECT produits.*
FROM offres INNER JOIN offre ON offres.block_id=offre.id
INNER JOIN produits ON offres.id_produit = produits.id
WHERE offres.block_id=$block_id

";

$query = $this->_custom_query($mysql_query);
$num_rows = $query->num_rows();
if($num_rows>0)
{
    $data['query'] = $query;
    $data['theme'] = $theme;
    $data['item_segments'] = $item_segments;
    $this->load->view('offers', $data);
}

}
function _delete_for_item($block_id)

{

    $mysql_query = "delete from offres where block_id=$block_id";
    $query = $this->_custom_query($mysql_query);
}
function delete($update_id){

    if(!is_numeric($update_id)) {
    redirect('securite/error');
}

$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){

$query = $this->get_where($update_id);
foreach ($query->result() as $row) {
    $block_id = $row->block_id;
}
$this->_delete($update_id);

$flash_msg="Le produit est supp avec succs.";
$value='<div class="alert alert-success" role="alert" >'.$flash_msg.'</div>';

$this->session->set_flashdata('item', $value);

redirect('homepage_offer/update/'.$block_id);
}
}
function is_available_item($id_produit)
{
if(!is_numeric($id_produit)){
    return FALSE;
}
$this->load->module('items');
$query = $this->items->get_where($id_produit);
$num_rows = $query->num_rows();
if($num_rows>0){
    return TRUE;
}else{
    return FALSE;
}

}

function submit($update_id)
{

    if(!is_numeric($update_id)) {
    redirect('securite/error');
}

$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){

$submit = $this->input->post('submit', TRUE);
$id_produit = trim($this->input->post('id_produit', TRUE));
if($submit=="Valider"){
    redirect('homepage_offer/create/'.$update_id);
}elseif($submit=="Submit"){
// si l'id du produit est disponible
$is_available_item = $this->is_available_item($id_produit);
if($is_available_item==FALSE){

    $flash_msg="L'id du produit que vous avez insérer est invalide ou le produit n'existe pas.";
$value='<div class="alert alert-danger" role="alert" >'.$flash_msg.'</div>';
$this->session->set_flashdata('item', $value);
redirect('homepage_offer/update/'.$update_id);
}

    if($id_produit!=""){
        $data['block_id'] = $update_id;
    $data['id_produit'] = $id_produit;
$this->_insert($data);


$flash_msg="L'offre est insérer avec succées.";
$value='<div class="alert alert-success" role="alert" >'.$flash_msg.'</div>';

$this->session->set_flashdata('item', $value);
    }
}
redirect('homepage_offer/update/'.$update_id);
}
}
    function  update($update_id){
//si l'id est un numéro:astuce sécurité
if(!is_numeric($update_id)) {
    redirect('securite/error');
}

$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){
$data['query'] = $this->get_where_custom('block_id',$update_id);
$data['num_rows'] = $data['query']->num_rows();



$data['headline'] = "Mettre à jour l'offre";
  $data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');
    
    $data['view_file']="update";
    $this->load->module('templates');
    $this->templates->admin($data);

     
    }
}

function get($order_by) {
$this->load->model('mdl_homepage_offer');
$query = $this->mdl_homepage_offer->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_homepage_offer');
$query = $this->mdl_homepage_offer->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_homepage_offer');
$query = $this->mdl_homepage_offer->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_homepage_offer');
$query = $this->mdl_homepage_offer->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_homepage_offer');
$this->mdl_homepage_offer->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_homepage_offer');
$this->mdl_homepage_offer->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_homepage_offer');
$this->mdl_homepage_offer->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_homepage_offer');
$count = $this->mdl_homepage_offer->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_homepage_offer');
$max_id = $this->mdl_homepage_offer->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_homepage_offer');
$query = $this->mdl_homepage_offer->_custom_query($mysql_query);
return $query;
}

}