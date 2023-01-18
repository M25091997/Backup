<?php
// session_start();
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$data = json_decode(file_get_contents('php://input'), true);

$result = array();


if ( isset($data['user_id']) && isset($data['cart_id']) && isset($data['product_id']) && isset($data['key']) && isset($data['qty']) && isset($data['mrp'])) {

    $user_id = $data['user_id'];
    $product_id = $data['product_id'];
    $cart_id = $data['cart_id'];
    $key = $data['key'];
    $qty = $data['qty'];
    $mrp = $data['mrp'];

    // echo json_encode($mrp);
    // exit();


    // $select_cart = $conn -> query("SELECT quantity FROM cart WHERE id = '$cart_id' && item_id = '$product_id' && account_id = '$account_id' ");
    // $row_sel_cart = mysqli_fetch_assoc($select_cart);
    // $qty = $row_sel_cart['quantity'];

try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("UPDATE cart SET quantity = :qty, total_amount = :total_amount WHERE id = :cart_id && item_id = :product_id && account_id = :user_id");

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->bindParam(':cart_id', $cart_id);
    // $stmt->bindParam(':key', $key);
    $stmt->bindParam(':qty', $qty);
    $stmt->bindParam(':total_amount', $total_amount);

if($key == 'plus'){
    $qty = $qty + 1;
}else{
    $qty = $qty - 1;
}

$mrp = $data['mrp'];
$total_amount = $qty * $mrp;



    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) {
    
    $result = array( 'response' => 1, 'msg' => 'Profile Updated Successfully' );

    }

   } 
    catch(PDOException $e) #try 1
    {
    $error_msg = "Error: ".$e->getMessage();
    $result = array( 'response'=> 0, 'msg' => $error_msg." #2");
    }

    $conn_pdo = null;
 
    

} else { $result = array( 'response' => 0, 'msg' => 'Something went wrong' ); }

echo json_encode($result);