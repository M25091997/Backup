<?php
session_start();
include('../../../config.php');

$result = array();


if ( isset($_POST['user_id']) && isset($_POST['cart_id']) && isset($_POST['product_id']) && isset($_POST['key']) && isset($_POST['qty']) && isset($_POST['mrp'])) {

    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $cart_id = $_POST['cart_id'];
    $key = $_POST['key'];
    $qty = $_POST['qty'];
    $mrp = $_POST['mrp'];


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

$mrp = $_POST['mrp'];
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