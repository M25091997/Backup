<?php
session_start();
include('../../config.php');

$result = [];
$product = [];
$price = [];

if (isset($_POST['account-id'])) {
    $account_id = $_POST['account-id'];

    $sql = "SELECT * FROM cart WHERE account_id = '$account_id' && checkout = 0 ";
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($query)) {

            $total = $row['total_amount'];
            array_push($price, $total);
            $coupon_discount = 0;

            $sub_amt = array_sum($price);
        
        $check_bundle_discount = $conn -> query("SELECT DISTINCT cat_id FROM cart WHERE account_id = '$account_id' && checkout = 0");
        $count_cat = mysqli_num_rows($check_bundle_discount);

        // $check_cat_count = $conn -> query("SELECT DISTINCT id FROM super_category");
        // $count_super_cat = mysqli_num_rows($check_cat_count);
        $get_bundle_cat_no = $conn -> query("SELECT * FROM bundle_cat_no");
        $row_bundle_cat_no = mysqli_fetch_assoc($get_bundle_cat_no);
        $count_super_cat = $row_bundle_cat_no['bundle_cat_no'];
        if($count_cat >= $count_super_cat){
            $bundal_discount = round(5/100*$sub_amt);
        }else{
            $bundal_discount = 0;
        }

        if($sub_amt<499){
            $delivery = 49;
        }else{
            $delivery = 0;
        }

        $total_amt = $sub_amt - $bundal_discount;

        

    $get_wallet = $conn -> query("SELECT * FROM wallet WHERE user_id = '$account_id'");
    $wallet_balance = mysqli_fetch_assoc($get_wallet)['amount'];

            $res = array('sub total' => $sub_amt, 'bundal discount' => $bundal_discount, 'coupon discount' => $coupon_discount, 'total' => $total_amt , 'balance' => $wallet_balance);
        }
        array_push($result, array('user_id' => $account_id, 'response' => $res));
    } else {
        array_push($result);
    }
} else {
    array_push($result,  array('response' => 'Please send Account id Found'));
}

echo json_encode($result);
