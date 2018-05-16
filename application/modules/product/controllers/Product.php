<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Product extends MX_Controller
{

function __construct() {
parent::__construct();
}

function list()
{
	//cree l id du produits
	
	$url_produit = $this->uri->segment(3);
	$this->load->module('items');
	$item_id = $this->items->_get_item_id_from_item_url($url_produit);
	$this->items->view($item_id);
}

}