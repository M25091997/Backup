<?php

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('../../config.php');
// $cart_items_array = array();
$final_cart_array = array();
$result = array();
$process_id = $_POST['process_id'];
$cart_arr = [];

// ======================================================================
// if skiped
// ======================================================================

/*
    1. update subs_bookings table(isskip).
    2. insert subs_history (user_id, process_id, subsprocess_id, total_amt, date, total_items, isskip, iscancel)
    3. skip month (next month)
*/

if ($process_id != '') {

    $find_sub_booking_sql = "SELECT * FROM subs_booking WHERE process_id = '$process_id' AND isskip = 0";
    $find_sub_booking_query = mysqli_query($conn, $find_sub_booking_sql);
    $find_count = mysqli_num_rows($find_sub_booking_query);
    if ($find_count > 0) {

        // update subs_booking
        $update_sub_booking_sql = "UPDATE subs_booking SET isskip = 1 WHERE process_id = '$process_id'";
        $update_sub_booking_query = mysqli_query($conn, $update_sub_booking_sql);

        $update_sub_history = "UPDATE sub_order_history SET isskip = 1 WHERE process_id = '$process_id'";
        $update_sub_his = mysqli_query($conn, $update_sub_history);

        if ($update_sub_booking_query && $update_sub_his) {
            // enter skip
            $bSql = "SELECT * FROM subs_booking WHERE process_id = '$process_id'";
            $bquery = mysqli_query($conn, $bSql);
            $bcount = mysqli_num_rows($bquery);
            if ($bcount > 0) {
                $row = mysqli_fetch_assoc($bquery);
                $user_id = $row['user_id'];
                $creation_date = $row['date'];
                $amount = $row['total'];
                $subsprocess_id = $row['subsprocess_id'];
                $total_items = $row['total_items'];
                $iscancel = $row['iscancel'];

                // $nxtdate = getNextDate('1');
                $nxtdate = date('Y-m-d', strtotime('first day of +1 month'));

                // sub_order_history
                $sub_order_history_sql = "INSERT INTO sub_order_history (user_id,process_id,subsprocess_id,total_amt,date,total_items,isskip,iscancel) VALUES('$user_id','$process_id','$subsprocess_id','$amount','$nxtdate','$total_items',0,'$iscancel')";
                $sub_order_history_query = mysqli_query($conn, $sub_order_history_sql);


                // subs_booking
                $sub_book_skip = $conn -> query("INSERT INTO subs_booking (user_id,process_id,subsprocess_id,total,date,total_items,isskip,iscancel) VALUES('$user_id','$process_id','$subsprocess_id','$amount','$nxtdate','$total_items',0,'$iscancel')");
               

                if ($sub_order_history_query && $subs_booking_query) {
                    array_push($result, array('response' => '1'));
                } else {
                    array_push($result, array('response' => 'somthing wrong!'));
                }

                array_push($result, array('response' => '1'));
            } else {
                array_push($result, array('response' => 'NO process id found!'));
            }
        } else {
            array_push($result, array('response' => 'Bundle not skipped!'));
        }
    } else {
        array_push($result, array('response' => 'process_id not found!'));
    }
} else {
    array_push($result, array('response' => 'No Sessions Found'));
}

echo json_encode($result);

// get next date
function getNextDate($nt)
{
    $next_date = date('Y-m-d', strtotime('first day of +' . $nt . ' month'));
    return $next_date;
}
