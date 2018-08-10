<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends MX_Controller
{

function __construct() {
parent::__construct();
}

function _check_session_id($checkout_token)
{

$session_id= $this->_session_id_from_token($checkout_token);

if($session_id==''){
	redirect(base_url());
}
//vérifier si la session est verifié dans la table (basket)
$this->load->module('basket');
$query= $this->basket->get_where_custom('session_id', $session_id);
$num_rows = $query->num_rows();
if($num_rows<1){
	redirect(base_url());
}
return $session_id;

}
function _checkout_token($session_id)
{

	$this->load->module('securite');
$encrypted_string= $this->securite->_encrypt_string($session_id);

//
$checkout_token = str_replace('+', '-plus-', $encrypted_string);
$checkout_token = str_replace('/', '-fwrd-', $checkout_token);
$checkout_token = str_replace('=', '-eqls-', $checkout_token);

return $checkout_token;
}


function _session_id_from_token($checkout_token)
{

	$this->load->module('securite');

$session_id = str_replace('-plus-', '+', $checkout_token);
$session_id = str_replace('-fwrd-', '/', $session_id);
$session_id = str_replace('-eqls-', '=', $session_id);

$session_id= $this->securite->_decrypt_string($session_id);

return $session_id;


}

	
	
	

function _generate_guest_account($checkout_token)
{
	$this->load->module('securite');
$this->load->module('users');
	$customer_session_id= $this->_session_id_from_token($checkout_token);


$ref=$this->securite->generate_random_strings(4);
	$data['pseudo']='Visiteur'.$ref;
	$data['nom']='Visiteur';
	$data['prenom']='compte';
	$data['date_creation']= time();
	$data['mot_de_passe']= $checkout_token;

$this->users->_insert($data);


$new_account_id= $this->users->get_max();
//mettre à jour la table panier

$mysql_query="update panier set id_acheteur=$new_account_id";
$mysql_query.=" where session_id='$customer_session_id'";
$query = $this->users->_custom_query($mysql_query);

}
function choice_submit()
{

$submit = $this->input->post('submit', TRUE);
if($submit=="Non Continuer ma visite") {
	$checkout_token = $this->input->post('checkout_token', TRUE);

	$this->_generate_guest_account($checkout_token);
redirect('cart/index/'.$checkout_token);

}
elseif ($submit=="Oui, Je veux Créer mon compte") {
	redirect('youraccount/createaccount');
}
}
function checkout()
{



    
      $this->load->module('securite');
	$id_acheteur = $this->securite->_get_user_id();
//si il est connecté
	if(is_numeric($id_acheteur)){
		redirect('cart');
	}
	
   $data['checkout_token'] = $this->uri->segment(3);
$data['flash'] = $this->session->flashdata('item');
    $data['view_file']="checkout";
    $this->load->module('templates');
    $this->templates->main_page($data);
}
function _create_checkout_btn($query)
{
	$data['query'] = $query;
	$this->load->module('securite');
	//si il n'est pas co vs il est co
	$id_acheteur = $this->securite->_get_user_id();
	$third_bit = $this->uri->segment(3);



	if(!is_numeric($id_acheteur) AND ($third_bit=='') ){
		$this->_fake_checkout_btn($query);
	}else{
		$this->_real_checkout_btn($query);
	}
}
function _real_checkout_btn($query)
{
	$this->load->module('paypal');
	$this->paypal->_payement_btn($query);
}

function _fake_checkout_btn($query)
{
	foreach($query->result() as $row)
	{
		$session_id = $row->session_id;
	}
	$data['checkout_token']= $this->_checkout_token($session_id);
	$this->load->view('register_btn', $data);
}
function _cart_contents($query, $user_type)
{
$this->load->module('shipping');
if($user_type=='public'){
	$view_file='public_cart';
}else{
	$view_file='admin_cart';
}

$data['shipping']= $this->shipping->_shipping();

$data['query'] = $query;
$this->load->view($view_file, $data);
}
function index()
{
	$data['flash'] = $this->session->flashdata('item');
    $data['view_file']="cart";

$third_bit = $this->uri->segment(3);
if($third_bit!=''){
	//vérifier que le token est valide, et retourner l'id de la session (session_id)
$session_id = $this->_check_session_id($third_bit);
}else{
	$session_id = $this->session->session_id;
}
    

    $this->load->module('securite');
	$id_acheteur = $this->securite->_get_user_id();

	if(!is_numeric($id_acheteur)){
		$id_acheteur = 0;
	}
	$table= 'panier';
    $data['query']=$this->_fetch_cart_contents($session_id, $id_acheteur, $table);
   //compter le nombre de produits dans le panier
    $data['num_rows']= $data['query']->num_rows();
    $data['showing_statement']= $this->_get_statement($data['num_rows']);
    $this->load->module('templates');
    $this->templates->main_page($data);
}

function _get_statement($num_items)
{
	if($num_items==1){
		$showing_statement="<center><b>Vous avez un seul produit dans votre Panier.</b></center>";
	}else{
		$showing_statement="<center><h1> Vous avez"." ".$num_items." "."produits dans votre panier. </h1></center>";
	}
	return $showing_statement;
}
function _fetch_cart_contents($session_id, $id_acheteur, $table)
{
//parcourir le contenu du panier(cart)
	$this->load->module('basket');
	$this->load->module('parametre_web');

$mysql_query= "

SELECT $table.*,
produits.image_mini,

produits.status,
produits.url_produit
FROM $table LEFT JOIN produits ON $table.id_produit = produits.id ";



	if($id_acheteur>0){
		//si l'utilisateur se connecte les données dans le panier seront toujours enregistré dedans
	$condition=  "WHERE $table.id_acheteur=$id_acheteur";

}else{
	$condition="WHERE $table.session_id='$session_id'";
}
$mysql_query.=$condition;
$query = $this->basket->_custom_query($mysql_query);
return $query;

}
//fonction privée
function _add_to_cart($id_produit)
{
$data['id_produit']= $id_produit;
$this->load->view('add_tocart', $data);


}
}