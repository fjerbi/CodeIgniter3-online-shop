<?php
class Securite extends MX_Controller
{

    function __construct() {
        parent::__construct();
        
    }

function test()
{
  echo "test";
}
function _check_admin_login($pseudo, $mot_de_passe)
{
$target_username="firas";
$target_pass="password";

if(($pseudo==$target_username) && ($mot_de_passe==$target_pass)){
    return TRUE;
}else{
    return FALSE;
}


}
function check_login()
{
    //vérifier si l'utilisateur est connectée
    $user_id = $this->_get_user_id();
    if(!is_numeric($user_id)){
        return FALSE;
    }else{
      return TRUE;
    }
}

function _check_logged_in()
{
    //vérifier si l'utilisateur est connectée
    $user_id = $this->_get_user_id();
    if(!is_numeric($user_id)){
        redirect('youraccount/login');
    }
}


function _get_user_id()
{
//recupere l id de l'utilisateur

    //vérification d'une variable de la session


$user_id= $this->session->userdata('user_id');

if(!is_numeric($user_id)){
//verifier une cookie valide
$this->load->module('web_cookies');
$user_id = $this->web_cookies->_get_user_id();
}

return $user_id;
}

function generate_random_strings($length)
{
$characters ='23456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomstring='';
for ($i=0; $i < $length ; $i++) { 
    $randomstring.= $characters[rand(0,strlen($characters) -1)];

}
return $randomstring;
}

/*function test()
{
	$name ="Firas";
	$hashed_name =$this->_hash_string($name);
	echo"vous etes $name <br>";
	echo $hashed_name;
echo "<hr>";
$submitted_name = "Jerbi";
$result = $this->_verify_hash($submitted_name, $hashed_name);
if($result == TRUE){
	echo "parfait";
}else {
	echo " fail";
}

}*/
    function _hash_string($str)
    {
    	$hashed_string = password_hash($str,PASSWORD_BCRYPT,array(
'cost' =>11

    	));
    	return $hashed_string;
    }

    function _verify_hash($plain_test_str, $hashed_string)
    {

$result = password_verify($plain_test_str,$hashed_string);
return $result;

    }
    function _encrypt_string($str)
    {
      $this->load->library('encryption');
$encrypted_string = $this->encryption->encrypt($str);
return $encrypted_string;

    }

        function _decrypt_string($str)
    {
      $this->load->library('encryption');
$decrypted_string = $this->encryption->decrypt($str);
return $decrypted_string;

    }
function _verify_admin(){
      

$is_admin= $this->session->userdata('is_admin');
if($is_admin==1){
 return TRUE;
}else{
 
            redirect('securite/error');
        }
}

function error(){
    echo "
<style>

@import url(https://fonts.googleapis.com/css?family=Roboto:900);
@import url(https://fonts.googleapis.com/css?family=Open+Sans);
* { 
  paading: 0; 
  margin: 0;
}
#oopss  {
    background: #333;
    text-align: center;
    margin-bottom: 50px;
    font-weight: 400;
    font-size: 20px;
    font-family: 'Open Sans', sans-serif;
    , sans-serif;
    position: fixed;
    width: 100%;
    height: 100%;
    line-height: 1.5em;
    z-index: 9999;
    left: 0px;
}
#error-text  {
    top: 30%;
    position: relative;
    font-size: 20px;
    color: #eee;
}

#error-text a {
    color: #eee;
}

#error-text a:hover {
    color:#f35d5c;
}


#error-text p  {
    color: #eee;
    margin: 50px 0 0 0;
}

#error-text i  {
    margin-left: 10px;
}

#error-text p.hmpg  {
    margin: 20px 0 0 0;
}

#error-text span  {
    position: relative;
    background: #ef4824;
    color: #fff;
    font-size: 450%;
    padding: 0 20px;
    border-radius: 5px;
    font-family: 'Roboto', sans-serif;
    ,  sans-serif;
    font-weight: bolder;
    transition: all .5s;
    cursor:pointer;
}
#error-text span:hover  {
    background: #d7401f;
    color: #fff;
    -webkit-animation: jelly .5s;
    -moz-animation: jelly .5s;
    -ms-animation: jelly .5s;
    -o-animation: jelly .5s;
    animation: jelly .5s;
}

#error-text span:after  {
    top: 100%;
    left: 50%;
    border: solid transparent;
    content: &quot;
     &quot;
    ;
    height: 0;
    
width: 0;
    position: absolute;
    pointer-events: none;
    border-color: rgba(136, 183, 213, 0);
    border-top-color: #ef4824;
    border-width: 7px;
    margin-left: -7px;
}

@-webkit-keyframes jelly {
    
from, to {
    -webkit-transform: scale(1, 1);
    transform: scale(1, 1);
}
25% {
    -webkit-transform: scale(.9, 1.1);
    transform: scale(.9, 1.1);
}
50% {
    -webkit-transform: scale(1.1, .9);
    transform: scale(1.1, .9);
}
75% {
    -webkit-transform: scale(.95, 1.05);
    transform: scale(.95, 1.05);
}
}
@keyframes jelly {
    
from, to {
    -webkit-transform: scale(1,  1);
    transform: scale(1, 1);
}
25% {
    -webkit-transform: scale(.9, 1.1);
    transform: scale(.9, 1.1);
}
50% {
    -webkit-transform: scale(1.1, .9);
    transform: scale(1.1, .9);
}
75% {
    -webkit-transform: scale(.95,  1.05);
    transform: scale(.95,  1.05);
}
}

/* CSS Error Page Responsive */
@media only screen and (max-width:640px) {
    
#error-text span  {
    font-size: 200%;
}

#error-text a:hover  {
    color: #fff;
}
}
.back:active {
  -webkit-transform:scale(0.95);
  -moz-transform:scale(0.95);
  transform:scale(0.95);
  background:#f53b3b;
  color:#fff;
}
.back:hover {
  background:#4c4c4c;
}

.back {
  text-decoration:none;
  background:#5b5a5a;
  color:#fff;
  padding:10px 20px;
  font-size:20px;
  font-weight:700;
  line-height:normal;
  text-transform:uppercase;
  border-radius:3px;
  -webkit-transform:scale(1);
  -moz-transform:scale(1);
  transform:scale(1);
  transition:all 0.5s ease-out;
}





</style>

<!DOCTYPE html>
<html lang='en' >

<head>
  <meta charset='UTF-8'>
  <title>Erreur 404</title>
  
  
  
     
  
</head>

<body>

  <div id='oopss'>
<div id='error-text'>
<span>404</span>
<p>Vous n'avez pas l'autorisation pour accéder a cette séction du site, veuillez vous connecter ici  !!</p>
</div>
</div>
  
  

</body>

</html>









    ";

}
}
