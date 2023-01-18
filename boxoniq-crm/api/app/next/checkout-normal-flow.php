<?php 
// "fromwallet" = $data['razorpay"fromwallet"'];
$payment_status = "Credit";
// $payment_request_id = $_POST['payment_request_id'];


if ($payment_status == "Credit") {
    //inserting payment status


    $process_id = rand() . time();
    $amount = $total_cart_value;
    // $account_id = $data['account_id'];
    $msg_query = $conn->query("SELECT * FROM cart WHERE account_id = '$account_id' AND checkout = '0'");
    while ($msg_q = mysqli_fetch_array($msg_query)) {

    $updated_cart_process = $conn->query("UPDATE cart SET process_id = '$process_id' WHERE account_id = '$account_id' AND checkout = '0'");

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
        $stmt_bookings = $conn_pdo->prepare("INSERT INTO bookings ( process_id, creation_time, creation_date, payment_mode, payment_transaction_id, payment_status, account_id, amount, subscription, subscription_month, is_coupon, coupon_id, address_id ) VALUES ( :process_id, :creation_time, :creation_date, :payment_mode, :payment_transaction_id, :payment_status, :account_id, :amount, :subscription, :subscription_month, :is_coupon, :coupon_id, :address_id )");


        $stmt_bookings->bindParam(':process_id', $process_id);
        $stmt_bookings->bindParam(':creation_time', $creation_time);
        $stmt_bookings->bindParam(':creation_date', $creation_date);
        $stmt_bookings->bindParam(':payment_mode', $payment_mode);
        $stmt_bookings->bindParam(':payment_transaction_id', $payment_transaction_id);

        $stmt_bookings->bindParam(':payment_status', $payment_status);
        $stmt_bookings->bindParam(':account_id', $account_id);
        $stmt_bookings->bindParam(':amount', $amount);
        $stmt_bookings->bindParam(':is_coupon', $is_coupon);
        $stmt_bookings->bindParam(':coupon_id', $coupon_id);
        $stmt_bookings->bindParam(':address_id', $address_id);


        $stmt_bookings->bindParam(':subscription', $subscription);
        $stmt_bookings->bindParam(':subscription_month', $subscription_month);



        $process_id = $process_id;
        $creation_time = date('h:i:s');
        $creation_date = date('Y-m-d');
        if($is_wallet == 1){
            $payment_mode = "1";
        }else{
            $payment_mode = "2"; 
        }
        
        $payment_status = "1";
        $account_id = $account_id;
        $amount = $amount;
        



        $execution_flag = $stmt_bookings->execute(); // Executing the query

        if ($execution_flag) {
            $user_id = $account_id;
            // $debit_amt = $total_cart_value;

            // $sql = "SELECT * FROM wallet WHERE user_id= '$user_id'";
            // $query = mysqli_query($conn, $sql);
            // $count = mysqli_num_rows($query);
            // if ($count > 0) {
            //     $row = mysqli_fetch_assoc($query);
            //     $wallet_id = $row['id'];
            //     $amt = $row['amount'];

            //     $updata_amt = $amt -  $debit_amt;

            //     // if ($updata_amt > 0) {
            //     $update_sql = "UPDATE wallet SET amount = '$updata_amt' WHERE user_id = '$user_id'";
            //     $update_query = mysqli_query($conn, $update_sql);

            //     if ($update_query) {
            //         $msg = "Rs." . $debit_amt . " is deducted for your Order";
            //         $wallet_history_sql = "INSERT INTO wallet_history (wallet_id,amount,tran_id,type,msg,created_on) VALUES ('$wallet_id','$debit_amt','JKHI736','debit','$msg','$date')";
            //         $wallet_history_query = mysqli_query($conn, $wallet_history_sql);
            //     }
            // }

            // include('picker_api_link.php');
            $picker_transaction_id = "webtest";
        }

        $AQ = $conn->query("SELECT * FROM accounts WHERE id = '$account_id'");
        while ($AD = mysqli_fetch_array($AQ)) {

            //  _SEND_MESSAGE_NEW($AD['phone'], "Dear Customer, Your Order has been placed.  Order Id: "."CTIND".substr($process_id, 0,8)." Order Amount: Rs.".$amount." Online payment received Successfully!. Thank You. Cityindia.in", "1207162119977002081");

            // // /*Order Message to Admins*/
            //  _SEND_MESSAGE_NEW('9801840531', "Dear Admin, New Online Payment Order has been placed.  Order Id: "."CTIND".substr($process_id, 0,8)." Order Amount: Rs.".$amount."- Cityindia.in", "1207162128656823253");

            //  _SEND_MESSAGE_NEW('9334483355', "Dear Admin, New Online Payment Order has been placed.  Order Id: "."CTIND".substr($process_id, 0,8)." Order Amount: Rs.".$amount."- Cityindia.in", "1207162128656823253");

            //  _SEND_MESSAGE_NEW('7004286568', "Dear Admin, New Online Payment Order has been placed.  Order Id: "."CTIND".substr($process_id, 0,8)." Order Amount: Rs.".$amount."- Cityindia.in", "1207162128656823253");

            //  _SEND_MESSAGE_NEW('7004776271', "Dear Admin, New Online Payment Order has been placed.  Order Id: "."CTIND".substr($process_id, 0,8)." Order Amount: Rs.".$amount."- Cityindia.in", "1207162128656823253");

            //  _SEND_MESSAGE_NEW('8228999193', "Dear Admin, New Online Payment Order has been placed.  Order Id: "."CTIND".substr($process_id, 0,8)." Order Amount: Rs.".$amount."- Cityindia.in", "1207162128656823253");

            $refer_count = $AD['refer_count'];
            $refer_by = $AD['refer_by'];

            if($refer_count == 0 && $refer_by > 0 && $amount > 499){
                $check_tok = 'yes';
                $sel_wall = $conn -> query("SELECT * FROM wallet WHERE user_id = '$refer_by'");
                $row_sel_wall = mysqli_fetch_assoc($sel_wall);
                $wallet_amt = $row_sel_wall['amount'];
                $wallet_id = $row_sel_wall['id'];

                $new_wall_amt = $wallet_amt + 50;

                $update_wallet_balance = $conn -> query("UPDATE wallet SET amount = '$new_wall_amt' WHERE user_id = '$refer_by' && id = '$wallet_id'");
                $msg_wall = 'Rs. 50 added in your wallet For Refer & Earn';
                $wall_update_date = date('Y-m-d h:i');

                $updated_wallet_history = $conn -> query("INSERT INTO wallet_history (wallet_id, amount, tran_id, type, msg, created_on) VALUES ('$wallet_id', 50, 'Refer50', 'credit', '$msg_wall', '$wall_update_date')");
                if($update_wallet_balance && $updated_wallet_history){
                    $update_refer_count = $conn -> query("UPDATE accounts SET refer_count = 1 WHERE id = '$account_id'");
                }
            }else{
                $check_tok = 'no';

            }


        }

        $result = array('response' => '1', 'amount' => $amount, 'order-id' => "BOXONIQ" . substr($process_id, 0, 8));
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
        $stmt = $conn_pdo->prepare("INSERT INTO payment_history ( transaction_id, date_creation, time_creation, process_id, picker_transaction_id ) VALUES ( :transaction_id, :date_creation, :time_creation, :process_id, :picker_transaction_id )");

        $stmt->bindParam(':transaction_id', $transaction_id);
        $stmt->bindParam(':date_creation', $date_creation);
        $stmt->bindParam(':time_creation', $time_creation);
        $stmt->bindParam(':process_id', $process_id);
        $stmt->bindParam(':picker_transaction_id', $picker_transaction_id);


        $transaction_id = $payment_transaction_id;
        $date_creation = date('Y-m-d');
        $time_creation = date('H:i:s');
        $process_id = $process_id;



        $execution_flag = $stmt->execute(); // Executing the query
        $lastBookingid = $conn_pdo->lastInsertId();
    } catch (PDOException $e) #try 1
    {
        echo $error_msg = "Error: " . $e->getMessage();
    }

    $conn_pdo = null;

    




} else {
    array_push($result, array('response' => 'GATEWAY SYNC ERROR 1'));
}

?>