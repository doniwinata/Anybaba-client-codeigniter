<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//adding config items.
use \Firebase\JWT\JWT;
$url = 'http://localhost:3000';
$handle = curl_init($url);


$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
if($httpCode == 0){
	$config['serv_url'] = 'https://anybaba-services.herokuapp.com';
}
else{
	$config['serv_url'] = $url;
}


curl_close($handle);
$client_id= 'this_is_client_id';
$client_secret = 'this_is_client_secret';
$service_secret = 'this_is_secret_key';

$key = $service_secret;
$token = array(
	"client_id" => $client_id,
	"client_secret" => $client_secret
	);

$jwt = JWT::encode($token, $key);

$config['token'] = $jwt;
