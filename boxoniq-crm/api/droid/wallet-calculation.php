<?php
session_start();
include('../../config.php');

$result = [];
$res = [];
$date = date('Y-m-d h:i:s');

if (isset($_POST['account-id']) && isset($_POST['amt'])) {
    $user_id = $_POST['account-id'];
    $debit_amt = $_POST['amt'];

    $sql = "SELECT * FROM wallet WHERE user_id= '$user_id'";
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($query);
        $wallet_id = $row['id'];
        $amt = $row['amount'];

        $updata_amt = $amt -  $debit_amt;

        // if ($updata_amt > 0) {
        $update_sql = "UPDATE wallet SET amount = '$updata_amt' WHERE user_id = '$user_id'";
        $update_query = mysqli_query($conn, $update_sql);

        if ($update_query) {
            $msg = "Rs." . $debit_amt . " is deducted for Video Call";
            $wallet_history_sql = "INSERT INTO wallet_history (wallet_id,amount,tran_id,type,msg,created_on) VALUES ('$wallet_id','$debit_amt','JKHI736','debit','$msg','$date')";
            $wallet_history_query = mysqli_query($conn, $wallet_history_sql);

            if ($wallet_history_query) {
                // update cart checkout 

                // $select_sql = "SELECT * FROM cart WHERE account_id = '$user_id'";
                // $select_query = mysqli_query($conn, $select_sql);
                // $select_count = mysqli_num_rows($select_query);
                // while ($row = mysqli_fetch_assoc($select_query)) {
                //     $del_sql = "DELETE FROM cart WHERE account_id = '$user_id'";
                //     $update_cart = "UPDATE cart SET checkout = '1' WHERE account_id = '$user_id'";
                //     $del_query = mysqli_query($conn, $update_cart);
                // }

                array_push($res,  array('response' => 'success!'));
                // echo json_encode(true);
            } else {
                array_push($result,  array('response' => 'Failed'));
            }
        } else {
            array_push($result,  array('response' => 'failed'));
        }
        // } else {
        //     array_push($result,  array('response' => 'failed'));
        // }
    } else {
        array_push($result,  array('response' => 'Not Found!'));
    }
} else {
    array_push($result,  array('response' => 'Post var missing!'));
}

if ($res != '') {
    echo json_encode(array('response' => '1'));
} else {
    echo json_encode($result);
}
