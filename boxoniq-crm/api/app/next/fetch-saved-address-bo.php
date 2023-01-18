<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');
$result = array();

// $data = json_decode(file_get_contents('php://input'), true);
$user_id = $_POST['user_id'];
$address_id = $_POST['address_id'];


$Q = $conn -> query("SELECT * FROM saved_address WHERE account_id = '$user_id' && id = '$address_id ");
$DQ = $Q -> fetch_assoc();

$result = array('response' => '1','address' => $DQ['full_address'], 'landmark' => $DQ['landmark'], 'pincode' => $DQ['pincode'], 'phone' => $DQ['phone'], 'state_id' => $DQ['state_id']);

echo json_encode($result);

?>