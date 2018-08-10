<?php
(defined('BASEPATH') || defined('SYSPATH')) or die('No direct access allowed.');

if(!defined('IP2LOCATION_DATABASE')) {
	define('IP2LOCATION_DATABASE', dirname(__FILE__) . '/ip2location/IP2LOCATION-DB.BIN');
}

require_once('ip2location/IP2Location.php');

class IP2Location_lib {
	private $database;

	protected static $ip2location;

	public function __construct() {
		self::$ip2location = new \IP2Location\Database(IP2LOCATION_DATABASE, \IP2Location\Database::FILE_IO);
	}

	public function getCountryCode($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::COUNTRY_CODE);
	}

	public function getCountryName($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::COUNTRY_NAME);
	}

	public function getRegionName($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::REGION_NAME);
	}

	public function getCityName($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::CITY_NAME);
	}

	public function getLatitude($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::LATITUDE);
	}

	public function getLongitude($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::LONGITUDE);
	}

	public function getISP($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::ISP);
	}

	public function getDomainName($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::DOMAIN_NAME);
	}

	public function getZIPCode($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::ZIP_CODE);
	}

	public function getTimeZone($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::TIME_ZONE);
	}

	public function getNetSpeed($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::NET_SPEED);
	}
	public function getIDDCode($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::IDD_CODE);
	}

	public function getAreaCode($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::AREA_CODE);
	}

	public function getWeatherStationCode($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::WEATHER_STATION_CODE);
	}

	public function getWeatherStationName($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::WEATHER_STATION_NAME);
	}

	public function getMCC($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::MCC);
	}

	public function getMNC($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::MNC);
	}

	public function getMobileCarrierName($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::MOBILE_CARRIER_NAME);
	}

	public function getElevation($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::ELEVATION);
	}

	public function getUsageType($ip=NULL) {
		return self::$ip2location->lookup(self::getIP($ip), \IP2Location\Database::USAGE_TYPE);
	}

	protected function getIP($ip=NULL) {
		return ($ip) ? $ip : $_SERVER['REMOTE_ADDR'];
	}
}
?>
