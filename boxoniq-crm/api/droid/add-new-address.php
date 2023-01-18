<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('../../config.php');
$result = array();

// print_r($_POST);
// exit();

// $data = json_decode(file_get_contents('php://input'), true);

// post data
$fullAddress = $_POST['full_address'];
$landmark = $_POST['landmark'];
$user_id = $_POST['user_id'];
$pincode = $_POST['pincode'];
$state = $_POST['state'];
$phone = $_POST['phone'];
$user_name = $_POST['name'];



if ($fullAddress && $user_id && $pincode) {
    $sql = "INSERT INTO saved_address (user_name, account_id, full_address, landmark, pincode, state, phone) VALUES ('$user_name', '$user_id', '$fullAddress', '$landmark', '$pincode', '$state', '$phone')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $result = array('response' => '1');
    } else {
        $result = array('response' => '0');
    }
} else {
    $result = array('response' => '0');
}



echo json_encode($result);
