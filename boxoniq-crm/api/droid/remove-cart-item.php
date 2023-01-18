<?php
session_start();
include('../../config.php');

$result = [];
$process_id = $_POST['process_id'];

if (isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];

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

        array_push($result,  array('response' => true));
    } else {
        array_push($result,  array('response' => false));
    }
} else {
    array_push($result,  array('response' => 'Please send Cart id not Found!'));
}

echo json_encode($result);
