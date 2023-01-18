<?php 
include ('../../../config.php');

// echo "<pre>";
// print_r($_POST);
// exit();

$name = $conn->real_escape_string($_POST['name']);
$hindi_name = $_POST['hindi_name'];
$slug = slugify($_POST['name']);
$details = $conn->real_escape_string($_POST['description']);
$category_id = $_POST['category_id'];
$corporate_id = $_POST['corporate_id'];
$product_id = $_POST['product_id'];
$media_number = $_POST['media-number-p'];

// if(isset($_POST['media-number'])){
// $media_number = $_POST['media-number'];
// }
// print_r($media_number);
// exit();

$attr_id = $_POST['attr_id'];
$attr_name = $_POST['attr_name'];
$attr_slug = slugify($attr_name);
$price = $_POST['pro_price'];
$mrp = $_POST['pro_mrp'];
$discount = $mrp - $price;
$stock = $_POST['pro_stock'];
$expiry = $_POST['expiry'];

// print_r($attr_id);echo '<br>';
// print_r($attr_name);echo '<br>';
// print_r($attr_slug);echo '<br>';
// print_r($mrp);echo '<br>';
// print_r($price);echo '<br>';
// print_r($discount);echo '<br>';
// print_r($stock);echo '<br>';
// print_r($expiry);
// exit();
$update_sql = "UPDATE items SET name = '$name', hindi_name = '$hindi_name', slug = '$slug', details = '$details', media_number = '$media_number', category_id = '$category_id', corporate_id = '$corporate_id' WHERE id = '$product_id' ";
$query = mysqli_query($conn, $update_sql);


//  $update_product = $conn -> query("UPDATE items SET name = '$name', hindi_name = '$hindi_name', slug = '$slug', details = '$details', media_number = '$media_number', category_id = '$category_id', corporate_id = '$corporate_id' WHERE id = '$product_id' ");

$update_attr = $conn -> query("UPDATE `attributes` SET `name`='$attr_name',`slug`='$attr_slug',`price`='$price',`mrp`='$mrp',`discount`='$discount',`media_number`='$media_number',`stock`='$stock',`expiry_date`='$expiry' WHERE id = '$attr_id'");



if($query && $update_attr){
   
   header("Location: ../edit-product.php?id=".$product_id);
}


?>