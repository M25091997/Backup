<?php
header('Access-Control-Allow-Origin: *');
include("config.php");

#Washing Ease Items

$result = array();
$url = $site_url . "/media/";

$user_id = $_POST['user_id'];
$sel_user = $conn->query("SELECT * FROM accounts WHERE id = '$user_id' ");
$account_type = mysqli_fetch_assoc($sel_user)['account_type'];

// $pro_rating = 0;
if ($account_type == 0) {
  $QBanner = $conn->query("SELECT * FROM super_category ORDER BY priority_no ASC");
  while ($row_super = mysqli_fetch_assoc($QBanner)) {

    $bann = $row_super['banner_number'];
    $super_cat_id = $row_super['id'];

    $get_banner_image = $conn->query("SELECT * FROM media WHERE media_number = '$bann'");
    $file_name = mysqli_fetch_assoc($get_banner_image)['file_name'];
    $banner = $url . $file_name;

    // mysqli_set_charset('utf8');
    $Q = $conn->query("SELECT * FROM items WHERE category_id = '$super_cat_id' ORDER BY name ASC LIMIT 5 ");
    $product = array();
    while ($itemData = mysqli_fetch_array($Q)) {

      $name = $itemData['name'];
      $hindi = $itemData['hindi_name'];

      // $hindi = "प्राकृतिक अगरबत्ती";

      $item_slug = $itemData['slug'];
      $item_id = $itemData['id'];
      $subcat_id = $itemData['sub_category_id'];
      $cat_id = $itemData['category_id'];
      $media_number = $itemData['media_number'];
      $item_url = $site_url . "/item/" . $itemData['slug'];

      // $q = $conn -> query("SELECT * FROM ratings WHERE item_id = '$item_id' ORDER BY id DESC ");
      //       $count_row_rating = mysqli_num_rows( $q );

      //       while ($R_D = mysqli_fetch_array( $q )) { 

      //           $ratings = $R_D['rating'];
      //           $pro_rating += (int)$ratings;

      //           $ratings = 0;

      //           }

      $catq = $conn->query("SELECT * FROM super_category WHERE id = '$cat_id'");
      while ($catD = mysqli_fetch_array($catq)) {
        $cat_name = $catD['name'];
      }
      // $subcatq = $conn -> query("SELECT * FROM category WHERE id = '$subcat_id'");
      //         while ($subcatD = mysqli_fetch_array($subcatq)) {
      //           $subcat_name = $subcatD['name'];
      //         }


      $QIMG = $conn->query("SELECT * FROM media WHERE media_number = '$media_number' ");

      while ($img_data = mysqli_fetch_array($QIMG)) {
        $img = $site_url . "/media/" . $img_data['file_name'];
      }

      $attr_q = $conn->query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 ");
      while ($item_Data = mysqli_fetch_array($attr_q)) {

        $off = "Rs. " . ($item_Data['mrp'] - $item_Data['price']) . " Off";
        $mrp = $item_Data['mrp'];
        $price = $item_Data['price'];
        // $floatValue = intval($price);
        // $p = $floatValue . ".00";
        $attribute_name = $item_Data['name'];
        $attribute_id = $item_Data['id'];
        $stock = $item_Data['stock'];
        if ($stock > 0) {
          $is_stock = 1;
        } else {
          $is_stock = 0;
        }
      }

      // if ($count_row_rating != 0) {
      //             $avg_rating = round($pro_rating / $count_row_rating);
      //           }else{
      //             $avg_rating = 0;
      //           }

      array_push($product, array('response' => 1, 'name' => substr($name, 0, 23), 'is_stock' => $is_stock, 'hindi_name' => $hindi, 'id' => $item_id, 'cat_name' => $cat_name, 'image' => $img, 'price' => $price, 'attr_id' => $attribute_id, 'category_id' => '1', 'attribute' => $attribute_name));

      // $pro_rating = 0;

    }

    array_push($result, array('banner' => $banner, 'product' => $product, 'category_id' => $super_cat_id));
  }
}

if ($account_type == 1) {
  // $QBanner = $conn -> query("SELECT * FROM super_category");
  // while($row_super = mysqli_fetch_assoc($QBanner)){
  $get_cat = $conn->query("SELECT * FROM corporate_control WHERE account_id = '$user_id'");
  $cat = mysqli_fetch_assoc($get_cat)['cat_id'];
  $ca = explode(",", $cat);
  for ($i = 0; $i < count($ca); $i++) {
    $QBanner = $conn->query("SELECT * FROM super_category");
    $row_super = mysqli_fetch_assoc($QBanner);

    $bann = $row_super['banner_number'];
    $super_cat_id = $row_super['id'];

    $get_banner_image = $conn->query("SELECT * FROM media WHERE media_number = '$bann'");
    $file_name = mysqli_fetch_assoc($get_banner_image)['file_name'];
    $banner = $url . $file_name;

    // mysqli_set_charset('utf8');
    $Q = $conn->query("SELECT * FROM items WHERE category_id = '$super_cat_id' ORDER BY id DESC LIMIT 5 ");

    while ($itemData = mysqli_fetch_array($Q)) {

      $name = $itemData['name'];
      $hindi = $itemData['hindi_name'];

      // $hindi = "प्राकृतिक अगरबत्ती";

      $item_slug = $itemData['slug'];
      $item_id = $itemData['id'];
      $subcat_id = $itemData['sub_category_id'];
      $cat_id = $itemData['category_id'];
      $media_number = $itemData['media_number'];
      $item_url = $site_url . "/item/" . $itemData['slug'];

      // $q = $conn -> query("SELECT * FROM ratings WHERE item_id = '$item_id' ORDER BY id DESC ");
      //       $count_row_rating = mysqli_num_rows( $q );

      //       while ($R_D = mysqli_fetch_array( $q )) { 

      //           $ratings = $R_D['rating'];
      //           $pro_rating += (int)$ratings;

      //           $ratings = 0;

      //           }

      $catq = $conn->query("SELECT * FROM super_category WHERE id = '$cat_id'");
      while ($catD = mysqli_fetch_array($catq)) {
        $cat_name = $catD['name'];
      }
      // $subcatq = $conn -> query("SELECT * FROM category WHERE id = '$subcat_id'");
      //         while ($subcatD = mysqli_fetch_array($subcatq)) {
      //           $subcat_name = $subcatD['name'];
      //         }


      $QIMG = $conn->query("SELECT * FROM media WHERE media_number = '$media_number' ");

      while ($img_data = mysqli_fetch_array($QIMG)) {
        $img = $site_url . "/media/" . $img_data['file_name'];
      }

      $attr_q = $conn->query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 ");
      while ($item_Data = mysqli_fetch_array($attr_q)) {

        $off = "Rs. " . ($item_Data['mrp'] - $item_Data['price']) . " Off";
        $mrp = $item_Data['mrp'];
        $price = $item_Data['price'];
        // $p = $price . ".00";
        $attribute_name = $item_Data['name'];
        $attribute_id = $item_Data['id'];
        $stock = $item_Data['stock'];
        if ($stock > 0) {
          $is_stock = 1;
        } else {
          $is_stock = 0;
        }
      }

      // if ($count_row_rating != 0) {
      //             $avg_rating = round($pro_rating / $count_row_rating);
      //           }else{
      //             $avg_rating = 0;
      //           }

      array_push($product, array('response' => 1, 'name' => substr($name, 0, 23) . "...", 'is_stock' => $is_stock, 'hindi_name' => $hindi, 'id' => $item_id, 'cat_name' => $cat_name, 'image' => $img, 'price' => $price, 'attr_id' => $attribute_id, 'category_id' => '1', 'attribute' => $attribute_name));

      // $pro_rating = 0;

    }

    array_push($result, array('banner' => $banner, 'product' => $product, 'category_id' => $super_cat_id));
  }
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);