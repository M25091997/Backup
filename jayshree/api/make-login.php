<?php
session_start();
include('../config.php');

$result = array();

$phone = $_REQUEST['email'];
$password = $_REQUEST['password'];

$account_arr = $conn -> query("SELECT * FROM accounts WHERE email = '$phone' AND password = '$password'");

if ( mysqli_num_rows($account_arr) != 0 ) {

	while ( $row = mysqli_fetch_array($account_arr) ) {

	$account_id = $_SESSION['account-id'] = $row['id'];
	$_SESSION['username'] = $row['email'];
	$_SESSION['name'] = $row['name'];

	}

	array_push($result, array( 'response' => '1', 'account-id' => $account_id ));

} else { array_push($result, array( 'response' => '444' )); }

echo json_encode($result);