<?php 
session_start();
include ("../../config.php");
include ("../../variables.php");

$q = $_GET['q'];

$cQ = $conn -> query("SELECT * FROM attributes ORDER BY id ASC LIMIT 200"); 
while ($rowD = mysqli_fetch_array($cQ)) {
$id = $rowD['id'];
$name = $rowD['name'];
$item_id = $rowD['item_id'];

$category_Q = $conn -> query("SELECT * FROM items WHERE name LIKE '%$q%' ");
while ($iData = mysqli_fetch_array($category_Q)) {

$item_name = $iData['name'];

}

echo $item_name."<br><br>";



}



?>


