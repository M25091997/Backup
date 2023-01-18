<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');

$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'];
$email = $data['email'];
$password = $data['password'];
$accountId = $data['accountId'];

$result = array();

if (isset($accountId) && isset($name) && isset($email) && isset($password)) {

if ($conn -> query("UPDATE accounts SET name ='$name' WHERE id = '$accountId'" ) 

&& $conn -> query("UPDATE accounts SET email = '$email' WHERE id = '$accountId'" )

&& $conn -> query("UPDATE accounts SET password = '$password' WHERE id = '$accountId'" )


) { array_push($result, array( 'response' => '1' ) ); }

} else { array_push($result, array( 'response' => '888' ) ); /* No Sessions Mismatch */ } 

echo json_encode($result);