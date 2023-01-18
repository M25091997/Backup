<?php 
include('../config.php');
$result = array();
$query = $conn -> query("SELECT * FROM service_pincodes");
while ($pD = mysqli_fetch_array($query)) {
	array_push($result, array('pincode' => $pD['pincode']));
}	
echo json_encode($result);

?>