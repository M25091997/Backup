<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');

$result = array();

$data = json_decode(file_get_contents('php://input'), true);

$product_id = $data['product_id'];
$attribute_id = $data['attribute_id'];
$product_price = $data['product_price'];
$quantity = $data['quantity'];
$account_id = $data['account_id'];


if (isset($account_id)) {

//ADDING TO THE CART
try {

    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // prepare sql and bind parameters

    $stmt = $conn->prepare("INSERT INTO cart (item_id, attribute_id, account_id, date_creation, checkout, quantity, total_amount) 

    VALUES (:item_id, :attribute_id, :account_id, :date_creation, :checkout, :quantity, :total_amount)");

    $stmt->bindParam(':item_id', $item_id);
    $stmt->bindParam(':attribute_id', $attribute_id);
    $stmt->bindParam(':account_id', $account_id);
    $stmt->bindParam(':date_creation', $date_creation);
    $stmt->bindParam(':checkout', $checkout);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':total_amount', $total_amount);


$item_id = $product_id;
$attribute_id = $attribute_id;
$account_id = $account_id;
$date_creation = date('Y-m-d');
$checkout = 0;
$quantity = $quantity;
$total_amount = ( $product_price * $quantity );

$flag = $stmt -> execute();

if ( $flag ) { array_push($result,  array('response' => '1')); }
else { array_push($result,  array('response' => '0')); }

}

catch(PDOException $e)

    {
    echo "Error: ".$e->getMessage();
    }

$conn = null;


} else { array_push($result,  array('response' => 'No Sessions Found')); }

echo json_encode($result);