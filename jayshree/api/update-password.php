<?php
session_start();
include('../config.php');
$result = array();

	$password = $_REQUEST['password'];
    $account_id = $_SESSION['account-id-password-reset'];

    if ( $conn -> query("UPDATE accounts SET password = '$password' WHERE id = '$account_id'") ) { 
    	array_push($result, array( 'response' => '1' ) ); /* OTP Matched */
    }

    

echo json_encode($result); ?>