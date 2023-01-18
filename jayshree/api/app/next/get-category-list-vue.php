<?php session_start();
header('Access-Control-Allow-Origin: *'); ?>
<?php include ("config.php"); 

$result = array();

$user_id = $_POST['user_id'];
$sel_user = $conn -> query("SELECT * FROM accounts WHERE id = '$user_id' ");
$account_type = mysqli_fetch_assoc($sel_user)['account_type'];

// print_r($account_type);
// exit();

$url = $site_url."/media/";

if($account_type == 0){
	$CQ = $conn -> query("SELECT * FROM super_category ORDER BY priority_no ASC");
	while ($LData = mysqli_fetch_array($CQ)) {
		$media_number = $LData['media_number'];
		$get_img = $conn->query("SELECT * FROM media WHERE media_number = '$media_number'");
		$img = mysqli_fetch_array($get_img)['file_name'];
		array_push($result, array('super_id' => $LData['id'], 'name' => $LData['name'], 'image' => $url.$img));
	}
}

if($account_type == 1){
	// $get_cat = $conn -> query("SELECT * FROM corporate_control WHERE account_id = '$user_id'");
	// $cat = mysqli_fetch_assoc($get_cat)['cat_id'];
	// $ca = explode(",", $cat);
	
	// for($i = 0; $i<count($ca); $i++){
	// $CQ1 = $conn -> query("SELECT * FROM super_category WHERE id = $ca[$i]");
	// 	$LData1 = mysqli_fetch_array($CQ1);
	// 	$media_number = $LData1['media_number'];
	// 	$get_img = $conn->query("SELECT * FROM media WHERE media_number = '$media_number'");
	// 	$img = mysqli_fetch_array($get_img)['file_name'];
	// 	array_push($result, array('super_id' => $LData1['id'], 'name' => $LData1['name'], 'image' => $url.$img));

	// }

	$CQ = $conn -> query("SELECT * FROM corporate_category ORDER BY priority_no ASC");
	while ($LData = mysqli_fetch_array($CQ)) {
		$media_number = $LData['media_number'];
		$get_img = $conn->query("SELECT * FROM media WHERE media_number = '$media_number'");
		$img = mysqli_fetch_array($get_img)['file_name'];
		array_push($result, array('super_id' => $LData['id'], 'name' => $LData['name'], 'image' => $url.$img));
	}


}



echo json_encode($result);

?>