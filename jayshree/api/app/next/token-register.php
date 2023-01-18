<?php
include("config.php");
if (isset($_POST["token"]) && isset($_POST['account-id'])) {
$account_id = $_POST['account-id'];
$token = $_POST['token'];
$update_truck_token = $conn -> query("UPDATE accounts SET firebase_token = '$token' WHERE id = '$account_id'");

if ($update_truck_token) { echo "Success!"; }
} else { echo "no POST variables found!"; }



?>