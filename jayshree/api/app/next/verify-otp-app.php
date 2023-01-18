<?php
include('../../../config.php');
// $result = array();

	$otp = $_POST['otp'];
    $account_id = $_POST['account_id'];
    $check_otp_q = $conn -> query("SELECT * FROM accounts WHERE otp = '$otp' AND id = '$account_id'");

    if ( mysqli_num_rows( $check_otp_q ) != 0 ) {
    	
    	

    		if ($conn -> query("UPDATE accounts SET verification ='1' WHERE id = '$account_id'" )) { 

    			$result = array( 'response' => 1, 'account_id' => $account_id, 'msg' => 'Your account is under Review' ); /* OTP Matched */

    		}
    	

    } else { $result = array( 'response' => 0, 'msg' => 'OTP not matched...'); /* OTP Mismatch */ } 

echo json_encode($result);


?>