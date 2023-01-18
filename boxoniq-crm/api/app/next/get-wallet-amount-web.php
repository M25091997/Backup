<?php

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents('php://input'), true);


include('../../../config.php');

$result = array();

if ( isset($data['user_id']) ) {
	
$user_id = $data['user_id'];

$get_wallet = $conn -> query("SELECT * FROM wallet WHERE user_id = '$user_id' ");
$count = mysqli_num_rows($get_wallet);

if (mysqli_num_rows($get_wallet) > 0) {
	$row = mysqli_fetch_array($get_wallet);
	
	$wallet_id = $row['id'];
	$wallet_amount = $row['amount'];
	
	$result = array('response' =>1, 'wallet_balance' => $wallet_amount);

		}else{$result = array( 'response' => 0, 'msg' => 'Something went wrong13' ); }		
	
	
}else{$result = array( 'response' => 0, 'msg' => 'Something went wrong12' ); }	
 
echo json_encode($result);