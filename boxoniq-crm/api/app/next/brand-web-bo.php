<?php 
header('Access-Control-Allow-Origin: *');
include("config.php");
$result = array();


$SQ = $conn -> query("SELECT * FROM brand");
$url = $site_url."/img/brand/";
while ($SDATA = mysqli_fetch_array($SQ)) {
	array_push($result, array( 'id' => $SDATA['id'],'brand' => $url.$SDATA['brand_img']) );
}

echo json_encode($result);

?>