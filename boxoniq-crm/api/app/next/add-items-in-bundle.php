<?php

// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include("config.php");

$account_id = $_POST['account_id'];

$result = array();
// $url = $site_url."/img/bundle/";
        $msg_query = $conn -> query("SELECT * FROM bundle_creator ORDER BY id ASC");  
            while ($msg_q = mysqli_fetch_array($msg_query)) {

                $id = $msg_q['id'];
                $name = $msg_q['item_ids'];
                $arr = explode(",", $name);

                // $result = array('len' => count($arr));
                
                // array_push($result, array('id' => $id, 'name' => $name, 'arr' => $arr));
            }
            // print_r(count($arr));

            for($i =0;$i<count($arr);$i++){
                $get_item = $conn -> query("SELECT * FROM items WHERE id = '$arr[$i]'");
                $row_item = mysqli_fetch_assoc($get_item);
                $category_id = $row_item['category_id'];
                $item_id = $row_item['id'];


                $get_attr = $conn -> query("SELECT * FROM attributes WHERE item_id = '$arr[$i]' ORDER BY ID ASC LIMIT 1");
                $row_attr = mysqli_fetch_assoc($get_attr);
                $attr_id = $row_attr['id'];
                $price = $row_attr['price'];
                $mrp = $row_attr['mrp'];
                $qty = 1;
                $created_on = date('Y-m-d');

                $add_item_cart = $conn -> query("INSERT INTO cart (item_id, attribute_id, account_id, date_creation, quantity, total_amount, mrp, cat_id) 
                VALUES ('$item_id', '$attr_id', '$account_id', '$created_on', '$qty', '$price', '$mrp', '$category_id')");

                if($add_item_cart){
                    $result = array('response' => 1);
                }
            }


echo json_encode($result);

?>