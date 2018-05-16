<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Timedate extends MX_Controller
{

function __construct() {
parent::__construct();
}

function get_date($timestamp, $format)
{
	switch ($format) {
		case 'full':
		$the_date = date ('l jS\of F Y \a\t h:i:s A',$timestamp);
	break;

		case 'cool':
		$the_date = date ('l jS\of F Y ',$timestamp);
	break;
		case 'shorter':
		$the_date = date ('jS\of F Y',$timestamp);
	break;
		case 'datepicker':
		$the_date = date ('d\-m\-Y',$timestamp);
	break;
		case 'datepicker_us':
		$the_date = date ('m\/d\/Y',$timestamp);
	break;

	}
	return $the_date;
}

function make_timestamp_from_datepicker($datepicker)
{
	$hour=7;
	$minute=0;
	$second=0;

	$day= substr($datepicker, 0, 2);
	$month = substr($datepicker, 3, 2);
	$year = substr($datepicker, 6,4);
	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	return $timestamp;

}

function make_timestamp_from_datepicker_us($datepicker)
{
	$hour=7;
	$minute=0;
	$second=0;

	$month= substr($datepicker, 0, 2);
	$day = substr($datepicker, 3, 2);
	$year = substr($datepicker, 6,4);
	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	return $timestamp;

}

function make_timestamp($day,$month,$year)
{
	$hour=7;
	$minute=0;
	$second=0;
	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
	return $timestamp;

}
}