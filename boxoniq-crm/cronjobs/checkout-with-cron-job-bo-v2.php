<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('../config.php');

// $data = json_decode(file_get_contents('php://input'), true);
$current_date = date('Y-m-d');
$process_id = rand() . time();


// print_r('alsflasdjflajs');
// exit();

// $get_all_active_bookings = $conn -> query("SELECT * FROM subs_booking_history WHERE isskip = 0 && iscancel = 0 && checkout_status = 0");
$get_all_active_bookings = $conn -> query("SELECT * FROM subs_booking WHERE isskip = 0 && iscancel = 0 && checkout_status = 0");


while($row_active_bookings = mysqli_fetch_assoc($get_all_active_bookings)){
    // $process_id = $row_active_bookings['process_id'];
// $update_all_active_bookings = $conn -> query("UPDATE subs_booking_history SET checkout_status = 1");

    $subsprocess_id = $row_active_bookings['subsprocess_id'];
    $pros_id = $row_active_bookings['process_id'];

    $user_id = $row_active_bookings['user_id'];
    $total_items = $row_active_bookings['total_items'];
    $subs = $row_active_bookings['subs'];
    $subs_status = $row_active_bookings['subs_status'];
    $address_id = $row_active_bookings['address_id'];
    $total = $row_active_bookings['total'];

    $book_date = $row_active_bookings['date'];

    $date_diff = $current_date - $book_date;
    $diff = abs(strtotime($current_date) - strtotime($book_date));
    
    $no_of_days = $diff/86400;
    // print_r($no_of_days);
    // exit();

    // if($no_of_days == 26){
        if(true){
    
        // include('picker_api_link.php');

            $picker_transaction_id = "test_pickeer_id";

    if($picker_transaction_id != ""){
        $add_subs_booking = $conn -> query("INSERT INTO `subs_booking_history`(`user_id`, `process_id`, `subsprocess_id`, `total`, `date`, `total_items`, `subs`, `subs_status`, `address_id`, `picker_transaction_id`) 
    VALUES ('$user_id', '$process_id', '$subsprocess_id', '$total', '$current_date', '$total_items' , '$subs', '$subs_status', '$address_id', '$picker_transaction_id')");

    }
    

    
    
    // print_r($add_subs_booking);
    // exit();

    if($add_subs_booking){
        // $get_active_orders = $conn ->query("SELECT * FROM subs_order_history WHERE process_id = '$pros_id' && status = 0 && checkout_status = 0 ");
        $get_active_orders = $conn ->query("SELECT * FROM subs_order WHERE process_id = '$pros_id' && status = 0 && checkout_status = 0 ");

        while($row_active_orders = mysqli_fetch_assoc($get_active_orders)){

            // echo "executed!";

        // $update_all_active_orders = $conn -> query("UPDATE subs_order_history SET checkout_status = 1");

            // $process_id = $row_active_orders['process_id'];
            $subprocess_id = $row_active_orders['subprocess_id'];
            $sub_cart_id = $row_active_orders['sub_cart_id'];

            // $get_active_cart = $conn -> query("SELECT * FROM subs_cart_history WHERE id = '$sub_cart_id' && delete_status = 0 ");
            $get_active_cart = $conn -> query("SELECT * FROM subs_cart WHERE id = '$sub_cart_id' && delete_status = 0 ");

            $row_active_cart = mysqli_fetch_assoc($get_active_cart);
            $item_id = $row_active_cart['item_id'];
            $attr_id = $row_active_cart['attr_id'];
            $attr_price = $row_active_cart['attr_price'];
            $item_qty = $row_active_cart['item_qty'];
            $account_id = $row_active_cart['account_id'];
            $cat_id = $row_active_cart['cat_id'];



            $add_subs_cart = $conn -> query("INSERT INTO `subs_cart_history`(`item_id`, `attr_id`, `attr_price`, `item_qty`, `account_id`, `cat_id`) 
            VALUES ('$item_id','$attr_id','$attr_price','$item_qty','$account_id','$cat_id')");

            if ($add_subs_cart) {
                $last_cart_id = $conn->insert_id;
            }

            $add_subs_order = $conn -> query("INSERT INTO `subs_order_history`(`process_id`, `subprocess_id`, `sub_cart_id`) 
            VALUES ('$process_id', '$subprocess_id', '$last_cart_id')");

        }
    }
    }
    // else{
    //     echo "date is less than";
    // }

}


?>


