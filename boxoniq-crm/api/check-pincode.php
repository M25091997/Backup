<?php
session_start();
include('../config.php');
$pincode = $_POST['pincode'];
$attribute_id = $_POST['attribute-id'];
$result = array();

if (isset($_POST['pincode']) && isset($_POST['pincode']) != "" & isset($_POST['attribute-id']) && isset($_POST['attribute-id']) != "" ) {

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
   		
   	} else { array_push($result, array('availability' => "1", 'days' => "7-8 Days Delivery", 'price' => "SAME" )); }

                

} else { array_push($result, array('Error' => "NO POST VARS FOUND")); }

echo json_encode($result);

?>