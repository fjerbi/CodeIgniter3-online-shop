<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_login extends CI_Model {

    public function get_table() {
        $table = "utilisateurs";
        return $table;
    }

    public function validate(){
        $table = $this->get_table();
        $this->db->where('pseudo', $this->input->post('pseudo'));
       
        $query = $this->db->get($table);
        if($query->num_rows() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function get_logged_in_user_data($pseudo){
        $table = $this->get_table();
        $this->db->where('pseudo', $pseudo);
        $query = $this->db->get($table);
        if($query->num_rows() == 1){
            return $query;
        }else{
            return false;
        }
    }

}