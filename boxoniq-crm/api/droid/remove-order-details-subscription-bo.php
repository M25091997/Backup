<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('../../config.php');
$result = array();


// $data = json_decode(file_get_contents('php://input'), true);

// $accountId = $data['accountId'];
$process_id = $_POST['process_id'];



if (isset($process_id)) {

    $msg_query = $conn->query("SELECT * FROM orders WHERE process_id = '$process_id' ORDER BY id DESC ");
    $odC = mysqli_num_rows($msg_query);
    if ($odC > 0) {
        while ($msg_q = mysqli_fetch_array($msg_query)) {

            $msg_query = $conn->query("SELECT * FROM orders WHERE process_id = '$process_id' ORDER BY id DESC ");
            while ($msg_q = mysqli_fetch_array($msg_query)) {

                $cart_id = $msg_q['cart_id'];

                //   delete cart 
                $sCart = $conn->query("DELETE FROM cart WHERE id = '$cart_id'");

                // delete also orders table
                $oCart = $conn->query("DELETE FROM orders WHERE cart_id = '$cart_id'");

                // delete also booking table
                // $sCart = $conn->query("DELETE FROM bookings WHERE process_id = '$process_id'");
                if ($sCart && $oCart) {
                    $result = array('response' => '1');
                } else {
                    $result = array('response' => '2');
                }
            }
        }
    } else {
        $result = array('response' => 'No Data found!');
    }
} else {
    $result = array('response' => '0');
}



echo json_encode($result);
