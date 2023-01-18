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
$wallet_history = array();


// print_r($_POST);
// exit();

if ( isset($data['user_id']) ) {
	
$user_id = $data['user_id'];

$get_wallet = $conn -> query("SELECT * FROM wallet WHERE user_id = '$user_id' ");
$count = mysqli_num_rows($get_wallet);

if (mysqli_num_rows($get_wallet) > 0) {
	$row = mysqli_fetch_array($get_wallet);
	
	$wallet_id = $row['id'];
	$wallet_amount = $row['amount'];
	$get_wallet_history = $conn -> query("SELECT * FROM wallet_history WHERE wallet_id = '$wallet_id' ORDER BY id DESC ");

if (mysqli_num_rows($get_wallet_history) > 0) {
	while ( $row_his = mysqli_fetch_array($get_wallet_history) ) {

		$amount = $row_his['amount'];
		$tran_id = $row_his['tran_id'];
		$type = $row_his['type'];
		$msg = $row_his['msg'];
		$created_on = $row_his['created_on'];

		if($type == "credit"){
			$type = 1;
		}else{
			$type = 0;
		}


	array_push($wallet_history, array('amount' => $amount, 'tran_id' => $tran_id, 'type' => $type, 'msg' => $msg, 'created_on' => $created_on ));
		}

		}else{array_push($result, array( 'response' => 0, 'msg' => 'Something went wrong13' )); }		
	
	
}else{array_push($result, array( 'response' => 0, 'msg' => 'Something went wrong12' )); }	
 
	

} else { array_push($result, array( 'response' => 0, 'msg' => 'Something went wrong11' ));}

$result['wallet_balance'] = $wallet_amount;

$result['wallet_history'] = $wallet_history;

echo json_encode($result);