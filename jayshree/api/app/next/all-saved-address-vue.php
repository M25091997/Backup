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
$userid = $data['userid'];

$result = array();
$account_id = $userid;
$Q = $conn -> query("SELECT * FROM saved_address WHERE account_id = '$account_id'");
while ($DQ = mysqli_fetch_array($Q)) {
	array_push($result, array('response' => '1', 'addressId' => $DQ['id'], 'address-type' => $DQ['address_type'], 'address' => $DQ['full_address'], 'landmark' => $DQ['landmark'], 'pincode' => $DQ['pincode'] ));
}
echo json_encode($result);

?>