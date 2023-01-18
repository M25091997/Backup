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
$account_id = $data['user_id'];

if (isset($account_id)) {

	  $total_cart_value = 0;

        $get_cart = $conn -> query("SELECT * FROM cart WHERE account_id = '$account_id' AND checkout = '0' ");
        	$cat_count = mysqli_num_rows($get_cart);

        while($row_get_cart = mysqli_fetch_assoc($get_cart)){

        		$cart_id = $row_get_cart['id'];
            	$item_id = $row_get_cart['item_id'];

              	array_push($result,$item_id);
				  
             }

} else { array_push($result, array('response' => 'No Sessions Found' )); }

echo json_encode($result);

?>