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

		$msg_query = $conn -> query("SELECT * FROM faq_section");	
            while ($msg_q = mysqli_fetch_array($msg_query)) {

            	$id = $msg_q['id'];
            	$faq = $msg_q['faq'];
            	$answer = $msg_q['answer'];
              	
              	array_push($result, array('id' => $id, 'faq' => $faq, 'answer' => $answer ));

            }

echo json_encode($result);

?>