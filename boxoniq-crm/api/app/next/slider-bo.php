<?php 
header('Access-Control-Allow-Origin: *');
include("config.php");
$result = array();

$SQ = $conn -> query("SELECT * FROM slider ORDER BY id DESC");
$c_count = 1;
// $url = $site_url."/media/";
while ($SDATA = mysqli_fetch_array($SQ)) {

	$media_no = $SDATA['media_number'];
	$slider_id = $SDATA['id'];

	// $get_slider = $conn -> query("SELECT * FROM media WHERE media_number = '$media_no' ");
	// $row_slider = mysqli_fetch_assoc($get_slider);
	// $slider = $row_slider['file_name'];
	// $slider_id = $row_slider['id'];

	array_push($result, array( 'slider_id' => $slider_id, 'slide' => $media_no) );
	$c_count++;
}

echo json_encode($result);

?>