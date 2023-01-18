<?php

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$data = json_decode(file_get_contents('php://input'), true);
$url = $site_url."/img/user/";
$ans = array();


$question_id = $data['question_id'];

$get_ques = $conn -> query("SELECT * FROM community_question WHERE id = '$question_id' ");
$row_ques = mysqli_fetch_assoc($get_ques);
$fquestion = $row_ques['question'];

$get_answer_count = $conn -> query("SELECT * FROM community_answer WHERE question_id = '$question_id' ORDER BY id DESC");
while ($DQ = mysqli_fetch_array($get_answer_count)) {
	$id = $DQ['id'];
	$answer = $DQ['answer'];
	$created_by = $DQ['answer_by'];
	$created_on = $DQ['created_on'];

$get_user = $conn -> query("SELECT name, profile_img FROM accounts WHERE id = '$created_by'");
$row_user = mysqli_fetch_assoc($get_user);
$user_name = $row_user['name'];
$user_img = $url.$row_user['profile_img'];
// $answer_count = 5;

	array_push($ans, array('response' => '1', 'answer_id' => $id, 'answer' => $answer, 'user_name' => $user_name, 'img' => $user_img, 'created_on' => $created_on ));

}
echo json_encode(array('question' => $fquestion, 'answer' => $ans));

?>