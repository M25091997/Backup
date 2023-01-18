<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

// $data = json_decode(file_get_contents('php://input'), true);


$user_id = $_POST['user_id'];
$item_id = $_POST['item_id'];
$price = $_POST['price'];
$attribute = $_POST['attr_id'];
$qty = $_POST['qty'];


$result = array();

if ($user_id != "" && $item_id != "") {
	$total = $qty * $price;

if ($conn -> query("UPDATE cart SET quantity ='$qty', attribute_id = '$attribute', total_amount = '$total' WHERE account_id = '$user_id' && item_id = '$item_id' && checkout = '0' " ) 

) { $result = array( 'response' => '1', 'msg' => 'Updated Product Quantity' ); }

} else { $result = array( 'response' => '0' ); /* No Sessions Mismatch */ } 

echo json_encode($result);