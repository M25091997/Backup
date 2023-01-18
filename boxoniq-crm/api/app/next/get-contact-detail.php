<?php

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

// $data = json_decode(file_get_contents('php://input'), true);
$result = array();

$Q = $conn -> query("SELECT * FROM contact_detail");
while ($DQ = mysqli_fetch_array($Q)) {
	$id = $DQ['id'];
	$mobile = $DQ['mobile'];
	$phone = $DQ['phone'];
	$email = $DQ['email'];

	$result = array('response' => '1', 'id' => $id, 'mobile' => $mobile, 'phone' => $phone, 'email' => $email );
}
echo json_encode($result);

?>