<?php 
header('Access-Control-Allow-Origin: *');
include ("config.php"); 

#Washing Ease Items

$result = array();
$product = array();
$url = $site_url."/images/slider/";
$search = $_POST['search'];
$user_id = $_POST['user_id'];

$get_account_type = $conn -> query("SELECT * FROM accounts WHERE id = '$user_id'");
$account_type = mysqli_fetch_assoc($get_account_type)['account_type'];


// $pro_rating = 0;

// $QBanner = $conn -> query("SELECT * FROM super_category WHERE id = '1'");
// $bannerData = mysqli_fetch_array($QBanner);
// $banner = $url.$bannerData['banner'];

$banner = "";
// mysqli_set_charset('utf8');

if($account_type == 0){
  if($search == 'all'){
    $Q = $conn -> query("SELECT * FROM items WHERE corporate_id = 0 LIMIT 30  ");
  }else{
    $Q = $conn -> query("SELECT * FROM items WHERE name LIKE '%$search%' && corporate_id = 0 LIMIT 20 ");
  }
}
else{
  // print_r($search);
  // exit();
  
  if($search == 'all'){
    $Q = $conn -> query("SELECT * FROM items WHERE corporate_id != 0 LIMIT 20 ");
  }else{
    $Q = $conn -> query("SELECT * FROM items WHERE name LIKE '%$search%' && corporate_id != 0 LIMIT 20 ");
  }
}

// print_r(mysqli_num_rows($Q));
// exit();




  while ($itemData = mysqli_fetch_array($Q)) { 

        $name = $itemData['name'];
        // $hindi = $itemData['hindi_name'];
        $hindi = "";
        // $hindi = "प्राकृतिक अगरबत्ती";

        $item_slug = $itemData['slug'];
        $item_id = $itemData['id'];
        $subcat_id = $itemData['sub_category_id'];
        $cat_id = $itemData['category_id'];
        $media_number = $itemData['media_number'];
        $item_url = $site_url."/item/".$itemData['slug'];

        // $q = $conn -> query("SELECT * FROM ratings WHERE item_id = '$item_id' ORDER BY id DESC ");
        //       $count_row_rating = mysqli_num_rows( $q );

        //       while ($R_D = mysqli_fetch_array( $q )) { 

        //           $ratings = $R_D['rating'];
        //           $pro_rating += (int)$ratings;

        //           $ratings = 0;

        //           }

        $catq = $conn -> query("SELECT * FROM super_category WHERE id = '$cat_id'");
                while ($catD = mysqli_fetch_array($catq)) {
                  $cat_name = $catD['name'];
                }
        // $subcatq = $conn -> query("SELECT * FROM category WHERE id = '$subcat_id'");
        //         while ($subcatD = mysqli_fetch_array($subcatq)) {
        //           $subcat_name = $subcatD['name'];
        //         }


        $QIMG = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number' ");

                            while ($img_data = mysqli_fetch_array($QIMG)) {
                                $img = $site_url."/media/".$img_data['file_name'];
                }

      $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 "); 
        while ($item_Data = mysqli_fetch_array($attr_q)) { 

                              $off = "Rs. ".( $item_Data['mrp'] - $item_Data['price'] ). " Off";
                              $mrp = $item_Data['mrp'];
                              $price = $item_Data['price'];
                              $attribute_name = $item_Data['name'];
                              $attribute_id = $item_Data['id'];
                              $stock = $item_Data['stock'];
                              if($stock>0){
                                $is_stock = 1;
                              }else{
                                $is_stock = 0;
                              }
        }

        // if ($count_row_rating != 0) {
        //             $avg_rating = round($pro_rating / $count_row_rating);
        //           }else{
        //             $avg_rating = 0;
        //           }

  array_push($product, array( 'response' => 1, 'is_stock' => $is_stock, 'name' => substr($name, 0, 23), 'hindi' => substr($hindi, 0, 23)."...", 'id' => $item_id, 'cat_name' => $cat_name, 'image' => $img, 'price' => $price, 'attr_id' => $attribute_id, 'category_id' => '1'));

  // $pro_rating = 0;

} 

$result = array('banner' => $banner, 'product' => $product, 'category_id' => '1');

echo json_encode($result, JSON_UNESCAPED_UNICODE);

?>