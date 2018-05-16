<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Myprofile extends MX_Controller
{

function __construct() {
parent::__construct();
}


function myprofile()
{
  $this->load->module('securite');
   $this->load->module('users');

        $this->load->library('session');



  $this->securite->_check_logged_in();

  $data['flash'] = $this->session->flashdata('item');

    $data['view_file']="myprofile";
    $this->load->module('templates');
    $this->templates->main_page($data);

}
function get($order_by) {
$this->load->model('mdl_myprofile');
$query = $this->mdl_myprofile->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_myprofile');
$query = $this->mdl_myprofile->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_myprofile');
$query = $this->mdl_myprofile->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_myprofile');
$query = $this->mdl_myprofile->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_myprofile');
$this->mdl_myprofile->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_myprofile');
$this->mdl_myprofile->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_myprofile');
$this->mdl_myprofile->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_myprofile');
$count = $this->mdl_myprofile->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_myprofile');
$max_id = $this->mdl_myprofile->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_myprofile');
$query = $this->mdl_myprofile->_custom_query($mysql_query);
return $query;
}

}