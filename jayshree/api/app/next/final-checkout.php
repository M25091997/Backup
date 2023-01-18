<?php 
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
 ?>
<?php include ("config.php"); 
$result = array();

// $data = json_decode(file_get_contents('php://input'), true);

$account_id = $_POST['account_id'];
$total_amount = $_POST['total_amount'];
// $coins_redeemed = $data['coin_count'];
$shop_name = $_POST['shop_name'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$transport = $_POST['transport'];

// $sql_total = $conn -> query('SELECT SUM(total_amount) AS total_amt FROM `cart` WHERE account_id = $account_id && checkout = 0');
// $row_total = mysqli_fetch_assoc($sql_total);

// $total_amount = $row_total['total_amt'];


if (true) {

	//inserting payment status

$process_id = rand().time();
$process_id = "JAYS".substr($process_id, 0,8);
$amount = $total_amount;
$account_id = $account_id;
$msg_query = $conn -> query("SELECT * FROM cart WHERE account_id = '$account_id' AND checkout = '0'");	
while ($msg_q = mysqli_fetch_array($msg_query)) {

/*Setting Checkout to Cart Table*/
$cart_id = $msg_q['id'];
$conn -> query("UPDATE cart SET checkout = '1' WHERE id = '$cart_id'" );

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
    $stmt_bookings = $conn_pdo -> prepare("INSERT INTO bookings ( process_id, creation_time, creation_date, payment_mode, payment_status, account_id, amount, order_status ) VALUES ( :process_id, :creation_time, :creation_date, :payment_mode, :payment_status, :account_id, :amount, :order_status )");

    
    $stmt_bookings->bindParam(':process_id', $process_id);
    $stmt_bookings->bindParam(':creation_time', $creation_time);
    $stmt_bookings->bindParam(':creation_date', $creation_date);
    $stmt_bookings->bindParam(':payment_mode', $payment_mode);
    $stmt_bookings->bindParam(':payment_status', $payment_status);
    $stmt_bookings->bindParam(':account_id', $account_id);
    $stmt_bookings->bindParam(':amount', $amount);
    $stmt_bookings->bindParam(':order_status', $order_status);


    $process_id = $process_id;
    $creation_time = date('H:i:s');
    $creation_date = date('Y-m-d');
    $payment_mode = "2";
    $payment_status = "0";
    $account_id = $account_id;
    $amount = $amount;
    $order_status = 0;


    $execution_flag = $stmt_bookings -> execute(); // Executing the query
    $booking_id = $conn_pdo->lastInsertId();

    if($execution_flag) {

        $save_address = $conn -> query("INSERT INTO `saved_address`(`account_id`, `shop_name`, `full_address`, `mobile`, `transport`) VALUES ('$account_id','$shop_name','$address','$mobile','$transport')");

        // $stmt_acc = $conn_pdo -> prepare("INSERT INTO saved_address (account_id, shop_name, full_address, mobile, transport) VALUES (:account_id, :shop_name :address, :mobile, :transport )");
    //     $stmt_acc = $conn_pdo -> prepare("INSERT INTO saved_address ( account_id, shop_name, full_address, mobile, transport ) VALUES ( :account_id, :shop_name :address, :mobile, :transport)");
    
    // $stmt_acc->bindParam(':address', $address);
    // $stmt_acc->bindParam(':shop_name', $shop_name);
    // $stmt_acc->bindParam(':mobile', $mobile);
    // $stmt_acc->bindParam(':account_id', $account_id);
    // $stmt_acc->bindParam(':transport', $transport);

    // $execution_acc = $stmt_acc -> execute(); 
    // Executing the query

    }


    $result = array('response' => '1', 'msg' =>'Thanks for Shopping with us', 'order-id' => $process_id);


	} 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;


}else{ $result = array( 'response' => '0'); }

echo json_encode($result); ?>