<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents('php://input'), true);

include("config.php");
$url = $site_url . "/img/supercat/";

#Washing Ease Items

$result = array();
$cat = array();
$product = array();

$sequence = $data['sequence'];
// print_r($sequence);
// exit();

$get_super_cat_id = $conn->query("SELECT * FROM super_category WHERE sequence = '$sequence'");
$super_id = mysqli_fetch_assoc($get_super_cat_id)['id'];
// print_r($super_id);
// exit();

$pro_rating = 0;

$get_sel_cat = $conn->query("SELECT * FROM super_category WHERE id = '$super_id'");
$row_sel_cat = mysqli_fetch_assoc($get_sel_cat);
$cat_name = $row_sel_cat['name'];
$cat_image = $url . $row_sel_cat['image'];
$cat_desc = $row_sel_cat['cat_desc'];

// print_r($cat_name);
// exit();

$result['img'] = $cat_image;
$result['name'] = $cat_name;
$result['desc'] = $cat_desc;

$count_super_cat = $conn->query("SELECT * FROM super_category");
$count_super_cat = mysqli_num_rows($count_super_cat);
$result['count_super_cat'] = $count_super_cat;

$Q = $conn->query("SELECT * FROM items WHERE category_id = '$super_id' ORDER BY id DESC");

while ($itemData = mysqli_fetch_array($Q)) {

  $name = $itemData['name'];
  $item_slug = $itemData['slug'];
  $item_id = $itemData['id'];
  $cat_id = $itemData['category_id'];
  $media_number = $itemData['media_number'];
  $name = $itemData['name'];
  $pro_desc = $itemData['details'];

  $get_attr_price = $conn->query("SELECT * FROM attributes WHERE item_id = '$item_id'");
      $row_attr_price = mysqli_fetch_array($get_attr_price);
      $single_price = $row_attr_price['price'];
      $single_mrp = $row_attr_price['mrp'];
      $single_attr_id = $row_attr_price['id'];
      $single_discount = round(($single_mrp-$single_price)/$single_mrp*100);




  $catq = $conn->query("SELECT * FROM super_category WHERE id = '$cat_id'");
  while ($catD = mysqli_fetch_array($catq)) {
    $cat_name = $catD['name'];
  }



  $QIMG = $conn->query("SELECT * FROM cover_media WHERE media_number = '$media_number' ");

  while ($img_data = mysqli_fetch_array($QIMG)) {
    $img = $site_url . "/media/" . $img_data['file_name'];
  }

  $attributes = array();

  $attr_q = $conn->query("SELECT * FROM attributes WHERE item_id = '$item_id' ");
  while ($item_Data = mysqli_fetch_array($attr_q)) {

    $off = "Rs. " . ($item_Data['mrp'] - $item_Data['price']) . " Off";
    $mrp = $item_Data['mrp'];
    $price = $item_Data['price'];
    $discount = (int)$mrp - (int)$price;
    $attr_name = $item_Data['name'];
    $attribute_id = $item_Data['id'];

    $new_discount = round($discount/$mrp*100);

    array_push($attributes, array('id' => $attribute_id, 'product_id' => $item_id, 'name' => $attr_name, 'price' => $price, 'mrp' => $mrp, 'discount' => $new_discount));
  }

  // if ($count_row_rating != 0) {
  //             $avg_rating = round($pro_rating / $count_row_rating);
  //           }else{
  //             $avg_rating = 0;
  //           }

  array_push($product, array('image' => $img, 'item_slug' => $item_slug, 'id' => $item_id, 'qty' => 1, 'selected_attr_id' => $single_attr_id, 'item_price' => $single_price, 'item_mrp' => $single_mrp, 'title' => substr($name, 0, 23) . "...", 'desc' => $pro_desc, 'attribute' => $attributes, 'item_discount' => $single_discount));

  $pro_rating = 0;
}

$result['product'] = $product;

echo json_encode($result);
