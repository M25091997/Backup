<?php session_start(); ?>
<?php include ('../../config.php');

$customer_id = $_GET['id'];

if ( $conn->query("UPDATE accounts SET cod = '1' WHERE id = '$customer_id'") === TRUE ) 
{ header("Location: all-customers.php"); } else { echo false; }

?>