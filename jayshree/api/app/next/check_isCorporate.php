<?php
session_start();
include('../../../config.php');

$result = array();
// $main = [];
$url = $site_url.'/images/profile/';

$user_id = $_POST['user_id'];

if ( isset($_POST['user_id']) ) {

$get_review = $conn -> query("SELECT * FROM accounts WHERE id = $user_id");
$row = mysqli_fetch_array($get_review);
$account_type = $row['account_type'];

if($account_type == 1){
	$result = array('response' => 1);

}else{
	$result = array('response' => 0);

}

} else { $result = array( 'response' => 0, 'msg' => 'Something went wrong' ); }

echo json_encode($result);