<?php

try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO accounts ( name, password, phone, email, creation_date, creation_time, otp, refer_by, baby_name, baby_dob, refer_code ) VALUES ( :name, :password, :phone, :email, :creation_date, :creation_time, :otp, :refer_by, :baby_name, :baby_dob, :refer_code )");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':creation_date', $creation_date);
    $stmt->bindParam(':creation_time', $creation_time);
    $stmt->bindParam(':otp', $otp);
    $stmt->bindParam(':refer_by', $refer);
    $stmt->bindParam(':baby_name', $baby_name);
    $stmt->bindParam(':baby_dob', $baby_dob);
    $stmt->bindParam(':refer_code', $refer_code);

    	// insert a row
    	$name = $name;    	
    	$password = $password;
    	$phone = NumberFilter($phone);
    	$email = $email;    	
		$creation_date = date("Y-m-d");
		$creation_time = date("h:i:s");
        $refer_code = referral_code(8);
        $refer = $refer_by;

		$otp = rand(6666, 666666);
        $baby_name = $baby_name;
        $baby_dob = $baby_dob;

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) {
        $user_id = $conn_pdo -> lastInsertId();
        /*Taking Account ID*/

        $AQ = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone' ");
        while ($ADT = mysqli_fetch_array($AQ)) {
            $_SESSION['account_to_verify'] = $account_id = $ADT['id'];
        }

        /*Taking Account ID ENDS*/

    /*Create Wallet ID*/

    $curr_date = date('Y-m-d H:i:sa');

    $create_wallet = $conn -> query("INSERT INTO wallet ( user_id, amount, tran_id, created_on) VALUES ( '$user_id', 0, 'Ist_tran', '$curr_date')");
    
    // $stmt_wallet = $conn_pdo -> prepare("INSERT INTO wallet ( user_id, amount, tran_id, created_on) VALUES ( :user_id, :amount, :tran_id, :created_on )");

    // $stmt_wallet->bindParam(':user_id', $user_id);
    // $stmt_wallet->bindParam(':amount', $amount);
    // $stmt_wallet->bindParam(':tran_id', $tran_id);
    // $stmt_wallet->bindParam(':created_on', $curr_date);

    // $user_id = $user_id;
    // $amount = 0;
    // $tran_id = "Ist_tran";
    // $curr_date = date('Y-m-d H:i:sa');

    // $execution_flag_wallet = $stmt_wallet -> execute(); // Executing the query


    /*Create Wallet ID ENDS*/

            if($create_wallet){
                    /*First Sending OTP*/
                // $updated_refer_amt = $conn -> query("UPDATE wallet SET amount = amount + 50 WHERE user_id = '$refer_by' ");

                // $get_wallet_id = $conn -> query("SELECT * FROM wallet WHERE user_id = '$refer_by'");
                // $wallet_id = mysqli_fetch_assoc($get_wallet_id)['id'];

                // $add_wallet_history = $conn -> query("INSERT INTO wallet_history (wallet_id, amount, tran_id, type, msg, created_on) VALUES ('$wallet_id', 50, 'ReferEarn', 'credit', '₹ 460 Added is added in your wallet', '$curr_date') ");
                
                // if($updated_refer_amt && $add_wallet_history){
                    // $msg = "Your Signup OTP is: " .$otp."\n- ".$the_project;    //Message Here
                    $msg = "Your Signup OTP is: ".$otp." - Boxoniq ";

                    _SEND_MESSAGE_NEW($phone, $msg, "1207165849257751035");
                    
                    // $_SESSION['name'] = $name;
                    $result = array( 'response' => '1', 'accountId' => $account_id, 'msg' => "Successfully Registered");
                // }

               
            }

	}

   } 
    catch(PDOException $e) #try 1
    {
    $error_msg = "Error: ".$e->getMessage();
    $result = array( 'response' => $error_msg." #2" );
    }

    $conn_pdo = null;
?>