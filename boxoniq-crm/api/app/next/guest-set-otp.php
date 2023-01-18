<?php
// session_start();
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents('php://input'), true);

include('../../../config.php');

// $result = array();

$phone = $data['phone'];
$account_random_id = $data['account_id'];
$creation_date = date('Y-m-d');
$creation_time = date('H-i-s');
$verification = 0;
$otp = rand(11111, 99999);
$account_type = 0;

try {

    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // prepare sql and bind parameters

    $stmt = $conn->prepare("INSERT INTO accounts (phone, creation_date, creation_time, verification, otp, account_type, account_random_id) 

    VALUES (:phone, :creation_date, :creation_time, :verification, :otp, :account_type, :account_random_id)");

    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':creation_date', $creation_date);
    $stmt->bindParam(':creation_time', $creation_time);
    $stmt->bindParam(':verification', $verification);
    $stmt->bindParam(':otp', $otp);
    $stmt->bindParam(':account_type', $account_type);
    $stmt->bindParam(':account_random_id', $account_random_id);


$flag = $stmt -> execute();

if ( $flag ) { 
	 $accId = $conn->lastInsertId();
	 
	 $updated_cart = $conn -> query("UPDATE cart SET account_id = $accId WHERE account_id = $account_random_id");
	 if($updated_cart){
					 	$msg = "Your Password Reset OTP is: ".$otp." - ".$the_project;

				    _SEND_MESSAGE_NEW($phone, $msg, "1207161786099974111");

					 $result = array('response' => '1', 'accountId' => $accId); 
			 }
			else {
				$result = array('response' => '0'); 
			}
 
	}
	else {$result = array('response' => '0'); }

	}

catch(PDOException $e)

    {
    echo "Error: ".$e->getMessage();
    }

$conn = null;


echo json_encode($result);