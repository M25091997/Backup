<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');


$del_book = $conn -> query("TRUNCATE TABLE bookings");
$del_payment_history = $conn -> query("TRUNCATE TABLE payment_history");
$del_orders = $conn -> query("TRUNCATE TABLE orders");
$del_cart = $conn -> query("TRUNCATE TABLE cart");

$del_subs_book = $conn -> query("TRUNCATE TABLE subs_booking");
$del_subs_book_his = $conn -> query("TRUNCATE TABLE subs_booking_history");
$del_subs_order = $conn -> query("TRUNCATE TABLE subs_order");
$del_subs_order_history = $conn -> query("TRUNCATE TABLE subs_order_history");
$del_subs_cart = $conn -> query("TRUNCATE TABLE subs_cart");
$del_subs_cart_history = $conn -> query("TRUNCATE TABLE subs_cart_history");

if($del_subs_book && $del_subs_book_his && $del_subs_order && $del_subs_order_history && $del_subs_cart && $del_subs_cart_history && $del_payment_history){
    $result = array('response' => 1);
}

echo json_encode($result);

?>