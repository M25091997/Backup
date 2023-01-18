<?php
include ('../../config.php');

/*Deleting old img*/
$media_number = $_POST['media-number'];
$iQ = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number'");

while ($iD = mysqli_fetch_array($iQ)) {
	$media_id = $iD['id'];
	$q_delete = $conn -> query("DELETE FROM media WHERE id = '$media_id'");
}

?>