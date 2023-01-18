<?php
if(!empty($_FILES)){
include ('../../config.php');

	$product_number = $_REQUEST['media-number'];	

	$targetDir = "../../slider/";

	$fileName = time().$ad.rand().$_FILES['file']['name'];

	$targetFile = $targetDir.$fileName;	

	if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){

		$conn -> query("UPDATE slider SET file_name = '".$fileName."' WHERE id = '3' ");

	}

	

}

?>