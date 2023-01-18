<?php
if(!empty($_FILES)){
include ('../../config.php');

// $media_number = rand().time();
$product_number = rand().time();

	$targetDir = "../../media/";

	$fileName = time().$ad.rand().$_FILES['file']['name'];

	$targetFile = $targetDir.$fileName;	

	if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){

		//insert file information into db table

		// $conn->query("INSERT INTO cover_media (file_name, media_number) VALUES('".$fileName."','".$product_number."')");

		$update_media = $conn->query("INSERT INTO media (file_name, media_number) VALUES('".$fileName."','".$product_number."')");

		if($update_media){
			$result = array('response' => 1, 'media_number' => $product_number);
		}

	}

	echo json_encode($result);
}

?>