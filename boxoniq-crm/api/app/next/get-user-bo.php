<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');

$result = array();

// $data = json_decode(file_get_contents('php://input'), true);

$userid = $_POST['user_id'];
$url = $site_url."/img/user/";


$account_arr = $conn -> query("SELECT * FROM accounts WHERE id = '$userid'");

// $account_arr2 = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone' AND password = '$password'");

if ( mysqli_num_rows($account_arr) != 0 ) {

	
	while ( $row = mysqli_fetch_array($account_arr) ) {

	$account_id = $row['id'];
	$address = $row['full_address'];
	$name = $row['name'];
	$baby_name = $row['baby_name'];
	$baby_dob = $row['baby_dob'];
	$refer_code = $row['refer_code'];


	$profile_img = $url.$row['profile_img'];
	$email = $row['email'];
	$phone = $row['phone'];
	$pincode = $row['pincode'];
	$landmark = $row['landmark'];
	}


	$result = array( 'response' => '1', 'accountId' => $account_id, 'img' => $profile_img, 'refer_code' => $refer_code, 'baby_name' => $baby_name, 'baby_dob' => $baby_dob, 'address' => $address, 'name' => $name, 'email' => $email, 'phone' => $phone, 'pincode' => $pincode, 'landmark' => $landmark );

} else { }

echo json_encode($result);