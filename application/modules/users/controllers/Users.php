<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users extends MX_Controller
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


function _get_client_address($update_id, $delimiter)
{
  //retourne l'adresse du client(acheteur)
  $data = $this->fetch_db($update_id);
  $address ='';
  if($data['address1']!=''){
$address.=$data['address1'];
$address.=$delimiter;
  }

    if($data['address2']!=''){
$address.=$data['address2'];
$address.=$delimiter;
  }
    if($data['ville']!=''){
$address.=$data['ville'];
$address.=$delimiter;
  }

    if($data['pays']!=''){
$address.=$data['pays'];
$address.=$delimiter;
  }
    if($data['code_postal']!=''){
$address.=$data['code_postal'];
$address.=$delimiter;
  }
return $address; 
}
function actif()
{
 $update_id = $this->uri->segment(3);

$query = $this->get_where($update_id);

foreach($query->result() as $row)
{

$data['active'] = $row->active;

 
if($data['active'] =='1'){
  return TRUE;
}else{
  return FALSE;
}


}
}
function num_users()
{

  $num = $this->db->query('SELECT * FROM utilisateurs');
echo $num->num_rows();
}
function _generate_token($update_id)
{
$data = $this->fetch_db($update_id);
$date_creation = $data['date_creation'];
$derniere_connexion = $data['derniere_connexion'];
$mot_de_passe = $data['mot_de_passe'];


$pword_length = strlen($mot_de_passe);
$start_point = $pword_length-6;
$last_six_chars = substr($mot_de_passe, $start_point,6);

if(($pword_length>5) AND ($derniere_connexion>0)){
  $token = $last_six_chars.$date_creation.$derniere_connexion;
}else{
  $token ='';
}

return $token;

}

function _get_user_id_from_token($token)
{
//les  6 derniers charactére du mot de passe
$last_six_chars = substr($token, 0,6);
$date_creation = substr($token, 6,10);
$derniere_connexion = substr($token, 16,10);

$sql = "SELECT * FROM utilisateurs WHERE date_creation = ? AND mot_de_passe Like ? AND derniere_connexion = ?";
$query = $this->db->query($sql, array($date_creation, '%'.$last_six_chars, $derniere_connexion));
foreach($query->result() as $row)
{
  $customer_id = $row->id;
}
if(!isset($customer_id)){
  $customer_id = 0;
}

return $customer_id;

}



function _get_customer_name($update_id, $optional_user_data = NULL)
{

  if(!isset($optional_user_data)){

  $data = $this->fetch_db($update_id);
}else{
  $data['nom']=$optional_user_data['nom'];
  $data['prenom']=$optional_user_data['prenom'];
  $data['societe']=$optional_user_data['societe'];
}

  if ($data=="") {
    $customer_name ="Inconnu";
  }else{
  $nom = trim(ucfirst($data['nom']));
  $prenom = trim(ucfirst($data['prenom']));
    $societe = trim(ucfirst($data['societe']));

    $company_length = strlen($societe);
    if($company_length>2){
      $customer_name = $societe;
    }else{
      $customer_name = $nom." ".$prenom;
    }
  }


  return $customer_name;
}


function test2()
{

$pseudo= $this->session->userdata('pseudo');
if($pseudo!=""){
  echo "<h1>Salut $pseudo</h1>";
}

}

function  update_pword(){
$this->load->library('session');
$this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin()){
//echo"Test01";die();


  $update_id= $this->uri->segment(3);
       $submit =$this->input->post('submit',TRUE);

if(!is_numeric($update_id)){
	redirect('users/manage');
}elseif ($submit=="Cancel") {
	redirect('users/create/'.$update_id); 
}

if($submit =="Cancel"){
    redirect('users/manage');
}


       if($submit=="Submit"){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('mot_de_passe','Password','required|min_length[8]|max_length[55]');
        $this->form_validation->set_rules('repeat_pword','Repeat Password','required|matches[mot_de_passe]');
      
           if($this->form_validation->run($this) ==TRUE){
           
$mot_de_passe= $this->input->post('mot_de_passe',TRUE);
$this->load->module('securite');
$data['mot_de_passe']= $this->securite->_hash_string($mot_de_passe);


            
                //update
         $this->_update($update_id,$data);
$flash_msg="le mot de passe du compte est mise a jour avec succes.";

                $value='<div class="alert alert-success" role="alert">le mot de passe du compte est mise a jour avec succes</div>';
           $this->session->set_flashdata('account', $value);
redirect('users/create/'.$update_id);


            
            
           }
       }

  
    $data['headline'] ="Mettre à jour le mot de passe du compte";
     
$data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('account');
    
    $data['view_file']="update_pword";
    $this->load->module('templates');
    $this->templates->admin($data);

    }
}

function fetch_post(){

$data['nom'] = $this->input->post('nom',TRUE);
$data['pseudo'] = $this->input->post('pseudo',TRUE);
$data['prenom'] = $this->input->post('prenom',TRUE);
$data['societe'] = $this->input->post('societe',TRUE);
$data['address1'] = $this->input->post('address1',TRUE);
$data['address2'] = $this->input->post('address2',TRUE);
$data['ville'] = $this->input->post('ville',TRUE);
$data['pays'] = $this->input->post('pays',TRUE);
$data['code_postal'] = $this->input->post('code_postal',TRUE);
$data['num_tel'] = $this->input->post('num_tel',TRUE);
$data['email'] = $this->input->post('email',TRUE);

return $data;
}

function fetch_db($update_id){

    if(!is_numeric($update_id)){
        redirect('securite/error');
    }

$query =$this->get_where($update_id);
foreach ($query->result() as $row) {
   $data['nom'] = $row->nom;
 $data['pseudo'] = $row->pseudo;
$data['prenom'] = $row->prenom;
$data['societe'] = $row->societe;
$data['address1'] = $row->address1;
$data['address2'] = $row->address2;
$data['ville'] = $row->ville;
$data['pays'] = $row->pays;
$data['code_postal'] = $row->code_postal;
$data['num_tel'] = $row->num_tel;
$data['email'] = $row->email;
$data['date_creation'] = $row->date_creation;
$data['mot_de_passe'] = $row->mot_de_passe;

$data['derniere_connexion'] = $row->derniere_connexion;
    $data['code'] = $row->code;
$data['active'] = $row->active;
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
    redirect('users/manage');
}


       if($submit=="Submit"){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nom','First Name','required');
       $this->form_validation->set_rules('pseudo','Username','required');
           if($this->form_validation->run($this) ==TRUE){
            $data = $this->fetch_post();



            if (is_numeric($update_id)){
                //update
                $this->_update($update_id,$data);
$flash_msg="L'utilisateur est mise à jour avec succés.";

                $value='<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
           $this->session->set_flashdata('account', $value);
redirect('users/create/'.$update_id);


            }else{
                // inserer un nouveau utilisateur
                $data['date_creation']= time();
                $this->_insert($data);
$update_id =$this->get_max(); //recupere l'id du nouveau produit

$flash_msg="L'utilisateur est inséré avec succés.";
$value='<div class="alert alert-success" role="alert" >'.$flash_msg.'</div>';

$this->session->set_flashdata('account', $value);
redirect('users/create/'.$update_id);//  

            }
           }
       }

       if((is_numeric($update_id)) && ($submit!="Submit")){
$data =$this->fetch_db($update_id);

       }else{
        $data =$this->fetch_post();
       
       }

       if(!is_numeric($update_id)){
    $data['headline'] ="Ajouter un Nouveau compte";
       }else{
        $data['headline'] ="Mettre à jour le compte";
       }

$data['update_id']=$update_id;
$data['flash'] = $this->session->flashdata('account');
    
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

$data['query'] = $this->get('prenom');
        //echo"Manage";

$data['view_file']="manage";
$this->load->module('templates');
$this->templates->admin($data);

    }
  }


function get($order_by) {
$this->load->model('mdl_users');
$query = $this->mdl_users->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_users');
$query = $this->mdl_users->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_users');
$query = $this->mdl_users->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_users');
$query = $this->mdl_users->get_where_custom($col, $value);
return $query;
}
function get_with_double_condition($col1, $value1, $col2, $value2) {
$this->load->model('mdl_users');
$query = $this->mdl_users->get_with_double_condition($col1, $value1, $col2, $value2);
return $query;
}

function _insert($data) {
$this->load->model('mdl_users');
$this->mdl_users->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_users');
$this->mdl_users->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_users');
$this->mdl_users->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_users');
$count = $this->mdl_users->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_users');
$max_id = $this->mdl_users->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_users');
$query = $this->mdl_users->_custom_query($mysql_query);
return $query;
}



}