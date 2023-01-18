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
$process_id = $_POST['process_id'];



if (isset($process_id)) {

		$msg_query = $conn -> query("SELECT * FROM orders WHERE process_id = '$process_id' ORDER BY id DESC ");	
            while ($msg_q = mysqli_fetch_array($msg_query)) {

              $cart_id = $msg_q['cart_id'];

              $sCart = $conn -> query("SELECT * FROM cart WHERE id = '$cart_id'");
              $item_id = mysqli_fetch_assoc($sCart)['item_id'];

              $sItem = $conn -> query("SELECT * FROM items WHERE id = '$item_id'");
              $media_number = mysqli_fetch_assoc($sItem)['media_number'];

              $media_q = $conn -> query("SELECT * FROM cover_media WHERE media_number = '$media_number'");
              	while ($media_D = mysqli_fetch_array($media_q)) {
              		$img = $site_url."/media/".$media_D['file_name'];
                  // $img = $media_D['file_name'];
              	}

              if ( $order_status == 0 ) { $status = "Processing";  }

              array_push($orders_array, array('response' => '1', 'order_id' => $process_id, 'img' => $img, 'amount' => $amount, 'status' => $status, 'date' => $creation_date));
            }

} else { $orders_array = array('response' => '0'); }

echo json_encode($orders_array);

?>
