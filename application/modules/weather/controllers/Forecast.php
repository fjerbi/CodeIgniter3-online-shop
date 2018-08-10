<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forecast extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 * Develope by vrushal raut vrushalrt@gmail.com
	 */
	public function index()
	{
		$this->load->model('weather');
		$data =	$this->weather->connect();
		$this->load->view('main',$data);
		//echo '<pre>'; print_r($data);exit();
	}


}
