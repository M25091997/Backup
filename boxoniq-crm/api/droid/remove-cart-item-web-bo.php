<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents('php://input'), true);


include('../../config.php');

$result = [];
$process_id = $data['process_id'];

if (isset($data['cart_id'])) {
    $cart_id = $data['cart_id'];

    // find cart id exist or not
    // $d_cart_sql = "UPDATE subs_cart SET delete_status = 1 WHERE id = '$cart_id'";
    $d_cart_sql = "DELETE FROM subs_cart WHERE id = '$cart_id'";

    $d_cart_query = mysqli_query($conn, $d_cart_sql);

    // sub orders
    $o_cart_sql = "UPDATE subs_order SET status = 1 WHERE sub_cart_id = '$cart_id'";
    // $o_cart_sql = "DELETE FROM subs_order WHERE sub_cart_id = '$cart_id'";

    $o_cart_query = mysqli_query($conn, $o_cart_sql);

    if ($d_cart_query && $o_cart_query) {
        // order
        $cart_query = $conn->query("SELECT * FROM subs_order WHERE process_id = '$process_id'");
        while ($ssrow = mysqli_fetch_array($cart_query)) {
            // while ($row = mysqli_fetch_assoc($cart_query)) {
            $cartid = $ssrow['sub_cart_id'];


            $squery = $conn->query("SELECT * FROM subs_cart WHERE id = '$cartid' AND delete_status != 1");
            $srow = mysqli_fetch_assoc($squery);
            $amt = $srow['attr_price'];
            $item_qty = $srow['item_qty'];
            $t = (int)$item_qty * $amt;
            $total += $t;
        }
        $usBooking = $conn->query("UPDATE subs_booking SET total = '$total' WHERE process_id = '$process_id'");

        $result = array('response' => 1);
    } else {
        $result = array('response' => 0);
    }
} else {
    array_push($result,  array('response' => 'Please send Cart id not Found!'));
}

echo json_encode($result);
