<?php

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');
// $cart_items_array = array();
// $final_cart_array = array();

$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'];
// print_r($account_id);
// exit();

if (true) {

	  try {

    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // prepare sql and bind parameters

    $stmt = $conn->prepare("INSERT INTO subscribe (email, created_on) VALUES (:email, :created_on)");

    $stmt->bindParam(':email', $email);
    
    $stmt->bindParam(':created_on', $created_on);
    
$email = $email;
$created_on = date('Y-m-d');

$flag = $stmt -> execute();

if ( $flag ) { $result = array('response' => '1'); }
else {$result = array('response' => '0'); }

}

catch(PDOException $e)

    {
    echo "Error: ".$e->getMessage();
    }

$conn = null;

} else { $result = array('response' => 0); }

echo json_encode($result);

?>