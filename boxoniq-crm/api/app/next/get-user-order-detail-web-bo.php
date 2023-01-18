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

$userid = $data['user_id'];

$get_order = $conn -> query("SELECT * FROM bookings WHERE account_id = '$userid' ORDER BY id DESC LIMIT 1");


if ( mysqli_num_rows($get_order) != 0 ) {

	$row_order = mysqli_fetch_assoc($get_order);
	$process_id = $row_order['process_id'];

	$new_order_id = "BOXONIQ" . substr($process_id, 0, 8);

	$result = array( 'response' => '1', "order_id" => $new_order_id );

} else { }

echo json_encode($result);