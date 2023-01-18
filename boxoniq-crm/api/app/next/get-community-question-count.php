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
$result = array();

$Q = $conn -> query("SELECT COUNT(*) AS count FROM community_question");

$count_question = mysqli_fetch_assoc($Q)['count'];
	
$result = array('response' => '1', 'quesion_count' => $count_question);

echo json_encode($result);

?>