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
$total = 0;

// $data = json_decode(file_get_contents('php://input'), true);

// print_r($_POST);
// exit();

// post data
$attr_id = $_POST['attr_id'];
$qty = $_POST['qty'];
$account_id = $_POST['user_id'];
$item_id = $_POST['product_id'];
$process_id = $_POST['process_id'];

$date = date('Y-m-d');
$checkout = 1;


if (isset($process_id)) {

    // attributes table
    $sAtt = "SELECT * FROM attributes WHERE id = '$attr_id'";
    $squery = mysqli_query($conn, $sAtt);
    $sRow = mysqli_fetch_assoc($squery);
    $mrp = $sRow['mrp'];
    $price = $sRow['price'];

    // items table
    $sItm = "SELECT * FROM items WHERE id = '$item_id'";
    $iquery = mysqli_query($conn, $sItm);
    $iRow = mysqli_fetch_array($iquery);
    $cat_id = $iRow['category_id'];

    // total amount
    $total_amount = $qty * $price;

    // insert into cart table
    $iCart = $conn->query("INSERT INTO subs_cart (item_id, attr_id, attr_price, item_qty, delete_status, account_id, cat_id) VALUES ('$item_id','$attr_id','$price','$qty',0, '$account_id', '$cat_id')");

    if ($iCart) {

        // cart
        $ssql = "SELECT * FROM `subs_cart` WHERE delete_status != 1 ORDER BY id DESC limit 1";
        $squery = mysqli_query($conn, $ssql);
        $srow = mysqli_fetch_assoc($squery);
        $cartid = $srow['id'];
        
        $get_sub_process = $conn -> query("SELECT subprocess_id FROM subs_order WHERE process_id = '$process_id' ");
        $subprocess_id = mysqli_fetch_assoc($get_sub_process)['subprocess_id'];

        // $rand_process = rand().time();

        // insert into order table
        $iOdr = $conn->query("INSERT INTO subs_order (process_id, subprocess_id, sub_cart_id, cat_id) VALUES ('$process_id','$subprocess_id','$cartid', '$cat_id')");

        $item_count = $conn ->query("SELECT * FROM subs_order WHERE process_id = '$process_id' && subprocess_id = '$subprocess_id'");
        $it_count = mysqli_num_rows($item_count);

        // order
        $cart_query = $conn->query("SELECT * FROM subs_order WHERE process_id = '$process_id' AND status != 1");
        while ($ssrow = mysqli_fetch_array($cart_query)) {
            // while ($row = mysqli_fetch_assoc($cart_query)) {
            $cartid = $ssrow['sub_cart_id'];


            $squery = $conn->query("SELECT * FROM subs_cart WHERE id = '$cartid' AND delete_status != 1");
            $srow = mysqli_fetch_assoc($squery);
            $amt = $srow['attr_price'];
            $item_qty = $srow['item_qty'];
            $t = $amt * (int)$item_qty;
            $total += $t;
        }
        $usBooking = $conn->query("UPDATE subs_booking SET total = '$total', total_items = '$it_count' WHERE process_id = '$process_id'");


        // query success
        if ($iOdr) {
            $result = array('response' => '1');
        } else {
            $result = array('response' => '0');
        }
    }
} else {
    $result = array('response' => 'process id missing');
}



echo json_encode($result);
