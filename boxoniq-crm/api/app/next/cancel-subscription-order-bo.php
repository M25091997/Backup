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



$accountId = $_POST['user_id'];
$process_id = $_POST['process_id'];
$order_status = 5;

// print_r($_POST);
// exit();


$result = array();

if (isset($accountId) && isset($process_id)) {
    $update_profile = $conn -> query("UPDATE subs_booking_history SET order_status ='$order_status' WHERE user_id = '$accountId' && process_id = '$process_id'"); 

        if ($update_profile){ 
            $result = array( 'response' => '1', 'msg' => 'Order is Cancelled Successfully' ); 
        } else {
            $result = array( 'response' => '0', 'msg' => 'Something went wrong' ); 
        }

} else { 
    $result = array( 'response' => '0', 'msg' => 'Something went wrong' ); /* No Sessions Mismatch */ 
} 

echo json_encode($result);