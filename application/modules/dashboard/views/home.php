<?php
// GET VISITOR IP
function get_ip() {
if (isset($_SERVER['HTTP_CLIENT_IP'])) {
return $_SERVER['HTTP_CLIENT_IP'];
}
elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
return $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else {
return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
}
}
$ip=get_ip();
// USE AN API TO GET VISITOR DATA
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
if($query && $query['status'] == 'success') {
echo "VISITOR ISP IS :".$query['isp']."<br/>";
echo "VISITOR COUNTRY IS :".$query['country']."<br/>";
echo "VISITOR COUNTRY CODE IS :".$query['countryCode']."<br/>";
echo "VISITOR REGION IS :".$query['region']."<br/>";
echo "VISITOR REGION NAME IS :".$query['regionName']."<br/>";
echo "VISITOR CITY IS :".$query['city']."<br/>";
echo "VISITOR ZIP CODE IS :".$query['zip']."<br/>";
echo "VISITOR LATITUDE IS :".$query['lat']."<br/>";
echo "VISITOR TIMEZONE IS :".$query['timezone']."<br/>";
echo "VISITOR ORG IS :".$query['org']."<br/>";
echo "VISITOR AS IS :".$query['as']."<br/>";
} 
else
{
echo 'Something is wrong !';	
}
?>
