<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');




$data = json_decode(file_get_contents('php://input'), true);

$currency = 'INR';
$orderId = $data['order_id'];
$amount = $data['amount'];
// print_r($data);
// exit();

$arrayData = array( orderId=>$orderId, orderAmount=>$amount, orderCurrency=>$currency);
$url = 'https://test.cashfree.com/api/v2/cftoken/order';
function postData($arrayData = array(), $url)
{
$headers = array(
'Content-Type: application/json',
'x-client-id: 1520515e63d5612b1f28642840150251',
'x-client-secret: b40e1387b825c053d714968d51d827e80f850096'
);
$payload = json_encode($arrayData);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
$response_string = curl_exec($ch);
curl_close($ch);
// echo "<pre>" .$response_string. "</pre>";
echo $response_string;
}
postData($arrayData, $url);

        
?>