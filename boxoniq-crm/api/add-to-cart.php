<?php
session_start();
include('../config.php');

$result = array();

if (isset($_POST['account-id'])) {

//ADDING TO THE CART
try {

    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // prepare sql and bind parameters

    $stmt = $conn->prepare("INSERT INTO cart (item_id, attribute_id, account_id, date_creation, quantity, total_amount) 

    VALUES (:item_id, :attribute_id, :account_id, :date_creation, :quantity, :total_amount)");

    $stmt->bindParam(':item_id', $item_id);
    $stmt->bindParam(':attribute_id', $attribute_id);
    $stmt->bindParam(':account_id', $account_id);
    $stmt->bindParam(':date_creation', $date_creation);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':total_amount', $total_amount);


$item_id = $_POST['item_id'];
$attribute_id = $_POST['attribute_id'];
$account_id = $_SESSION['account-id'];
$date_creation = date('Y-m-d');
$quantity = $_POST['quantity'];
$total_amount = ( $_POST['total-amount'] * $_POST['quantity'] );

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