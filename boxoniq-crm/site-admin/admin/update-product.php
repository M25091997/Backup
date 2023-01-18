<?php session_start(); ?>
<?php include ('../../config.php');

$name = $conn->real_escape_string($_POST['name']);
$slug = slugify($_POST['name']);
$details = $conn->real_escape_string($_POST['description']);
$category_id = $_POST['category_id'];
$product_id = $_POST['product_id'];

$sub_category_id = $_POST['sub_category_id'];
$child_category_id = 0;
$brand_id = $_POST['brand_id'];
$gst = $_POST['gst'];


if (
$conn->query("UPDATE items SET name = '$name' WHERE id = '$product_id'") === TRUE && 
$conn->query("UPDATE items SET slug = '$slug' WHERE id = '$product_id'") === TRUE && 
$conn->query("UPDATE items SET category_id = '$category_id' WHERE id = '$product_id'") === TRUE &&
$conn->query("UPDATE items SET details = '$details' WHERE id = '$product_id'") === TRUE &&
$conn->query("UPDATE items SET sub_category_id = '$sub_category_id' WHERE id = '$product_id'") === TRUE &&
$conn->query("UPDATE items SET category_2_id = '$child_category_id' WHERE id = '$product_id'") === TRUE &&
$conn->query("UPDATE items SET gst = '$gst' WHERE id = '$product_id'") === TRUE &&
$conn->query("UPDATE items SET brand_id = '$brand_id' WHERE id = '$product_id'") === TRUE

   ) 
{ header("Location: edit-product.php?id=".$product_id); }
else{
   echo "error";
}

?>