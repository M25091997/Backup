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

$url = $site_url . "/img/supercat/";

// print_r($data);
// exit();
#Washing Ease Items

$result = array();
$cat = array();
$product = array();

$sequence = $data['sequence'];
$sort = $data['sort'];
$sort_key = $data['sort_key'];

$filter = $data['filter'];
$filter_type = $data['filter_type'];
$brand_key = $data['brand_key'];
$sub_key = $data['sub_key'];

$bras = substr($brand_key, 1, -1);
$sub = substr($sub_key, 1, -1);


$bran = explode(",",$bras);
$subs = explode(",",$sub);

$brand_count = count($bran);
$subs_count = count($subs);

if($brand_count > 1){
  $filter_type = 0;
}
if($subs_count > 1){
  $filter_type = 1;
}

if(($brand_count > 1) && ($subs_count > 1)){
  $filter_type = 2;
}

// print_r($filter_type);
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

$result['response'] = 1;
$result['img'] = $cat_image;
$result['name'] = $cat_name;
$result['desc'] = $cat_desc;

$count_super_cat = $conn->query("SELECT * FROM super_category");
$count_super_cat = mysqli_num_rows($count_super_cat);
$result['count_super_cat'] = $count_super_cat;

if($sort == 0 && $filter == 0){
  $Q = $conn->query("SELECT I.id AS item_id, I.category_id AS category_id, I.media_number AS media_number_pro, I.name AS name, I.details AS details FROM `items` AS I INNER JOIN attributes AS A ON A.item_id = I.id WHERE I.category_id = '$super_id'");
}

if($sort == 1 && $filter == 0){
  if($sort_key == 1){
    $Q = $conn->query("SELECT I.id AS item_id, I.category_id AS category_id, I.media_number AS media_number_pro, I.name AS name, I.details AS details FROM `items` AS I INNER JOIN attributes AS A ON A.item_id = I.id WHERE I.category_id = '$super_id' ORDER BY A.price ASC");
  }
  if($sort_key == 2){
    $Q = $conn->query("SELECT I.id AS item_id, I.category_id AS category_id, I.media_number AS media_number_pro, I.name AS name, I.details AS details FROM `items` AS I INNER JOIN attributes AS A ON A.item_id = I.id WHERE I.category_id = '$super_id' ORDER BY A.price DESC");
  }
}

if($sort == 0 && $filter == 1){
  if($filter_type == 0){
    // print_r($bras);
    // exit;
    $Q = $conn->query("SELECT I.id AS item_id, I.category_id AS category_id, I.media_number AS media_number_pro, I.name AS name, I.details AS details FROM `items` AS I WHERE I.category_id = '$super_id' && I.brand_id IN ($bras) ");
  }
  if($filter_type == 1){
    // print_r($sub);
    // exit;
    $Q = $conn->query("SELECT I.id AS item_id, I.category_id AS category_id, I.media_number AS media_number_pro, I.name AS name, I.details AS details FROM `items` AS I WHERE I.category_id = '$super_id' && I.sub_category_id IN ($sub) ");
  }
  if($filter_type == 2){
    // print_r($sub);
    // print_r($bras);
    // exit;
    $Q = $conn->query("SELECT I.id AS item_id, I.category_id AS category_id, I.media_number AS media_number_pro, I.name AS name, I.details AS details FROM `items` AS I WHERE I.category_id = '$super_id' && I.sub_category_id IN ($sub) && I.brand_id IN ($bras) ");
  }
}

while ($itemData = mysqli_fetch_array($Q)) {

  $name = $itemData['name'];
  // $item_slug = $itemData['slug'];
  $item_id = $itemData['item_id'];
  $cat_id = $itemData['category_id'];
  $media_number = $itemData['media_number_pro'];
  $name = $itemData['name'];
  $pro_desc = $itemData['details'];

  $get_attr_price = $conn->query("SELECT * FROM attributes WHERE item_id = '$item_id'");
      $row_attr_price = mysqli_fetch_array($get_attr_price);
      $single_price = $row_attr_price['price'];
      $single_mrp = $row_attr_price['mrp'];
      $single_attr_id = $row_attr_price['id'];


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

    $new_discount = round($discount/$mrp*100);
    // $discount = $new_discount;

    if($stock > 0){
      $is_stock = 1;
    }else{
      $is_stock = 0;
    }

    array_push($attributes, array('id' => $attribute_id, 'name' => $attr_name, 'price' => $price, 'mrp' => $mrp, 'discount' => $new_discount));
  }

  // if ($count_row_rating != 0) {
  //             $avg_rating = round($pro_rating / $count_row_rating);
  //           }else{
  //             $avg_rating = 0;
  //           }

  array_push($product, array('image' => $img, 'id' => $item_id, 'qty' => 1, 'selected_attr_id' => $single_attr_id, 'item_price' => $single_price, 'item_mrp' => $single_mrp, 'is_stock' => $is_stock, 'title' => substr($name, 0, 23) . "...", 'desc' => $pro_desc, 'attribute' => $attributes));

  $pro_rating = 0;
}

$result['product'] = $product;

echo json_encode($result);
