<?php
// include ("../../config.php");
header('Access-Control-Allow-Origin: *');
include('../../config.php');

$data = json_decode(file_get_contents('php://input'), true);

// $razorpay_payment_id = $data['razorpay_payment_id'];
$razorpay_payment_id = "Wallet system";
$total_cart_value = $data['total_cart_value'];
$account_id = $data['account_id'];
$plan_type = $data['plan_type'];



$result = array();

if (isset($data['total_cart_value']) && isset($data['account_id'])) {

    // echo json_encode($account_id);
    // // print_r($_POST);
    // exit();

    $payment_id = $data['razorpay_payment_id'];
    $payment_status = "Credit";
    // $payment_request_id = $_POST['payment_request_id'];


    if ($payment_status == "Credit") {
        //inserting payment status


        $process_id = rand() . time();
        $amount = $data['total_cart_value'];
        $account_id = $data['account_id'];
        $msg_query = $conn->query("SELECT * FROM cart WHERE account_id = '$account_id' AND checkout = '0'");
        while ($msg_q = mysqli_fetch_array($msg_query)) {

            /*Setting Checkout to Cart Table*/
            $cart_id = $msg_q['id'];
            $conn->query("UPDATE cart SET checkout = '1' WHERE id = '$cart_id'");

            $ATTR_ID = $msg_q['attribute_id'];
            $QUANTITY = $msg_q['quantity'];

            /*stock Deduction*/
            $attrQ = $conn->query("SELECT * FROM attributes WHERE id = '$ATTR_ID'");
            while ($attr_D = mysqli_fetch_array($attrQ)) {
                $new_stock = ($attr_D['stock'] - $QUANTITY);
            }

            $conn->query("UPDATE attributes SET stock = '$new_stock' WHERE id = '$ATTR_ID'");
            /*stock Deduction Complete*/



            /*Inserting into Orders*/
            try { #try 1

                $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

                // set the PDO error mode to exception
                $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


                // prepare sql and bind parameters
                $stmt = $conn_pdo->prepare("INSERT INTO orders ( cart_id, process_id ) VALUES ( :cart_id, :process_id )");

                $stmt->bindParam(':cart_id', $cart_id);
                $stmt->bindParam(':process_id', $process_id);


                $execution_flag = $stmt->execute(); // Executing the query

            } catch (PDOException $e) #try 1
            {
                echo $error_msg = "Error: " . $e->getMessage();
            }

            $conn_pdo = null;
        }




        /*Inserting into booking*/
        try { #try 1

            $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

            // set the PDO error mode to exception
            $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            // prepare sql and bind parameters
            $stmt_bookings = $conn_pdo->prepare("INSERT INTO bookings ( process_id, creation_time, creation_date, payment_mode, payment_status, account_id, amount, plan_type ) VALUES ( :process_id, :creation_time, :creation_date, :payment_mode, :payment_status, :account_id, :amount, :plan_type)");


            $stmt_bookings->bindParam(':process_id', $process_id);
            $stmt_bookings->bindParam(':creation_time', $creation_time);
            $stmt_bookings->bindParam(':creation_date', $creation_date);
            $stmt_bookings->bindParam(':payment_mode', $payment_mode);
            $stmt_bookings->bindParam(':payment_status', $payment_status);
            $stmt_bookings->bindParam(':account_id', $account_id);
            $stmt_bookings->bindParam(':amount', $amount);
            $stmt_bookings->bindParam(':plan_type', $type);


            $process_id = $process_id;
            $creation_time = date('h:i:s');
            $creation_date = date('Y-m-d');
            $payment_mode = "1";
            $payment_status = "1";
            $account_id = $account_id;
            $amount = $amount;
            $type = $plan_type;


            $execution_flag = $stmt_bookings->execute(); // Executing the query
            // $lastBookingid = $conn_pdo->lastInsertId();

            $AQ = $conn->query("SELECT * FROM accounts WHERE id = '$account_id'");
            while ($AD = mysqli_fetch_array($AQ)) {

                //  _SEND_MESSAGE_NEW($AD['phone'], "Dear Customer, Your Order has been placed.  Order Id: "."CTIND".substr($process_id, 0,8)." Order Amount: Rs.".$amount." Online payment received Successfully!. Thank You. Cityindia.in", "1207162119977002081");

                // // /*Order Message to Admins*/
                //  _SEND_MESSAGE_NEW('9801840531', "Dear Admin, New Online Payment Order has been placed.  Order Id: "."CTIND".substr($process_id, 0,8)." Order Amount: Rs.".$amount."- Cityindia.in", "1207162128656823253");

                //  _SEND_MESSAGE_NEW('9334483355', "Dear Admin, New Online Payment Order has been placed.  Order Id: "."CTIND".substr($process_id, 0,8)." Order Amount: Rs.".$amount."- Cityindia.in", "1207162128656823253");

                //  _SEND_MESSAGE_NEW('7004286568', "Dear Admin, New Online Payment Order has been placed.  Order Id: "."CTIND".substr($process_id, 0,8)." Order Amount: Rs.".$amount."- Cityindia.in", "1207162128656823253");

                //  _SEND_MESSAGE_NEW('7004776271', "Dear Admin, New Online Payment Order has been placed.  Order Id: "."CTIND".substr($process_id, 0,8)." Order Amount: Rs.".$amount."- Cityindia.in", "1207162128656823253");

                //  _SEND_MESSAGE_NEW('8228999193', "Dear Admin, New Online Payment Order has been placed.  Order Id: "."CTIND".substr($process_id, 0,8)." Order Amount: Rs.".$amount."- Cityindia.in", "1207162128656823253");



            }

            array_push($result, array('response' => '1', 'order-id' => "BOXONIQ" . substr($process_id, 0, 8)));
        } catch (PDOException $e) #try 1
        {
            echo $error_msg = "Error: " . $e->getMessage();
        }

        $conn_pdo = null;






        /*Inserting into Payment History*/
        try { #try 1

            $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

            // set the PDO error mode to exception
            $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            // prepare sql and bind parameters
            $stmt = $conn_pdo->prepare("INSERT INTO payment_history ( transaction_id, date_creation, time_creation, process_id ) VALUES ( :transaction_id, :date_creation, :time_creation, :process_id )");

            $stmt->bindParam(':transaction_id', $transaction_id);
            $stmt->bindParam(':date_creation', $date_creation);
            $stmt->bindParam(':time_creation', $time_creation);
            $stmt->bindParam(':process_id', $process_id);

            $transaction_id = $payment_id;
            $date_creation = date('Y-m-d');
            $time_creation = date('H:i:s');
            $process_id = $process_id;



            $execution_flag = $stmt->execute(); // Executing the query



        } catch (PDOException $e) #try 1
        {
            echo $error_msg = "Error: " . $e->getMessage();
        }

        $conn_pdo = null;

        // =========================================================================================
        // subs table entry begin
        // =========================================================================================
        // if (isset($lastBookingid)) {
        //     $time = date('Y-m-d');
        //     // enter skip
        //     $bSql = "SELECT * FROM bookings WHERE id = '$lastBookingid' AND subscription = '1' AND subs_status= '1'";
        //     $bquery = mysqli_query($conn, $bSql);
        //     $bcount = mysqli_num_rows($bquery);
        //     if ($bcount > 0) {
        //         $row = mysqli_fetch_assoc($bquery);
        //         $user_id = $row['account_id'];
        //         $creation_date = $row['creation_date'];
        //         $subscription_month = $row['subscription_month'];
        //         $amount = $row['amount'];
        //         $process_id = $row['process_id'];

        //         $sMonthCount = (int)$subscription_month;

        //         // order table
        //         $osql = "SELECT * FROM orders WHERE process_id = '$process_id'";
        //         $oquery = mysqli_query($conn, $osql);
        //         $ocount = mysqli_num_rows($oquery);

        //         // $nxtdate = getNextDate('1');
        //         $nxtdate = $time;
        //         $subsprocess_id = rand() . time();
        //         $isskip = false;
        //         $iscancel = false;
        //         // insert into subs_booking
        //         $iSql = "INSERT INTO subs_booking (user_id,process_id,subsprocess_id,total,date,total_items,isskip,iscancel) VALUES ('$user_id','$process_id','$subsprocess_id','$amount','$nxtdate','$ocount','$isskip','$isskip')";
        //         $iquery = mysqli_query($conn, $iSql);

        //         // ===================================
        //         // insert into subscart
        //         $order_sql = "SELECT * FROM orders WHERE process_id = '$process_id'";
        //         $order_query = mysqli_query($conn, $order_sql);
        //         while ($order_row = mysqli_fetch_assoc($order_query)) {
        //             $c_id =  $order_row['cart_id'];
        //             // cart item
        //             $cart_sql = "SELECT * FROM cart WHERE id = '$c_id'";
        //             $cart_query = mysqli_query($conn, $cart_sql);
        //             while ($cart_row = mysqli_fetch_assoc($cart_query)) {
        //                 $item_id = $cart_row['item_id'];
        //                 $attr_id = $cart_row['attribute_id'];
        //                 $attr_qty = $cart_row['quantity'];

        //                 $str_sql = "SELECT * FROM attributes WHERE id = '$attr_id'";
        //                 $str_query = mysqli_query($conn, $str_sql);
        //                 while ($attr_row = mysqli_fetch_assoc($str_query)) {
        //                     $attr_price = $attr_row['price'];
        //                 }

        //                 $iSql = "INSERT INTO subs_cart (item_id,attr_id,attr_price,item_qty,delete_status) VALUES ('$item_id','$attr_id','$attr_price','$attr_qty','0')";
        //                 $iquery = mysqli_query($conn, $iSql);
        //                 $sub_cart_id = mysqli_insert_id($conn);

        //                 // ==========================================
        //                 // subs_order
        //                 $sub_order_sql = "INSERT INTO subs_order (process_id,subprocess_id,sub_cart_id) VALUES('$process_id','$subsprocess_id','$sub_cart_id')";
        //                 $sub_order_query = mysqli_query($conn, $sub_order_sql);
        //             }
        //         }
        //         // get item id and attr id

        //         // }

        //         // sub_order_history
        //         $sub_order_history_sql = "INSERT INTO sub_order_history (user_id,process_id,subsprocess_id,total_amt,date,total_items,isskip,iscancel) VALUES('$user_id','$process_id','$subsprocess_id','$amount','$time','$ocount','$isskip','$iscancel')";
        //         $sub_order_history_query = mysqli_query($conn, $sub_order_history_sql);

        //         $result = array('response' => '1', 'id' => $lastBookingid);
        //         // sub order history
        //         // if ($iquery) {
        //         //     $iSql = "INSERT INTO sub_order_history (process_id,creation_date,delivery_date,skip_date,order_status) VALUES ('$process_id','$creation_date','$time')";
        //         //     $iquery = mysqli_query($conn, $iSql);
        //         // }
        //     } else {
        //         array('response' => 'NO process id found!');
        //     }
        // } else {
        //     array_push($result, array('response' => 'No Sessions Found'));
        // }



        // =========================================================================================
        // subs table entry end
        // =========================================================================================



    } else {
        array_push($result, array('response' => 'GATEWAY SYNC ERROR 1'));
    }
} else {
    array_push($result, array('response' => 'GATEWAY SYNC ERROR 2'));
}

echo json_encode($result); 

// header("location:https://web.cityindia.in/shop/dashboard");
