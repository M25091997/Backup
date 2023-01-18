<?php
session_start();
include('../../../config.php');

$result = array();
$url = $site_url.'customer_image/';
$astro_id = $_POST['astro_id'];
$type = $_POST['type'];


$get_call_list = $conn -> query("SELECT * FROM call_detail WHERE status = '1' && astro_id = '{$astro_id}' && type = '{$type}' ORDER BY id DESC ");

if (mysqli_num_rows($get_call_list) > 0) {
	while ( $row = mysqli_fetch_array($get_call_list) ) {

	$call_id = $row['id'];
	$user_id = $row['user_id'];
	$end_time = $row['end_time'];
	$start_time = $row['start_time'];
	$trn_d = explode(' ', $end_time);
	$trn_date = $trn_d[0];
	$trn_time = $trn_d[1];

	$old_time = strtotime($start_time);
	$new_time = strtotime($end_time);

	$dur = $new_time - $old_time;
	$call_duration = gmdate("H:i:s", $dur);

	if($start_time == '0000-00-00 00:00:00'){
		$call_duration = '00:00:00';
	}


	$get_user = $conn -> query("SELECT * FROM user WHERE id = '{$user_id}' ");
	$row_user = mysqli_fetch_array($get_user);
	$user_name = $row_user['f_name'];
	$user_img = $url.$row_user['profile_img'];

	array_push($result, array('call_id' => $call_id, 'user_name' => $user_name, 'user_img' => $user_img, 'trn_date' => $trn_date, 'trn_time' => $trn_time, 'duration' => $call_duration ));
	
	}
	// $result = $x;
}else{ }	
 

echo json_encode($result);