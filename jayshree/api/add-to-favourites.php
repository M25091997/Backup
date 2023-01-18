<?php
session_start();
include('../config.php');

$result = array();

if (true) {

//ADDING TO THE CART
try {

    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // prepare sql and bind parameters

    $stmt = $conn->prepare("INSERT INTO favourites (account_id, item_id) 

    VALUES (:account_id, :item_id)");

    
    $stmt->bindParam(':account_id', $account_id);
    $stmt->bindParam(':item_id', $item_id);


$item_id = $_POST['item-id'];
$account_id = $_SESSION['account-id'];

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