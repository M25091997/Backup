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

include('../app/next/config.php');

// $result = array();


	$password = $data['password'];
    $phone = $data['phone'];
    $otp = $data['otp'];
    

    if ( $password!='' && $phone!='' && $otp!='' ) {

        $account_arr = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone' && otp = '$otp' ");
       
        if (mysqli_num_rows($account_arr) > 0) {

            $update = $conn -> query("UPDATE accounts SET password = '$password' WHERE phone = '$phone' && otp = '$otp'");
            if($update){
               $result = array( 'response' => 1, 'msg' => 'Password Successfully updated' ); /* OTP Matched */ 
            } 
            else
            {
                $result = array( 'response' => 0, 'msg' => 'User111' );
            }        
        }
        else{
        $result = array( 'response' => 0, 'msg' => 'User222' );

        }
    }   

else{
        $result = array( 'response' => '0', 'msg' => 'Required values not found' );
    }
    
echo json_encode($result); ?>