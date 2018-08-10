<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Weather extends CI_Model {

	public function connect()
	{
		$connect	=	array(
								'country'    =>	'TN',
								'city'       => 'djerba',
								'api'        => '8187218c2aca04ca' // Your API here
							);
	
	
	$json    =   file_get_contents('http://api.wunderground.com/api/'.$connect['api'].'/geolookup/conditions/q/'.$connect['country'].'/'.$connect['city'].'.json');

	$json2	=	file_get_contents('http://api.wunderground.com/api/'.$connect['api'].'/forecast/q/'.$connect['country'].'/'.$connect['city'].'.json');

	$json3	=	file_get_contents('http://api.wunderground.com/api/'.$connect['api'].'/hourly/q/'.$connect['country'].'/'.$connect['city'].'.json');
	$weather = array(
						'weather'	=>	json_decode($json,true),
						'forecast'	=>	json_decode($json2,true),
						'hourly'	=>	json_decode($json3,true)
					);
	return $weather;
	//http://api.wunderground.com/api/8187218c2aca04ca/geolookup/conditions/q/IN/dahanu.json
	//http://api.wunderground.com/api/8187218c2aca04ca/geolookup/conditions/q/tn/medenine.json

	}
}
