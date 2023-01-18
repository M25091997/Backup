<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('../../config.php');
$orders_array = array();
$result = array();


// $data = json_decode(file_get_contents('php://input'), true);

// $accountId = $data['accountId'];
// $process_id = $_POST['process_id'];
$qty = $_POST['qty'];
// $amount = $_POST['amount'];
$cart_id = $_POST['cart_id'];


if (isset($cart_id)) {
    // select cart
    $usCart = $conn->query("SELECT * FROM cart WHERE id = '$cart_id'");
    $usRow = mysqli_fetch_array($usCart);
    $sqty = $usRow['quantity'];
    $tamt = $usRow['total_amount'];

    $upamt = $qty * (int)$tamt;

    // update cart data
    $usCart = $conn->query("UPDATE cart SET quantity = '$qty', total_amount = '$upamt' WHERE id = '$cart_id'");

    // if true
    if ($usCart) {
        $result = array('response' => '1');
    } else {
        $result = array('response' => '0');
    }
} else {
    $result = array('response' => 'process id missing');
}



echo json_encode($result);
