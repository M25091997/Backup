<?php

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

// $data = json_decode(file_get_contents('php://input'), true);
$url = $site_url."/img/stories/";
$result = array();
// $image = array();

	$Q = $conn -> query("SELECT * FROM story");

while ($DQ = mysqli_fetch_array($Q)) {
	$id = $DQ['id'];
	$title = $DQ['title'];
	$slug = $DQ['slug'];
	$story = $DQ['story'];
	$media_no = $DQ['media_no'];
	$created_on = $DQ['created_on'];

	$get_img = $conn -> query("SELECT * FROM media WHERE media_number = '$media_no'");
	$row_img = mysqli_fetch_assoc($get_img);
	$image = $url.$row_img['file_name'];

	// while($row_img = mysqli_fetch_assoc($get_img)){
	// 	array_push($image, array('id' => $row_img['id'], 'image' => $url.$row_img['file_name']));
	// }

	array_push($result, array('response' => '1', 'id' => $id, 'title' => $title, 'slug' => $slug, 'story' => $story, 'img' => $image, 'created_on' => $created_on ));
}
echo json_encode($result);

?>