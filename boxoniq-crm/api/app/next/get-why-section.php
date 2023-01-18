<?php 
header('Access-Control-Allow-Origin: *');
include("config.php");
$result = array();

$SQ = $conn -> query("SELECT * FROM why_choose");
$url = $site_url."/img/why/";
while ($SDATA = mysqli_fetch_array($SQ)) {
	// array_push($result, array( 'slide' => $SDATA['file'] ) );
	array_push($result, array('id' => $SDATA['id'], 'why_desc' => $SDATA['why_desc'], 'image' => $url.$SDATA['why_photo']) );
}

echo json_encode($result);

?>