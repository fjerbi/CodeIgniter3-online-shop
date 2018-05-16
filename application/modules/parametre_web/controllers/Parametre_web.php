<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Parametre_web extends MX_Controller
{

function __construct() {
parent::__construct();
}
function _map_code()
{
	$code='<iframe src="https://www.google.com/maps/embed?pb=!1m17!1m11!1m3!1d687.7066545773038!2d10.19511382222287!3d36.86944789466733!2m2!1f0!2f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12e2cb39a98f09d5%3A0x379e97c05992cc94!2sLyc%C3%A9e+Borj+Louzir%2C+Ariana!5e1!3m2!1sfr!2stn!4v1524733445304" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>';
	return $code;
}

function _get_address()
{
	$address='2073, Ariana,Tunis <br>';
	$address.='Appartement Ines F1-3';
	return $address;
}

function _get_telnum()
{
	$telnum='(216) 71 658 985';
	return $telnum;
}

function _get_currency_code()
{
	$code="EUR";
	return $code;
}
function _paypal_email()
{
	$email='firasmerchant@gmail.com';
	return $email;
}
function _get_support_team_name()
{
	$name ="Administration";
	return $name;
}
function _get_welcome_msg($customer_id)
{


$this->load->module('users');
$customer_name = $this->users->_get_customer_name($customer_name);
$msg = "Salut".$customer_name.",<br><br>";
$msg.="Merci d'avoir fait un compte, si vous avez des questions ";
$msg.="on est ici pour répondre à vos questions";
$msg.="Cordialement,<br><br>";
$msg.="Administrateur";
return $msg;
}
function _get_cookie_name()
{
	$cookie_name='fkrvgfjasj';
	return $cookie_name;
}
function _get_item_segments()
{
	//retourne le segment pour le store_item page
	$segments="product/list/";
	return $segments;
}
function _get_items_segments()
{
	//retourne les segments pour les pages de catégories
	$segments="products/lists/";
	return $segments;
}
function _get_page_not_found_msg()
{
	$msg="


<div class='err404'>
            <h1 class='err404-ttl'>404</h1>
            <p class='err404-subttl'>
                Error. Page not found.
            </p>
           







	";
	return $msg;
}

}