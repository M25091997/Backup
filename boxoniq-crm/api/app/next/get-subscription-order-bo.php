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

// $data = json_decode(file_get_contents('php://input'), true);

// $accountId = $data['accountId'];
$accountId = $_POST['account_id'];
$final_total = [];
$amt = 0;


$account_id = $accountId;

if (isset($account_id)) {

		$msg_query = $conn -> query("SELECT * FROM subs_booking_history WHERE user_id = '$account_id' && iscancel = 0 ORDER BY id DESC ");	
            while ($msg_q = mysqli_fetch_array($msg_query)) {

              $process_id = $msg_q['process_id'];
              $creation_time = $msg_q['creation_time'];
              $creation_date = $msg_q['date'];
              $order_status = $msg_q['order_status'];
              $amount = $msg_q['total'];
              $booking_id = $msg_q['id'];
              $subsprocess_id = $msg_q['subsprocess_id'];

              $sQ = $conn -> query("SELECT * FROM status_id WHERE id = '$order_status'");
              while ($SData = mysqli_fetch_array($sQ)) {
                $status = $SData['name'];
              }



              $sOrder = $conn -> query("SELECT * FROM subs_order_history WHERE process_id = '$process_id' ");
              // print_r(mysqli_num_rows($sOrder));
              // exit();
              while($row_order = mysqli_fetch_assoc($sOrder)){
                $cart_id = $row_order['sub_cart_id'];

                $sCart = $conn -> query("SELECT * FROM subs_cart_history WHERE id = '$cart_id' && delete_status = 0");
                while($row_cart = mysqli_fetch_assoc($sCart)){
                  $item_id = $row_cart['item_id'];
                  $attr_price = $row_cart['attr_price'];
                  $quantity = $row_cart['item_qty'];
                  $tot = $attr_price * $quantity;
                  // array_push($final_total,$tot);
                  $amt = $amt + $tot;
                }
                
              }

              $sItem = $conn -> query("SELECT * FROM items WHERE id = '$item_id'");
              $media_number = mysqli_fetch_assoc($sItem)['media_number'];

              $media_q = $conn -> query("SELECT * FROM cover_media WHERE media_number = '$media_number'");
              	while ($media_D = mysqli_fetch_array($media_q)) {
              		$img = $site_url."/media/".$media_D['file_name'];
                  // $img = $media_D['file_name'];
              	}

              if ( $order_status == 0 ) { $status = "Processing";  }

              $new_order_id = "BOXONIQ" . substr($process_id, 0, 8);

              array_push($orders_array, array('response' => '1', 'order_id' => $process_id, 'new_order_id' => $new_order_id, 'img' => $img, 'amount' => $amount, 'status' => $status, 'date' => $creation_date));
            }

} else { $orders_array = array('response' => '0'); }

echo json_encode($orders_array);

?>
