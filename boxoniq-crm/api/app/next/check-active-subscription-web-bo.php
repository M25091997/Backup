<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');
$result = array();

$data = json_decode(file_get_contents('php://input'), true);

// $accountId = $data['accountId'];
$accountId = $data['account_id'];


$account_id = $accountId;

if (isset($account_id)) {

		$msg_query = $conn -> query("SELECT * FROM subs_booking WHERE user_id = '$account_id' && subs = 1 && iscancel != 1 ORDER BY id DESC LIMIT 1");	
    $count_get = mysqli_num_rows($msg_query);
    if($count_get>0){
      $result = array('response' => 1);
    }else{
      $result = array('response' => 0);
    }

} else { $result = array('response' => 0); }

echo json_encode($result);

?>
