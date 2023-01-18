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


$data = json_decode(file_get_contents('php://input'), true);

// $accountId = $data['accountId'];
$user_id = $data['user_id'];

if (isset($user_id)) {

  // for subs month
  $bk_query = $conn->query("SELECT * FROM subs_booking WHERE user_id = '$user_id' && iscancel = 0 ORDER BY id DESC ");
  $bk_q = mysqli_fetch_array($bk_query);
  // count bookings
  $bk_count = mysqli_num_rows($bk_query);

  if ($bk_count > 0) {
       
      $process_id = $bk_q['process_id'];

      $result = array('response' => 1, 'active_processid' => $process_id);
    
  }else{
    $result = array('response' => '2');
  }
} else {
  $result = array('response' => '0');
}



echo json_encode($result);
