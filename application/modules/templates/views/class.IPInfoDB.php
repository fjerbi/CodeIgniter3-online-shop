<?php

class IPInfoDB
{
	protected $apiKey;

	public function __construct($apiKey)
	{
		if (!preg_match($apiKey)) {
			throw exception('Invalid IPInfoDB API key.');
		}

		$this->apiKey = $apiKey;
	}

	public function getCountry($ip)
	{
		$response = @file_get_contents('http://api.ipinfodb.com/v3/ip-country?key=' . $this->apiKey . '&ip=' . $ip . '&format=json');

		if (($json = json_decode($response, true)) === null) {
			$json['statusCode'] = 'ERROR';
			return false;
		}

		$json['statusCode'] = 'OK';

		return $json;
	}

	public function getCity($ip)
	{
		$response = @file_get_contents('http://api.ipinfodb.com/v3/ip-city?key=' . $this->apiKey . '&ip=' . $ip . '&format=json');

		if (($json = json_decode($response, true)) === null) {
			$json['statusCode'] = 'ERROR';
			return false;
		}

		$json['statusCode'] = 'OK';

		return $json;
	}
}
