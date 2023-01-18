<?php include("../../config.php");

header('Access-Control-Allow-Origin: *');
include('config.php');

$result = array();

// $data = json_decode(file_get_contents('php://input'), true);

$coupon = $_POST['coupon'];
// $total = $_POST['total'];
$account_id = $_POST['account_id'];

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

$cus_id = $account_id;

$discounted_value = intval ( APPLY_COUPON( $coupon, $total ) ); 

$result = array('response' => '1', 'msg' => "Congratulation! Rs.".($total - $discounted_value)." Discount Coupon Has been Applied to your invoice, Enjoy!", 'discount' => ( $total - $discounted_value )  );

}else{ $result = array('response' => '0', 'msg' => 'Invalid or Coupon Code not Applicable' ); }

} else{ $result = array('response' => '0'); /*Missing Post Variables*/ }

//Json Output
echo json_encode($result); ?>