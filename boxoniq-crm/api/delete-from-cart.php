<?php
session_start();
include('../config.php');
$dlete_cart_item = array();
$account_id = $_SESSION['account-id'];
$cart_id = $_POST['id'];

if (isset($_SESSION['account-id'])) {

$sql = "DELETE FROM cart WHERE id='$cart_id'";

if ($conn->query($sql) === TRUE) {

 array_push($dlete_cart_item, array('response' => '1' )); 

}

} else { array_push($dlete_cart_item, array('response' => '666' )); }

echo json_encode($dlete_cart_item);

?>