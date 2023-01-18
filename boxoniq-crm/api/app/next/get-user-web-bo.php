<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$data = json_decode(file_get_contents('php://input'), true);


$result = array();

// $data = json_decode(file_get_contents('php://input'), true);

$userid = $data['user_id'];
$url = $site_url."/img/user/";


$account_arr = $conn -> query("SELECT * FROM accounts WHERE id = '$userid'");

// $account_arr2 = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone' AND password = '$password'");

if ( mysqli_num_rows($account_arr) != 0 ) {

	
	while ( $row = mysqli_fetch_array($account_arr) ) {

	$account_id = $row['id'];
	// $address = $row['full_address'];
	$name = $row['name'];
	$baby_name = $row['baby_name'];
	$baby_dob = $row['baby_dob'];
	$refer_code = $row['refer_code'];


	$profile_img = $url.$row['profile_img'];
	$email = $row['email'];
	$phone = $row['phone'];
	// $pincode = $row['pincode'];
	// $landmark = $row['landmark'];
	}


	$result = array( 'response' => '1', 'refer_code' => $refer_code, 'img' => $profile_img, 'baby_name' => $baby_name, 'baby_dob' => $baby_dob, 'name' => $name, 'email' => $email, 'phone' => $phone );

} else { }

echo json_encode($result);