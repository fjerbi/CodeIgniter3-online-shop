<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends MX_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        echo Modules::run('templates/members_area');
    }

}