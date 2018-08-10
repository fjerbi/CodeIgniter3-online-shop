<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Payement extends MX_Controller
{

function __construct() {
parent::__construct();
}

  function  create(){
$this->load->library('session');
$this->load->module('securite');



  $id_produit= $this->uri->segment(3);
       $submit =$this->input->post('submit',TRUE);



       if($submit=="Submit"){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nom_produit','Item Title','required|max_length[240]|callback_item_check');
        
         $this->form_validation->set_rules('quantite_produit','quantity','required|numeric');
         
           if($this->form_validation->run($this) ==TRUE){
            $data = $this->fetch_post();


                // insert new item
                $this->_insert($data);



            
           }
       }



$data['id_produit']=$id_produit;
$data['flash'] = $this->session->flashdata('item');
    
    $data['view_file']="create";
    $this->load->module('templates');
    $this->templates->main_page($data);

    }
function fetch_post(){

$data['nom_produit'] = $this->input->post('nom_produit',TRUE);
$data['quantite_produit'] = $this->input->post('quantite_produit',TRUE);
return $data;
}

function get($order_by) {
$this->load->model('mdl_perfectcontroller');
$query = $this->mdl_perfectcontroller->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_perfectcontroller');
$query = $this->mdl_perfectcontroller->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_perfectcontroller');
$query = $this->mdl_perfectcontroller->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_perfectcontroller');
$query = $this->mdl_perfectcontroller->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_perfectcontroller');
$this->mdl_perfectcontroller->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_perfectcontroller');
$this->mdl_perfectcontroller->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_perfectcontroller');
$this->mdl_perfectcontroller->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_perfectcontroller');
$count = $this->mdl_perfectcontroller->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_perfectcontroller');
$max_id = $this->mdl_perfectcontroller->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_perfectcontroller');
$query = $this->mdl_perfectcontroller->_custom_query($mysql_query);
return $query;
}

}