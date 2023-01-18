<?php
session_start();
include('../inc/app.php');

$slug = $_POST['slug'];
$result = array();
$total_items = 0;

if (isset($_POST['slug']) && isset($_POST['slug']) != "" ) {

$msg_query = $conn -> query("SELECT * FROM super_category WHERE slug = '$slug'");	

$total_products = mysqli_num_rows($msg_query);

            while ($msg_q = mysqli_fetch_array($msg_query)) {

              $name = $msg_q['name'];
              $super_category_id = $msg_q['id'];

              $msg_query_ = $conn -> query("SELECT * FROM category WHERE super_category_id = '$super_category_id'");

              $total_products = mysqli_num_rows($msg_query_);
            

              while ($msg_q_ = mysqli_fetch_array($msg_query_)) { $category_id = $msg_q_['id']; }

              array_push($result, array('name' => $name, 'total_categories' => $total_products));

			     }


$category_array = array();

$msg_query = $conn -> query("SELECT * FROM category WHERE super_category_id = '$super_category_id'");

$total_products = mysqli_num_rows($msg_query);            

     while ($msg_q = mysqli_fetch_array($msg_query)) {

              $name = $msg_q['name'];
              $category_id = $msg_q['id'];
              $category_slug = $msg_q['slug'];

              $pQ = $conn -> query("SELECT * FROM items WHERE category_id = '$category_id'");
              $total_items = mysqli_num_rows($pQ);

              array_push($category_array, array('name' => $name, 'id' => $category_id, 'slug' => $category_slug, 'total_items' => $total_items));

      }

array_push($result, array('categories' => $category_array));

} else { array_push($result, array('Error' => "NO POST VARS FOUND")); }

echo json_encode($result);



?>