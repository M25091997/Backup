<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents('php://input'), true);

include('../../../config.php');

// $result = array();


if (isset($data['user_id']) && isset($data['tran_id']) && isset($data['amount'])) {
    $user_id = $data['user_id'];
    $tran_id = $data['tran_id'];
    $amount = $data['amount'];
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
