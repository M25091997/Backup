<?php include("../../config.php");

header('Access-Control-Allow-Origin: *');
include('config.php');

$result = array();

$data = json_decode(file_get_contents('php://input'), true);

$coupon = $data['coupon'];
$total = $data['total'];
$account_id = $data['account_id'];

if (($account_id) && isset($total) && isset($coupon) ) {

if (APPLY_COUPON($coupon, $total)) {

$coupon_code = $coupon;
$CCQ = $conn -> query("SELECT * FROM coupon WHERE code = '$coupon_code'");
$CData = $CCQ -> fetch_assoc();

$cus_id = $account_id;
$CCQ_A = $conn -> query("SELECT * FROM bookings WHERE account_id = '$cus_id'");


if ($CData['type'] == "SECOND_ORDER") { /*Checking if Coupon is Second type or not*/
		
	if(mysqli_num_rows($CCQ_A)){ /*checking if has old orders or not*/

		
		$discounted_value = intval ( APPLY_COUPON( $coupon, $total ) ); 

		$result = array('response' => '1', 'text' => "Congratulation! Rs.".($total - $discounted_value)." Discount Coupon Has been Applied to your invoice, Enjoy!", 'discounted_amount' => $discounted_value, 'discount' => ( $total - $discounted_value )  );

	}else { $result = array('response' => 'Sorry, This Coupon is only applicable on Next Order(s)!' ); }

		echo json_encode($result);
		return;
	}

$discounted_value = intval ( APPLY_COUPON( $coupon, $total ) ); 

$result = array('response' => '1', 'text' => "Congratulation! Rs.".($total - $discounted_value)." Discount Coupon Has been Applied to your invoice, Enjoy!", 'discounted_amount' => $discounted_value, 'discount' => ( $total - $discounted_value )  );

}else{ $result = array('response' => 'Invalid or Coupon Code not Applicable' ); }

} else{ $result = array('response' => '666'); /*Missing Post Variables*/ }

//Json Output
echo json_encode($result); ?>