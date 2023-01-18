<?php

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');
// $cart_items_array = array();
$final_cart_array = array();
$result = array();

$data = json_decode(file_get_contents('php://input'), true);
$account_id = $data['user_id'];

if (isset($account_id)) {

	  $total_cart_value = 0;

		$msg_query = $conn -> query("SELECT DISTINCT(cat_id) FROM cart WHERE account_id = '$account_id' AND checkout = '0'");
		$count_cat = mysqli_num_rows($msg_query);

            while ($msg_q = mysqli_fetch_array($msg_query)) {
				$cart_items_array = array();


            	
            	$cat_id = $msg_q['cat_id'];
            	// $get_cat_name = $conn -> query("SELECT * FROM super_category WHERE id  = '$cat_id'");
            	// $cat_name = mysqli_fetch_assoc($get_cat_name)['name'];

        $get_cart = $conn -> query("SELECT * FROM cart WHERE account_id = '$account_id' AND checkout = '0' AND cat_id ='$cat_id' ");
        	$cat_count = mysqli_num_rows($get_cart);

        while($row_get_cart = mysqli_fetch_assoc($get_cart)){

				

        		// $cart_id = $row_get_cart['id'];
          //   	$item_id = $row_get_cart['item_id'];
          //   	$attribute_id = $row_get_cart['attribute_id'];
          //   	$date_creation = $row_get_cart['date_creation'];
          //   	$quantity = $row_get_cart['quantity'];
            	$total_amount = $row_get_cart['total_amount'];
            	// $mrp_price = $row_get_cart['mrp'];

    //         	$mrp = $conn -> query("SELECT * FROM attributes WHERE id = '$attribute_id'");	
    //         	while ($msg_mrp = mysqli_fetch_array($mrp)) {
				// $it_price = $msg_mrp['price'];
				// $it_name = $msg_mrp['name'];

				// }

    //         	$mq = $conn -> query("SELECT * FROM items WHERE id = '$item_id'");	
    //         	while ($msg_q = mysqli_fetch_array($mq)) {
				// $media_number = $msg_q['media_number'];
    //     		$item_name = $msg_q['name'];
				// }


            	// $media_q = $conn -> query("SELECT * FROM cover_media WHERE media_number = '$media_number'");
             //  	while ($media_D = mysqli_fetch_array($media_q)) {
             //  		$product_img = $site_url."/media/".$media_D['file_name'];
             //  	}

             //  	array_push($cart_items_array, array('id' => $cart_id, 'item_id' => $item_id, 'item_name' => $item_name, 'item_price' => $it_price, 'quantity' => $quantity, 'total_amount' => $total_amount, 'image' => $product_img, 'mrp' => $mrp_price, 'attribute' => $it_name ));

			 $total_cart_value += $total_amount;
             
			}

              	

              	// print_r($cart_items_array);
              	// exit();

        // array_push($final_cart_array, array('id' => $cat_id, 'title' => $cat_name, 'count' => $cat_count, 'product' => $cart_items_array ));
	}

} else { array_push($result, array('response' => 'No Sessions Found' )); }

$coupon_discount = 0;

$get_bundle_cat_no = $conn -> query("SELECT * FROM bundle_cat_no");
$row_bundle_cat_no = mysqli_fetch_assoc($get_bundle_cat_no);
$count_super_cat = $row_bundle_cat_no['bundle_cat_no'];
if($count_cat >= $count_super_cat){
	$hi = 1;
	$bundle_discount = round(5/100*$total_cart_value);
}else{
	$hi=0;
	$bundle_discount = 0;
}

$subs_discount = 5/100*$total_cart_value;
$new_total = round($total_cart_value-$subs_discount);

if($total_cart_value<499){
	$del_charge = 49;
}else{
	$del_charge = 0;
}

$grand_total = $total_cart_value - $bundle_discount - $coupon_discount;
$grand_subs_total = $new_total - $bundle_discount - $coupon_discount;


$total = array('sub_total' => $total_cart_value, 'bundle_discount' => $bundle_discount, 'del_charge' => $del_charge, 'coupon_discount' => $coupon_discount, 'grand_total' => $grand_total, 'grand_subs_total' => $grand_subs_total);

$result = array('total' => $total);

echo json_encode($result);

?>