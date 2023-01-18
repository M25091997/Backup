<?php
header('Access-Control-Allow-Origin: *');
include("config.php");

#Washing Ease Items

$result = array();
$product = array();

$product_id = $_POST['product_id'];

$pro_rating = 0;

$Q = $conn->query("SELECT * FROM items WHERE id = '$product_id' ORDER BY id DESC");

while ($itemData = mysqli_fetch_array($Q)) {

  $name = $itemData['name'];
  // $item_slug = $itemData['slug'];
  $item_id = $itemData['id'];
  $cat_id = $itemData['category_id'];
  $media_number = $itemData['media_number'];
  $name = $itemData['name'];
  $pro_desc = $itemData['details'];


  $catq = $conn->query("SELECT * FROM super_category WHERE id = '$cat_id'");
  while ($catD = mysqli_fetch_array($catq)) {
    $cat_name = $catD['name'];
  }



  $QIMG = $conn->query("SELECT * FROM media WHERE media_number = '$media_number' ");
  $img_arr = array();
  while ($img_data = mysqli_fetch_array($QIMG)) {
    $img = $site_url . "/media/" . $img_data['file_name'];
    array_push($img_arr , array('img' => $img));
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
    $stock = $item_Data['stock'];

    if($stock > 0){
      $is_stock = 1;
    }else{
      $is_stock = 0;
    }

    array_push($attributes, array('id' => $attribute_id, 'name' => $attr_name, 'price' => $price, 'mrp' => $mrp, 'discount' => $discount));
  }

  // if ($count_row_rating != 0) {
  //             $avg_rating = round($pro_rating / $count_row_rating);
  //           }else{
  //             $avg_rating = 0;
  //           }

  $product = array('image' => $img_arr, 'id' => $item_id, 'is_stock' => $is_stock, 'title' => substr($name, 0, 23) . "...", 'desc' => $pro_desc, 'attribute' => $attributes);

  $pro_rating = 0;
}

$result['product'] = $product;

echo json_encode($result);
