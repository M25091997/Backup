<?php 
header('Access-Control-Allow-Origin: *');
include("config.php");
$result = array();

$SQ = $conn -> query("SELECT * FROM super_category");
$c_count = 1;
$url = $site_url."/img/supercat/";
while ($SDATA = mysqli_fetch_array($SQ)) {
	// array_push($result, array( 'slide' => $SDATA['file'] ) );
	array_push($result, array('id' => $SDATA['id'], 'sequence' => $SDATA['sequence'], 'name' => $SDATA['name'], 'image' => $url.$SDATA['image']) );
	$c_count++;
}

echo json_encode($result);

?>