<?php
// include ("../../config.php");
header('Access-Control-Allow-Origin: *');
include('config.php');

// print_r($_POST);
// exit();

// $data = json_decode(file_get_contents('php://input'), true);

// $razorpay_payment_id = $data['razorpay_payment_id'];
$total_cart_value = $_POST['total_cart_value'];
$account_id = $_POST['account_id'];
$subscription = $_POST['subscription'];
$subscription_month = $_POST['subscription_month'];
$address_id = $_POST['address_id'];
$is_coupon = $_POST['is_coupon'];
$coupon_id = $_POST['coupon_id'];




$result = array();

if (isset($_POST['total_cart_value']) && isset($_POST['account_id'])) {

    if ($subscription == '1') {
        include('checkout-supscription-wallet-flow.php');
    } else if ($subscription == '0') {
        include('checkout-normal-wallet-flow.php');
        
    }
} else {
    array_push($result, array('response' => 'GATEWAY SYNC ERROR 2'));
}

echo json_encode($result); 

// header("location:https://web.cityindia.in/shop/dashboard");
