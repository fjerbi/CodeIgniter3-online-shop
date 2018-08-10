<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class User_messages extends MX_Controller
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
function fix()
{
  $this->load->module('securite');
  $query = $this->get('id');
  foreach($query->result() as $row)
  {
    $data['code'] = $this->securite->generate_random_strings(8);
    $this->_update($row->id, $data);

  }
  echo "fini!";

}

function _get_data_from_code($customer_id, $code)
{
  //
  $query = $this->get_where_custom('code', $code);
  $num_rows = $query->num_rows();

  foreach ($query->result() as $row ) {
 
    $data['sujet'] = $row->sujet;
    $data['message'] = $row->message;
    $data['envoye_a'] = $row->envoye_a;
    $data['date_creation'] = $row->date_creation;
    $data['ouvert'] = $row->ouvert;
    $data['envoye_par'] = $row->envoye_par;
    $data['urgent'] = $row->urgent;

  }
  //si le code est vérifié et l'utilisateur est autorisé de répondre et voir
    if(($num_rows<1) OR ($customer_id!=$data['envoye_a'])){
    redirect('securite/error');
  }
  return $data;

}


function _create_user_inbox($customer_id)
{


    $folder_type = "BOITE DE RECEPTION";
    $data['customer_id'] = $customer_id;
  $data['query'] = $this->_fetch_user_messages($folder_type, $customer_id);
  $data['folder_type'] = ucfirst($folder_type);
 $data['flash'] = $this->session->flashdata('item');
 $this->load->view('user_inbox',$data);
}

function  create(){
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){



  $update_id= $this->uri->segment(3);
       $submit =$this->input->post('submit',TRUE);

      $this->load->module('timedate');
      


if($submit =="Cancel"){
    redirect('user_messages/inbox');
}


       if($submit=="Submit"){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('sujet','sujet','required|max_length[250]');
   $this->form_validation->set_rules('envoye_a','Recepient','required');
       
           $this->form_validation->set_rules('message','Message','required');
           



           if($this->form_validation->run($this) ==TRUE){
           	


            $data = $this->fetch_post();


//convertir la date en variable unix timestamp

$data['date_creation'] = time();
$data['envoye_par'] = 0;//administrateur
$data['ouvert'] = 0;
$data['code'] = $this->securite->generate_random_strings(8);
//die();
                // inserer un noveau message
                $this->_insert($data);


$flash_msg="Le message est envoyé avec succées.";
$value='<div class="alert alert-success" role="alert" >'.$flash_msg.'</div>';

$this->session->set_flashdata('item', $value);
redirect('user_messages/inbox');//memoriser le flash data

            
           }
       }

       if((is_numeric($update_id)) && ($submit!="Submit")){
$data =$this->fetch_db($update_id);
$data['message'] =" Salutation
-------------------------------------<br>


Merci pour votre message !! Veuillez répondre ici".$data['message'];
       }else{
        $data =$this->fetch_post();
        
       }

       if(!is_numeric($update_id)){
    $data['headline'] ="Composer un nouveau message";
       }else{
        $data['headline'] ="Répondre au message";
       }
$data['options'] = $this->_fetch_users();
$data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('item');
    
    $data['view_file']="create";
    $this->load->module('templates');
    $this->templates->admin($data);

    }
}

function _fetch_users()
{
	//chercher les utilisateurs pour le dropdown
$options[''] = "Veuillez choisir un Destinataire.. ";
	$this->load->module('users');
	$query = $this->users->get('prenom');
	foreach ($query->result() as $row) {
$customer_name = $row->nom." ".$row->prenom;

$company_length = strlen($row->societe);
if($company_length>2){
	$customer_name.= " de ".$row->societe;
}
$customer_name = trim($customer_name);
		if($customer_name!=""){
		$options[$row->id]= $customer_name;
		}

	} 
	
	return $options;
}
function fetch_post(){

$data['sujet'] = $this->input->post('sujet',TRUE);
$data['message'] = $this->input->post('message',TRUE);
$data['envoye_a'] = $this->input->post('envoye_a',TRUE);

return $data;
}

function fetch_db($update_id){

    if(!is_numeric($update_id)){
        redirect('securite/error');
    }

$query =$this->get_where($update_id);
foreach ($query->result() as $row) {
    $data['sujet'] = $row->sujet;
    $data['message'] = $row->message;
    $data['envoye_a'] = $row->envoye_a;
    $data['date_creation'] = $row->date_creation;
    $data['ouvert'] = $row->ouvert;
    $data['envoye_par'] = $row->envoye_par;
    $data['urgent'] = $row->urgent;
   
   
    
}
}
function view()
{
	$this->load->library('session');
        $this->load->module('securite');

if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){


	$update_id = $this->uri->segment(3);
	$this->_set_to_opened($update_id);
	

$data['update_id'] = $update_id;
  $data['headline'] = "Message D'iD n°".$update_id;
	$data['query'] = $this->get_where($update_id);
    $data['flash'] = $this->session->flashdata('item');
$data['view_file']="view";
$this->load->module('templates');
$this->templates->admin($data);

}
}
//si le message est ouvert la couleur de l'icone change en changeant la valeur de "ouvert de 0 à 1"
function _set_to_opened($update_id)
{
	$data['ouvert'] = 1;
	$this->_update($update_id, $data);
}
function inbox()
{
	$this->output->enable_profiler(TRUE);
	    $this->load->library('session');
        $this->load->module('securite');

if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){

	$folder_type = "inbox";
	$data['query'] = $this->_fetch_messages($folder_type);
	$data['folder_type'] = ucfirst($folder_type);
 $data['flash'] = $this->session->flashdata('item');


      

$data['view_file']="view_messages";
$this->load->module('templates');
$this->templates->admin($data);
}
}

function _fetch_messages($folder_type)
{

	$mysql_query="
SELECT messages.*,
utilisateurs.nom,
utilisateurs.prenom,
utilisateurs.societe
FROM messages INNER JOIN utilisateurs ON messages.envoye_par= utilisateurs.id 
WHERE messages.envoye_a=0
order by messages.date_creation desc

";




	$query = $this->_custom_query($mysql_query);
	return $query;
}




function _fetch_user_messages($folder_type, $customer_id)
{

  $mysql_query="
SELECT messages.*,
utilisateurs.nom,
utilisateurs.prenom,
utilisateurs.societe
FROM messages INNER JOIN utilisateurs ON messages.envoye_a= utilisateurs.id 
WHERE messages.envoye_a=$customer_id
order by messages.date_creation desc

";




  $query = $this->_custom_query($mysql_query);
  return $query;

}
function get($order_by) {
$this->load->model('mdl_user_messages');
$query = $this->mdl_user_messages->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_user_messages');
$query = $this->mdl_user_messages->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_user_messages');
$query = $this->mdl_user_messages->get_where($id);
return $query;
}

function get_with_double_condition($col1, $value1, $col2, $value2) {
$this->load->model('mdl_user_messages');
$query = $this->mdl_user_messages->get_with_double_condition($col1, $value1, $col2, $value2);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_user_messages');
$query = $this->mdl_user_messages->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_user_messages');
$this->mdl_user_messages->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_user_messages');
$this->mdl_user_messages->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_user_messages');
$this->mdl_user_messages->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_user_messages');
$count = $this->mdl_user_messages->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_user_messages');
$max_id = $this->mdl_user_messages->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_user_messages');
$query = $this->mdl_user_messages->_custom_query($mysql_query);
return $query;
}

}