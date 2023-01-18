<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');
$result = array();

$data = json_decode(file_get_contents('php://input'), true);

$phone = $data['phone'];
$name = $data['name'];
$email = $data['email'];
$password = $data['password'];


    //CLEANUP

	
    //CLEANUP COMPLETED


if ( isset($name) && isset($email) && isset($phone) && isset($password) ) {

    $check_statement_mobile = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone' AND verification = '0'");

    while ($row_c = mysqli_fetch_array($check_statement_mobile)) {
        $to_delete_id = $row_c['id'];
        $conn -> query("DELETE FROM accounts WHERE id = '$to_delete_id'");
    }

$p_check = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone'");
$p_check_2 = $conn -> query("SELECT * FROM accounts WHERE email = '$email'");

if (mysqli_num_rows($p_check) == 0 OR mysqli_num_rows($p_check_2) == 0) {

try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO accounts ( name, password, phone, email, creation_date, creation_time, otp ) VALUES ( :name, :password, :phone, :email, :creation_date, :creation_time, :otp )");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':creation_date', $creation_date);
    $stmt->bindParam(':creation_time', $creation_time);
    $stmt->bindParam(':otp', $otp);



    	// insert a row
    	$name = $name;    	
    	$password = $password;
    	$phone = NumberFilter($phone);
    	$email = $email;    	
		$creation_date = date("Y-m-d");
		$creation_time = date("h:i:s");

		$otp = rand(6666, 666666);

    $execution_flag = $stmt -> execute(); // Executing the query


    if ($execution_flag) {

        /*Taking Account ID*/

        $AQ = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone' ");
        while ($ADT = mysqli_fetch_array($AQ)) {
            $_SESSION['account_to_verify'] = $account_id = $ADT['id'];
        }

        /*Taking Account ID ENDS*/


	/*First Sending OTP*/

	$msg = "Your Signup OTP is: " .$otp."\n- ".$the_project;    //Message Here

    // _SEND_MESSAGE_NEW($phone, $msg, "1207161761199657681");
    
    $_SESSION['name'] = $name;
    $result = array( 'response' => '1', 'accountId' => $account_id);

	}



   } 
    catch(PDOException $e) #try 1
    {
    $error_msg = "Error: ".$e->getMessage();
    $result = array( 'response' => $error_msg." #2" );
    }

    $conn_pdo = null;

} else { $result = array( 'response' => '0'); /* Account Already Exists*/ } 



} else { $result = array( 'response' => '0' ); /* Variable(s) not found */ } 

echo json_encode($result);

?>