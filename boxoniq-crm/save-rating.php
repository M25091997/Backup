<?php
session_start();
include('config.php');

$account_id = $_SESSION['account-id'];
$rating = $_POST['rating'];
$review = $_POST['review'];
$item_id = $_POST['item-id'];

$date_ = date("Y-m-d");
$time_ = date("h:i:s");


$sql = "INSERT INTO ratings (account_id, rating, review, item_id, date_creation, time_creation)
VALUES ('$account_id', '$rating', '$review', '$item_id', '$date_', '$time_')";

if ($conn->query($sql) === TRUE) {
  echo "<h2>Thank You!</h2>Your Review has been Saved Successfully!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>