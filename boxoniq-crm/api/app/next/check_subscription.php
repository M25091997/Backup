<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// $data = json_decode(file_get_contents('php://input'), true);


   include('config.php');

    $user_id = $_POST['user_id'];

    $check_otp_q = $conn -> query("SELECT * FROM subs_booking WHERE user_id = '$user_id' && iscancel = 0");

    if ( mysqli_num_rows( $check_otp_q ) > 0 ) {
    	
    			$result = array( 'response' => 1, 'msg' => 'Kindly go to your active subscription bundle'); 

    } else { $result = array( 'response' => 0); /* OTP Mismatch */ } 

echo json_encode($result);


?>