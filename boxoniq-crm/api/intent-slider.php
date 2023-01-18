<?php 
include("../../config.php");
$result = array();

$SQ = $conn -> query("SELECT * FROM intent_slider ORDER BY id DESC");
$c_count = 1;
while ($SDATA = mysqli_fetch_array($SQ)) {
	array_push($result, array( 'slide' => $site_url."/intent-slider/".$SDATA['media_number'], 'category-id' => $SDATA['intent_id'], 'title' => $SDATA['title'] ) );
	$c_count++;
}

echo json_encode($result);

?>