<?php include("../../config.php");

$reason = $_GET['reason'];
$order_id = $_GET['order-id'];
$by = $_GET['by'];

     $cQ = $conn -> query("SELECT * FROM bookings WHERE id = '$order_id' ORDER BY id DESC "); 
	 while ($rowD = mysqli_fetch_array($cQ)) { 
          $account_id = $rowD['account_id'];
          $process_id = $rowD['process_id'];   

     }

	 $aQ = $conn -> query("SELECT * FROM accounts WHERE id = '$account_id'");
     while ($sD = mysqli_fetch_array($aQ)) { $mobile = $sD['phone']; }

     $U = $conn -> query("UPDATE bookings SET cancelled_by = '$by' WHERE id = '$order_id'");
     $U2 = $conn -> query("UPDATE bookings SET cancelled_reason = '$reason' WHERE id = '$order_id'");

     $R4 = $conn->query("UPDATE bookings SET order_status = '5' WHERE id = '$order_id' ");

    /*When Order has been cancelled*/
    // _SEND_MESSAGE($mobile, "Dear Customer, Your Order #".$order_id."has been cancelled. Reason: ".$reason."\nThank You.\nCityindia.in");

    /*When Order has been cancelled to ADMINS*/
    // _SEND_MESSAGE('9801840531', "Dear Customer, Your Order #".$order_id."has been cancelled. Reason: ".$reason."\nThank You.\nCityindia.in");

    // _SEND_MESSAGE('7903959562', "Dear Customer, Your Order #".$order_id."has been cancelled. Reason: ".$reason."\nThank You.\nCityindia.in");

    // *********************************************************************************

    $cQOrder = $conn -> query("SELECT * FROM orders WHERE process_id = '$process_id' ORDER BY id DESC "); 
           while ($rowDOrders = mysqli_fetch_array($cQOrder)) {
               $cart_id = $rowDOrders['cart_id'];

          $cQCart = $conn -> query("SELECT * FROM cart WHERE id = '$cart_id' && checkout = '1' ORDER BY id DESC "); 
               $rowDCart = mysqli_fetch_array($cQCart);
               $attribute_id = $rowDCart['attribute_id'];
               $quantity = $rowDCart['quantity'];

          $cQAttr = $conn -> query("SELECT * FROM attributes WHERE id = '$attribute_id' "); 
               $rowDAttr = mysqli_fetch_array($cQAttr);
               $stock = $rowDAttr['stock'];

               $newstock = $stock + $quantity;

               $R5 = $conn->query("UPDATE attributes SET stock = '$newstock' WHERE id = '$attribute_id' ");

           }

          
    // ***************************************************************************


	if ($by == "CUSTOMER") { header('Location: '.$site_url.'/account/my-orders.php'); } else { header('Location: all-orders.php'); }

    


?>