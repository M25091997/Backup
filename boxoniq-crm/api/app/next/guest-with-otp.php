<?php
// session_start();
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

    $acc_id = $data['account_id'];
    $otp = $data['otp'];

    if ( $acc_id!='' && $otp!='' ) {

        $account_arr = $conn -> query("SELECT * FROM accounts WHERE id = '$acc_id' && otp = '$otp' ");
       
        if (mysqli_num_rows($account_arr) > 0) {
            $row_user = mysqli_fetch_assoc($account_arr);
            $account_id = $row_user['id'];
            $phone = $row_user['phone'];

        $update = $conn -> query("UPDATE accounts SET verification = 1, account_type = 1 WHERE id = '$acc_id' && otp = '$otp' ");

        if($update){
                    $result = array( 'response' => '1', 'accountId' => $account_id, 'phone' => $phone);
                }else{
                $result = array( 'response' => 0, 'msg' => 'Something Went Wrong' );
                }
        }
        else{
        $result = array( 'response' => 0, 'msg' => 'Something Went Wrong' );

        }
    }   

else{
        $result = array( 'response' => '0', 'msg' => 'Something Went Wrong' );
    }
    
echo json_encode($result); ?>