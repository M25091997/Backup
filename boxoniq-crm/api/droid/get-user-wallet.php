<?php
session_start();
include('../../config.php');

$result = [];

if (isset($_POST['account-id'])) {
    $user_id = $_POST['account-id'];
    $sql = "SELECT * FROM wallet WHERE user_id= '$user_id'";
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($query);
        $amt = $row['amount'];
        array_push($result,  array('response' => 'success!', 'amount' => $amt));
    } else {
        array_push($result,  array('response' => 'Not Found!'));
    }
} else {
    array_push($result,  array('response' => 'Post var missing!'));
}


echo json_encode($result);
