<?php
session_start();
include('../../../config.php');

$result = array();
$wallet_history = array();


// print_r($_POST);
// exit();

if ( isset($_POST['user_id']) ) {
	
$user_id = $_POST['user_id'];

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