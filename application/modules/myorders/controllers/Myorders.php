<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Myorders extends MX_Controller
{

function __construct() {
parent::__construct();
}



function _get_order_status_options(){
	//retourner une table de tout les options de statut de la commande
	$this->load->module('order_status');

$options=$this->order_status->_dropdown_options();

return $options;
 
}
function show(){

  $this->load->module('securite');
  $this->load->module('orders');
    $this->load->module('custom_pagination');
  $this->securite->_check_logged_in();
  $shopper_id = $this->securite-> _get_user_id();
//compter les commandes pour chaques utilisateurs
$use_limit = FALSE;
$mysql_query = $this->_generate_mysql_query($use_limit, $shopper_id);
$query = $this->orders->_custom_query($mysql_query);
$total_items = $query->num_rows();

//fetch les commandes pour cette page
$use_limit = TRUE;
$mysql_query = $this->_generate_mysql_query($use_limit, $shopper_id);


 $data['flash'] = $this->session->flashdata('item');

$data['query']= $this->orders->_custom_query($mysql_query);
$data['num_rows'] = $data['query']->num_rows();
      //generer la pagination 
$pagination_data['template'] = 'main_page';
$pagination_data['target_base_url'] = $this->get_target_pagination_base_url();
$pagination_data['total_rows'] = $total_items;
$pagination_data['offset_segment'] = 3;
$pagination_data['limit'] = $this->get_limit();
$data['pagination'] = $this->custom_pagination->_generate_pagination($pagination_data);


$pagination_data['offset'] = $this->get_offset();
$data['showing_statement'] = $this->custom_pagination->get_showing_statement($pagination_data);
$data['order_status_options']= $this->_get_order_status_options();

  $data['flash'] = $this->session->flashdata('item');

    $data['view_file']="show";
    $this->load->module('templates');
    $this->templates->main_page($data);
}


function view()
{
  $this->load->module('securite');
  $this->load->module('orders');
    $this->load->module('order_status');
    $this->load->module('cart');
    $this->load->module('timedate');
  $this->securite->_check_logged_in();
  $id_acheteur = $this->securite-> _get_user_id();
  $libelle_commande= $this->uri->segment(3);
//recuperer les détails des commandes
$col1='libelle_commande';
$value1= $libelle_commande;
$col2='id_acheteur';
$value2=$id_acheteur;

$query=$this->orders->get_with_double_condition($col1, $value1, $col2, $value2);
$num_rows= $query->num_rows();
if($num_rows<1){
  redirect('securite/error');
}

foreach($query->result() as $row)
{
  $date_creation= $row->date_creation;
  $statut_commande= $row->statut_commande;
  $session_id=$row->session_id;
}
$data['date_creation']= $this->timedate->get_date($date_creation,'datepicker');
if($statut_commande==0){
  $data['order_status_title']='Commande envoyée';
}else{
  $data['order_status_title']=$this->order_status->_get_status_name($statut_commande);
}
$table= 'traces_client';
$data['query_c']=$this->cart->_fetch_cart_contents($session_id,$id_acheteur, $table);





$data['libelle_commande']= $libelle_commande;
$data['flash']= $this->session->flashdata('item');
$data['view_file']= 'view';
$this->load->module('templates');
$this->templates->main_page($data);
}


function _generate_mysql_query($use_limit, $shopper_id)
{
	
//NB: use_limit peut etre TRUE ou FALSE
$mysql_query="select * from commandes where id_acheteur=$shopper_id order by date_creation desc";


if($use_limit==TRUE){
  $limit = $this->get_limit();
  $offset = $this->get_offset();
  $mysql_query.= " limit ".$offset.", ".$limit;
}
return $mysql_query;
}
//préciser la limite des  données qui vont etre affiché par page
function get_limit()
{
  $limit = 10;
  return $limit; 
}

function get_offset()
{
  //nombre de segment (liens)
  $offset = $this->uri->segment(3);
if(!is_numeric($offset)){
  $offset = 0;
}
return $offset;
}

    function get_target_pagination_base_url()
{
  $first_bit = $this->uri->segment(1);
  $second_bit = $this->uri->segment(2);

  $target_base_url = base_url().$first_bit."/".$second_bit;
return $target_base_url;
}

}