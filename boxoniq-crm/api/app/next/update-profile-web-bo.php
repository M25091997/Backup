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

$name = $data['user_name'];
$email = $data['email'];
$phone = $data['phone'];

$accountId = $data['user_id'];
$baby_name = $data['baby_name'];
$baby_dob = $data['baby_dob'];

// print_r($_POST);
// exit();


$result = array();

if (isset($accountId) && isset($name) && isset($email) && isset($phone)) {
    $update_profile = $conn -> query("UPDATE accounts SET name ='$name', email ='$email', baby_name ='$baby_name',baby_dob ='$baby_dob',phone ='$phone' WHERE id = '$accountId'"); 

        if ($update_profile){ 
            $result = array( 'response' => '1', 'msg' => 'Profile updated successfully' ); 
        } else {
            $result = array( 'response' => '0', 'msg' => 'Something went wrong' ); 
        }

} else { 
    $result = array( 'response' => '0', 'msg' => 'Something went wrong' ); /* No Sessions Mismatch */ 
} 

echo json_encode($result);