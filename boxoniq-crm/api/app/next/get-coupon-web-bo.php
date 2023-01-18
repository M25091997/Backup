<?php

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

// $data = json_decode(file_get_contents('php://input'), true);

$result = array();
$Q = $conn -> query("SELECT * FROM coupon");
while ($DQ = mysqli_fetch_array($Q)) {
	$coupon = $DQ['code'];
	$text = $DQ['text_'];
	$coupon_id = $DQ['id'];

	array_push($result, array('response' => '1', 'coupon_id' => $coupon_id, 'coupon' => $coupon, 'msg' => $text ));
}
echo json_encode($result);

?>