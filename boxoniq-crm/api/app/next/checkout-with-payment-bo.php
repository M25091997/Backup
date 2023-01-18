<?php
// include ("../../config.php");
header('Access-Control-Allow-Origin: *');
include('config.php');

// $data = json_decode(file_get_contents('php://input'), true);

$payment_transaction_id = $_POST['cashfree_payment_id'];
$total_cart_value = $_POST['total_cart_value'];
$account_id = $_POST['account_id'];
$subscription = $_POST['subscription'];
$subscription_month = $_POST['subscription_month'];
$address_id = $_POST['address_id'];
$month_amount_value = $_POST['month_amount_value'];
$is_wallet = $_POST['is_wallet'];
$is_coupon = $_POST['is_coupon'];
$coupon_id = $_POST['coupon_id'];

$amount_to_be_updated_wallet = $month_amount_value - $total_cart_value;


$result = array();

if (isset($_POST['total_cart_value']) && isset($_POST['account_id'])) {

    if ($subscription == '1') {
        include('checkout-subscription-flow.php');
    } else if ($subscription == '0') {
        include('checkout-normal-flow.php');
    }
    if($is_wallet == 1){
        $get_wallet_amount = $conn -> query("SELECT * FROM wallet WHERE user_id = '$account_id'");
        $row_wallet_amount = mysqli_fetch_assoc($get_wallet_amount);
        $amount = $row_wallet_amount['amount'];
        $new_updated_amount = $amount + $amount_to_be_updated_wallet;
        $update_wallet_amount = $conn -> query("UPDATE wallet SET amount = $new_updated_amount WHERE user_id = '$account_id' ");
    }
} else {
    array_push($result, array('response' => 'GATEWAY SYNC ERROR 2'));
}

echo json_encode($result); 

// header("location:https://web.cityindia.in/shop/dashboard");
