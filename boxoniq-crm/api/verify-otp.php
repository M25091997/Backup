<?php
session_start();
include('../config.php');
$result = array();

	$otp = $_REQUEST['otp-n'];
    $account_id = $_SESSION['account_to_verify'];

    if ($conn -> query("UPDATE accounts SET verification = '1' WHERE id = '$account_id'" )) { 
                array_push($result, array( 'response' => '1' ) ); /* OTP Matched */
                $_SESSION['account-id'] = $account_id;
            }

echo json_encode($result); ?>