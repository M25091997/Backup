<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');

$data = json_decode(file_get_contents('php://input'), true);
$pincode = $data['pincheck'];
$attributeId = $data['attributeId'];

$pincode = $pincode;
$attribute_id = $attributeId;
$result = array();

if (isset($pincode) && isset($pincode) != "" & isset($attributeId) && isset($attributeId) != "" ) {

		$msg_query = $conn -> query("SELECT * FROM attributes WHERE id = '$attribute_id'");	
            while ($msg_q = mysqli_fetch_array($msg_query)) {
            	$media_number = $msg_q['media_number'];
            }

   	$pin_Q = $conn -> query("SELECT * FROM pincode WHERE media_number = '$media_number'");

   	if (mysqli_num_rows($pin_Q) != 0) {

   		$pin_Q1 = $conn -> query("SELECT * FROM pincode WHERE media_number = '$media_number' AND pincode = '$pincode'");
   		if (mysqli_num_rows($pin_Q1) != 0) { 

   			while ($pinD = mysqli_fetch_array($pin_Q1)) {
   				$days = $pinD['delivery'];
   				$price = $pinD['price'];
   			}

   			array_push($result, array('availability' => "1", 'days' => $days." Day Delivery", 'price' => $price ));

   		 } else {  array_push($result, array('availability' => "0")); }
   		
   	} else { 

        $pin_query = $conn -> query("SELECT * FROM default_pincode where pincode = '$pincode'");
        mysqli_num_rows($pin_query)?array_push($result, array('availability' => "1", 'days' => "2 hrs Day Delivery")):array_push($result, array('availability' => "0"));

     }

                

} else { array_push($result, array('Error' => "NO POST VARS FOUND")); }

echo json_encode($result);

?>