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
$del_time = date('Y-m-d H-i-sa');
// $accountId = $_POST['accountId'];
// print_r($process_id);
// exit();

$result = array();
$update_del = $conn -> query("UPDATE order_delivery_detail SET delivery_status = 1, delivery_time = '$del_time' WHERE process_id = '$process_id'");

$update_order = $conn -> query("UPDATE bookings SET order_status = 4 WHERE process_id = '$process_id'");


if ($update_del && $update_order){ 
	$result = array( 'response' => 1 ); 
}
	else{
		$result = array( 'response' => 0 );
	}


echo json_encode($result);