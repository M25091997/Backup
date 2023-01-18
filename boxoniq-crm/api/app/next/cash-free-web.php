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
$user_id = $data['user_id'];
$user_email = $data['user_email'];
$user_phone = $data['user_phone'];

// print_r($data);
// exit();

// $arrayData = array( orderId=>$orderId, order_amount=>$amount, order_currency=>$currency);
// {\"customer_details\":{\"customer_id\":\"12345\",\"customer_email\":\"user@example.com\",\"customer_phone\":\"1299087801\"},\"order_amount\":1,\"order_currency\":\"INR\",\"order_note\":\"test order\"}

// $payload = json_encode($arrayData);

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://sandbox.cashfree.com/pg/orders",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"customer_details\":{\"customer_id\":\"$user_id\",\"customer_email\":\"$user_email\",\"customer_phone\":\"$user_phone\"},\"order_amount\":$amount,\"order_currency\":\"INR\",\"order_note\":\"test order\"}",
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json",
    "x-api-version: 2022-01-01",
    "x-client-id: 1520515e63d5612b1f28642840150251",
     "x-client-secret: b40e1387b825c053d714968d51d827e80f850096"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(array("error" => 1));
  echo "cURL Error #:" . $err;
  die();

} else {
  $result = json_decode($response, true);
  header('Content-Type: application/json; charset=utf-8');
  $output = array("order_token" => $result["order_token"]);
  echo json_encode($output);
  die();
}

// $currency = 'INR';
// $orderId = $data['order_id'];
// $amount = $data['amount'];
// // print_r($data);
// // exit();

// $arrayData = array( orderId=>$orderId, orderAmount=>$amount, orderCurrency=>$currency);
// $url = 'https://test.cashfree.com/api/v2/cftoken/order';
// function postData($arrayData = array(), $url)
// {
// $headers = array(
// 'Content-Type: application/json',
// 'x-client-id: 1520515e63d5612b1f28642840150251',
// 'x-client-secret: b40e1387b825c053d714968d51d827e80f850096'
// );
// $payload = json_encode($arrayData);

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
// $response_string = curl_exec($ch);
// curl_close($ch);
// // echo "<pre>" .$response_string. "</pre>";
// echo $response_string;
// }
// postData($arrayData, $url);

        
?>