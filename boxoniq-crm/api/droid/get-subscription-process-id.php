<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('../../config.php');

$result = array();

// $data = json_decode(file_get_contents('php://input'), true);


$accountId = $_POST['account_id'];


$account_id = $accountId;

if (isset($account_id)) {

		$msg_query = $conn -> query("SELECT * FROM subs_booking_history WHERE user_id = '$account_id' && subs = 1 && iscancel != 1 ORDER BY id DESC LIMIT 1");	
            while ($row = mysqli_fetch_array($msg_query)) {

		$process_id = $row['process_id'];
		
	}


	$result = array('response' => '1', 'id' => $process_id);
} else {
}

echo json_encode($result);
