<?php

$route['users/logout'] 	= "users/logout";
$route['users/account']	= "users/account";
$route['users/signin'] 	= "users/signin";
$route['users/signup'] 	= "users/signup";
$route['users/(:any)'] 	= "users/user/$1";

?>