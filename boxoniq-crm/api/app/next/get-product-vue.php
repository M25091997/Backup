<?php

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$data = json_decode(file_get_contents('php://input'), true);
$slug = $data['product_slug'];
$id = $data['product_id'];

// print_r($slug);
// print_r($id);
// exit();


$result = array();
$attribute_array = array();
$product = array();

$pincode_array = array();

$image_array = array();

$pro_rating = 0;


if ($slug != "" or $id!= "" ) {

		$msg_query = $conn -> query("SELECT * FROM items WHERE slug = '$slug' or id = '$id' ");	

            while ($msg_q = mysqli_fetch_array($msg_query)) {


            	$product_id = $msg_q['id'];
            	/*set_views($product_id);*/

            	$media_number = $msg_q['media_number'];
              $category_id = $msg_q['category_id'];

              $q = $conn -> query("SELECT * FROM ratings WHERE item_id = '$product_id' ORDER BY id DESC ");
              $count_row_rating = mysqli_num_rows( $q );

              while ($R_D = mysqli_fetch_array( $q )) { 

                  $ratings = $R_D['rating'];
                  $pro_rating += (int)$ratings;

                  $ratings = 0;

                  }

              $catq = $conn -> query("SELECT * FROM super_category WHERE id = '$category_id'");
                while ($catD = mysqli_fetch_array($catq)) {

                  $cat_name = $catD['name'];

                }

            	$media_q = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number'");
              	while ($media_D = mysqli_fetch_array($media_q)) {
              		$product_img = $site_url."/media/".$media_D['file_name'];
              		array_push($image_array, array('image' => $product_img));
              	}



                $cq = $conn -> query("SELECT * FROM category WHERE id = '$category_id'");
                while ($cD = mysqli_fetch_array($cq)) {

                  $category_id = $cD['id'];

                }

                $attr_qprice = $conn -> query("SELECT * FROM attributes WHERE item_id = '$product_id' ORDER BY id ASC LIMIT 1");
                while ($attr_Dprice = mysqli_fetch_array($attr_qprice)) {
                  $pro_price = $attr_Dprice['price'];
                }


              	$attr_query = $conn -> query("SELECT * FROM attributes WHERE item_id = '$product_id'");
                while ($attr_D = mysqli_fetch_array($attr_query)) {

                  $attr_name = $attr_D['name'];
                  $attr_price = $attr_D['price'];
                  if( $attr_D['availablity'] == "0" ) { $availability = "Available"; } else { $availability = "Currently Out of stock"; }
                  $media_number_A = $attr_D['media_number'];

                  /*Fetching Pin*/

                  $pin_query = $conn -> query("SELECT * FROM pincode WHERE media_number = '$media_number_A'");
                while ($attr_P = mysqli_fetch_array($pin_query)) {

                  $pincode = $attr_P['pincode'];
                  $days = $attr_P['delivery'];
                  $price = $attr_P['price'];


                  array_push($pincode_array, array( 'id' => $id, 'pincode' => $pincode, 'days' => $days, 'price' => $price ));

                }
                /*Fetching Pin Ends*/

                  array_push($attribute_array, array('id' => $attr_D['id'], 'name' => $attr_D['name'], 'price' => $attr_D['price'], 'mrp' => $attr_D['mrp'], 'discount' => $attr_D['discount'], 'pincodes' => $pincode_array, 'stock' => preg_replace('/\s+/', '', $attr_D['stock'])  ));

                }

        if ($count_row_rating != 0) {
                    $avg_rating = round($pro_rating / $count_row_rating);
                  }else{
                    $avg_rating = 0;
                  }
                

              array_push($product, array('id' => $msg_q['id'], 'name' => $msg_q['name'], 'details' => $msg_q['details'], 'image' => $product_img, 'images' => $image_array, 'category_id' => $category_id,'cat_name' => $cat_name, 'price' => $pro_price, 'ratings' => $avg_rating, 'review' => $count_row_rating, 'slug' => $msg_q['slug']));

              $pro_rating = 0;

			}

      $result['product'] = $product;
      $result['attribute'] = $attribute_array;



} else { array_push($result, array('Error' => "NO POST VARS FOUND")); }

echo json_encode($result);

?>