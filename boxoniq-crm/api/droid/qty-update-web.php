<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('../../config.php');
$orders_array = array();
$result = array();


$data = json_decode(file_get_contents('php://input'), true);

// $accountId = $data['accountId'];
// $process_id = $_POST['process_id'];
$qty = $data['qty'];
// $amount = $data['amount'];
$cart_id = $data['cart_id'];
$process_id = $data['process_id'];
$total = 0;


if (isset($cart_id)) {
    // select cart
    // $usCart = $conn->query("SELECT * FROM cart WHERE id = '$cart_id'");
    // $usRow = mysqli_fetch_array($usCart);
    // $sqty = $usRow['quantity'];
    // $tamt = $usRow['total_amount'];

    // $upamt = $qty * (int)$tamt;

    // update cart data
    if ($qty > 0) {

        // select cart
        $ssCart = $conn->query("SELECT * FROM subs_cart WHERE id = '$cart_id' AND delete_status = '0'");
        $ssrow = mysqli_fetch_array($ssCart);
        $atrid = $ssrow['attr_id'];

        // attribute
        $aCart = $conn->query("SELECT * FROM attributes WHERE id = '$atrid'");
        $arow = mysqli_fetch_array($aCart);
        $atramt = $arow['price'];


        $upamt = (int)$qty * $atramt;

        // update cart price
        $usCart = $conn->query("UPDATE subs_cart SET item_qty = '$qty' WHERE id = '$cart_id' AND delete_status = '0'");

        // if true
        if ($usCart) {
            $cart_query = $conn->query("SELECT * FROM subs_order WHERE process_id = '$process_id'");
            while ($ssrow = mysqli_fetch_array($cart_query)) {
                // while ($row = mysqli_fetch_assoc($cart_query)) {
                $cartid = $ssrow['sub_cart_id'];


                $squery = $conn->query("SELECT * FROM subs_cart WHERE id = '$cartid' AND delete_status = '0'");
                $srow = mysqli_fetch_assoc($squery);
                $amt = $srow['attr_price'];
                $item_qty = $srow['item_qty'];
                $t = $amt * (int)$item_qty;
                $total += $t;
            }
            $usBooking = $conn->query("UPDATE subs_booking SET total = '$total' WHERE process_id = '$process_id'");

            // success
            if ($usBooking) {
                $result = array('response' => '1');
            } else {
                $result = array('response' => '0');
            }
        } else {
            $result = array('response' => 'cart not updated');
        }
    } else {
        $result = array('response' => 'qty not be 0');
    }
} else {
    $result = array('response' => 'cart id missing');
}



echo json_encode($result);
