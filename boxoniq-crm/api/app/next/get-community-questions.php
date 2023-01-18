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

$limit = 10;

if (isset($_POST["page"])) { 
	$pn  = $_POST["page"]; 
  } 
  else { 
	$pn=1; 
  };  

  $start_from = ($pn-1) * $limit;
  $end_at = $pn * $limit;  


//   $sql = "SELECT * FROM table1 LIMIT $start_from, $limit";  

	$Q = $conn -> query("SELECT * FROM community_question ORDER BY created_on DESC LIMIT $start_from, $end_at");


// $is_limit = $_POST['is_limit'];
// if($is_limit == 1){
// 	$Q = $conn -> query("SELECT * FROM community_question ORDER BY created_on DESC");
// }else{
// 	$Q = $conn -> query("SELECT * FROM community_question ORDER BY created_on DESC");
// }

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