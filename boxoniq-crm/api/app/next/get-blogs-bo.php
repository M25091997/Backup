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
$url = $site_url."/img/blog/";
$result = array();

$Q = $conn -> query("SELECT * FROM blog");
while ($DQ = mysqli_fetch_array($Q)) {
	$id = $DQ['id'];
	$title = $DQ['title'];
	$slug = $DQ['slug'];
	$blog_desc = $DQ['blog_desc'];
	$image = $url.$DQ['image'];
	$created_on = $DQ['created_on'];



	array_push($result, array('response' => '1', 'id' => $id, 'title' => $title, 'slug' => $slug, 'blog_desc' => $blog_desc, 'img' => $image, 'created_on' => $created_on ));
}
echo json_encode($result);

?>