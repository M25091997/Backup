<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');
$result = array();

$data = json_decode(file_get_contents('php://input'), true);
$addid = $data['addid'];

$Q = $conn -> query("SELECT * FROM saved_address WHERE id = '$addid'");
$DQ = $Q -> fetch_assoc();

array_push($result, array('response' => '1','address' => $DQ['full_address'], 'landmark' => $DQ['landmark'], 'pincode' => $DQ['pincode'] ));

echo json_encode($result);

?>