<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Invoices extends MX_Controller
{

function __construct() {
parent::__construct();
}

function test()
{
	$data['name']="Jerbi Firas";
$this->load->view('test',$data);
// Get output html

$html = $this->output->get_output();

// Load library
$this->load->library('dompdf_gen');

// Convert to PDF
$this->dompdf->load_html($html);
$this->dompdf->render();
$this->dompdf->stream("welcome.pdf");

}
}