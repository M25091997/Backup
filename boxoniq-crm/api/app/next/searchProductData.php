<?php 

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$result = array();

$data = json_decode(file_get_contents('php://input'), true);

$search_key = $data['search_key'];

#Washing Ease Items

$result = array();
$pro_rating = 0;

// $Q_S = $conn -> query("SELECT * FROM home_sliders WHERE id = '3'");
// $SData = $Q_S -> fetch_assoc();
// $x = explode(",", $SData['sliders']);

// foreach ($x as $id_value) {

$Q = $conn -> query("SELECT * FROM items WHERE name LIKE '%$search_key%'");

  while ($itemData = mysqli_fetch_array($Q)) { 

        $name = $itemData['name'];
        $details = $itemData['details'];
        $item_slug = $itemData['slug'];
        $item_id = $itemData['id'];
        $subcat_id = $itemData['sub_category_id'];
        $cat_id = $itemData['category_id'];
        $media_number = $itemData['media_number'];
        $item_url = $site_url."/item/".$itemData['slug'];

        $q = $conn -> query("SELECT * FROM ratings WHERE item_id = '$item_id' ORDER BY id DESC ");
              $count_row_rating = mysqli_num_rows( $q );

              while ($R_D = mysqli_fetch_array( $q )) { 

                  $ratings = $R_D['rating'];
                  $pro_rating += (int)$ratings;

                  $ratings = 0;

                  }

        $catq = $conn -> query("SELECT * FROM super_category WHERE id = '$cat_id'");
                while ($catD = mysqli_fetch_array($catq)) {
                  $cat_name = $catD['name'];
                }
        $subcatq = $conn -> query("SELECT * FROM category WHERE id = '$subcat_id'");
                while ($subcatD = mysqli_fetch_array($subcatq)) {
                  $subcat_name = $subcatD['name'];
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

        if ($count_row_rating != 0) {
                    $avg_rating = round($pro_rating / $count_row_rating);
                  }else{
                    $avg_rating = 0;
                  }

  array_push($result, array( 'name' => $name, 'details' => $details, 'id' => $item_id, 'cat_name' => $cat_name, 'subcat_name' => $subcat_name, 'slug' => $item_slug, 'attributeId' => $attribute_id, 'image' => $img, 'mrp' => $mrp, 'price' => $price, 'discount' => $off, 'attributeName' => $attribute_name, 'ratings' => $avg_rating, 'review' => $count_row_rating ));

  $pro_rating = 0;

} 
// }

echo json_encode($result);

?>