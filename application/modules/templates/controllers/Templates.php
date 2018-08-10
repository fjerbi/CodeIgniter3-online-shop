<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Etc/UTC');
class Templates extends MX_Controller
{

function __construct() {
parent::__construct();
$this->load->library('ip2location_lib');
}


 

function index()
{
	
	if(!isset($data['view_module'])){
		$data['view_module'] = $this->uri->segment(1);
	}

	$this->load->module('securite');
	$data['customer_id'] = $this->securite->_get_user_id();
    $this->load->view('main_page',$data);
}
function blog($data)
{
if(!isset($data['view_module'])){
		$data['view_module'] = $this->uri->segment(1);
		$this->load->view('blog', $data);
}

}
function _page_top()
{
	$this->load->module('securite');
	$user_id = $this->securite->_get_user_id();
	$this->_page_top_left();
	$this->_page_top_mid($user_id);
	//$this->_page_top_right();

}
function _page_top_left()
{
$this->load->view('_page_top_left');
}

function _page_top_mid($user_id)
{

	
if((is_numeric($user_id)) AND ($user_id>0)){
	$view_file='_user_connected'; //quand l'utilisateur est connectée
}else{
	$view_file='_user_not_connected'; //quand l'utilisateur n'est pas co
}
$this->load->view($view_file);

}
function login($data){
if(!isset($data['view_module'])){
$data['view_module'] = $this->uri->segment(1);
	
}
$this->load->view('login_page', $data);
}





function _draw_sub()
{
	$this->load->view('info_sub');
}

function _draw_breadcrumbs($data)
{

	//NB: pour que ça marcha il faut que data cotirne:
	//template, current_page_title,breadcrumbs_array
	$this->load->view('breadcrumbs_main_page', $data);

}

function test(){

    $data="";
$this->main_page($data);
}
function  main_page($data){

	if(!isset($data['view_module'])){
		$data['view_module'] = $this->uri->segment(1);
	}

	$this->load->module('securite');
	$data['customer_id'] = $this->securite->_get_user_id();
    $this->load->view('main_page',$data);

}
   

 

    function  admin($data){


	if(!isset($data['view_module'])){
		$data['view_module'] = $this->uri->segment(1);
	}
	$this->load->module('order_status');
	$data['query_s'] = $this->order_status->get('nom_statut');
        $this->load->view('admin',$data);

    }


}