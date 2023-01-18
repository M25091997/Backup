<?php 
require 'config.php';

$x = $_GET['mobile'];
$otp=$_GET['otp'];
$the_project = "RGC";

$result = [];

$msg = "Your Signup OTP is: " .$otp."\n- ".$the_project; 

$res = _SEND_MESSAGE_NEW($x, $msg, "1207161761199657681");  

$result = array('response' =>1, 'result' => $res);

echo json_encode($result);


?>