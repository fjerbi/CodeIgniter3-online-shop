<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller
{

function __construct() {
parent::__construct();
}

function home(){


 $this->load->library('session');
        $this->load->module('securite');

$this->securite->_verify_admin();
 $data['flash'] = $this->session->flashdata('item');


$data['view_file']="home";
$this->load->module('templates');
$this->templates->admin($data);


}

}