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

$email = $data['email'];
$user_id = $data['user_id'];
// print_r($_POST);
// exit();


    try {

        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

        // set the PDO error mode to exception

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters

        $stmt = $conn->prepare("INSERT INTO stay_touch (user_id, email, created_on) VALUES (:user_id, :email, :date_creation)");

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':email', $email);

        $stmt->bindParam(':date_creation', $date_creation);

        $date_creation = date('Y-m-d h:i:sa');

        $flag = $stmt->execute();

        if ($flag) {
            $result = array('response' => '1', 'msg' => 'Successfully Added your email..');
        } else {
            $result = array('response' => '0', 'msg' => 'Something went wrong');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
   


echo json_encode($result);
