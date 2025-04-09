<?php



include '.config.php';

$cred = new \Cdiscount\Api\Token();
$cred->setClientId('client_id');
$cred->setClientSecret('client_secret');
$token = $cred->getAccessToken();
if(!$cred->isSuccess()){
	print_r($token);
	die();
}

$api = new \Cdiscount\Api\Finances();
$api->setAccessToken('access_token');
$api->setSellerId('seller_id');
$api->setSubscriptionKey('finance_subscription_key');

$rsp = $api->getSellerPayments();

print_r($rsp);

$query = [
	'$limit' => 1,
	'$page' => 2,
];

$data = [
	"states"=> [
		"NotPayable",
		"InProcess"
	],
    "start_date"=> "2021-01-01T09:06:50.062Z",
    "end_date"=> "2021-12-12T09:06:50.062Z"
];


$rsp = $api->searchesSellerPayments($query,$data);
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);

$query = [
	'$limit' => 1,
	'$page' => 1,
];

$data = [
	"order_number"=> "2201101938B7FU8"
];


$rsp = $api->searchesSellerPaymentsDetails($query,$data);
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}
print_r($rsp);