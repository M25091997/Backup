<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$result = array();

// $data = json_decode(file_get_contents('php://input'), true);

$account_id = $_POST['account_id'];
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$msg = $_POST['msg'];

    try {

        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

        // set the PDO error mode to exception

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters

        $stmt = $conn->prepare("INSERT INTO enquiry_form_detail (name, phone, email, msg, account_id, created_on) VALUES (:name, :phone, :email, :msg, :account_id, :date_creation)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':msg', $msg);

        $stmt->bindParam(':account_id', $account_id);
        $stmt->bindParam(':date_creation', $date_creation);

        $name = $name;
        $phone = $phone;
        $email = $email;
        $msg = $msg;
        $account_id = $account_id;
        $date_creation = date('Y-m-d h:i:sa');

        $flag = $stmt->execute();

        if ($flag) {
            $result = array('response' => '1', 'msg' => 'Successfully added question');
        } else {
            $result = array('response' => '0', 'msg' => 'Something went wrong');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
   


echo json_encode($result);
