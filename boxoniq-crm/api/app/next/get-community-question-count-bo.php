<?php

// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include("config.php");

$result = array();

		$msg_query = $conn -> query("SELECT count(*) as ques_count FROM community_question");	
            while ($msg_q = mysqli_fetch_array($msg_query)) {

            	$name = $msg_q['ques_count'];
              	
              	$result = array('ques_count' => $name);

            }

echo json_encode($result);

?>