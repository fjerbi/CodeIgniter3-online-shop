<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Shopper_track extends MX_Controller
{

function __construct() {
parent::__construct();
}
function get_with_double_condition($col1, $value1, $col2, $value2) {
$this->load->model('mdl_shopper_track');
$query = $this->mdl_shopper_track->get_with_double_condition($col1, $value1, $col2, $value2);
return $query;
}

function _transfer_from_basket($customer_session_id)
{
	$this->load->module('basket');
	$query = $this->basket->get_where_custom('session_id', $customer_session_id);
	foreach($query->result() as $row)
	{
$data['session_id'] = $row->session_id;
$data['nom_produit'] = $row->nom_produit;
$data['prix'] = $row->prix;
$data['tax'] = $row->tax;
$data['quantite_produit'] = $row->quantite_produit;
$data['id_produit'] = $row->id_produit;
$data['date_ajout'] = $row->date_ajout;
$data['id_acheteur'] = $row->id_acheteur;
$data['address_ip'] = $row->address_ip;

$this->_insert($data);



	}
	$mysql_query="delete from panier where session_id='$customer_session_id'";
	$query=$this->_custom_query($mysql_query);
}

function get($order_by) {
$this->load->model('mdl_shopper_track');
$query = $this->mdl_shopper_track->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_shopper_track');
$query = $this->mdl_shopper_track->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_shopper_track');
$query = $this->mdl_shopper_track->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_shopper_track');
$query = $this->mdl_shopper_track->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_shopper_track');
$this->mdl_shopper_track->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_shopper_track');
$this->mdl_shopper_track->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_shopper_track');
$this->mdl_shopper_track->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_shopper_track');
$count = $this->mdl_shopper_track->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_shopper_track');
$max_id = $this->mdl_shopper_track->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_shopper_track');
$query = $this->mdl_shopper_track->_custom_query($mysql_query);
return $query;
}

}