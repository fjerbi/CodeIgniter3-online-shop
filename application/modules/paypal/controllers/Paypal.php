<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Paypal extends MX_Controller
{

function __construct() {
parent::__construct();
}
function pdf()
{

$this->load->view('payement_info');
// Get output html

$html = $this->output->get_output();

// Load library
$this->load->library('dompdf_gen');

// Convert to PDF
$this->dompdf->load_html($html);
$this->dompdf->render();
$this->dompdf->stream("welcome.pdf");

}


function _display_info($update_id)
{
	$this->load->module('timedate');
	$query=$this->get_where($update_id);
	foreach($query->result() as $row)
	{
		$date_created=$row->date_created;
		$post_info= $row->post_info;
	}
//	$data=parse_str($post_info, $data);
//print_r($data);
	$data=unserialize($post_info);
	$data['date_created']= $this->timedate->get_date($date_created, 'datepicker');

$this->load->view('payement_info', $data);
}
/*
function test()
{
$vars['name'] = 'firas';
$vars['city']= 'Ariana';
$this->ipn_listener($vars);
}
*/
function submit_test()
{
	$test_paypal=$this->_test_paypal();
	$num_orders= $this->input->post('num_orders', TRUE);
	$custom = $this->input->post('custom', TRUE);

if(($test_paypal== FALSE) OR(!is_numeric($num_orders))) {
	die();
}

//simuler une creation commande
$id_paypal=3;
$this->load->module('orders');
$this->load->module('securite');

$this->load->module('basket');
$customer_session_id= $this->securite->_decrypt_string($custom);

	$query = $this->basket->get_where_custom('session_id', $customer_session_id);
	foreach($query->result() as $row)
	{
$basket_data['session_id'] = $row->session_id;
$basket_data['nom_produit'] = $row->nom_produit;
$basket_data['prix'] = $row->prix;
$basket_data['tax'] = $row->tax;
$basket_data['quantite_produit'] = $row->quantite_produit;
$basket_data['id_produit'] = $row->id_produit;
$basket_data['date_ajout'] = $row->date_ajout;
$basket_data['id_acheteur'] = $row->id_acheteur;
$basket_data['address_ip'] = $row->address_ip;
	}


for ($i=0; $i < $num_orders ; $i++) { 
$this->orders->_generate_order($id_paypal, $customer_session_id);

$this->basket->_insert($basket_data);
}

echo "terminé";

}


function ipn_listener()
{
	//c'est l URL qui accepte les variable que paypal a posté
header('HTTP/1.1 200 OK');//passer une information a paypal que tout marche bien


// STEP 1: read POST data
// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
// Instead, read raw POST data from the input stream.
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
    $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
$req = 'cmd=_notify-validate';
if (function_exists('get_magic_quotes_gpc')) {
  $get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
  if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
    $value = urlencode(stripslashes($value));
  } else {
    $value = urlencode($value);
  }
  $req .= "&$key=$value";
}

// Step 2: POST IPN data back to PayPal to validate
$ch = curl_init('https://ipnpb.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
// In wamp-like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "https://curl.haxx.se/docs/caextract.html" and set
// the directory path of the certificate as shown below:
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
if ( !($res = curl_exec($ch)) ) {
  // error_log("Got " . curl_error($ch) . " when processing IPN data");
  curl_close($ch);
  exit;
}
curl_close($ch);

// inspect IPN validation result and act accordingly
if (strcmp ($res, "VERIFIED") == 0) {
  // The IPN is verified, process it
//si tout ce papsse bien, inserer
	$this->load->module('securite');
	$data['date_creation']= time();
;
foreach ($_POST  as $key => $value) {

if($key=='mc_gross')
{
	$customer_session_id = $this->securite->_decrypt_string($value);
	$value= $customer_session_id;
}



	$post_info[$key]=$value ;
}

$data['post_info']= serialize($post_info);
$this->_insert($data);
$max_id = $this->get_max();
$this->load->module('orders');
$this->orders->_generate_order($max_id, $customer_session_id);

} else if (strcmp ($res, "INVALID") == 0) {
  // IPN invalid, log for manual investigation
}




}

function success()
{
	$data['view_file']= 'success';
	$this->load->module('templates');
	$this->templates->main_page($data);
}

function canceled()
{
	$data['view_file']= 'canceled';
	$this->load->module('templates');
	$this->templates->main_page($data);
}
function _test_paypal()
{
	return TRUE;// en cas de test il va passer a sandbox.paypal pour tester, si on passe a au live il faut le changer a false pour passer a paypal.com
}
function _payement_btn($query)
{
	$this->load->module('shipping');
	$this->load->module('items');
	$this->load->module('securite');
	$this->load->module('parametre_web');

	foreach($query->result() as $row)
	{
		$session_id = $row->session_id;
	}
	$test_paypal= $this->_test_paypal();

	if($test_paypal==TRUE){
		$data['form_location']='https://www.sandbox.paypal.com/cgi-bin/webscr';//démo paypal
	}else{
		$data['form_location']='https://www.paypal.com/cgi-bin/webscr';//payement réél paypal
	}

$data['test_paypal']= $test_paypal;
$data['return']= base_url().'paypal/success';
$data['cancel_return']= base_url().'paypal/canceled';
	$data['shipping']= $this->shipping->_shipping();
$data['custom']= $this->securite->_encrypt_string($session_id);

	$data['paypal_email']= $this->parametre_web->_paypal_email();
	$data['currency_code']= $this->parametre_web->_get_currency_code();
	$data['query']= $query;
	$this->load->view('payement_btn', $data);
}
function get($order_by) {
$this->load->model('mdl_paypal');
$query = $this->mdl_paypal->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_paypal');
$query = $this->mdl_paypal->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_paypal');
$query = $this->mdl_paypal->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_paypal');
$query = $this->mdl_paypal->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_paypal');
$this->mdl_paypal->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_paypal');
$this->mdl_paypal->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_paypal');
$this->mdl_paypal->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_paypal');
$count = $this->mdl_paypal->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_paypal');
$max_id = $this->mdl_paypal->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_paypal');
$query = $this->mdl_paypal->_custom_query($mysql_query);
return $query;
}

}