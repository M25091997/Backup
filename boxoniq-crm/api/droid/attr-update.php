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
// $qty = $_POST['qty'];
$attr_id = $_POST['attr_id'];
$cart_id = $_POST['cart_id'];
$process_id = $_POST['process_id'];
$total = 0;


if (isset($process_id)) {

    // update cart data
    if ($cart_id) {


        // get quantity from cart table
        $ssCart = $conn->query("SELECT * FROM subs_cart WHERE id = '$cart_id' AND delete_status = '0'");
        $ssrow = mysqli_fetch_array($ssCart);
        $atrqty = $ssrow['item_qty'];


        // get attribute price form attribute table
        $aCart = $conn->query("SELECT * FROM attributes WHERE id = '$attr_id'");
        $arow = mysqli_fetch_array($aCart);
        $atramt = $arow['price'];


        // update total amount
        $upamt = (int)$atrqty * $atramt;

        // update cart price
        $usCart = $conn->query("UPDATE subs_cart SET attr_id = '$attr_id', item_qty = '$atrqty', attr_price = '$atramt' WHERE id = '$cart_id'");

        // if true
        if ($usCart) {
            $cart_query = $conn->query("SELECT * FROM subs_order WHERE process_id = '$process_id'");
            while ($ssrow = mysqli_fetch_array($cart_query)) {
                $cartid = $ssrow['sub_cart_id'];

                // select cart id from cart table
                $squery = $conn->query("SELECT * FROM subs_cart WHERE id = '$cartid' AND delete_status = '0'");
                $srow = mysqli_fetch_assoc($squery);
                $amt = $srow['attr_price'];
                $item_qty = $srow['item_qty'];
                $t = (int)$item_qty * $amt;
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
        $result = array('response' => 'cart id not be found');
    }
} else {
    $result = array('response' => 'process id missing');
}



echo json_encode($result);
