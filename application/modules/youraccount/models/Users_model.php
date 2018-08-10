<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}



     function is_active_user() {
        
    $this->db->select('*'); 
    $this->db->from('utilisateurs');     
    $this->db->where('pseudo', $this->input->post('pseudo'));

    $this->db->where('active>0');
    $result=$this->db->get();
    return $result->row_array();   
        
    }
    
 
     function get_user_id_from_username($pseudo) {
        
        $this->db->select('id');
        $this->db->from('utilisateurs');
        $this->db->where('pseudo', $pseudo);
        return $this->db->get()->row('id');
        
    }
    
 
     function get_active($active) {
        
        $this->db->select('id');
        $this->db->from('utilisateurs');
        $this->db->where('active', $active);
        return $this->db->get()->row('id');
        
    }
     function get_user($user_id) {
        
        $this->db->from('utilisateurs');
        $this->db->where('id', $user_id);
        return $this->db->get()->row();
        
    }
     function resolve_user_login($pseudo, $mot_de_passe) {
        
        $this->db->select('mot_de_passe');
        $this->db->from('utilisateurs');
        $this->db->where('pseudo', $pseudo);
        $hash = $this->db->get()->row('mot_de_passe');
        
        return $this->verify_password_hash($mot_de_passe, $hash);
        
    }
     function verify_password_hash($mot_de_passe, $hash) {
        
        return password_verify($mot_de_passe, $hash);
        
    }
 
     function hash_password($mot_de_passe) {
        
        return password_hash($mot_de_passe, PASSWORD_BCRYPT);
        
    }

    function namebyid($id)
        {
                $this->db->select('*');
                $this->db->where('id', $id);
                $query = $this->db->get('email');
                return $query->result();
        }
	public function getAllUsers(){
		$query = $this->db->get('utilisateurs');
		return $query->result(); 
	}

	public function insert($user){
		$this->db->insert('utilisateurs', $user);
		return $this->db->insert_id(); 
	}

	public function getUser($id){
		$query = $this->db->get_where('utilisateurs',array('id'=>$id));
		return $query->row_array();
	}

	public function activate($data, $id){
		$this->db->where('utilisateurs.id', $id);
		return $this->db->update('utilisateurs', $data);
	}

	public function verify(){

    $query = $this->db
            ->select('*')
            
            ->where('active','1')
            ->get('users');

            if ($query->num_rows() == 1) {
                $result = $query->row_array();
                return $result;
            } else {
                return FALSE;
            }

}

public function verifyemail()
{
$this->db->select("active"); 
  $this->db->from('utilisateurs');
  $query = $this->db->get();
  return $query->result();           
}


}
