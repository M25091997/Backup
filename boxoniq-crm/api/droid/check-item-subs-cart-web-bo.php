<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('../../config.php');
$subs_order_array = array();

$result = array();
$total = 0;


$data = json_decode(file_get_contents('php://input'), true);

// $accountId = $data['accountId'];
$user_id = $data['user_id'];
$total_amt = 0;

if (isset($user_id)) {

  $get_process = $conn->query("SELECT * FROM subs_booking WHERE user_id = '$user_id' && iscancel = 0 ORDER BY id DESC ");
  $row_process = mysqli_fetch_assoc($get_process);
  $process_id = $row_process['process_id'];


  // for subs month
  $bk_query = $conn->query("SELECT * FROM subs_booking WHERE process_id = '$process_id' && iscancel = 0 ORDER BY id DESC ");
  $bk_q = mysqli_fetch_array($bk_query);
  // count bookings
  $bk_count = mysqli_num_rows($bk_query);

  if ($bk_count > 0) {
       
    // select
    $msg_query = $conn->query("SELECT * FROM subs_order WHERE process_id = '$process_id' AND status != 1 ORDER BY id DESC ");
    $count_inner = mysqli_num_rows($msg_query);
    $orders_array = array();

    // $odC = mysqli_num_rows($msg_query);
    // if ($odC > 0) {
    while ($msg_q = mysqli_fetch_array($msg_query)) {


      $cart_id = $msg_q['sub_cart_id'];

      // select cart data where cart id = cart_id
      $sCart = $conn->query("SELECT * FROM subs_cart WHERE id = '$cart_id' AND delete_status != 1");
      $row_cart = mysqli_fetch_assoc($sCart);
      $item_id = $row_cart['item_id'];
     

      array_push($result, $item_id);
    }
  }else{
    $result = array('response' => '2');
  }
} else {
  $result = array('response' => '0');
}



echo json_encode($result);
