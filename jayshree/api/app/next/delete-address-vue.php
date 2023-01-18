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
$add_id = $data['addid'];
// print_r(json_decode($add_id));
// exit();


$sql = "DELETE FROM saved_address WHERE id='$add_id'";

if ($conn->query($sql) === TRUE) {

 $dlete_cart_item = array('response' => '1' ); 

} else { $dlete_cart_item = array('response' => '0' );  }


echo json_encode($dlete_cart_item);

?>