<?php

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

$data = json_decode(file_get_contents('php://input'), true);

include("config.php");


if (isset($data['full_address']) && isset($data['landmark']) && isset($data['pincode']) && isset($data['address_type']) && isset($data['account_id']) ) {

/*Adding*/

try {
		    $conn_P = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

		    // set the PDO error mode to exception

		    $conn_P->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		     // prepare sql and bind parameters

		    $stmt = $conn_P -> prepare("INSERT INTO saved_address (user_name, address_type, account_id, full_address, landmark, pincode, state, phone) VALUES (:user_name, :address_type, :account_id, :full_address, :landmark, :pincode, :state, :phone)");

		    $stmt->bindParam(':address_type', $address_type);
		    $stmt->bindParam(':account_id', $account_id);
		    $stmt->bindParam(':full_address', $full_address);
		    $stmt->bindParam(':landmark', $landmark);
		    $stmt->bindParam(':pincode', $pincode);
		    $stmt->bindParam(':state', $state);
		    $stmt->bindParam(':user_name', $user_name);
		    $stmt->bindParam(':phone', $phone);



		    $full_address = $data['full_address'];
			$landmark = $data['landmark'];
			$pincode = $data['pincode'];
			$state = $data['state'];
			$user_name = $data['user_name'];
			$phone = $data['phone'];


			$address_type = $data['address_type'];
			$account_id = $data['account_id'];

		

		/*Checking Stock then executing*/
		$flag = $stmt -> execute();

		if ($flag) { $result = array( 'response' => '1', 'msg' => 'Address Added Successfully'); }

		}

		catch(PDOException $e)

		    {
		    echo "Error: ".$e->getMessage();
		    }

		$conn_P = null;


} else { $result = array( 'response' => '0' ); /* Post Vars Not Found */ } 

echo json_encode($result);