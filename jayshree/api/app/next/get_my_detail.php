<?php
session_start();
include('../../../config.php');

$result = array();
// $main = [];
$url = $site_url.'/images/profile/';


$user_id = $_POST['user_id'];


if ( isset($_POST['user_id']) ) {

$get_review = $conn -> query("SELECT * FROM accounts WHERE id = $user_id");

if (mysqli_num_rows($get_review) > 0) {
	while ( $row = mysqli_fetch_array($get_review) ) {

	$user_id = $row['id'];
	$email = $row['email'];
	$phone = $row['phone'];
	$name = $row['name'];
	$shop_name = $row['shop_name'];
	$profile_img = $url.$row['profile_img'];

	
	$result = array('name' => $name, 'shop_name' => $shop_name, 'profile_img' => $profile_img, 'email' => $email, 'phone' => $phone);
	
	}
	

	// $result = $x;
}else{array_push($result, array( 'response' => 0, 'msg' => 'Something went wrong' )); }	
 

} else { array_push($result, array( 'response' => 0, 'msg' => 'Something went wrong' )); }

// $main['reviews'] = $result;

echo json_encode($result);