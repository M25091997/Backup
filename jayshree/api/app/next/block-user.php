<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$result = array();

// $data = json_decode(file_get_contents('php://input'), true);

$userid = $_POST['user_id'];

$account_arr = $conn -> query("SELECT approve FROM accounts WHERE id = '$userid'");

// $account_arr2 = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone' AND password = '$password'");

if ( mysqli_num_rows($account_arr) != 0 ) {
	
	while ( $row = mysqli_fetch_array($account_arr) ) {
		$approve = $row['approve'];
	}

	if($approve == 1){
		$result = array( 'response' => 1);
	}
	if($approve == 0){
		$result = array( 'response' => 0);
	}
} else { 
	$result = array( 'response' => 2);
 }

echo json_encode($result);