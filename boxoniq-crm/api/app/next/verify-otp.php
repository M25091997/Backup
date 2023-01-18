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



	$otp = $data['otp'];
    $account_id = $data['account_id'];

    // echo json_encode($otp.$account_id);
    // exit();

    // $account_id = $_POST['account_id'];
    $check_otp_q = $conn -> query("SELECT * FROM accounts WHERE otp = '$otp' AND id = '$account_id'");

    if ( mysqli_num_rows( $check_otp_q ) != 0 ) {
    	
    	

    		if ($conn -> query("UPDATE accounts SET verification ='1' WHERE id = '$account_id'" )) { 

    			$result = array( 'response' => 1, 'msg' => 'Successfully Verified' ); /* OTP Matched */

    		}
    	

    } else { $result = array( 'response' => 0, 'msg' => 'OTP not matched...'); /* OTP Mismatch */ } 

echo json_encode($result);


?>