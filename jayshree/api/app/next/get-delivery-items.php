<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$result = array();
$delivered_order = array();

// $data = json_decode(file_get_contents('php://input'), true);

$account_id = $_POST['account_id'];
// print_r($process_id);
// exit();

$sel_book_bank_status = $conn -> query("SELECT * FROM bookings WHERE account_id = '$account_id' && bank_status = 1 && customer_approve_status = 1 ORDER BY id DESC LIMIT 1 ");
$row_bank_status = mysqli_fetch_assoc($sel_book_bank_status);
$process_id = $row_bank_status['process_id'];
$amount = $row_bank_status['amount'];

$sel_order = $conn -> query("SELECT * FROM orders WHERE process_id = '$process_id'");

if ( mysqli_num_rows($sel_order) != 0 ) {
	// while ( $row = mysqli_fetch_array($sel_order) ) {
	$row = mysqli_fetch_array($sel_order);

	$item_count = mysqli_num_rows($sel_order);


	// $id = $row['id'];
	// $cart_id = $row['cart_id'];
	

	// $sql_cart = $conn -> query("SELECT * FROM cart WHERE id = '$cart_id'");
	// $row_cart = mysqli_fetch_array($sql_cart);
	// $mrp = $row_cart['mrp'];
	// $qty = $row_cart['quantity'];
	// $total_amount = $row_cart['total_amount'];
	// $item_id = $row_cart['item_id'];
	// $account_id = $row_cart['account_id'];

	$get_del_charge = $conn -> query("SELECT * FROM order_bank_detail WHERE process_id = '$process_id'");
	$row_del_charge = mysqli_fetch_assoc($get_del_charge);
	$del_charge = $row_del_charge['del_charge'];
	$pack_charge = $row_del_charge['pack_charge'];

	$new_amount = $amount + $del_charge + $pack_charge;
	

	// array_push($cart, array( 'response' => '1',  'qty' => $qty, 'price' => $mrp, 'total_amount' => $total_amount ));
		array_push($delivered_order, array( 'response' => 1, 'process_id' => $process_id, 'item_count' => $item_count, 'total' => $new_amount ));
  // }
	
	// $result = array( 'response' => 1, 'process_id' => $process_id, 'item_count' => $item_count, 'total' => '500' );
  

} else { $result = array( 'response' => 0 ); }

// $result['delivered_order_items'] = $delivered_order;


// $result['bank_no'] = $count_bank;



echo json_encode($delivered_order);