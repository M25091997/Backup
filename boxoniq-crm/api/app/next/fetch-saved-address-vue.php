<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');
$result = array();

// $data = json_decode(file_get_contents('php://input'), true);
$user_id = $_POST['user_id'];

$Q = $conn -> query("SELECT * FROM accounts WHERE id = '$user_id'");
$DQ = $Q -> fetch_assoc();

$result = array('response' => '1','address' => $DQ['full_address'], 'landmark' => $DQ['landmark'], 'pincode' => $DQ['pincode']);

echo json_encode($result);

?>