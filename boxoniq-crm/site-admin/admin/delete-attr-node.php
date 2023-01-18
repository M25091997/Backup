<?php 

session_start();

include ("../../config.php");
$ad_id = $_POST['id'];

$q_delete = $conn -> query("DELETE FROM attributes WHERE id = '$ad_id'");

if ($q_delete === True) {
  echo 1;
}

?>