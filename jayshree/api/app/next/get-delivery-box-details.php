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
// $delivered_order = array();

// $data = json_decode(file_get_contents('php://input'), true);

$process_id = $_POST['process_id'];
$url = $site_url."/images/delivery_bill/";

$sel_order = $conn -> query("SELECT * FROM order_delivery_detail WHERE process_id = '$process_id' ORDER BY id DESC LIMIT 1");

if ( mysqli_num_rows($sel_order) != 0 ) {
	$row_box = mysqli_fetch_assoc($sel_order);
	$big_box = $row_box['big_box'];
	$medium_box = $row_box['medium_box'];
	$small_box = $row_box['small_box'];
	// $delivery_date = $row_box['delivery_date'];
	$del_charge = $row_box['del_charge'];
	$pack_charge = $row_box['pack_charge'];
	$delivery_status = $row_box['delivery_status'];
	$image = $url.$row_box['delivery_bill'];
	$description = $row_box['description'];
	$delivery_time = explode(" ",$row_box['delivery_time']);
	$delivery_date = $delivery_time[0];
	$del_time = $delivery_time[1];


	$total = $big_box + $medium_box + $small_box;

	
	$result = array( 'response' => 1, 'big_box' => $big_box, 'medium_box' => $medium_box, 'small_box' => $small_box, 'delivery_date' => $delivery_date, 'del_time' => $del_time, 'total' => $total, 'delivery_status' => $delivery_status, 'image' => $image, 'del_charge' => $del_charge, 'pack_charge' => $pack_charge, 'description' => $description );
  

} else { $result = array( 'response' => 0 ); }


echo json_encode($result);