<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');

$result = array();

$data = json_decode(file_get_contents('php://input'), true);
$phone = $_POST['phone'];

// $phone = $_POST['mobile'];

$account_arr = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone'");

if ( mysqli_num_rows($account_arr) != 0 ) {

	while ( $row = mysqli_fetch_array($account_arr) ) {

	$otp = $row['otp'];
	$account_id = $row['id'];

	$msg = "Your Password Reset OTP is: ".$otp." - ".$the_project;

    _SEND_MESSAGE_NEW($phone, $msg, "1207161786099974111");
    
    $_SESSION['account-id-password-reset'] = $row['id'];

	}

	$result = array( 'response' => '1', 'account-id' => $account_id);

} else { $result = array( 'response' => '0', 'msg' => 'Something went wrong' ); }

echo json_encode($result);