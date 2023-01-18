<?php 
header('Access-Control-Allow-Origin: *');
include("config.php");
$result = array();

$count_brand = $conn -> query("SELECT COUNT(*) AS brand_no FROM `brand`");
$brand_on = mysqli_fetch_assoc($count_brand)['brand_no'];
$up_limit = floor($brand_on/2);

$SQ = $conn -> query("SELECT * FROM brand LIMIT $up_limit,$brand_on");
$c_count = 1;
$url = $site_url."/img/brand/";
while ($SDATA = mysqli_fetch_array($SQ)) {
	// array_push($result, array( 'slide' => $SDATA['file'] ) );
	array_push($result, array( 'brand' => $url.$SDATA['brand_img']) );
	$c_count++;
}

echo json_encode($result);

?>