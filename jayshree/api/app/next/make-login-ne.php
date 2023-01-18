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

$email = $data['login_email'];
$password = $data['login_password'];

$email1 = rtrim($email);
$password1 = rtrim($password);

try {

    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // prepare sql and bind parameters

    $stmt = $conn->prepare("SELECT Count(*) AS count_num FROM accounts WHERE email = :email AND password = :password AND verification = '1'");

    $stmt->bindParam(':email', $email1);
    $stmt->bindParam(':password', $password1);
    

$flag = $stmt -> execute();

if ( $flag ) { 
	$row = $stmt->fetch();
	$count_num = $row['count_num'];
	if($count_num > 0){

    $stmt_user = $conn->prepare("SELECT * FROM accounts WHERE email = :email AND password = :password AND verification = '1'");

    $stmt_user->bindParam(':email', $email1);
    $stmt_user->bindParam(':password', $password1);

	$flag_user = $stmt_user -> execute();
	if($flag_user){
		$row_user = $stmt_user->fetch();
		$account_id = $row_user['id'];
		$name = $row_user['name'];
		$phone = $row_user['phone'];
		$email = $row_user['email'];
		$address = $row_user['full_address'];

		$result = array( 'response' => '1', 'accountId' => $account_id, 'address' => $address, 'name' => $name, 'email' => $email, 'phone' => $phone);

	}else{
		$result = array('response' => '0');

	}

	}else{
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



// $account_arr = $conn -> query("SELECT * FROM accounts WHERE email = '$email1' AND password = '$password1' AND verification = '1'");

// $account_arr2 = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone' AND password = '$password'");

// if ( mysqli_num_rows($account_arr) != 0 ) {

// 	if( mysqli_num_rows($account_arr) != 0 ){
// 	while ( $row = mysqli_fetch_array($account_arr) ) {

// 	$account_id = $row['id'];
// 	$address = $row['full_address'];
// 	$name = $row['name'];
// 	$email = $row['email'];
// 	$phone = $row['phone'];

// 	}
// 	}


// 	$result = array( 'response' => '1', 'accountId' => $account_id, 'address' => $address, 'name' => $name, 'email' => $email, 'phone' => $address);

// } else {$result = array( 'response' => '0'); }

echo json_encode($result);