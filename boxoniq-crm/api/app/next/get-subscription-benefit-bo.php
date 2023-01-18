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
// $url = $site_url."/img/bundle/";
		$msg_query = $conn -> query("SELECT * FROM subscription_benefit ORDER BY id ASC");	
            while ($msg_q = mysqli_fetch_array($msg_query)) {

            	$id = $msg_q['id'];
            	$name = $msg_q['benefit'];
            	
              	
              	array_push($result, array('id' => $id, 'name' => $name,));

            }

echo json_encode($result);

?>