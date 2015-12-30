<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//adding config items.
use \Firebase\JWT\JWT;
$url = 'https://localhost:3000';

$handle = curl_init($url);


curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($handle, CURLOPT_TIMEOUT,1);
curl_setopt ($handle, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt ($handle, CURLOPT_SSL_VERIFYPEER, 0); 
$result = curl_exec($handle);

$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);

if($httpCode == 0){
	$config['serv_url'] = 'https://localhost:3030';
}
else{
	$config['serv_url'] = $url;
}
//$config['serv_url'] = $url;

curl_close($handle);
$client_id= '0UgWuwIEeATm';
$service_secret = 'MD8CAQACCQC+jQHtWqZAXQIDAQABAghI';
$config['service_secret'] = $service_secret;
$date = new DateTime();
$config['time'] = $date->getTimestamp();
$key = $service_secret;
$token = array(
	"client_id" => $client_id,
	"timestamp" =>  $date->getTimestamp()
	);

$jwt = JWT::encode($token, $key);
$config['token'] = $jwt;
