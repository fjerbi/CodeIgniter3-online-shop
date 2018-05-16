*<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Comments extends MX_Controller
{

function __construct() {
parent::__construct();
}

function get_name_comment()
{

$mysql_query="
SELECT
utilisateurs.pseudo
FROM
utilisateurs
INNER JOIN commentaires ON utilisateurs.id = commentaires.id

";


}
function _make_comments($id_produit)
{
	$mysql_query ="select * from commentaires where id_produit=$id_produit";
$mysql_query.=" order by date_creation";
	$data['query'] = $this->_custom_query($mysql_query);
	$num_rows = $data['query']->num_rows();
	if($num_rows>0){
		$this->load->view('comments', $data);
}
}
function submit()
{
		$this->load->module('users');
	
	$this->load->module('securite');
	$id_acheteur = $this->securite->_get_user_id();
//si il est connecté
	if(is_numeric($id_acheteur)){

$data['id_produit']= $this->input->post('id_produit', TRUE);
$data['commentaire']= $this->input->post('commentaire', TRUE);
$data['date_creation']= time();
if($data['commentaire']!=''){
	$this->_insert($data);

}

$refer_url = $_SERVER['HTTP_REFERER'];
redirect($refer_url);
}else{
	redirect('youraccount/login');
}
}

function get($order_by) {
$this->load->model('mdl_comments');
$query = $this->mdl_comments->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_comments');
$query = $this->mdl_comments->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id) {
$this->load->model('mdl_comments');
$query = $this->mdl_comments->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_comments');
$query = $this->mdl_comments->get_where_custom($col, $value);
return $query;
}

function _insert($data) {
$this->load->model('mdl_comments');
$this->mdl_comments->_insert($data);
}

function _update($id, $data) {
$this->load->model('mdl_comments');
$this->mdl_comments->_update($id, $data);
}

function _delete($id) {
$this->load->model('mdl_comments');
$this->mdl_comments->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_comments');
$count = $this->mdl_comments->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_comments');
$max_id = $this->mdl_comments->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_comments');
$query = $this->mdl_comments->_custom_query($mysql_query);
return $query;
}

}