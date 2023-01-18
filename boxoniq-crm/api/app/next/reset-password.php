<?php
// session_start();
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents('php://input'), true);

include('../../../config.php');

// $result = array();

$phone = $data['phone'];

$account_arr = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone'");

if ( mysqli_num_rows($account_arr) != 0 ) {

	while ( $row = mysqli_fetch_array($account_arr) ) {

	$otp = rand(11111, 99999);
	$account_id = $row['id'];

	$msg = "Your Password Reset OTP is: ".$otp." - ".$the_project;

    _SEND_MESSAGE_NEW($phone, $msg, "1207161786099974111");
    
	}

	if ( $conn -> query("UPDATE accounts SET otp = '$otp' WHERE id = '$account_id'") ) { 
    	$result = array( 'response' => '1', 'accountId' => $account_id, 'otp' => $otp );
    }else{

    	$result = array( 'response' => '0' );

    }

	

} else { array_push($result, array( 'response' => '333' )); }

echo json_encode($result);