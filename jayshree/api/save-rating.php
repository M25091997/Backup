<?php
session_start();
include('../config.php');

$account_id = $_SESSION['account-id'];
$rating = $_GET['rating'];
$review = $_GET['review'];
$item_id = $_GET['item-id'];

$date_ = date("Y-m-d");
$time_ = date("h:i:s");


$sql = "INSERT INTO ratings (account_id, rating, review, item_id, date_creation, time_creation)
VALUES ('$account_id', '$rating', '$review', '$item_id', '$date_', '$time_')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>