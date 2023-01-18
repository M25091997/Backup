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

$address_id = $_POST['address_id'];

// print_r($_POST);
// exit();



if ($fullAddress && $user_id && $pincode) {
    $sql = "UPDATE saved_address SET user_name = '$user_name', full_address = '$fullAddress', landmark = '$landmark', pincode = '$pincode', state = '$state', phone = '$phone' WHERE id = '$address_id' && account_id = '$user_id' ";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $result = array('response' => '1', 'msg' => 'Address updated successfully');
    } else {
        $result = array('response' => '0' , 'msg' => 'Something went wrong');
    }
} else {
    $result = array('response' => '0');
}



echo json_encode($result);
