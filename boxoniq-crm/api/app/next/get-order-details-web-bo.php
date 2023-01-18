<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');
$orders_array = array();
$result = array();


$data = json_decode(file_get_contents('php://input'), true);

// $accountId = $data['accountId'];
$process_id = $data['process_id'];
$stotal = 0;


if (isset($process_id)) {

		$msg_query = $conn -> query("SELECT * FROM orders WHERE process_id = '$process_id' ORDER BY id DESC ");	
            while ($msg_q = mysqli_fetch_array($msg_query)) {

              $cart_id = $msg_q['cart_id'];

              $sCart = $conn -> query("SELECT * FROM cart WHERE id = '$cart_id'");
              $row_cart = mysqli_fetch_assoc($sCart);
              $item_id = $row_cart['item_id'];
              $attribute_id = $row_cart['attribute_id'];
              $quantity = $row_cart['quantity'];
              $total_amount = $row_cart['total_amount'];
              $item_price = $total_amount/$quantity;

              $stotal = $stotal + $total_amount;


              $sItem = $conn -> query("SELECT * FROM items WHERE id = '$item_id'");
              $row_item = mysqli_fetch_assoc($sItem);
              $media_number = $row_item['media_number'];
              $item_name = $row_item['name'];


              $media_q = $conn -> query("SELECT * FROM cover_media WHERE media_number = '$media_number'");
              	while ($media_D = mysqli_fetch_array($media_q)) {
              		$img = $site_url."/media/".$media_D['file_name'];
                  // $img = $media_D['file_name'];
              	}

              $stat_ord = "processing";

              array_push($orders_array, array('response' => '1', 'item_id' => $item_id, 'img' => $img, 'item_name' => $item_name, 'item_price' => $item_price, 'quantity' => $quantity, 'amount' => $total_amount, 'status' => $stat_ord));
            }

      $get_total = $conn -> query("SELECT * FROM bookings WHERE process_id = '$process_id' ");
      $row_total = mysqli_fetch_assoc($get_total);
      $order_status = $row_total['order_status'];
      $account_id = $row_total['account_id'];
      $amount = $row_total['amount'];



      if($stotal < 500){
        $delivery = 49;
      }else{
        $delivery = 0;
      }
      $discount = 0;

      $new_total = $stotal + $delivery;


      $is_coupon = $row_total['is_coupon'];
      if($is_coupon == 1){
        $coupon_id = $row_total['coupon_id'];
        $get_coupon = $conn -> query("SELECT * FROM coupon WHERE id = '$coupon_id'");
        $coupon_amount = mysqli_fetch_assoc($get_coupon)['amount'];
        $amt = $amt + $coupon_amount;
      }else{
        $coupon_amount = 0;
      }

  $add_id = $row_total['address_id'];
  $get_add = $conn -> query("SELECT * FROM saved_address WHERE id = '$add_id'");
  $row_add = mysqli_fetch_assoc($get_add);
  $full_add = $row_add['full_address'];
  $landmark = $row_add['landmark'];
  $pincode = $row_add['pincode'];
  $phone = $row_add['phone'];
  $state = $row_add['state'];
  $name = $row_add['user_name'];

  $check_bundle_discount = $conn -> query("SELECT DISTINCT cat_id FROM `cart` WHERE process_id = '$process_id' && checkout = 1 ");
  $count_cat = mysqli_num_rows($check_bundle_discount);

  // $check_cat_count = $conn -> query("SELECT DISTINCT id FROM super_category");
  // $count_super_cat = mysqli_num_rows($check_cat_count);
  $get_bundle_cat_no = $conn -> query("SELECT * FROM bundle_cat_no");
  $row_bundle_cat_no = mysqli_fetch_assoc($get_bundle_cat_no);
  $count_super_cat = $row_bundle_cat_no['bundle_cat_no'];
  if($count_cat >= $count_super_cat){
      $bundal_discount = round((5/100)*$new_total);
  }else{
      $bundal_discount = 0;
  }



  $address = array('address' => $full_add, 'landmark' => $landmark, 'pincode' => $pincode, 'phone' => $phone, 'state' => $state, 'name' => $name);

  $total = array('subtotal' => $stotal, 'discount' => $discount, 'status' => $order_status, 'delivery' => $delivery, 'coupon' => $coupon_amount, 'total' => $amount, 'bundle_discount' => $bundal_discount);

  $get_track = $conn -> query("SELECT * FROM payment_history WHERE process_id = '$process_id' ");
  $row_track = mysqli_fetch_assoc($get_track);
  $picker_transaction_id = $row_track['picker_transaction_id'];
            
  $result = array('items' => $orders_array, 'total' => $total, 'address' => $address, 'track_id' => $picker_transaction_id);

} else { $result = array('response' => '0'); }



echo json_encode($result);

?>
