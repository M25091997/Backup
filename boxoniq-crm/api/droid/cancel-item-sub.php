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

    $get_subprocess_id = $conn -> query("SELECT * FROM subs_booking_history WHERE process_id = '$process_id'");
    while($row_subprocess = mysqli_fetch_assoc($get_subprocess_id)){
        $sub_process_id = $row_subprocess['subsprocess_id'];
        $sql = $conn->query("UPDATE subs_booking_history SET iscancel = 1, subs_status = 0 WHERE subsprocess_id = '$sub_process_id'");

    }

    $sql_booking = $conn->query("UPDATE subs_booking SET iscancel = 1, subs_status = 0 WHERE process_id = '$process_id'");

    // $sql_booking = $conn->query("DELETE FROM subs_booking WHERE process_id = '$process_id'");

    // $sql_history = $conn->query("UPDATE subs_order_history SET iscancel = 1 WHERE process_id = '$process_id'");


    if ($sql) {
        $result = array('response' => '1', 'msg' => 'Successfully Bundle Canceled!');
    } else {
        $result = array('response' => '0', 'msg' => 'Somthing Wrong!');
    }
} else {
    $result = array('response' => 'process_id missing');
}

echo json_encode($result);
