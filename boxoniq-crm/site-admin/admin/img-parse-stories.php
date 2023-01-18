<?php
if(!empty($_FILES)){
include ('../../config.php');

	$product_number = $_REQUEST['media-number'];	

	$targetDir = "../../img/stories/";

	$fileName = time().$ad.rand().$_FILES['file']['name'];

	$targetFile = $targetDir.$fileName;	

	if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){

		//insert file information into db table

		$conn->query("INSERT INTO media (file_name, media_number) VALUES('".$fileName."','".$product_number."')");



	}

	

}

?>