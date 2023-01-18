<?php include("config.php");
header('Access-Control-Allow-Origin: *');
// $data = json_decode(file_get_contents('php://input'), true);

$order_id = $_POST['order_id'];

// $reason = $_GET['reason'];
// $order_id = $cancelOrderId;
// $by = $_GET['by'];
$by = 'CUSTOMER';
$reason = 'Mistake Order';

$result = array();

     $cQ = $conn -> query("SELECT * FROM bookings WHERE process_id = '$order_id' ORDER BY id DESC "); 
	 while ($rowD = mysqli_fetch_array($cQ)) { 
          $account_id = $rowD['account_id'];  
          $process_id = $rowD['process_id'];
     }

	 $aQ = $conn -> query("SELECT * FROM accounts WHERE id = '$account_id'");
     while ($sD = mysqli_fetch_array($aQ)) { $mobile = $sD['phone']; }

     $U = $conn -> query("UPDATE bookings SET cancelled_by = '$by' WHERE process_id = '$order_id'");
     $U2 = $conn -> query("UPDATE bookings SET cancelled_reason = '$reason' WHERE process_id = '$order_id'");

     $R4 = $conn->query("UPDATE bookings SET order_status = '5' WHERE process_id = '$order_id' ");

    /*When Order is has been shipped and in transit*/
    // _SEND_MESSAGE_NEW($mobile, "Dear Customer, Your Order #".$order_id."has been cancelled. Reason: ".$reason."\nThank You.\nJayshree.in");
    // ********************************************************************************

     $cQOrder = $conn -> query("SELECT * FROM orders WHERE process_id = '$process_id'"); 
           while ($rowDOrders = mysqli_fetch_array($cQOrder)) {
               $cart_id = $rowDOrders['cart_id'];

          $cQCart = $conn -> query("SELECT * FROM cart WHERE id = '$cart_id' && checkout = '1'"); 
               $rowDCart = mysqli_fetch_array($cQCart);
               $attribute_id = $rowDCart['attribute_id'];
               $quantity = $rowDCart['quantity'];

          $cQAttr = $conn -> query("SELECT * FROM attributes WHERE id = '$attribute_id' "); 
               $rowDAttr = mysqli_fetch_array($cQAttr);
               $stock = $rowDAttr['stock'];

               $newstock = $stock + $quantity;

               $R5 = $conn->query("UPDATE attributes SET stock = '$newstock' WHERE id = '$attribute_id' ");

           }

    // *******************************************************************************

    $result = array( 'response' => '1');

    echo json_encode($result);

	// if ($by == "CUSTOMER") { header('Location: cancelled.php?id='.$order_id); } else { header('Location: all-orders.php'); }

    


?>