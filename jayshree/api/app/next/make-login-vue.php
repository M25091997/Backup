<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');

$result = array();

$data = json_decode(file_get_contents('php://input'), true);

$email = $data['login_email'];
$password = $data['login_password'];

$account_arr = $conn -> query("SELECT * FROM accounts WHERE email = '$email' AND password = '$password' AND verification = '1'");

// $account_arr2 = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone' AND password = '$password'");

if ( mysqli_num_rows($account_arr) != 0 ) {

	if( mysqli_num_rows($account_arr) != 0 ){
	while ( $row = mysqli_fetch_array($account_arr) ) {

	$account_id = $row['id'];
	$address = $row['full_address'];
	$name = $row['name'];
	$email = $row['email'];
	$phone = $row['phone'];

	}
	}


	array_push($result, array( 'response' => '1', 'accountId' => $account_id, 'address' => $address, 'name' => $name, 'email' => $email, 'phone' => $address ));

} else { array_push($result, array( 'response' => '444' )); }

echo json_encode($result);