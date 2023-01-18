<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');

$data = json_decode(file_get_contents('php://input'), true);

$address = $data['address'];
$pincode = $data['pincode'];
$landmark = $data['landmark'];
$addId = $data['addId'];

$result = array();

if (isset($addId) && isset($address) && isset($landmark) && isset($pincode)) {

if ($conn -> query("UPDATE saved_address SET full_address ='$address' WHERE id = '$addId'" ) 

&& $conn -> query("UPDATE saved_address SET landmark = '$landmark' WHERE id = '$addId'" )

&& $conn -> query("UPDATE saved_address SET pincode = '$pincode' WHERE id = '$addId'" )

&& $conn -> query("UPDATE saved_address SET address_type = 'Home' WHERE id = '$addId'" )

) { array_push($result, array( 'response' => '1' ) ); }

} else { array_push($result, array( 'response' => '888' ) ); /* No Sessions Mismatch */ } 

echo json_encode($result);