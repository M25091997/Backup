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
$question_id = $_POST['question_id'];
$answer = $_POST['answer'];



    try {

        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

        // set the PDO error mode to exception

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters

        $stmt = $conn->prepare("INSERT INTO community_answer (question_id, answer, answer_by, created_on) VALUES (:question_id, :answer, :account_id, :date_creation)");

        $stmt->bindParam(':question_id', $question_id);
        $stmt->bindParam(':answer', $answer);
        $stmt->bindParam(':account_id', $account_id);
        $stmt->bindParam(':date_creation', $date_creation);

        $question_id = $question_id;
        $answer = $answer;
        $account_id = $account_id;
        $date_creation = date('Y-m-d h:i:sa');

        $flag = $stmt->execute();

        if ($flag) {
            $created_on = date('Y-m-d H:i:sa');
            $update_question_time = $conn -> query("UPDATE community_question SET created_on = '$created_on' WHERE id = '$question_id'");
            if($update_question_time){
                $result = array('response' => '1', 'msg' => 'Successfully added question');
            }
        } else {
            $result = array('response' => '0', 'msg' => 'Something went wrong');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
   


echo json_encode($result);
