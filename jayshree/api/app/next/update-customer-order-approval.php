<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

// $data = json_decode(file_get_contents('php://input'), true);


$process_id = $_POST['process_id'];
// $accountId = $_POST['accountId'];
// print_r($process_id);
// exit();

$result = array();

if ($conn -> query("UPDATE bookings SET customer_approve_status = 1 WHERE process_id = '$process_id'" ) 

) { $result = array( 'response' => 1 ); }
	else{
		$result = array( 'response' => 0 );
	}


echo json_encode($result);