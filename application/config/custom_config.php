<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//adding config items.
use \Firebase\JWT\JWT;
$config['serv_url'] = 'http://localhost:3000';

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
