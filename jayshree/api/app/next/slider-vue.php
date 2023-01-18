<?php 
header('Access-Control-Allow-Origin: *');
include("config.php");
$result = array();

$url = "https://cms.cybertizeweb.com/jayshree-crm/media/";

$SQ = $conn -> query("SELECT * FROM slider");
// $c_count = 1;
while ($SDATA = mysqli_fetch_assoc($SQ)) {
	$id = $SDATA['id'];
	$media_number = $SDATA['media_number'];
	$slider_type = $SDATA['slider_type'];
	$cat_id = $SDATA['cat_id'];
	$pro_id = $SDATA['pro_id'];
$get_cat = $conn -> query("SELECT * FROM super_category WHERE id = '$cat_id'");
$cat_title = mysqli_fetch_assoc($get_cat)['name'];

$get_img = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number'");
$image = $url.mysqli_fetch_assoc($get_img)['file_name'];

	array_push($result, array( 'slide' => $image, 'slider_type' => $slider_type, 'cat_id' => $cat_id, 'cat_title' => $cat_title, 'pro_id' => $pro_id ) );
	// array_push($result, array( 'slide' => $site_url."/slider/".$SDATA['file'] ) );
	// $c_count++;
}

echo json_encode($result);

?>