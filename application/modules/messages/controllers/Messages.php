<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Messages extends MX_Controller
{

function __construct() {
parent::__construct();
}

function messagesent()
{

  $data['headline'] ="Votre Message a été envoyé";
      
    $data['view_file']="messagesent";
    $this->load->module('templates');
    $this->templates->main_page($data);
}
function  create(){
	$this->load->module('user_messages');
$this->load->library('session');
$this->load->module('securite');
$this->load->module('users');
     $this->load->module('timedate');
        $submit =$this->input->post('submit',TRUE);
       $data =$this->fetch_post();
       $customer_id = $this->securite->_get_user_id();
$code = $this->uri->segment(3);

if($submit =="Cancel"){
    redirect('youraccount/welcome');
}


       if($submit=="Submit"){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('sujet','sujet','required|max_length[250]');
       
           $this->form_validation->set_rules('message','Message','required');
           



           if($this->form_validation->run($this) ==TRUE){
           	


      if((!is_numeric($customer_id)) OR($customer_id==0)) {
        //si la session a expiré (cookie)
$token= $this->input->post('token', TRUE);
$customer_id = $this->users->_get_user_id_from_token($token);
$not_logged_in = TRUE;

      }     




//convertir la date en variable unix timestamp
$data['date_creation'] = time();
$data['envoye_par'] = $customer_id;
$data['envoye_a'] = 0;//sera toujours envoyé vers l'admin
$data['ouvert'] = 0;
$data['code'] = $this->securite->generate_random_strings(8);

if($data['urgent'] !=1){
	$data['urgent'] =0;
}
                // inserer un noveau message
if($customer_id>0){
                $this->user_messages->_insert($data);



$flash_msg="Le message est envoyé avec succées.";
$value='<div class="alert alert-success" role="alert" >'.$flash_msg.'</div>';

$this->session->set_flashdata('item', $value);
}

if(isset($not_logged_in)){
  $target_url = base_url().'messages/messagesent';
}else{
  $target_url = base_url().'youraccount/welcome';
}

redirect($target_url);//memoriser le flash data

            
           }
       }elseif ($code!="") {
         $data = $this->user_messages->_get_data_from_code($customer_id, $code);
         $data['message']="VEUILLEZ RÉPONDRE ICI.".$data['message'];
       }


      
  $this->securite->_check_logged_in();     
$data['token'] = $this->users->_generate_token($customer_id);
if($code==""){
  $data['headline'] ="Composer un nouveau message";
}else{
  $data['headline'] ="Répondre au  message";
}
$data['message'] = $this->_format_msg($data['message']);
 $data['code'] = $code;  
$data['flash'] = $this->session->flashdata('item');
    
    $data['view_file']="create";
    $this->load->module('templates');
    $this->templates->main_page($data);

    }
    function _format_msg($msg){
      //récupere la chaine de caractére du message 
      $replace ='

      ';
      $msg = str_replace('<br>', $replace, $msg);
      $msg = strip_tags($msg);
      return $msg;
    }
    function fetch_post(){

$data['sujet'] = $this->input->post('sujet',TRUE);
$data['message'] = $this->input->post('message',TRUE);
$data['urgent'] = $this->input->post('urgent',TRUE);

return $data;
}
function view()
{
$this->load->module('user_messages');
        $this->load->module('securite');
         $this->load->module('timedate');

$this->securite->_check_logged_in();
$code = $this->uri->segment(3);
$col1 ='envoye_a';
$value1=$this->securite->_get_user_id();
$col2='code';
$value2= $code;
	$query = $this->user_messages->get_with_double_condition($col1, $value1, $col2, $value2);
$num_rows = $query->num_rows();
if($num_rows<1){
	redirect('securite/error');
}
foreach($query->result() as $row){
	$update_id = $row->id;
	$data['sujet'] = $row->sujet;
    $data['message'] = nl2br($row->message);
    $data['envoye_a'] = $row->envoye_a;
    $date_creation = $row->date_creation;
    $data['ouvert'] = $row->ouvert;
    $data['envoye_par'] = $row->envoye_par;
}

$data['code'] = $code;

$data['date_creation'] = $this->timedate->get_date($date_creation,'datepicker' );

	$this->user_messages->_set_to_opened($update_id);	
$data['flash'] = $this->session->flashdata('item');	
$data['view_file']="view";
$this->load->module('templates');
$this->templates->main_page($data);

}
//si le message e
}