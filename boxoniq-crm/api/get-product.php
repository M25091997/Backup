<?php

session_start();

include('../inc/app.php');


$slug = $_POST['slug'];
$result = array();
$attribute_array = array();


if (isset($_POST['slug']) && isset($_POST['slug']) != "" ) {


		$msg_query = $conn -> query("SELECT * FROM items WHERE slug = '$slug'");	

            while ($msg_q = mysqli_fetch_array($msg_query)) {


            	$product_id = $msg_q['id'];
            	set_views($product_id);

            	$media_number = $msg_q['media_number'];
              	$category_id = $msg_q['category_id'];

            	$media_q = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number' ORDER BY id DESC ");
              	while ($media_D = mysqli_fetch_array($media_q)) {

              		$product_img = $site_url."/media/".$media_D['file_name'];

              	}



                $cq = $conn -> query("SELECT * FROM category WHERE id = '$category_id'");
                while ($cD = mysqli_fetch_array($cq)) {

                  $category_slug = $cD['slug'];

                }


              	$attr_query = $conn -> query("SELECT * FROM attributes WHERE item_id = '$product_id'");
                while ($attr_D = mysqli_fetch_array($attr_query)) {

                  $attr_name = $attr_D['name'];
                  $attr_price = $attr_D['price'];
                  if( $attr_D['availablity'] == "0" ) { $availability = "Available"; } else { $availability = "Currently Out of stock"; }

                  array_push($attribute_array, array('id' => $attr_D['id'], 'name' => $attr_D['name'], 'price' => $attr_D['price'], 'mrp' => $attr_D['mrp'], 'off' => $attr_D['discount'], 'stock' => preg_replace('/\s+/', '', $attr_D['stock']) ));

                }

              array_push($result, array('id' => $msg_q['id'], 'name' => $msg_q['name'], 'details' => $msg_q['details'], 'image' => $product_img, 'category_slug' => $category_slug, 'attributes' => $attribute_array ));

			}



} else { array_push($result, array('Error' => "NO POST VARS FOUND")); }

echo json_encode($result);

?>