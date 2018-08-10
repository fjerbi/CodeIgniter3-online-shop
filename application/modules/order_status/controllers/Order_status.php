<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Order_status extends MX_Controller
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


function _dropdown_options()
{
  $options['0']='Commande envoyée';
  $query = $this->get('nom_statut');
  foreach($query->result() as $row)
  {
   $options[$row->id]=$row->nom_statut;
  }

return $options;
}



function _get_status_name($update_id)
{
  $query = $this->get_where($update_id);
  foreach($query->result() as $row)
  {
    $nom_statut = $row->nom_statut;
  }
if(!isset($nom_statut)){
  $nom_statut = 'Inconnu';
}
return $nom_statut;

}

function _left_nav_links()
{
  $data['query_s'] = $this->get('nom_statut');
  $this->load->view('left_nav_links', $data);
}
function num_order_status()
{

  $num = $this->db->query('SELECT * FROM statut_commande');
echo $num->num_rows();
}






function fetch_post(){


$data['nom_statut'] = $this->input->post('nom_statut',TRUE);


return $data;
}

function fetch_db($update_id){

    if(!is_numeric($update_id)){
        redirect('securite/error');
    }

$query =$this->get_where($update_id);
foreach ($query->result() as $row) {

$data['nom_statut'] = $row->nom_statut;

    
}
if (!isset($data)){
    $data="";
}
return $data;
    
}

function  create(){
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){


  $update_id= $this->uri->segment(3);
       $submit =$this->input->post('submit',TRUE);
if($submit =="Cancel"){
    redirect('order_status/manage');
}


       if($submit=="Submit"){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nom_statut','Nom Statut','required');
  
           if($this->form_validation->run($this) ==TRUE){
            $data = $this->fetch_post();



            if (is_numeric($update_id)){
                //update
                $this->_update($update_id,$data);
$flash_msg="La commande a éte mise à jour !.";

                $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
           $this->session->set_flashdata('account', $value);
redirect('order_status/create/'.$update_id);


            }else{
                // inserer un nouveau utilisateur
             
                $this->_insert($data);
$update_id =$this->get_max(); //recupere l'id du nouveau produit

$flash_msg="Le statut de la commande a éte inséré.";
$value='<div class="alert alert-success" role="alert" >'.$flash_msg.'</div>';

$this->session->set_flashdata('account', $value);
redirect('order_status/create/'.$update_id);//remember the flash data

            }
           }
       }

       if((is_numeric($update_id)) && ($submit!="Submit")){
$data =$this->fetch_db($update_id);

       }else{
        $data =$this->fetch_post();
       
       }

       if(!is_numeric($update_id)){
    $data['headline'] ="Ajouter une nouvelle commande";
       }else{
        $data['headline'] ="Mettre à jour la commande";
       }

$data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');
    
    $data['view_file']="create";
    $this->load->module('templates');
    $this->templates->admin($data);

    }

}
 function  manage(){

        $this->load->library('session');
        $this->load->module('securite');

if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){

 $data['flash'] = $this->session->flashdata('account');

$data['query'] = $this->get('nom_statut');
        //echo"Manage";

$data['view_file']="manage";
$this->load->module('templates');
$this->templates->admin($data);

    }
}
function get($order_by) {
$this->load->model('mdl_order_status');
$query = $this->mdl_order_status->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_order_status');
$query = $this->mdl_order_status->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_order_status');
$query = $this->mdl_order_status->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_order_status');
$query = $this->mdl_order_status->get_where_custom($col, $value);
return $query;
}
function get_with_double_condition($col1, $value1, $col2, $value2) {
$this->load->model('mdl_order_status');
$query = $this->mdl_order_status->get_with_double_condition($col1, $value1, $col2, $value2);
return $query;
}

function _insert($data) {
$this->load->model('mdl_order_status');
$this->mdl_order_status->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_order_status');
$this->mdl_order_status->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_order_status');
$this->mdl_order_status->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_order_status');
$count = $this->mdl_order_status->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_order_status');
$max_id = $this->mdl_order_status->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_order_status');
$query = $this->mdl_order_status->_custom_query($mysql_query);
return $query;
}



}