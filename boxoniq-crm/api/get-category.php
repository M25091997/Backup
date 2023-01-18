<?php

session_start();

include('../inc/app.php');


$slug = $_POST['slug'];
$result = array();

if (isset($_POST['slug']) && isset($_POST['slug']) != "" ) {

$msg_query = $conn -> query("SELECT * FROM category WHERE slug = '$slug'"); 

$total_products = mysqli_num_rows($msg_query);



            while ($msg_q = mysqli_fetch_array($msg_query)) {

              $name = $msg_q['name'];
              $category_id = $msg_q['id'];

              array_push($result, array('name' => $name));

      }



$product_array = array();


$msg_query = $conn -> query("SELECT * FROM items WHERE category_id = '$category_id'");


$total_products = mysqli_num_rows($msg_query);

            while ($msg_q = mysqli_fetch_array($msg_query)) {

              $product_name = $msg_q['name'];
              $product_media_number = $msg_q['media_number'];

              $item_slug = $msg_q['slug'];
              $item_id = $msg_q['id'];
              $availability = $msg_q['availability'];

                $media_q = $conn -> query("SELECT * FROM media WHERE media_number = '$product_media_number'");
                while ($media_D = mysqli_fetch_array($media_q)) {

                  $product_img = $site_url."/media/".$media_D['file_name'];

                }


                $attr_query = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id'");
                while ($attr_D = mysqli_fetch_array($attr_query)) {

                  $attr_name = $attr_D['name'];
                  $attr_price = $attr_D['price'];
                  if( $attr_D['availablity'] == "0" ) { $availability = "Available"; } else { $availability = "Currently Out of stock"; }

                  $pricing = $attr_price." / ".$attr_name;

                }


              array_push($product_array, array('name' => $product_name, 'image' => $product_img, 'price' => $pricing, 'availability' => $availability, 'slug' => $item_slug ));

      }

array_push($result, array('products' => $product_array, 'total_products' => $total_products));




} else { array_push($result, array('Error' => "NO POST VARS FOUND")); }



echo json_encode($result);



?>