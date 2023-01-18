<?php 
include('../config.php');
$result = array();

if (isset($_POST['customer-id'])) {


$cid = $_POST['customer-id'];
$pin = $_POST['pincode'];
$query = $conn -> query("UPDATE accounts SET primary_pincode = '$pin' WHERE id = '$cid'");
if ($query === True) {
	array_push($result, array('response' => '1'));
}	
} else { array_push($result, array('response' => '666')); }
echo json_encode($result);


?>