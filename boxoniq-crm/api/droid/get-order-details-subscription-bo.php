<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('../../config.php');
$subs_order_array = array();

$result = array();
$total = 0;


// $data = json_decode(file_get_contents('php://input'), true);

// $accountId = $data['accountId'];
$process_id = $_POST['process_id'];
$total_amt = 0;

if (isset($process_id)) {

  // for subs month
  $bk_query = $conn->query("SELECT * FROM subs_booking WHERE process_id = '$process_id' && iscancel = 0 ORDER BY id DESC ");
  $bk_q = mysqli_fetch_array($bk_query);
  // count bookings
  $bk_count = mysqli_num_rows($bk_query);
  $sub_mnt = '1';
  $odr_st = $bk_q['order_status'];
  $account_id = $bk_q['user_id'];

  $del = "2";
  $sub_del_dt = "24/05/2022";
  // $desc = "Your next box is ready to ship on " . $sub_del_dt . ". Please maintain sufficiant balance in your wallet for your upcoming shipment";
  $desc = "Your bundle is updated for next month. Please maintain sufficiant balance in your wallet for your upcoming shipment.";

  $subprocess_id = $bk_q['subsprocess_id'];

  $add_id = $bk_q['address_id'];
  $get_add = $conn -> query("SELECT * FROM saved_address WHERE id = '$add_id'");
  $row_add = mysqli_fetch_assoc($get_add);
  $full_add = $row_add['full_address'];
  $landmark = $row_add['landmark'];
  $pincode = $row_add['pincode'];
  $phone = $row_add['phone'];
  $state = $row_add['state'];

  $user_name = $row_add['user_name'];

  $address = array('address' => $full_add, 'landmark' => $landmark, 'pincode' => $pincode, 'phone' => $phone, 'state' => $state, 'name' => $user_name);

  if ($bk_count > 0) {
    $msg_query1 = $conn->query("SELECT DISTINCT(cat_id) AS dcat_id FROM subs_order WHERE process_id = '$process_id' AND status != 1 ORDER BY id DESC ");
    while($get_dis_cat = mysqli_fetch_assoc($msg_query1)){
    $cat_id = $get_dis_cat['dcat_id'];

    $count_outer = mysqli_num_rows($msg_query1);

            	$get_cat_name = $conn -> query("SELECT * FROM super_category WHERE id  = '$cat_id'");
            	$cat_name = mysqli_fetch_assoc($get_cat_name)['name'];
    $count_sub_cat = mysqli_num_rows($msg_query1);    
    // select
    $msg_query = $conn->query("SELECT * FROM subs_order WHERE process_id = '$process_id' AND status != 1 AND cat_id = '$cat_id' ORDER BY id DESC ");
    $count_inner = mysqli_num_rows($msg_query);
    $orders_array = array();

    // $odC = mysqli_num_rows($msg_query);
    // if ($odC > 0) {
    while ($msg_q = mysqli_fetch_array($msg_query)) {


      $cart_id = $msg_q['sub_cart_id'];

      // select cart data where cart id = cart_id
      $sCart = $conn->query("SELECT * FROM subs_cart WHERE id = '$cart_id' AND delete_status != 1");
      $row_cart = mysqli_fetch_assoc($sCart);
      $item_id = $row_cart['item_id'];
      $quantity = $row_cart['item_qty'];
      $atrid = $row_cart['attr_id'];
      $atr_price = $row_cart['attr_price'];

      $to = $atr_price * $quantity;

      $total_amt=$total_amt + $to;

      


      // attribute
      $aCart = $conn->query("SELECT * FROM attributes WHERE id = '$atrid'");
      $arow = mysqli_fetch_array($aCart);
      $atramt = $arow['price'];
      $item_attr = $arow['name'];


      $up_amt = $quantity * $atramt;


      // item attr
      $dItem = $conn->query("SELECT * FROM attributes WHERE item_id = '$item_id'");
      // $dcount = mysqli_num_rows($dItem);
      // if ($dcount > 0) {

      $attribute = array();

      while ($dmsg_q = mysqli_fetch_array($dItem)) {
        $attr_id = $dmsg_q['id'];
        $attr_name = $dmsg_q['name'];
        $attr_price = $dmsg_q['price'];
        $attr_mrp = $dmsg_q['mrp'];
        $attr_discount = $dmsg_q['discount'];
        $fp = (int)$quantity * (int)$attr_price;
        $total += $fp;
        array_push($attribute, array('attr_id' => $attr_id, 'attr_name' => $attr_name, 'attr_mrp' => $attr_mrp, 'attr_discount' => $attr_discount));
      }
      // }


      // select itmes where item_id
      $sItem = $conn->query("SELECT * FROM items WHERE id = '$item_id'");
      $row_item = mysqli_fetch_assoc($sItem);
      $media_number = $row_item['media_number'];
      $item_name = $row_item['name'];
      $super_category_id = $row_item['category_id'];

      $get_super_cat = $conn -> query("SELECT * FROM super_category WHERE id = '$super_category_id'");
      $row_su_cat = mysqli_fetch_assoc($get_super_cat);
      $super_cat_name = $row_su_cat['name'];




      $media_q = $conn->query("SELECT * FROM cover_media WHERE media_number = '$media_number'");
      while ($media_D = mysqli_fetch_array($media_q)) {
        $img = $site_url . "/media/" . $media_D['file_name'];
        // $img = $media_D['file_name'];
      }

      array_push($orders_array, array('response' => '1','cat_id' => $cat_id, 'item_id' => $item_id, 'super_cat_name' => $super_cat_name, 'attr_id' => $attr_id, 'item_attr' => $item_attr, 'attr_price' => $atr_price, 'img' => $img, 'item_name' => $item_name, 'quantity' => $quantity, 'amount' => $up_amt, 'cart_id' => $cart_id, 'attribute' => $attribute));
    }
    array_push($subs_order_array, array('title' => $super_cat_name, 'items' => $orders_array));
  }
    $curr_date = date('Y-m-d');
    $get_total = $conn->query("SELECT * FROM subs_booking_history WHERE process_id = '$process_id' && date = '$curr_date' ");
    $row_total = mysqli_fetch_assoc($get_total);
    $amt = (int)$row_total['total'];

    $isskip = $row_total['isskip'];
    $iscancel = (int)$row_total['iscancel'];

    if ($isskip == true) {
      $status = "Skipped";
    }  else {
      $status = "Processing";
    }

    $check_bundle_discount = $conn -> query("SELECT DISTINCT cat_id FROM subs_cart WHERE account_id = '$account_id' AND delete_status != 1");
        $count_cat = mysqli_num_rows($check_bundle_discount);

        // $check_cat_count = $conn -> query("SELECT DISTINCT id FROM super_category");
        // $count_super_cat = mysqli_num_rows($check_cat_count);
        $get_bundle_cat_no = $conn -> query("SELECT * FROM bundle_cat_no");
        $row_bundle_cat_no = mysqli_fetch_assoc($get_bundle_cat_no);
        $count_super_cat = $row_bundle_cat_no['bundle_cat_no'];
        if($count_cat >= $count_super_cat){
            $bundal_discount = round((5/100)*$total_amt);
        }else{
            $bundal_discount = 0;
        }
    
    // $discount = 0;
    // $new_total = $amt - $discount;
    $total = $total_amt - $bundal_discount;
    $final_total = $total - round((5/100*$total));

    $total = array('subtotal' => $total_amt, 'bundle_discount' => $bundal_discount, 'total' => $total, 'final_total' => $final_total, 'count_outer' => $count_outer, 'count_inner' => $count_inner);

    $result = array('order' => $subs_order_array, 'count' => $count_sub_cat,'address' => $address, 'total' => $total, 'subs_month' => $sub_mnt, 'delivered' => $del, 'nextdate' => $desc, 'status' => $status,'cancel' => $iscancel);
    // } else {
    //   $result = array('response' => 'No Data found!');
    // }
  }
} else {
  $result = array('response' => '0');
}



echo json_encode($result);
