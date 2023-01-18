<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');
$result = array();

$data = json_decode(file_get_contents('php://input'), true);
$reset = $data['reset'];
$accId = $data['accId'];
$password = $data['password'];

	$otp = $reset;
    $password = $password;
    $account_id = $accId;

    if ( $conn -> query("UPDATE accounts SET password = '$password' WHERE id = '$account_id' AND otp = '$otp' ") ) { 
    	array_push($result, array( 'response' => '1' ) ); /* OTP Matched */
    }

echo json_encode($result); ?>