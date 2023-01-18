<?php
if(!empty($_FILES)){
include ('../../config.php');

	$banner_id = $_REQUEST['banner-id'];
	$link = $_REQUEST['link'];	
	$targetDir = "../../media/";
	$fileName = time().$ad.rand().$_FILES['file']['name'];
	$targetFile = $targetDir.$fileName;	
	if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
		//insert file information into db table
		/*$conn->query("INSERT INTO banners (file_name, link) VALUES('".$fileName."','".$link."')");*/
	if ( $conn->query("UPDATE banners SET file_name = '$fileName' WHERE id = '$banner_id'") === TRUE && $conn->query("UPDATE banners SET link = '$link' WHERE id = '$banner_id'") === TRUE ) {}

	}	

} ?>