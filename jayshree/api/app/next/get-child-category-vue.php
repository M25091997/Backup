<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');

// $id = $_POST['id'];
$data = json_decode(file_get_contents('php://input'), true);

$id = $data['prochildid'];
$result = array();
$pro_rating = 0;

if ($id != "" ) {

$msg_query = $conn -> query("SELECT * FROM category_2 WHERE slug = '$id'"); 

$msg_query_T = $conn -> query("SELECT * FROM items WHERE category_2_id = '$id'");

$total_products = mysqli_num_rows($msg_query_T);



            while ($msg_q = mysqli_fetch_array($msg_query)) {

              $name = $msg_q['name'];
              $category_id = $msg_q['id'];

              // array_push($result, array('name' => $name, 'total_products' => $total_products));

             }



$product_array = array();


$msg_query = $conn -> query("SELECT * FROM items WHERE category_2_id = '$category_id' ORDER BY id DESC");


$total_products = mysqli_num_rows($msg_query);

            while ($msg_q = mysqli_fetch_array($msg_query)) {

              $product_name = $msg_q['name'];
              $product_media_number = $msg_q['media_number'];

              $item_id = $msg_q['id'];
              $item_slug = $msg_q['slug'];
              // $availability = $msg_q['availability'];

              $q = $conn -> query("SELECT * FROM ratings WHERE item_id = '$item_id' ORDER BY id DESC ");
              $count_row_rating = mysqli_num_rows( $q );

              while ($R_D = mysqli_fetch_array( $q )) { 

                  $ratings = $R_D['rating'];
                  $pro_rating += (int)$ratings;

                  $ratings = 0;

                  }

                $media_q = $conn -> query("SELECT * FROM media WHERE media_number = '$product_media_number'");
                while ($media_D = mysqli_fetch_array($media_q)) {

                  $product_img = $site_url."/media/".$media_D['file_name'];

                }

                $media_q_c = $conn -> query("SELECT * FROM cover_media WHERE media_number = '$product_media_number'");
                if (mysqli_num_rows($media_q_c) != 0) {
                  while ($media_D_c = mysqli_fetch_array($media_q_c)) {
                  $product_img = $site_url."/media/".$media_D_c['file_name'];
                }
                }

                $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 "); 
        while ($item_Data = mysqli_fetch_array($attr_q)) { 

                              $off = "Rs. ".( $item_Data['mrp'] - $item_Data['price'] ). " Off";
                              $mrp = $item_Data['mrp'];
                              $price = $item_Data['price'];
                              $attribute_name = $item_Data['name'];
                              $attribute_id = $item_Data['id'];
        }

        if ($count_row_rating != 0) {
                    $avg_rating = round($pro_rating / $count_row_rating);
                  }else{
                    $avg_rating = 0;
                  }


              array_push($result, array('id' => $item_id, 'slug' => $item_slug, 'attributeId' => $attribute_id, 'cat_name' => $name, 'name' => $product_name, 'image' => $product_img, 'mrp' => $mrp, 'price' => $price, 'discount' => $off, 'attributeName' => $attribute_name, 'ratings' => $avg_rating, 'review' => $count_row_rating ));

              $pro_rating = 0;

      }

// array_push($result, array('products' => $product_array));




} else { array_push($result, array('Error' => "NO POST VARS FOUND")); }



echo json_encode($result);



?>