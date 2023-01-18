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

$address = $data['address'];
$pincode = $data['pincode'];
$landmark = $data['landmark'];
$accountId = $data['accountId'];

$result = array();

if (isset($accountId)) {

if ($conn -> query("UPDATE accounts SET full_address ='$address' WHERE id = '$accountId'" ) 

&& $conn -> query("UPDATE accounts SET landmark = '$landmark' WHERE id = '$accountId'" )

&& $conn -> query("UPDATE accounts SET pincode = '$pincode' WHERE id = '$accountId'" )

) { $result = array( 'response' => '1'); }

} else {$result = array( 'response' => '888'); /* No Sessions Mismatch */ } 

echo json_encode($result);