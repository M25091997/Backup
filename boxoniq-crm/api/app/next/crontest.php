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

$result = array();
    
    $get_counter = $conn -> query("SELECT * FROM crontest");
    $row_counter = mysqli_fetch_assoc($get_counter);
    $cou = $row_counter['counter'];
    $new_counter = $cou + 1;

    $update_profile = $conn -> query("UPDATE crontest SET counter ='$new_counter'"); 

        if ($update_profile){ 
            $result = array( 'response' => '1', 'msg' => 'Profile updated successfully' ); 
        } else {
            $result = array( 'response' => '0', 'msg' => 'Something went wrong' ); 
        }



echo json_encode($result);