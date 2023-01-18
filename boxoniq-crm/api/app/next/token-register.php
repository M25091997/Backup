<?php

include('config.php');

if (isset($_POST["token"]) && isset($_POST['user_id'])) {
$user_id = $_POST['user_id'];
$token = $_POST['token'];
// $app_version = $_POST['app_version'];

$update_truck_token = $conn -> query("UPDATE accounts SET firebase_token = '$token' WHERE id = '$user_id'");

// $update_app_version = $conn -> query("UPDATE user SET app_version = '$app_version' WHERE id = '$user_id'");

// $count = 1;

// $app_open = $conn -> query("INSERT count_app_open (user_id, app_open) VALUES ('{$user_id}', '{$count}') ");

if ($update_truck_token) { 
	$result = array('response' => 1); 
}

} else { 
	$result = array('response' => 0); 
	
}

echo json_encode($result);


?>