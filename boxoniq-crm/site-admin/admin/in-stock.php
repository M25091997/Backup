<?php session_start(); ?>
<?php include ('../../config.php');

$attribute_id = $_GET['id'];

if ( $conn->query("UPDATE attributes SET availablity = '0' WHERE id = '$attribute_id'") === TRUE ) 
{ header("Location: new-attribute.php"); }

?>