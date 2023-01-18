<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include('config.php');
$result = array();

$data = json_decode(file_get_contents('php://input'), true);
$accountId = $data['user_id'];
$otpNo = $data['otp'];

	$otp = $otpNo;
    $account_id = $accountId;

    if ($conn -> query("UPDATE accounts SET verification = '1' WHERE id = '$account_id'" )) { 
                $result = array( 'response' => '1', 'accountId' => $account_id, 'msg' => "Succssfully Verified" ); /* OTP Matched */
            } else { 
                $result = array( 'response' => '0' , 'msg' => "Something" ); /* OTP Miss Matched */ 
            }

echo json_encode($result); ?>