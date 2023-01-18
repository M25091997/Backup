<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$result = array();

$data = json_decode(file_get_contents('php://input'), true);

$userid = $data['userid'];

$account_arr = $conn -> query("SELECT * FROM accounts WHERE id = '$userid'");

// $account_arr2 = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone' AND password = '$password'");

if ( mysqli_num_rows($account_arr) != 0 ) {

	
	while ( $row = mysqli_fetch_array($account_arr) ) {

	$account_id = $row['id'];
	$address = $row['full_address'];
	$name = $row['name'];
	$email = $row['email'];
	$phone = $row['phone'];
	$pincode = $row['pincode'];
	$landmark = $row['landmark'];
	}


	array_push($result, array( 'response' => '1', 'accountId' => $account_id, 'address' => $address, 'name' => $name, 'email' => $email, 'phone' => $phone, 'pincode' => $pincode, 'landmark' => $landmark ));

} else { array_push($result, array( 'response' => '444' )); }

echo json_encode($result);