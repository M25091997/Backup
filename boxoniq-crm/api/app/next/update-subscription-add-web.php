<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$data = json_decode(file_get_contents('php://input'), true);

$process_id = $data['process_id'];
$address_id = $data['address_id'];



// print_r($_POST);
// exit();


$result = array();

if (isset($process_id) && isset($address_id)) {
    $update_profile = $conn -> query("UPDATE subs_booking SET address_id ='$address_id' WHERE process_id = '$process_id'"); 

        if ($update_profile){ 
            $result = array( 'response' => '1', 'msg' => 'Profile updated successfully' ); 
        } else {
            $result = array( 'response' => '0', 'msg' => 'Something went wrong' ); 
        }

} else { 
    $result = array( 'response' => '0', 'msg' => 'Something went wrong' ); /* No Sessions Mismatch */ 
} 

echo json_encode($result);