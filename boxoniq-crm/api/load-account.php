<?php
session_start();
include('../config.php');
$account_array = array();
$account_id = $_SESSION['account-id'];

if (isset($_SESSION['account-id'])) {

$msg_query = $conn -> query("SELECT * FROM accounts WHERE id = '$account_id'");  
            while ($msg_q = mysqli_fetch_array($msg_query)) {

              $oq = $conn -> query("SELECT * FROM orders WHERE account_id = '$account_id'"); 
              $total_orders = mysqli_num_rows($oq); 

            array_push($account_array, array( 'response' => '1', 'name' => $msg_q['name'], 'email' => $msg_q['email'], 'phone' => $msg_q['phone'], 'orders' => $total_orders ));        

            }



} else { array_push($account_array, array('response' => '666' )); }

echo json_encode($account_array);

?>