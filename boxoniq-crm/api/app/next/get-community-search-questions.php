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
$url = $site_url."/img/user/";
$result = array();

$search = $_POST['search'];
if($search == "all"){
	$Q = $conn -> query("SELECT * FROM community_question");
}else{
	$Q = $conn -> query("SELECT * FROM community_question WHERE question LIKE '%$search%'");
}

while ($DQ = mysqli_fetch_array($Q)) {
	$id = $DQ['id'];
	$question = $DQ['question'];
	$created_by = $DQ['created_by'];

$get_answer_count = $conn -> query("SELECT * FROM community_answer WHERE question_id = '$id' ");
$answer_count = mysqli_num_rows($get_answer_count);

$get_user = $conn -> query("SELECT name, profile_img FROM accounts WHERE id = '$created_by'");
$row_user = mysqli_fetch_assoc($get_user);
$user_name = $row_user['name'];
$user_img = $url.$row_user['profile_img'];
$created_on = $DQ['created_on'];
// $answer_count = 5;

	array_push($result, array('response' => '1', 'question_id' => $id, 'question' => $question, 'answer_count' => $answer_count, 'user_name' => $user_name, 'img' => $user_img, 'created_on' => $created_on ));

}
echo json_encode($result);

?>