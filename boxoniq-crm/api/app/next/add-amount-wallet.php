<?php
// session_start();
include('../../../config.php');

// $result = array();


if (isset($_POST['user_id']) && isset($_POST['tran_id']) && isset($_POST['amount'])) {
    $user_id = $_POST['user_id'];
    $tran_id = $_POST['tran_id'];
    $amount = $_POST['amount'];
    $type = 'credit';

    // $add_wallet_id = $conn->query("INSERT INTO wallet(user_id, amount, tran_id) VALUES ('$user_id', '$amount', '$tran_id')");
    // $add_wallet_id = mysqli_fetch_assoc($add_wallet_id);

    // $get_wallet_id = $conn->query("SELECT * FROM wallet WHERE user_id = '$user_id' ");
    // $wallet_id = mysqli_fetch_assoc($get_wallet_id)['id'];

    // $check_wallet = $conn->query("INSER * FROM wallet_history WHERE wallet_id = '$wallet_id' ");
    // $check_count = mysqli_num_rows($check_wallet);

    $result = addToWallet($user_id, $tran_id, $amount, $type);
} else {
    $result = array('response' => 0, 'msg' => 'Something went wrong'); /* Variable(s) not found */
}
// $result['check'] = $check_count;
echo json_encode($result);
