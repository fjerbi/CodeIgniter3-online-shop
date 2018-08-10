<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Web_cookies extends MX_Controller
{

function __construct() {
parent::__construct();
}



function _set_cookie($user_id)
{
$this->load->module('securite');
$this->load->module('parametre_web');

$nowtime = time();
$one_day = 86400;
$two_weeks = $one_day*14 ;
$two_weeks_plus = $nowtime+$two_weeks;

$data['code_cookie'] = $this->securite->generate_random_strings(128);
$data['user_id'] = $user_id;
$data['date_expiration'] = $two_weeks_plus;
$this->_insert($data);

$cookie_name = $this->parametre_web->_get_cookie_name();

setcookie($cookie_name, $data['code_cookie'], $data['date_expiration'] );
$this->_delete_old_cookie();

}

function _get_user_id()
{
//vérifier si l'utilisateur à une valide cookie,et recuperer son id depuis le cookie
$this->load->module('parametre_web');
$cookie_name = $this->parametre_web->_get_cookie_name();

//verifier le cookie
if(isset($_COOKIE[$cookie_name])){

	$code_cookie = $_COOKIE[$cookie_name];

	//au cas ou il a un cookie et est ce qu'elle est encore dans la table ?

$query = $this->get_where_custom('code_cookie', $code_cookie);
$num_rows = $query->num_rows();

if($num_rows<1){
	$user_id = '';
}

foreach ($query->result() as $row) {
	$user_id = $row->user_id;
}

}	else{
	$user_id ='';
}
return $user_id;

}

function _destroy_cookie()
{

$this->load->module('parametre_web');
$cookie_name = $this->parametre_web->_get_cookie_name();

if(isset($_COOKIE[$cookie_name])){
$code_cookie = $_COOKIE[$cookie_name];
$mysql_query = "delete from Web_cookies where code_cookie=?";
$this->db->query($mysql_query, array($code_cookie));

}

	

setcookie($cookie_name, '', time() - 3600);


}

function _delete_old_cookie()
{
	$nowtime = time();
	$mysql_query = "delete from web_cookies where date_expiration<$nowtime";
	$query = $this->_custom_query($mysql_query);
}


function get($order_by) {
$this->load->model('mdl_web_cookies');
$query = $this->mdl_web_cookies->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_web_cookies');
$query = $this->mdl_web_cookies->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_web_cookies');
$query = $this->mdl_web_cookies->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_web_cookies');
$query = $this->mdl_web_cookies->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_web_cookies');
$this->mdl_web_cookies->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_web_cookies');
$this->mdl_web_cookies->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_web_cookies');
$this->mdl_web_cookies->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_web_cookies');
$count = $this->mdl_web_cookies->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_web_cookies');
$max_id = $this->mdl_web_cookies->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_web_cookies');
$query = $this->mdl_web_cookies->_custom_query($mysql_query);
return $query;
}

}