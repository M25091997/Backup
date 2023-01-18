<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');
$orders_array = array();
$result = array();

$final_total = 0;


// $data = json_decode(file_get_contents('php://input'), true);

// $accountId = $data['accountId'];
$process_id = $_POST['process_id'];



if (isset($process_id)) {
  // print_r($process_id);
  // exit();

		$msg_query = $conn -> query("SELECT * FROM subs_order_history WHERE process_id = '$process_id' ORDER BY id DESC ");	
            while ($msg_q = mysqli_fetch_array($msg_query)) {

              $cart_id = $msg_q['sub_cart_id'];
              // $address_id = $msg_q['address_id'];

              // print_r($cart_id);
              // exit();

              $sCart = $conn -> query("SELECT * FROM subs_cart_history WHERE id = '$cart_id'");
              $row_cart = mysqli_fetch_assoc($sCart);
              $item_id = $row_cart['item_id'];
              $quantity = $row_cart['item_qty'];
              $item_price = $row_cart['attr_price'];
              $total_amount = $quantity * $item_price;

              $final_total = $final_total + $total_amount;




              $sItem = $conn -> query("SELECT * FROM items WHERE id = '$item_id'");
              $row_item = mysqli_fetch_assoc($sItem);
              $media_number = $row_item['media_number'];
              $item_name = $row_item['name'];


              $media_q = $conn -> query("SELECT * FROM cover_media WHERE media_number = '$media_number'");
              	while ($media_D = mysqli_fetch_array($media_q)) {
              		$img = $site_url."/media/".$media_D['file_name'];
                  // $img = $media_D['file_name'];
              	}

              if ( $order_status == 0 ) { $status = "Processing";  }

              array_push($orders_array, array('response' => '1', 'item_id' => $item_id, 'img' => $img, 'item_name' => $item_name, 'item_price' => $item_price, 'quantity' => $quantity, 'amount' => $total_amount, 'status' => $status));
            }

         


      $get_total = $conn -> query("SELECT * FROM subs_booking_history WHERE process_id = '$process_id' ");
      $row_total = mysqli_fetch_assoc($get_total);
      $account_id = $row_total['user_id'];
      $track_id = $row_total['picker_transaction_id'];
      $order_status= $row_total['order_status'];



      $check_bundle_discount = $conn -> query("SELECT DISTINCT cat_id FROM subs_cart_history WHERE account_id = '$account_id' AND delete_status != 1");
        $count_cat = mysqli_num_rows($check_bundle_discount);

        // $check_cat_count = $conn -> query("SELECT DISTINCT id FROM super_category");
        // $count_super_cat = mysqli_num_rows($check_cat_count);
        $get_bundle_cat_no = $conn -> query("SELECT * FROM bundle_cat_no");
        $row_bundle_cat_no = mysqli_fetch_assoc($get_bundle_cat_no);
        $count_super_cat = $row_bundle_cat_no['bundle_cat_no'];
        if($count_cat >= $count_super_cat){
            $bundal_discount = (5/100)*$final_total;
        }else{
            $bundal_discount = 0;
        }

        $amt = $final_total;
        $discount = 0;
        $new_total = $amt - $bundal_discount;
    
    // $discount = 0;
    // $new_total = $amt - $discount;
    $total = $total_amt - $bundal_discount;

    $subs_discount = round((5/100)*$new_total);

    $final_total = $new_total - $subs_discount;



      $total = array('subtotal' => $amt, 'bundle_discount' => $bundal_discount, 'subs_discount' => $subs_discount, 'total' => $final_total, 'status' => $order_status);

      $add_id = $row_total['address_id'];
      $get_add = $conn -> query("SELECT * FROM saved_address WHERE id = '$add_id'");
      $row_add = mysqli_fetch_assoc($get_add);
      $full_add = $row_add['full_address'];
      $landmark = $row_add['landmark'];
      $pincode = $row_add['pincode'];
      $state = $row_add['state'];
      $phone = $row_add['phone'];
      $name = $row_add['user_name'];

    
      $address = array('address' => $full_add, 'landmark' => $landmark, 'pincode' => $pincode, 'state' => $state, 'phone' => $phone, 'name' => $name);


      $result = array('items' => $orders_array, 'total' => $total, 'address' => $address, 'track_id' => $track_id);

} else { $result = array('response' => '0'); }



echo json_encode($result);
