<?php
header('Access-Control-Allow-Origin: *');
include('../../config.php');
$url = $site_url . "/img/supercat/";

#Washing Ease Items

$result = array();
$cat = array();
$product = array();

$query = $_POST['query'];

if ($query) {
    // show filtered data
    $Q = $conn->query("SELECT * FROM items WHERE name LIKE '%$query%' ORDER BY id DESC");

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
            $discount = $item_Data['discount'];
            $dis_per = round(($discount/$mrp)*100);

            $attr_name = $item_Data['name'];
            $attribute_id = $item_Data['id'];
            array_push($attributes, array('id' => $attribute_id, 'name' => $attr_name, 'price' => $price, 'mrp' => $mrp, 'discount' => $dis_per));
        }

        array_push($product, array('image' => $img, 'id' => $item_id, 'title' => substr($name, 0, 23) . "...", 'desc' => $pro_desc, 'attribute' => $attributes));
    }
} else {
    // show all data
    $Q = $conn->query("SELECT * FROM items ORDER BY id DESC LIMIT 10");

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
            $attr_name = $item_Data['name'];
            $attribute_id = $item_Data['id'];
            $discount = $item_Data['discount'];
            $dis_per = round(($discount/$mrp)*100);
            array_push($attributes, array('id' => $attribute_id, 'name' => $attr_name, 'price' => $price, 'mrp' => $mrp,'discount' => $dis_per));
        }

        // if ($count_row_rating != 0) {
        //             $avg_rating = round($pro_rating / $count_row_rating);
        //           }else{
        //             $avg_rating = 0;
        //           }

        array_push($product, array('image' => $img, 'id' => $item_id, 'title' => substr($name, 0, 23) . "...", 'desc' => $pro_desc, 'attribute' => $attributes));
    }
}
$result['product'] = $product;

echo json_encode($result);
