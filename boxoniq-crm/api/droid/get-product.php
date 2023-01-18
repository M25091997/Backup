<?php
session_start();
include('../../config.php');

$result = [];
$product = [];

if (isset($_POST['account-id'])) {
    $account_id = $_POST['account-id'];
    $sql = "SELECT * FROM cart WHERE account_id = '$account_id'";
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $item_id = $row['item_id'];
            $cart_id = $row['id'];
            $item_qty = $row['quantity'];
            $item_sql = "SELECT * FROM items WHERE id = '$item_id'";
            $item_query = mysqli_query($conn, $item_sql);
            $item_count = mysqli_num_rows($item_query);
            if ($item_count > 0) {
                while ($item_row = mysqli_fetch_assoc($item_query)) {
                    $super_id = $item_row['category_id'];
                    $item_media_no = $item_row['media_number'];
                    $item_name = $item_row['name'];
                    $item_detail = $item_row['details'];
                    // item image query
                    $media_sql =  "SELECT * FROM media WHERE media_number = '$item_media_no'";
                    $media_query = mysqli_query($conn, $media_sql);
                    $media_row = mysqli_fetch_assoc($media_query);
                    $file_name = $media_row['file_name'];
                    $img_path = $site_url . "/media/" . $file_name;
                    // attribute id
                    $item_attr = $row['attribute_id'];
                    $item_attr_sql = "SELECT * FROM attributes WHERE id = '$item_attr'";
                    $item_attr_query = mysqli_query($conn, $item_attr_sql);
                    $item_attr_row = mysqli_fetch_assoc($item_attr_query);
                    $item_attr_name = $item_attr_row['name'];
                    $item_attr_price = $item_attr_row['price'];
                    $item_attr_array = ["name" => $item_attr_name];
                    $total = $item_qty * $item_attr_price;
                    // item category query
                    $category_sql =  "SELECT * FROM super_category WHERE id = '$super_id'";
                    $category_query = mysqli_query($conn, $category_sql);
                    $category_row = mysqli_fetch_assoc($category_query);
                    $category_name = $category_row['name'];
                }
                array_push($product, array('id' => $item_id, 'cart-id' => $cart_id, 'img' => $img_path, 'title' => $item_name, 'desc' => $item_detail, 'qty' => $item_qty, 'attribute' => $item_attr_array, 'price' => $item_attr_price, 'total' => $total));
            }
            array_push($result,  array('title' => $category_name, 'product' => $product));
        }
        // array_push($result,  array('title' => $category_name, 'product' => $product));
    } else {
        array_push($result);
    }
} else {
    array_push($result,  array('response' => 'Please send Account id Found'));
}

echo json_encode($result);
