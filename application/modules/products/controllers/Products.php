<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Products extends MX_Controller
{

function __construct() {
parent::__construct();
}

function lists()
{
	
	//savoir l id du category
	$url_categorie = $this->uri->segment(3);
	$this->load->module('categories');
	$id_cat = $this->categories->_get_cat_id_from_url_categorie($url_categorie);
	
	$this->categories->view($id_cat);
}

}