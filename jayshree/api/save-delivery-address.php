<?php
session_start();
include('../config.php');

$account_id = $_SESSION['account-id'];

$full_address = $_REQUEST['full_address'];
$landmark = $_REQUEST['landmark'];
$pincode = $_REQUEST['pincode'];

$result = array();

if (isset($_SESSION['account-id'])) {

if ($conn -> query("UPDATE accounts SET full_address ='$full_address' WHERE id = '$account_id'" ) 

&& $conn -> query("UPDATE accounts SET landmark = '$landmark' WHERE id = '$account_id'" )

&& $conn -> query("UPDATE accounts SET pincode = '$pincode' WHERE id = '$account_id'" )

) { array_push($result, array( 'response' => '1' ) ); }

} else { array_push($result, array( 'response' => '888' ) ); /* No Sessions Mismatch */ } 

echo json_encode($result);