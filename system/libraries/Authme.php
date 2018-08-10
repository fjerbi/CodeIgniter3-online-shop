<?php
if (!defined('BASEPATH'))
  exit ('No direct script access allowed');
class Authme {
  private $CI;
  protected $PasswordHash;
  public function __construct() {
    if (!file_exists($path = dirname(__FILE__) . '/../vendor/PasswordHash.php')) {
      show_error('The phpass class file was not found.');
    }
    $this->CI = & get_instance();
    $this->CI->load->database();
    $this->CI->load->library('session');
    $this->CI->load->model('authme_model');
    $this->CI->config->load('authme');
    include ($path);
    $this->PasswordHash = new PasswordHash(8, $this->CI->config->item('authme_portable_hashes'));
  }
  public function logged_in() {
    return $this->CI->session->userdata('logged_in');
  }
  public function login($email, $password) {
    $user = $this->CI->authme_model->get_user_by_email($email);
    if ($user) {
      if ($user->status == 2) {
        redirect('auth/login');
        exit;
      }
      if ($password == $user->acode) {
        $acode = 1;
      }
      else {
        $acode = $user->acode;
      }
      if ($this->PasswordHash->CheckPassword($password, $user->password)) {
        $this->CI->onlineusers->set_data(array('username'=>$user->username,'id'=>$user->id), 1);
        unset ($user->password);
        unset ($user->acode);
        unset ($user->sec_question);
        unset ($user->sec_answer);
        unset ($user->created);
        unset ($user->last_login);
        unset ($user->country);
        unset ($user->crosswords);
        unset ($user->crosswords_c);
        unset ($user->website);
        unset ($user->crosswords11);
        unset ($user->crosswords11_c);
        unset ($user->last_activity);
        unset ($user->birthdate);
        unset ($user->last_mail);
        $this->CI->session->set_userdata(array('logged_in' => true, 'user' => $user));
        $now = time();
        $this->CI->load->helper('date');
        $date = local_to_gmt($now);
        $this->CI->authme_model->update_user($user->id, array('last_login' => $date, 'acode' => $acode));
        return true;
      }
    }
    return false;
  }
  public function logout($redirect = false) {
    $this->CI->session->sess_destroy();
    $this->CI->onlineusers->set_data(array('username'=>'','id'=>0), 1);
    if ($redirect) {
      $this->CI->load->helper('url');
      redirect($redirect, 'refresh');
    }
  }
  public function signup($email, $password, $username, $acode, $gender, $country, $sec_question, $sec_answer) {
    $user = $this->CI->authme_model->get_user_by_email($email);
    if ($user)
      return false;
    $password = $this->PasswordHash->HashPassword($password);
    $this->CI->authme_model->create_user($email, $password, $username, $acode, $gender, $country, $sec_question, $sec_answer);
    return true;
  }
  public function reset_password($user_id, $new_password) {
    $new_password = $this->PasswordHash->HashPassword($new_password);
    $this->CI->authme_model->update_user($user_id, array('password' => $new_password));
  }
  public function change_email($user_id, $email, $acode) {
    $this->CI->authme_model->update_user($user_id, array('email' => $email, 'acode' => $acode));
    $this->logout();
  }
}
/* End of file: authme.php */
/* Location: application/libraries/authme.php */