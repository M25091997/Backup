<?php session_start(); ?>
<?php include ('../../config.php');

$attribute_id = $_POST['id'];

if ( $conn->query("UPDATE attributes SET deactive = '1' WHERE id = '$attribute_id'") === TRUE ) { echo 1; }

?>