<?php 
header('Access-Control-Allow-Origin: *');
include("config.php");
$result = array();

$SQ = $conn -> query("SELECT * FROM mobile_slider ORDER BY id DESC");
$c_count = 1;
while ($SDATA = mysqli_fetch_array($SQ)) {
	array_push($result, array( 'slide' => $SDATA['file'] ) );
	// array_push($result, array( 'slide' => $site_url."/slider/".$SDATA['file'] ) );
	$c_count++;
}

echo json_encode($result);

?>