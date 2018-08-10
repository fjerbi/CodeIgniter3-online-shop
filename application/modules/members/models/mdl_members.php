<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_members extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_table() {
        $table = "table_name";
        return $table;
    }
}