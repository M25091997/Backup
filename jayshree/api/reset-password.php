<?php
session_start();
include('../config.php');

$result = array();

$phone = $_REQUEST['mobile'];

$account_arr = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone'");

if ( mysqli_num_rows($account_arr) != 0 ) {

	while ( $row = mysqli_fetch_array($account_arr) ) {

	$otp = $row['otp'];

	$msg = "Your Password Reset OTP is: ".$otp." - ".$the_project;

    _SEND_MESSAGE_NEW($phone, $msg, "1207161786099974111");
    $_SESSION['account-id-password-reset'] = $row['id'];

	}

	array_push($result, array( 'response' => '1', 'account-id' => $account_id ));

} else { array_push($result, array( 'response' => '333' )); }

echo json_encode($result);