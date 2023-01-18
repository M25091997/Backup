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
$cart = array();
$address = array();
$bank = array();
$bank_st = array();

$url = $site_url . "/images/qrcode/";



// $data = json_decode(file_get_contents('php://input'), true);

$process_id = $_POST['process_id'];
// print_r($process_id);
// exit();

$sel_book_bank_status = $conn->query("SELECT * FROM bookings WHERE process_id = '$process_id'");
$row_bank_status = mysqli_fetch_assoc($sel_book_bank_status);
$bank_status = $row_bank_status['bank_status'];
$customer_approve_status = $row_bank_status['customer_approve_status'];
$amount = $row_bank_status['amount'];


if ($bank_status == 1) {
	$bank_st = array('response' => 1, 'bank_status' => $bank_status);
} else {
	$bank_st = array('response' => 0, 'bank_status' => $bank_status);
}

// $sel_pack = $conn -> query("SELECT * FROM order_delivery_detail WHERE process_id = '$process_id'");
// $count_pack = mysqli_num_rows($sel_pack);
// if($count_pack > 0){
// 	$row_pack = mysqli_fetch_assoc($sel_pack);
// 	$del_charge = $row_pack['del_charge'];
// 	$pack_charge = $row_pack['pack_charge'];
// }


$sel_bank = $conn->query("SELECT * FROM order_bank_detail WHERE process_id = '$process_id' ORDER BY id DESC LIMIT 1");
$count_bank = mysqli_num_rows($sel_bank);
if ($count_bank > 0) {
	$row_bank = mysqli_fetch_assoc($sel_bank);
	$acc_no = $row_bank['acc_no'];
	$acc_name = $row_bank['acc_name'];
	$ifsc = $row_bank['ifsc'];
	$phonepe = $row_bank['phonepe'];
	$googlepe = $row_bank['googlepe'];
	$bank_name = $row_bank['bank_name'];
	$qrcode = $url . $row_bank['qrcode'];
	$del_charge = $row_bank['del_charge'];
	$pack_charge = $row_bank['pack_charge'];

	$bank = array('response' => 1, 'bank_name' => $bank_name, 'account_no' => $acc_no, 'acc_name' => $acc_name, 'ifsc' => $ifsc, 'phonepe' => $phonepe, 'googlepe' => $googlepe, 'qrcode' => $qrcode);
} else {
	$bank = array('response' => 0, 'bank_name' => '', 'account_no' => '', 'acc_name' => '', 'ifsc' => '', 'phonepe' => '', 'googlepe' => '');
}




$account_arr = $conn->query("SELECT * FROM orders WHERE process_id = '$process_id'");

// $account_arr2 = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone' AND password = '$password'");

if (mysqli_num_rows($account_arr) != 0) {


	while ($row = mysqli_fetch_array($account_arr)) {

		$id = $row['id'];
		$cart_id = $row['cart_id'];
		// print_r($cart_id);
		// exit();

		$sql_cart = $conn->query("SELECT * FROM cart WHERE id = '$cart_id'");
		$row_cart = mysqli_fetch_array($sql_cart);
		$mrp = $row_cart['mrp'];
		$qty = $row_cart['quantity'];
		$total_amount = $row_cart['total_amount'];
		$item_id = $row_cart['item_id'];
		$account_id = $row_cart['account_id'];

		// print_r($mrp);
		// exit();

		$sql_item = $conn->query("SELECT * FROM items WHERE id = '$item_id' ");
		$row_item = mysqli_fetch_assoc($sql_item);

		$name = $row_item['name'];
		$media = $row_item['media_number'];
		// print_r($media);
		// exit();

		$sql_img = $conn->query("SELECT * FROM media WHERE media_number = '$media' ");
		$row_img = mysqli_fetch_assoc($sql_img);

		$pro_image = $row_img['file_name'];


		$img = $site_url . "/media/" . $pro_image;

		array_push($cart, array('response' => '1', 'name' => $name, 'img' => $img, 'qty' => $qty, 'price' => $mrp, 'total_amount' => $total_amount));
	}

	$sql_acc = $conn->query("SELECT * FROM saved_address WHERE account_id = '$account_id' ORDER BY id DESC limit 1 ");
	$row_add = mysqli_fetch_assoc($sql_acc);
	$mobile = $row_add['mobile'];
	$transport = $row_add['transport'];
	$shop_name = $row_add['shop_name'];
	$full_address = $row_add['full_address'];

	$amt = $amount + $del_charge + $pack_charge;

	$address = array('mobile' => $mobile, 'transport' => 'truck', 'sub_total' => $amount, 'shop_name' => $shop_name, 'full_address' => $full_address, 'amount' => $amt, 'del_charge' => $del_charge, 'pack_charge' => $pack_charge);
} else {
	$result = array('response' => '0');
}

$result['cart_items'] = $cart;
$result['address'] = $address;
$result['bank_detail'] = $bank;
$result['bank_status'] = $bank_status;
$result['approve_status'] = $customer_approve_status;

// $result['bank_no'] = $count_bank;



echo json_encode($result);
