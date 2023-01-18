<?php
session_start();
include('../inc/app.php');
$cart_items_array = array();
$final_cart_array = array();
$account_id = $_SESSION['account-id'];

if (isset($_SESSION['account-id'])) {

	$total_cart_value = 0;

		$msg_query = $conn -> query("SELECT * FROM cart WHERE account_id = '$account_id' AND checkout = '0'");	
            while ($msg_q = mysqli_fetch_array($msg_query)) {

            	$cart_id = $msg_q['id'];
            	$item_id = $msg_q['item_id'];
            	$attribute_id = $msg_q['attribute_id'];
            	$date_creation = $msg_q['date_creation'];
            	$quantity = $msg_q['quantity'];
            	$total_amount = $msg_q['total_amount'];


            	$mq = $conn -> query("SELECT * FROM items WHERE id = '$item_id'");	
            	while ($msg_q = mysqli_fetch_array($mq)) {
				$media_number = $msg_q['media_number'];
        $item_name = $msg_q['name'];
				}

				$aq = $conn -> query("SELECT * FROM attributes WHERE id = '$attribute_id'");	
            	while ($msg_q = mysqli_fetch_array($aq)) {
				$attribute_name = $msg_q['name'];
				}


            	$media_q = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number'");
              	while ($media_D = mysqli_fetch_array($media_q)) {

              		$product_img = $site_url."/media/".$media_D['file_name'];

              	}


              	array_push($cart_items_array, array('id' => $cart_id, 'item_id' => $item_id, 'item_name' => $item_name, 'attribute_name' => $attribute_name, 'quantity' => $quantity, 'total_amount' => $total_amount, 'image' => $product_img ));

              	$total_cart_value += $total_amount;

            }

array_push($final_cart_array, array('final_cart_amount' => $total_cart_value, 'cart_items' => $cart_items_array));

} else { array_push($result, array('response' => 'No Sessions Found' )); }

echo json_encode($final_cart_array);

$_SESSION['total_cart_value'] = $total_cart_value;

?>