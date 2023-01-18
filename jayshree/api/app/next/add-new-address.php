<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');

$account_id = $_POST['account-id'];

$result = array();

if (isset($_POST['full_address']) && isset($_POST['landmark']) && isset($_POST['pincode']) && isset($_POST['address_type']) && isset($_POST['account_id']) ) {

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

		    $full_address = $_POST['full_address'];
			$landmark = $_POST['landmark'];
			$pincode = $_POST['pincode'];
			$address_type = $_POST['address_type'];
			$account_id = $_POST['account_id'];

		

		/*Checking Stock then executing*/
		$flag = $stmt -> execute();

		if ($flag) { array_push($result, array( 'response' => '1' ) ); }

		}

		catch(PDOException $e)

		    {
		    echo "Error: ".$e->getMessage();
		    }

		$conn_P = null;


} else { array_push($result, array( 'response' => '888' ) ); /* Post Vars Not Found */ } 

echo json_encode($result);