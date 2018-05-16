<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Youraccount extends MX_Controller
{

function __construct() {
parent::__construct();
}

function test() {

$name="Jerbi";
$this->load->module('securite');
$hashed_name = $this->securite->_hash_string($name);
echo "Nom est $name<br>";
echo $hashed_name;

echo "<hr>";

$hashed_name_length = strlen($hashed_name);
$start_point = $hashed_name_length-6;
$last_six_chars = substr($hashed_name, $start_point,6);
echo $last_six_chars;


}
function logout()
{
unset($_SESSION['user_id']);
$this->load->module('web_cookies');
$this->web_cookies->_destroy_cookie();
redirect(base_url());

}

function myprofile()
{
  $this->load->module('securite');
   $this->load->module('users');

        $this->load->library('session');


$data['query'] = $this->users->get('prenom');
  $this->securite->_check_logged_in();
$data = $this->fetch_data_from_post();
  $data['flash'] = $this->session->flashdata('item');

    $data['view_file']="myprofile";
    $this->load->module('templates');
    $this->templates->main_page($data);

}

function welcome()
{
  $this->load->module('securite');
  $this->securite->_check_logged_in();
$data = $this->fetch_data_from_post();
  $data['flash'] = $this->session->flashdata('item');

    $data['view_file']="welcome";
    $this->load->module('templates');
    $this->templates->main_page($data);

}



function test1()
{
$your_name= "Firas";
   $this->session->set_userdata('your_name', $your_name);
echo "la session est bien saisi";



echo "<hr>";
 
 echo anchor('youraccount/test2','Get (display) the session variable')."<br>";
  echo anchor('youraccount/test3','Unset(destroy) the session variable')."<br>";

}


function test2()
{

$your_name= $this->session->userdata('your_name');
if($your_name!=""){
  echo "<h1>Salut $your_name</h1>";
}else{
  echo "pas de variable de la session pour votre your_name";
}
echo "<hr>";
  echo anchor('youraccount/test1','set the session variable')."<br>";

  echo anchor('youraccount/test3','Unset(destroy) the session variable')."<br>";


}

function test3()
{

  unset($_SESSION['your_name']);
  echo "la variable de la session est detruit";

  echo "<hr>";
  echo anchor('youraccount/test1','set the session variable')."<br>";
 echo anchor('youraccount/test2','Get (display) the session variable')."<br>";


}
function login(){
$this->load->module('users');
  
  $this->load->module('securite');
  $id_acheteur = $this->securite->_get_user_id();
//si il est connecté
  if(!is_numeric($id_acheteur)){
$data['pseudo']=$this->input->post('pseudo',TRUE);
    $this->load->module('templates');
    $this->templates->login($data);
}else{

redirect(base_url());
}
}


function submit_login()
{
  

$submit = $this->input->post('submit', TRUE);
       if($submit=="Submit"){


  $this->load->library('form_validation');
 $this->form_validation->set_rules('pseudo','Username','required|min_length[5]|max_length[60]|callback_username_check');
       
        $this->form_validation->set_rules('mot_de_passe','Password','required|min_length[7]|max_length[35]');
       
      
           if($this->form_validation->run($this) == TRUE){

          //recuperer lid de l'utilsateur
$col1 = 'pseudo';
$value1 = $this->input->post('pseudo', TRUE);
$col2 ='email';
$value2 = $this->input->post('pseudo', TRUE);;
$query = $this->users->get_with_double_condition($col1, $value1, $col2, $value2);
$num_rows = $query->num_rows();
foreach($query->result() as $row)
{
  $user_id= $row->id; 
}
$remember = $this->input->post('remember',TRUE);
if($remember=="remember-me"){
  $login_type="longterm";
}else{
  $login_type="shortterm";
}

$data['derniere_connexion'] = time();
$this->users->_update($user_id, $data);


//l'envoi vers a page privé
            $this->_final_step($user_id, $login_type);
            
            
           }else{
            echo validation_errors();
           } 
         
                }


  }


function _final_step($user_id, $login_type)
{
//NB: logintype peut etre a long term ou shortterm
  
if($logintype=="longterm"){
  //ajouter une cookie
  $this->load->module('web_cookies');
  $this->web_cookies->_set_cookie($user_id);
}else{
  //ajouter une variable de session
     $this->session->set_userdata('user_id', $user_id);
}

//METTRE A JOUR les commandes(cart) 
$this->_save_cart_data($user_id);

//envoyer l utilisateur vers la page correspondante
redirect('youraccount/welcome');
}

//enregistrer les donnees ( produits) mquand l utilisateur se connecte pour éviter de perdre ces derniers
function _save_cart_data($user_id)
{
$this->load->module('basket');
$user_session_id = $this->session->session_id;

$col1='session_id';
$value1=$user_session_id;
$col2='id_acheteur';
$value2= 0;

$query = $this->basket->get_with_double_condition($col1, $value1, $col2, $value2);
$num_rows= $query->num_rows();
if($num_rows>0){

  $mysql_query="update panier set id_acheteur=$user_id where session_id='$user_session_id'";
  $query = $this->basket->_custom_query($mysql_query);
  redirect('cart');
}
}

//inscription
function submit()
{
	

$submit = $this->input->post('submit', TRUE);
       if($submit=="Submit"){
        $this->load->library('form_validation');

         $this->form_validation->set_rules('pseudo','Username','required|min_length[8]|max_length[55]|is_unique[utilisateurs.pseudo]');
  
        $this->form_validation->set_rules('mot_de_passe','Mot de passe','required|min_length[8]|max_length[55]');
        $this->form_validation->set_rules('repeat_pword','Repeter mot de passe','required|matches[mot_de_passe]');
       $this->form_validation->set_rules('email','Email','required|valid_email|max_length[120]|is_unique[utilisateurs.email]');

           if($this->form_validation->run($this) == TRUE){


           	$this->_process_create_account();
           	
            redirect('youraccount/login');
     

            
            
           }else{
           	$this->createaccount();
           }
         
                }


	}

	function _process_create_account()
	{
		$this->load->module('users');
		$data = $this->fetch_data_from_post();
		unset($data['repeat_pword']);


$mot_de_passe= $data['mot_de_passe'];
$this->load->module('securite');
$data['mot_de_passe']= $this->securite->_hash_string($mot_de_passe);
$this->users->_insert($data);
	}
function createaccount()
{
$data = $this->fetch_data_from_post();
	$data['flash'] = $this->session->flashdata('item');

    $data['view_file']="start_login";
    $this->load->module('templates');
    $this->templates->main_page($data);

}


function fetch_data_from_post()
{
	$data['pseudo'] = $this->input->post('pseudo',TRUE);
	$data['email'] = $this->input->post('email');
	$data['mot_de_passe'] = $this->input->post('mot_de_passe');
	$data['repeat_pword'] = $this->input->post('repeat_pword');
	return $data;
}


function username_check($str){


$this->load->module('users');
$this->load->module('securite');
$error_msg = "Vous avez saisi un nom d'utilisateur ou un mot de passe incorrecte";
$col1 = 'pseudo';
$value1 = $str;
$col2 ='email';
$value2 = $str;


$query = $this->users->get_with_double_condition($col1, $value1, $col2, $value2);
$num_rows = $query->num_rows();

if($num_rows<1){

  $this->form_validation->set_message('username_check', $error_msg);
        return FALSE;
}

foreach($query->result() as $row)
{
  $pword_on_table= $row->mot_de_passe; 
}
$mot_de_passe = $this->input->post('mot_de_passe', TRUE);
$result = $this->securite->_verify_hash($mot_de_passe, $pword_on_table);
if ($result == TRUE)
{
  return TRUE;
}else{
  $this->form_validation->set_message('username_check', $error_msg);
  return FALSE;
}



}


}