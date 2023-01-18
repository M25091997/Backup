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


    $account_id = $data['account_id'];
    $process_id = $data['process_id'];
    

    if ( $account_id!='' && $process_id!='' ) {

            $update = $conn -> query("UPDATE bookings SET order_status = '5' WHERE account_id = '$account_id' && process_id = '$process_id'");
            if($update){
               $result = array( 'response' => 1, 'msg' => 'Status Updated updated' ); /* OTP Matched */ 
            } 
            else
            {
                $result = array( 'response' => 0, 'msg' => 'Something went wrong' );
            }        
        
    }   

else{
        $result = array( 'response' => '0', 'msg' => 'Required values not found' );
    }
    
echo json_encode($result); ?>