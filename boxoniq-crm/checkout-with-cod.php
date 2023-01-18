<?php session_start(); ?>
<?php include ("config.php"); 

if (true) {
	//inserting payment status
$process_id = rand().time();
$amount = $_SESSION['total_cart_value'];
$account_id = $_SESSION['account-id'];
$msg_query = $conn -> query("SELECT * FROM cart WHERE account_id = '$account_id' AND checkout = '0'");	
while ($msg_q = mysqli_fetch_array($msg_query)) {

/*Setting Checkout to Cart Table*/
$cart_id = $msg_q['id'];
$conn -> query("UPDATE cart SET checkout = '1' WHERE id = '$cart_id'" );

$ATTR_ID = $msg_q['attribute_id'];
$QUANTITY = $msg_q['quantity'];

/*stock Deduction*/
$attrQ = $conn -> query("SELECT * FROM attributes WHERE id = '$ATTR_ID'");
while ( $attr_D = mysqli_fetch_array( $attrQ ) ) { $new_stock = ( $attr_D['stock'] - $QUANTITY ); }

$conn -> query("UPDATE attributes SET stock = '$new_stock' WHERE id = '$ATTR_ID'" );
/*stock Deduction Complete*/


/*Inserting into Orders*/
try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO orders ( cart_id, process_id ) VALUES ( :cart_id, :process_id )");

    $stmt->bindParam(':cart_id', $cart_id);
    $stmt->bindParam(':process_id', $process_id);


    $execution_flag = $stmt -> execute(); // Executing the query

	} 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;

} 




/*Inserting into booking*/
try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt_bookings = $conn_pdo -> prepare("INSERT INTO bookings ( process_id, creation_time, creation_date, payment_mode, payment_status, account_id, amount ) VALUES ( :process_id, :creation_time, :creation_date, :payment_mode, :payment_status, :account_id, :amount )");

    
    $stmt_bookings->bindParam(':process_id', $process_id);
    $stmt_bookings->bindParam(':creation_time', $creation_time);
    $stmt_bookings->bindParam(':creation_date', $creation_date);
    $stmt_bookings->bindParam(':payment_mode', $payment_mode);
    $stmt_bookings->bindParam(':payment_status', $payment_status);
    $stmt_bookings->bindParam(':account_id', $account_id);
    $stmt_bookings->bindParam(':amount', $amount);


    $process_id = $process_id;
    $creation_time = date('H:i:s');
    $creation_date = date('Y-m-d');
    $payment_mode = "2";
    $payment_status = "0";
    $account_id = $account_id;
    $amount = $amount;


    $execution_flag = $stmt_bookings -> execute(); // Executing the query

    $AQ = $conn -> query("SELECT * FROM accounts WHERE id = '$account_id'");
    while ($AD = mysqli_fetch_array($AQ)) { 

        _SEND_MESSAGE($AD['phone'], "Dear Customer, Your Order has been placed.\n Order Id: "."CTIND".substr($process_id, 0,8)."\nOrder Amount: Rs.".$amount."\nKindly keep cash in hand on the delivery day.\nThank You.\nCityindia.in");

        /*Order Message to Admins*/
        _SEND_MESSAGE('7004776271', "Dear Admin, New COD Order for has been placed.\nOrder Id: "."CTIND".substr($process_id, 0,8)."\nOrder Amount: Rs.".$amount);

        _SEND_MESSAGE('7903959562', "Dear Admin, New COD Order for has been placed.\nOrder Id: "."CTIND".substr($process_id, 0,8)."\nOrder Amount: Rs.".$amount);

        _SEND_MESSAGE('7004286568', "Dear Admin, New COD Order for has been placed.\nOrder Id: "."CTIND".substr($process_id, 0,8)."\nOrder Amount: Rs.".$amount);

    }

	} 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;


?> 
<!DOCTYPE html>
<html>
<head>
    <title>Thank You - <?php echo $the_project; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
</head>
<body>



<br><br>
<center style="    margin-top: 7%;
" >
<h1><img src="https://esabbji.com/assets/misc-images/like.png" style="    width: 3%;
    display: inline;" class="img-responsive"/>Thank You!</h1><h2> Order has been placed Successfully!</h2> 

<h3>Your BOOKING ID is : <u> <?php echo "CTIND".substr($process_id, 0,8); ?></u></h3>
<a href="<?php echo $site_url; ?>" class="btn btn-primary btn-lg" style="background-color: #fff !important;     color: #2e6da4;
    font-weight: 900;">Go to Home</a></center>



</body>
</html>
<?php


}

?>