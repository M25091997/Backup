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

// $data = json_decode(file_get_contents('php://input'), true);

$account_id = $_POST['account_id'];

$account_arr = $conn -> query("SELECT * FROM bookings WHERE account_id = '$account_id' ORDER BY id DESC");

// $account_arr2 = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone' AND password = '$password'");

if ( mysqli_num_rows($account_arr) != 0 ) {

	
	while ( $row = mysqli_fetch_array($account_arr) ) {

	$id = $row['id'];
	$process_id = $row['process_id'];
	$creation_time = $row['creation_time'];
	$creation_date = $row['creation_date'];
	$amount = $row['amount'];
	$order_status = $row['order_status'];
		if($order_status == 0){
			$status= "Pending";

		}

		if($order_status == 5){
			$status= "Cancelled";
		}
		if($order_status == 4){
			$status= "Completed";
		}

		$invoice = "https://cms.cybertizeweb.com/jayshree-crm/billing-desk/?id=".$id;


	$get_del_charge = $conn -> query("SELECT * FROM order_bank_detail WHERE process_id = '$process_id'");
	$row_del_charge = mysqli_fetch_assoc($get_del_charge);
	$del_charge = $row_del_charge['del_charge'];
	$pack_charge = $row_del_charge['pack_charge'];

	$new_amount = $amount + $del_charge + $pack_charge;

	


	array_push($result, array( 'response' => '1', 'id' => $id, 'order_id' => $process_id, 'order_time' => $creation_time, 'order_date' => $creation_date, 'amount' => $new_amount, 'status' => $status, 'order_status' => $order_status, 'invoice' => $invoice ));
  }

} else { $result = array(); }

echo json_encode($result);