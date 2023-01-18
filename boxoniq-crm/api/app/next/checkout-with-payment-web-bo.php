<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents('php://input'), true);

// print_r($data);
// exit();

include('config.php');


$payment_transaction_id = $data['cashfree_payment_id'];
$total_cart_value = $data['total_cart_value'];
$account_id = $data['account_id'];
$subscription = $data['subscription'];
$subscription_month = $data['subscription_month'];
$address_id = $data['address_id'];
// $month_amount_value = $data['month_amount_value'];
$is_wallet = $data['is_wallet'];
$is_coupon = $data['is_coupon'];
$coupon_id = $data['coupon_id'];

// $amount_to_be_updated_wallet = $month_amount_value - $total_cart_value;


$result = array();

if (isset($data['total_cart_value']) && isset($data['account_id'])) {

    if ($subscription == '1') {
        include('checkout-subscription-flow.php');
    } else if ($subscription == '0') {
        include('checkout-normal-flow.php');
    }
        $get_wallet_amount = $conn -> query("SELECT * FROM wallet WHERE user_id = '$account_id'");
        $row_wallet_amount = mysqli_fetch_assoc($get_wallet_amount);
        $amount = $row_wallet_amount['amount'];
        $wallet_id = $row_wallet_amount['id'];
        $type = "debit";
        $msg="Rs.".$total_cart_value." is deducted for your Order";
        $trn_date=date("Y-m-d h:i:sa");

        $new_updated_amount = $amount - $total_cart_value;
        if($is_wallet == 1 || $is_wallet == 2){
            $update_wallet_amount = $conn -> query("UPDATE wallet SET amount = $new_updated_amount WHERE user_id = '$account_id' ");
        }
    
        $add_history = $conn -> query("INSERT INTO wallet_history ( wallet_id, amount, tran_id, type, msg, created_on ) VALUES ( '$wallet_id', '$total_cart_value', '$payment_transaction_id', '$type', '$msg', '$trn_date' )");
} else {
    array_push($result, array('response' => 'GATEWAY SYNC ERROR 2'));
}

echo json_encode($result); 

// header("location:https://web.cityindia.in/shop/dashboard");
