<?php
/**
Users Online class *
Manages active users *
@package CodeIgniter
@subpackage Libraries
@category Add-Ons
@author Leonardo Monteiro Bersan de Araujo
@link hhttp://codeigniter.com/wiki/Library: Online_Users
*/
class Onlineusers {
  public $file = "usersonline.tmp";
  public $data;
  public $ip;
  function Onlineusers() {
    $CI = & get_instance();
    $this->ip = $_SERVER['REMOTE_ADDR'];
    $this->data = @ unserialize(file_get_contents($this->file));
    $aryData = $this->data['useronline'];
    if (!$this->data)
      $this->data = array();
    $now = time();
//      $CI->load->helper('date');
//      $now = local_to_gmt($now);
    $timeout = $now - 900;
//Removes expired data
    foreach ($aryData as $key => $value) {
      if ($value['time'] <= $timeout) {
        if ($value['username']) {
          $this->data['memonline']--;
        }
        else
          $this->data['guestonline']--;
        unset ($aryData[$key]);
      }
    }
//If it's the first hit, add the information to database
    if (!isset ($aryData[$this->ip])) {
      $aryData[$this->ip]['time'] = time();
      $aryData[$this->ip]['uri'] = $_SERVER['REQUEST_URI'];
//      $username = $CI->session->userdata('username');
      $user = $CI->session->userdata('user');
      $username = user('username');
      $id = user('id');
      $aryData[$this->ip]['username'] = $username;
      $aryData[$this->ip]['id'] = $id;
      if ($username) {
        $this->data['memonline']++;
      }
      else {
        $this->data['guestonline']++;
      }
      $this->data['totalvisit']++;
//Loads the USER_AGENT class if it's not loaded yet
      if (!isset ($CI->agent)) {
        $CI->load->library('user_agent');
        $class_loaded = true;
      }
      if ($CI->agent->is_robot())
        $aryData[$this->ip]['bot'] = $CI->agent->robot();
      else
        $aryData[$this->ip]['bot'] = false;
//Destroys the USER_AGENT class so it can be loaded again on the controller
      if ($class_loaded)
        unset ($class_loaded, $CI->agent);
    }
    else {
      $aryData[$this->ip]['time'] = time();
      $aryData[$this->ip]['uri'] = $_SERVER['REQUEST_URI'];
    }
    $this->data['useronline'] = $aryData;
    $this->_save();
  }
//this function return the total number of online users
  function total_users() {
    return count($this->data['useronline']);
  }
//this function return the total number of online members
  function total_mems() {
    if (@ $this->data['memonline']) {
      return @ $this->data['memonline'];
    }
    else {
      return 0;
    }
  }
//this function return the total number of online guest
  function total_guests() {
    if (@ $this->data['guestonline'] > 0) {
      return @ $this->data['guestonline'];
    }
    else {
      return 0;
    }
  }
//this function return the total number of total visit
  function total_visit() {
    return @ $this->data['totalvisit'];
  }
//this function return the total number of online robots
  function total_robots() {
    $i = 0;
    foreach ($this->data as $value) {
      if ($value['is_robot'])
        $i++;
    }
    return $i;
  }
//Used to set custom data
  function set_data($data = false, $force_update = false) {
    if (!is_array($data)) {
      return false;
    }
    $tmp = false;
//Used to control if there are changes
    foreach ($data as $key => $value) {
      if (!isset ($aryData[$this->ip]['data'][$key]) || $force_update) {
        $aryData[$this->ip]['data'][$key] = $value;
        $tmp = true;
      }
    }
//Check if the user's already have this setting and skips the wiriting file process (saves CPU)
    if (!$tmp)
      return false;
    return $this->_save();
  }
  function get_info() {
    return @ $this->data;
  }
//Save current data into file
  function _save() {
    $fp = fopen($this->file, 'w');
    flock($fp, LOCK_EX);
    $write = fwrite($fp, serialize($this->data));
    fclose($fp);
    return $write;
  }
}