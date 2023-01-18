<?php 

include('../config.php');

$otp = "56854";
$msg = "Your Password Reset OTP is: ".$otp." - ".$the_project;

echo _SEND_MESSAGE_NEW(NumberFilter(7004286568), $msg, "1207161786099974111");

?>