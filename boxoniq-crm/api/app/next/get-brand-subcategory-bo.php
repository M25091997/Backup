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
$brand = array();
$subcat = array();

$sequence = $_POST['sequence'];
$get_supercat_id = $conn -> query("SELECT * FROM super_category WHERE sequence = '$sequence'");
$supercat_id = mysqli_fetch_assoc($get_supercat_id)['id'];

		$msg_query = $conn -> query("SELECT * FROM category WHERE super_category_id = '$supercat_id' ");	
            while ($msg_q = mysqli_fetch_array($msg_query)) {

            	$id = $msg_q['id'];
            	$name = $msg_q['name'];
              	
              	array_push($subcat, array('id' => $id, 'name' => $name ));

            }
			$brand_query = $conn -> query("SELECT * FROM brand");	
            while ($brand_q = mysqli_fetch_array($brand_query)) {

            	$id = $brand_q['id'];
            	$name = $brand_q['brand_name'];
              	
              	array_push($brand, array('id' => $id, 'name' => $name ));

            }

	$result = array('brand' => $brand, 'subcat' => $subcat);

echo json_encode($result);

?>