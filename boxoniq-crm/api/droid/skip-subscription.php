<?php

// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('../../config.php');
// $cart_items_array = array();
$final_cart_array = array();
$result = array();

$process_id = $_POST['process_id'];

if (isset($process_id)) {
    $sql = $conn->query("UPDATE subs_booking_history SET isskip = 1 WHERE process_id = '$process_id'");
    $sql_booking = $conn->query("UPDATE subs_booking SET isskip = 1 WHERE process_id = '$process_id'");

    // $sql_booking = $conn->query("DELETE FROM subs_booking WHERE process_id = '$process_id'");

    $sql_order = $conn->query("UPDATE subs_order SET isskip = 1 WHERE process_id = '$process_id'");
    $sql_order_history = $conn->query("UPDATE subs_order_history SET isskip = 1 WHERE process_id = '$process_id'");

    if ($sql && $sql_booking && $sql_order && $sql_order_history) {
        $result = array('response' => '1', 'msg' => 'Successfully Bundle Skipped!');
    } else {
        $result = array('response' => '0', 'msg' => 'Somthing Wrong!');
    }
} else {
    $result = array('response' => 'process_id missing');
}

echo json_encode($result);
