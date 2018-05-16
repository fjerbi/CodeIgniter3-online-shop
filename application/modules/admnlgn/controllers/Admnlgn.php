<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admnlgn extends MX_Controller
{

function __construct() {
parent::__construct();
}

function index(){

$data['pseudo']=$this->input->post('pseudo',TRUE);
    $this->load->module('templates');
    $this->templates->login($data);
}


function submit_login()
{
  

$submit = $this->input->post('submit', TRUE);
       if($submit=="Submit"){


  $this->load->library('form_validation');
 $this->form_validation->set_rules('pseudo','Username','required|min_length[5]|max_length[60]|callback_username_check');
       
        $this->form_validation->set_rules('mot_de_passe','Password','required|min_length[7]|max_length[35]');
       
      
           if($this->form_validation->run($this) == TRUE){


$this->_final_step();
            
           }else{
            echo validation_errors();
           } 
         
                }


  }


function _final_step()
{

  //ajouter une variable de session
  
     $this->session->set_userdata('is_admin', '1');
//envoyer l utilisateur vers la page correspondante
redirect('dashboard/home');
}


function logout() 
{
	unset($_SESSION['is_admin']);
	redirect(base_url());
}
function username_check($str){


$this->load->module('users');
$this->load->module('securite');
$error_msg = "Vous avez saisi un nom d'utilisateur ou un mot de passe incorrecte";

$mot_de_passe = $this->input->post('mot_de_passe', TRUE);
 
 $result = $this->securite->_check_admin_login($str, $mot_de_passe);
if($result==FALSE){

  $this->form_validation->set_message('username_check', $error_msg);
        return FALSE;
}else{
	return TRUE;
}



}



}