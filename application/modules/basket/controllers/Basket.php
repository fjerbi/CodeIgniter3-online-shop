<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Basket extends MX_Controller
{

function __construct() {
parent::__construct();
}

function _cart_errors($data)
{
	$this->load->module('shopper_track');
	//N.B: assuerer qu'il ny'a aucun produit dans la table traces_client
	$old_session_is=['session_id'];
	$id_acheteur=$data['id_acheteur'];
	$col1= 'session_id';
	$value1= $old_session_is;
	$col2= 'id_acheteur';
	$value2 =$id_acheteur;
	$query= $this->shopper_track->get_with_double_condition($col1, $value1, $col2, $value2);
	$num_rows = $query->num_rows();
$num_rows=1;
	if($num_rows>0)
	{
		session_regenerate_id();
$new_session_id = $this->session->session_id;
		$data['session_id']= $new_session_id;
	}
return $data;
}
function get_with_double_condition($col1, $value1, $col2, $value2) {
$this->load->model('mdl_basket');
$query = $this->mdl_basket->get_with_double_condition($col1, $value1, $col2, $value2);
return $query;
}

function remove()
{
	$update_id = $this->uri->segment(3);
	$autorised = $this->_autorise_remove($update_id);

if($autorised== FALSE){
	redirect('cart');
}

	$update_id = $this->uri->segment(3);
	$this->_delete($update_id);
	
	redirect('cart');
}
//vérifier si la personne est autorisé de supprimer le produit
function _autorise_remove($update_id)
{
$query = $this->get_where($update_id);
foreach($query->result() as $row)
{
	$session_id = $row->session_id;
	$id_acheteur = $row->id_acheteur;
}
if(!isset($id_acheteur)){
	return FALSE;
}
	$user_session_id = $this->session->session_id;
	
	$this->load->module('securite');
	$user_id_acheteur = $this->securite->_get_user_id();

	if(($session_id==$user_session_id) OR ($id_acheteur==$user_id_acheteur)){
		//ça marche
		return TRUE;
	}else{
		//ça marche pas
		return FALSE; 
	}

}
function add_to_basket()
{
	$submit = $this->input->post('submit',TRUE);
	 if($submit=="Submit"){
        $this->load->library('form_validation');
        
         $this->form_validation->set_rules('quantite_produit','Item Quantity','required|numeric');
          $this->form_validation->set_rules('id_produit','id_produit ','numeric');
         
          
           if($this->form_validation->run($this) ==TRUE){

//marche

           	$data = $this->_search_data();
           	//eviter les conflit entre es panier
           	$data=$this->_cart_errors($data);
           	$this->_insert($data);
           	//echo "test ça marche";
           	redirect('cart');
}else{
	//si ca marche pas 
	$refer_url = $_SERVER['HTTP_REFERER'];
	$error_msg= validation_errors("<p style='color: orange;'>","</p>");

	
 
 $this->session->set_flashdata('item', $error_msg);
 redirect($refer_url);

}

}
}

function _search_data()
{
	//récuperer tous les données
	$this->load->module('items');
	$this->load->module('securite');

	$id_produit = $this->input->post('id_produit', TRUE);
	$item_data = $this->items->fetch_db($id_produit);
	$prix_produit = $item_data['prix_produit'];
	$quantite_produit = $this->input->post('quantite_produit', TRUE);

	
	$id_acheteur = $this->securite->_get_user_id();
	//si l'utilisateur(shopper) n'est pas connecté(il n'a pas un id)
	if(!is_numeric($id_acheteur)){
		$id_acheteur=0;
	}




	$data['session_id'] = $this->session->session_id;	
$data['nom_produit'] = $item_data['nom_produit'];
$data['prix'] = $prix_produit;
$data['tax'] ='0';
$data['id_produit'] = $id_produit;

$data['quantite_produit'] = $quantite_produit;

$data['date_ajout'] =time();
$data['id_acheteur'] = $id_acheteur;
$data['address_ip'] = $this->input->ip_address();
return $data;
}


function test()
{
	$session_id = $this->session->session_id;
	echo $session_id;
	echo "<hr>";
	$this->load->module('securite');
	$id_acheteur = $this->securite->_get_user_id();
	echo "tu es l acheteur avec ID".$id_acheteur;

session_regenerate_id();

$session_id = $this->session->session_id;
	echo $session_id;
	echo "<hr>";
	$this->load->module('securite');
	$id_acheteur = $this->securite->_get_user_id();
	echo "tu es l acheteur avec ID".$id_acheteur;


}
function get($order_by) {
$this->load->model('mdl_basket');
$query = $this->mdl_basket->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_basket');
$query = $this->mdl_basket->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_basket');
$query = $this->mdl_basket->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_basket');
$query = $this->mdl_basket->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_basket');
$this->mdl_basket->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_basket');
$this->mdl_basket->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_basket');
$this->mdl_basket->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_basket');
$count = $this->mdl_basket->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_basket');
$max_id = $this->mdl_basket->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_basket');
$query = $this->mdl_basket->_custom_query($mysql_query);
return $query;
}



}