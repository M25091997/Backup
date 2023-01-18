<?php session_start(); ?>
<?php include("../../config.php"); ?>
<?php  

    $order_id = $_POST['order_id'];
    $status_id = $_POST['status_id'];

    // $glabel = $_POST['glabel'];
    // $gamount = $_POST['gamount'];


	 $aQ = $conn -> query("SELECT * FROM accounts WHERE id = '$account_id'");
     while ($sD = mysqli_fetch_array($aQ)) { $mobile = $sD['phone']; }

    

    /*When Order is being processed and packed*/
    // if ($status_id == '2') { _SEND_MESSAGE_NEW($mobile, "Dear Customer, Your order id #".$order_id." has been processed. You will receive your goods within 2 Hours - CityIndia.in", "1207162169220135742"); }

    /*When Order is has been shipped and in transit*/
    // if ($status_id == '3') { _SEND_MESSAGE_NEW($mobile, "Dear Customer, Your order id #".$order_id." is out for delivery. You will receive your order shortly - CityIndia.in", "1207162169227727803"); }



    $R4 = $conn->query("UPDATE bookings SET order_status = '$status_id' WHERE id = '$order_id' ");

    
    // if($gamount>0) {
    // $R6 = $conn->query("UPDATE bookings SET gift_amount = '$gamount', gift_label = '$glabel' WHERE id = '$order_id' ");
    // }
    

    if ($R4) {	header('Location: all-orders.php'); }

 ?>