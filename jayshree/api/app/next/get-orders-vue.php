<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');
$orders_array = array();

$data = json_decode(file_get_contents('php://input'), true);

$accountId = $data['accountId'];

$account_id = $accountId;

if (isset($account_id)) {

		$msg_query = $conn -> query("SELECT * FROM bookings WHERE account_id = '$account_id' ORDER BY id DESC ");	
            while ($msg_q = mysqli_fetch_array($msg_query)) {

              $process_id = $msg_q['process_id'];
              $creation_time = $msg_q['creation_time'];
              $creation_date = $msg_q['creation_date'];
              $order_status = $msg_q['order_status'];
              $amount = $msg_q['amount'];
              $booking_id = $msg_q['id'];
              $process_id = $msg_q['process_id'];

              $sQ = $conn -> query("SELECT * FROM status_id WHERE id = '$order_status'");
              while ($SData = mysqli_fetch_array($sQ)) {
                $status = $SData['name'];
              }

              if ( $order_status == 0 ) { $status = "Processing";  }

              array_push($orders_array, array('response' => '1', 'orderId' => $booking_id, 'amount' => $amount, 'status' => $status, 'status_id' => $order_status, 'date' => $creation_date, 'time' => $creation_time, 'processId' => $process_id ));
            }

} else { array_push($orders_array, array('response' => '666' )); }

echo json_encode($orders_array);

?>
