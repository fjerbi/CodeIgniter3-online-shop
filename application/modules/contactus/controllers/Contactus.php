<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Contactus extends MX_Controller
{

function __construct() {
parent::__construct();
}

function index()
{
 $this->load->module('parametre_web');
$data['address']=$this->parametre_web->_get_address();
$data['telnum']=$this->parametre_web->_get_telnum();
$data['map_code']=$this->parametre_web->_map_code();
$data['flash'] = $this->session->flashdata('item');

   $data['view_file']="contactus";
    $this->load->module('templates');
    $this->templates->main_page($data);

}


}