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

$address = $data['address'];
$pincode = $data['pincode'];
$landmark = $data['landmark'];
$accountId = $data['accountId'];

$result = array();

if (isset($address) && isset($landmark) && isset($pincode) && isset($accountId) ) {

/*Adding*/

try {
		    $conn_P = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

		    // set the PDO error mode to exception

		    $conn_P->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		     // prepare sql and bind parameters

		    $stmt = $conn_P -> prepare("INSERT INTO saved_address (address_type, account_id, full_address, landmark, pincode)

		    VALUES (:address_type, :account_id, :full_address, :landmark, :pincode)");

		    $stmt->bindParam(':address_type', $address_type);
		    $stmt->bindParam(':account_id', $account_id);
		    $stmt->bindParam(':full_address', $full_address);
		    $stmt->bindParam(':landmark', $landmark);
		    $stmt->bindParam(':pincode', $pincode);

		    $full_address = $address;
			$landmark = $landmark;
			$pincode = $pincode;
			$address_type = 'Home';
			$account_id = $accountId;

		

		/*Checking Stock then executing*/
		$flag = $stmt -> execute();

		if ($flag) { $result = array( 'response' => '1' ); }

		}

		catch(PDOException $e)

		    {
		    echo "Error: ".$e->getMessage();
		    }

		$conn_P = null;


} else { $result = array( 'response' => '0' ); /* Post Vars Not Found */ } 

echo json_encode($result);