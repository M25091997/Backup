<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');
$dlete_cart_item = array();
$data = json_decode(file_get_contents('php://input'), true);
$cart_id = $data['cart_id'];


$sql = "DELETE FROM cart WHERE id='$cart_id' && checkout = 0 ";

if ($conn->query($sql) === TRUE) {

 $dlete_cart_item = array('response' => '1', 'msg' => 'Item removed from cart successfully' ); 

} else { $dlete_cart_item = array('response' => '0');  }


echo json_encode($dlete_cart_item);

?>