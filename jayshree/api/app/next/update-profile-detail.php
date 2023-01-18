<?php
session_start();
include('../../../config.php');

$result = array();


if ( isset($_POST['user_id']) && isset($_POST['name']) && isset($_POST['phone'])) {

try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("UPDATE accounts SET name = :name, phone = :phone, shop_name = :shop_name WHERE id = :user_id ");

    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':shop_name', $shop_name);

$user_id = $_POST['user_id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$shop_name = $_POST['shop_name'];

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