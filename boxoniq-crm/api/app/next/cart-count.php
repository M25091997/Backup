<?php

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$result = array();

$data = json_decode(file_get_contents('php://input'), true);

$account_id = $data['account_id'];

if (true) {

	  // $total_cart_value = 0;

		$msg_query = $conn -> query("SELECT * FROM cart WHERE account_id = '$account_id' AND checkout = '0'");
		$count = mysqli_num_rows($msg_query);	
		
        $result = array('response' => 1, 'cart_count' => $count );

} else { $result = array('response' => 0); }

echo json_encode($result);

?>