<?php

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'];
$phone = $data['phone'];
$email = $data['email'];
$web = $data['web'];
$description = $data['description'];


$result = array();

// if (isset($name) && isset($email) && isset($phone) && isset($web) ) {

/*Adding*/

try {
		    $conn_P = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

		    // set the PDO error mode to exception

		    $conn_P->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		     // prepare sql and bind parameters

		    $stmt = $conn_P -> prepare("INSERT INTO contact_info (name, web, description, email, phone)

		    VALUES (:name, :web, :description, :email, :phone)");

		    $stmt->bindParam(':name', $name);
		    $stmt->bindParam(':web', $web);
		    $stmt->bindParam(':description', $description);
		    $stmt->bindParam(':email', $email);
		    $stmt->bindParam(':phone', $phone);
		

		/*Checking Stock then executing*/
		$flag = $stmt -> execute();

		if ($flag) { $result = array( 'response' => '1' ); }

		}

		catch(PDOException $e)

		    {
		    echo "Error: ".$e->getMessage();
		    }

		$conn_P = null;


// } else { $result = array( 'response' => '0' ); /* Post Vars Not Found */ } 

echo json_encode($result);