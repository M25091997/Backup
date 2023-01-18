<?php
session_start();
include('../../config.php');

$result = [];
$price = [];

if (isset($_POST['account-id'])) {
    $account_id = $_POST['account-id'];
    $sql = "SELECT * FROM cart WHERE account_id = '$account_id' && checkout = 0 ";
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $item_id = $row['item_id'];
            $item_qty = $row['quantity'];
            $item_sql = "SELECT * FROM items WHERE id = '$item_id'";
            $item_query = mysqli_query($conn, $item_sql);
            $item_count = mysqli_num_rows($item_query);
            if ($item_count > 0) {
                while ($item_row = mysqli_fetch_assoc($item_query)) {
                    // attribute id
                    $item_attr = $row['attribute_id'];
                    $item_attr_sql = "SELECT * FROM attributes WHERE id = '$item_attr'";
                    $item_attr_query = mysqli_query($conn, $item_attr_sql);
                    while ($item_attr_row = mysqli_fetch_assoc($item_attr_query)) {

                        $item_attr_price = $item_attr_row['price'];
                        $total = $item_qty * $item_attr_price;
                        array_push($price, $total);
                    }
                }
            }
        }
    } else {
        array_push($result,  array('response' => 'No data found!'));
    }
} else {
    array_push($result,  array('response' => 'Please send Account id Found'));
}

if ($price != '') {
    echo json_encode(array('total_amount' => array_sum($price)));
} else {
    echo json_encode($result);
}
