<?php
header('Access-Control-Allow-Origin: *');
include("config.php");
$url = $site_url . "/img/supercat/";

// print_r($_POST);
// exit();
#Washing Ease Items

$result = array();
$cat = array();
$product = array();

$msg_query = $conn -> query("SELECT * FROM bundle_creator ORDER BY id ASC");  
            while ($msg_q = mysqli_fetch_array($msg_query)) {

                $id = $msg_q['id'];
                $item_ids = $msg_q['item_ids'];
                $arr = explode(",", $name);

                // $result = array('len' => count($arr));
                
                // array_push($result, array('id' => $id, 'name' => $name, 'arr' => $arr));
            }
// print_r($item_ids);
// exit();
  
$select_items = $conn -> query("SELECT * FROM items WHERE id IN ($item_ids)");

while ($itemData = mysqli_fetch_array($select_items)) {

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

  array_push($product, array('image' => $img, 'id' => $item_id, 'is_stock' => $is_stock, 'title' => substr($name, 0, 23) . "...", 'desc' => $pro_desc, 'attribute' => $attributes));

  $pro_rating = 0;
}

$result = array('img' => 'https://images.unsplash.com/photo-1566576721346-d4a3b4eaeb55?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=765&q=80', 'name' => 'Recommended Bundle', 'desc' => "Boxoniq recommended products for faster checkout. Add product to box from our recommendation and proceed to checkout. It's just Simple, Quicker & Faster.");

$result['product'] = $product;

echo json_encode($result);
