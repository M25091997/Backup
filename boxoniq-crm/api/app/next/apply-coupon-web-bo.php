<?php 
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$data = json_decode(file_get_contents('php://input'), true);

$result = array();


$coupon = $data['coupon'];
// $total = $data['total'];
$account_id = $data['account_id'];

// print_r($_POST);
// exit();

if (($account_id) && isset($coupon) ) {

$get_total = $conn -> query("SELECT SUM(total_amount) AS total FROM cart WHERE account_id = '$account_id' && checkout = '0' ");
$total = mysqli_fetch_assoc($get_total)['total'];
// print_r($total);
// exit();

if (APPLY_COUPON($coupon, $total)) {

$coupon_code = $coupon;
$CCQ = $conn -> query("SELECT * FROM coupon WHERE code = '$coupon_code'");
$CData = $CCQ -> fetch_assoc();

$coupon_title = $CData['code'];

$cus_id = $account_id;

$discounted_value = intval ( APPLY_COUPON( $coupon, $total ) ); 

$result = array('response' => '1', 'coupon_title' => $coupon_title, 'msg' => "Congratulation! Rs.".($total - $discounted_value)." Discount Coupon Has been Applied to your invoice, Enjoy!", 'discount' => ( $total - $discounted_value )  );

}else{ $result = array('response' => '0', 'msg' => 'Invalid or Coupon Code not Applicable' ); }

} else{ $result = array('response' => '0'); /*Missing Post Variables*/ }

//Json Output
echo json_encode($result); ?>