<?php session_start(); ?>
<?php include ('../../config.php');

$attribute_id = $_POST['id'];
$price = $_POST['price'];
$name = $_POST['name'];
$mrp = $_POST['mrp'];
$discount = $_POST['discount'];
$stock = $_POST['stock'];
$expiry_date = $_POST['expiry'];

if ( $conn->query("UPDATE attributes SET price = '$price' WHERE id = '$attribute_id'") === TRUE 
	&& $conn->query("UPDATE attributes SET name = '$name' WHERE id = '$attribute_id'") === TRUE  
	&& $conn->query("UPDATE attributes SET mrp = '$mrp' WHERE id = '$attribute_id'") === TRUE 
	&& $conn->query("UPDATE attributes SET discount = '$discount' WHERE id = '$attribute_id'") === TRUE 
	&& $conn->query("UPDATE attributes SET stock = '$stock' WHERE id = '$attribute_id'") === TRUE 
	&& $conn->query("UPDATE attributes SET expiry_date = '$expiry_date' WHERE id = '$attribute_id'") === TRUE 
) { echo "Attribute Updated Successfully!"; }

?>