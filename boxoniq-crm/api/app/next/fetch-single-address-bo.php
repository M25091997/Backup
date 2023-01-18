<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
include('../../../config.php');
$result = array();

$data = json_decode(file_get_contents('php://input'), true);
$user_id = $data['user_id'];
$address_id = $data['address_id'];


$Q = $conn -> query("SELECT * FROM saved_address WHERE account_id = '$user_id' && id = '$address_id'");
$DQ = mysqli_fetch_assoc($Q);
$state = $DQ['state'];

$get_state = $conn -> query("SELECT * FROM states WHERE name = '$state' ");
$row_state = mysqli_fetch_assoc($get_state);
$state_id = $row_state['id'];

$result = array('response' => '1','address' => $DQ['full_address'], 'landmark' => $DQ['landmark'], 'pincode' => $DQ['pincode'], 'phone' => $DQ['phone'], 'state_id' => $state_id, 'state' => $DQ['state'], 'user_name' => $DQ['user_name']);

echo json_encode($result);

?>