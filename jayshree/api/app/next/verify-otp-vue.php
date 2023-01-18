<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');
$result = array();

// $data = json_decode(file_get_contents('php://input'), true);
$accountId = $_POST['account_id'];
$otpNo = $_POST['otp'];

	$otp = $otpNo;
    $account_id = $accountId;

    if ($conn -> query("UPDATE accounts SET verification = '1' WHERE id = '$account_id'" )) { 
                array_push($result, array( 'response' => '1', 'accountId' => $account_id ) ); /* OTP Matched */
            } else { array_push($result, array( 'response' => '0' ) ); /* OTP Miss Matched */ }

echo json_encode($result); ?>