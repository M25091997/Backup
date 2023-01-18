<?php 
header('Access-Control-Allow-Origin: *');
include ("config.php"); 

#Health & Beauty

$url = $site_url.'/images/slider/';

$result = array();
$product = array();

$QSuper = $conn -> query("SELECT * FROM super_category ORDER BY id ASC LIMIT 3 ");

  while ($superData = mysqli_fetch_array($QSuper)) { 
    $super_cat_id = $superData['id'];
    $banner = $url.$superData['banner'];


$Q = $conn -> query("SELECT * FROM items WHERE category_id = $super_cat_id ORDER BY id DESC LIMIT 20 ");

  while ($itemData = mysqli_fetch_array($Q)) { 

        $name = $itemData['name'];
        $item_id = $itemData['id'];
        $item_slug = $itemData['slug'];
        $subcat_id = $itemData['sub_category_id'];
        $cat_id = $itemData['category_id'];
        $media_number = $itemData['media_number'];
        $item_url = $site_url."/item/".$itemData['slug'];


        $catq = $conn -> query("SELECT * FROM super_category WHERE id = '$cat_id'");
                while ($catD = mysqli_fetch_array($catq)) {
                  $cat_name = $catD['name'];
                }
        

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
        }

        

  array_push($product, array( 'name' => substr($name, 0, 23)."...", 'id' => $item_id, 'slug' => $item_slug, 'cat_name' => $cat_name, 'attributeId' => $attribute_id, 'image' => $img, 'mrp' => $mrp, 'price' => $price, 'discount' => $off, 'attribute-name' => $attribute_name ));

} 

 array_push($result, array('banner' => $banner,'product' => $product)); 

}

// $result['product'] = $product;

echo json_encode($result);

?>