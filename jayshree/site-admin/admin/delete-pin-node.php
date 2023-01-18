<?php 
session_start();
include ("../../config.php");
$ad_id = $_POST['pin-id'];
$q_delete = $conn -> query("DELETE FROM pincode WHERE id = '$ad_id'");
if ($q_delete === True) {echo 1;} ?>