<?php
// session_start();
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
// header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// $data = json_decode(file_get_contents('php://input'), true);

include('../app/next/config.php');

// $result = array();
// print_r($_POST);
// exit();

$phone = $_POST['phone'];

$account_arr = $conn->query("SELECT * FROM accounts WHERE phone = '$phone'");

if (mysqli_num_rows($account_arr) != 0) {

	// while ( $row = mysqli_fetch_array($account_arr) ) {

	$row = mysqli_fetch_array($account_arr);

	$otp = rand(111111, 999999);
	$account_id = $row['id'];

	$msg = "Your Signup OTP is: " .$otp."\n- ".$the_project; 

	// _SEND_MESSAGE_NEW($phone, $msg, "1207161761199657681");
	$send_msg = _SEND_MESSAGE_NEW($phone, $msg, "1207161761199657681");

	// }

	if ($conn->query("UPDATE accounts SET otp = '$otp' WHERE id = '$account_id'")) {
		$result = array('response' => '1', 'accountId' => $account_id, 'otp' => $otp, 'msg' => 'OTP sent Successfully');
	} else {

		$result = array('response' => '0', 'msg' => 'Something went wront');
	}
} else {
	array_push($result, array('response' => '333'));
}

echo json_encode($result);




?>
