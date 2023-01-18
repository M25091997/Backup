<?php

$auth_token = $_POST['auth_token'];
$track_id = $_POST['track_id'];

$client = new Client();
$headers = [
  'Content-Type' => 'text/plain'
];

$body = '
  "auth_token": "$auth_token",
  "tracking_id": "$track_id",

';
$request = new Request('POST', 'https://pickrr.com/api/order-cancellation/', $headers, $body);
$res = $client->sendAsync($request)->wait();
echo $res->getBody();
?>