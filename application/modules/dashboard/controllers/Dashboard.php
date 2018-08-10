<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller
{

function __construct() {
parent::__construct();

		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
}

function home(){


 $this->load->library('session');
        $this->load->module('securite');
if($this->ion_auth->logged_in() && $this->ion_auth->is_admin() || $this->ion_auth->in_group('commercial')){
//$this->securite->_verify_admin();
 $data['flash'] = $this->session->flashdata('item');


$data['view_file']="home";
$this->load->module('templates');
$this->templates->admin($data);


}else{
	redirect('securite/error');
}
}
}
