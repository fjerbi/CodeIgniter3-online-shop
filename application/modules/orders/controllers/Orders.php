<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Orders extends MX_Controller
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


function _auto_notify($update_id)
{
  $this->load->module('user_messages');
  $this->load->module('order_status');
  $this->load->module('securite');
  //notification pour le client qund une mise a jour de statut de commande a éte effectué
  $query=$this->get_where($update_id);
  foreach($query->result() as $row)
  {
    $order_status = $row->statut_commande;
    $order_ref = $row->libelle_commande;
    $shopper_id = $row->id_acheteur;
  }

  $status_title = $this->order_status->_get_status_name($order_status);

  //un message pour le client
  $msg= 'Commande'.' '.$order_ref.' a été mise à jour.';
  $msg.='Le nouveau statut de votre commande est'.$status_title.'.';

//envoyer le messag de notification
$data['sujet']='Mise à jour de votre commande';
$data['message']=$msg;
$data['envoye_a']= $shopper_id;
$data['date_creation']= time();
$data['envoye_par']=0;//administrateur
$data['ouvert']= 0;
$data['code']= $this->securite->generate_random_strings(8);
 $this->user_messages->_insert($data);

}
function _set_to_opened($update_id)
{
  $data['ouvert'] = 1;
  $this->_update($update_id, $data);
}

function _get_order_status_name()
{

// NB: Appelé par /show et recupere le nom du statut
$this->load->module('order_status');
$order_status = $this->uri->segment(3);
$order_status = str_replace('status','', $order_status);

if(!is_numeric($order_status)){
  $order_status = 0;
}
if($order_status==0){
  $nom_statut = 'Commande envoyée';
}else{
  $nom_statut = $this->order_status->_get_status_name($order_status);

}

return $nom_statut;
}

function save_order_status()
{

  $update_id = $this->uri->segment(3);
   $this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){
$submit = $this->input->post('submit', TRUE);
$statut_commande = $this->input->post('statut_commande', TRUE);

if($submit=="Cancel")
{
  //recuperer le statut pour ce  produit
  $query = $this->get_where($update_id);
  foreach($query->result() as $row){
    $statut_commande = $row->statut_commande;
  }
  $target_url = base_url().'orders/show/status'.$statut_commande;

redirect($target_url);
}elseif($submit=='Submit'){
$data['statut_commande']= $statut_commande;
$this->_update($update_id, $data);


$this->_auto_notify($update_id);//notification pour le client lors de la mise à jour


$flash_msg="Le statut de la commande est mise à jour avec succées.";
 $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
 $this->session->set_flashdata('item', $value);
redirect('orders/view/'.$update_id);
}

}
}
function  view(){


$this->load->library('session');
$this->load->module('order_status');
$this->load->module('securite');
$this->load->module('cart');
$this->load->module('timedate');
$this->load->module('users');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){

$update_id = $this->uri->segment(3);
$this->_set_to_opened($update_id);
$query = $this->get_where($update_id);

foreach($query->result() as $row)
{

$data['libelle_commande'] = $row->libelle_commande;
$date_creation = $row->date_creation;
$data['id_paypal'] = $row->id_paypal;
$session_id = $row->session_id;
$data['ouvert'] = $row->ouvert;
$statut_commande = $row->statut_commande;
$data['id_acheteur']= $row->id_acheteur;
$data['mc_gross'] = $row->mc_gross;

}
$data['date_creation']= $this->timedate->get_date($date_creation,'full');
if($statut_commande==0){
  $data['nom_statut'] = 'Commande envoyée';
}else{
  $data['nom_statut'] = $this->order_status->_get_status_name($statut_commande);

}
//recuperer le contenu du panier
$table= 'traces_client';
$data['query_c']=$this->cart->_fetch_cart_contents($session_id,$data['id_acheteur'], $table);


$data['statut_commande'] = $statut_commande;
$data['options']= $this->order_status->_dropdown_options();
$data['users_data'] = $this->users->fetch_db($data['id_acheteur']);
$data['customer_address']= $this->users->_get_client_address($data['id_acheteur'], '<br>');
$data['headline']='ID de la commande'.": ".$data['libelle_commande'];
$data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('account');
    
    $data['view_file']="view";
    $this->load->module('templates');
    $this->templates->admin($data);

    }
}

function  show(){


$this->load->module('custom_pagination');
        $this->load->library('session');
        $this->load->module('securite');

if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){
$use_limit = FALSE;
$mysql_query = $this->_generate_mysql_query($use_limit);
$query = $this->_custom_query($mysql_query);
$total_items = $query->num_rows();

//fetch les commandes pour cette page
$use_limit = TRUE;
$mysql_query = $this->_generate_mysql_query($use_limit);


 $data['flash'] = $this->session->flashdata('item');

$data['query']= $this->_custom_query($mysql_query);
$data['num_rows'] = $data['query']->num_rows();
      //generer la pagination 
$pagination_data['template'] = 'admin';
$pagination_data['target_base_url'] = $this->get_target_pagination_base_url();
$pagination_data['total_rows'] = $total_items;
$pagination_data['offset_segment'] = 4;
$pagination_data['limit'] = $this->get_limit();
$data['pagination'] = $this->custom_pagination->_generate_pagination($pagination_data);


$pagination_data['offset'] = $this->get_offset();
$data['showing_statement'] = $this->custom_pagination->get_showing_statement($pagination_data);
$data['current_order_name']= $this->_get_order_status_name();
$data['view_file']="show";
$this->load->module('templates');
$this->templates->admin($data);

    }
  }

    function get_target_pagination_base_url()
{
  $first_bit = $this->uri->segment(1);
  $second_bit = $this->uri->segment(2);
  $third_bit = $this->uri->segment(3);
  $target_base_url = base_url().$first_bit."/".$second_bit."/".$third_bit;
return $target_base_url;
}

function _generate_mysql_query($use_limit)
{
//NB: use_limit peut etre TRUE ou FALSE

$order_status = $this->uri->segment(3);
$order_status = str_replace('status','', $order_status);

if(!is_numeric($order_status)){
	$order_status = 0;
}

if($order_status>0)
{

  $mysql_query="
SELECT commandes.id,
commandes.libelle_commande,
commandes.date_creation,
commandes.ouvert,
commandes.mc_gross,
utilisateurs.nom,
utilisateurs.prenom,
utilisateurs.societe,
statut_commande.nom_statut
FROM commandes INNER JOIN utilisateurs ON commandes.id_acheteur = utilisateurs.id
INNER JOIN statut_commande ON commandes.statut_commande = statut_commande.id
WHERE statut_commande=$order_status order by date_creation desc

";

}else{

  $mysql_query="
SELECT
commandes.id,
commandes.libelle_commande,
commandes.date_creation,
commandes.ouvert,
commandes.mc_gross,
utilisateurs.nom,
utilisateurs.prenom,
utilisateurs.societe
FROM
commandes 
INNER JOIN utilisateurs ON commandes.id_acheteur = utilisateurs.id
where statut_commande=$order_status
order by date_creation desc

  ";
}

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
  $limit = 20;
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
function test()
{
  $id_paypal =4;
  $this->_get_mc_gross($id_paypal);
}
function _get_mc_gross($id_paypal)
{

  $this->load->module('paypal');
  $query = $this->paypal->get_where($id_paypal);

foreach($query->result() as $row)
{
  $post_info = $row->post_info;
}

if(!isset($post_info)){
  $mc_gross = 0;
}else{
  $post_info = unserialize($post_info);
$mc_gross = $post_info['mc_gross'];
}
return $mc_gross;


}
function get_nom()
{
$nom=$this->_get_shopper_id();


}
function _get_shopper_id($customer_session_id)
{
  $this->load->module('basket');
  $query = $this->basket->get_where_custom('session_id', $customer_session_id);
  foreach($query->result() as $row)
  {
    $id_acheteur = $row->id_acheteur;
  }
if(!isset($id_acheteur)){
  $id_acheteur =0;
}
return $id_acheteur;

}
function _generate_order($id_paypal, $customer_session_id)
{
//cette fonction est appelé depuis le IPN Listener de Paypal quand une commande est prise
	$this->load->module('securite');
	//pour donner a chaque commande un libelle aléatoire composé de 6 caractére
	$libelle_commande=$this->securite->generate_random_strings(6);
	$libelle_commande = strtoupper($libelle_commande);
	$data['libelle_commande'] = $libelle_commande;
	$data['date_creation'] = time();
	$data['id_paypal'] = $id_paypal;
	$data['session_id'] = $customer_session_id;
	$data['ouvert'] = 0;
	$data['statut_commande'] = 0;
  $data['id_acheteur']= $this->_get_shopper_id($customer_session_id);
  $data['mc_gross'] = $this->_get_mc_gross($id_paypal);
	$this->_insert($data);

//transfere depuis le panier vers la table traces_client
	$this->load->module('shopper_track');
	$this->shopper_track->_transfer_from_basket($customer_session_id);

}


function get($order_by) {
$this->load->model('mdl_orders');
$query = $this->mdl_orders->get($order_by);
return $query;
}
function get_with_double_condition($col1, $value1, $col2, $value2) {
$this->load->model('mdl_orders');
$query = $this->mdl_orders->get_with_double_condition($col1, $value1, $col2, $value2);
return $query;
}
function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_orders');
$query = $this->mdl_orders->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_orders');
$query = $this->mdl_orders->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_orders');
$query = $this->mdl_orders->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_orders');
$this->mdl_orders->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_orders');
$this->mdl_orders->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_orders');
$this->mdl_orders->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_orders');
$count = $this->mdl_orders->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_orders');
$max_id = $this->mdl_orders->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_orders');
$query = $this->mdl_orders->_custom_query($mysql_query);
return $query;
}

}