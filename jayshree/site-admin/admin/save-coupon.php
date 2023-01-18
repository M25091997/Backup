<?php  session_start();

include ("../../config.php");

//Inserting Data

        try {







    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);



    // set the PDO error mode to exception



    $conn_pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    mysqli_set_charset($conn_pdo, "utf8");







     // prepare sql and bind parameters



    $stmt = $conn_pdo->prepare("INSERT INTO coupon ( code, amount, flag, cond, cond_amount, plan, max, date_, text_, start_date, media_number, type ) VALUES (:code, :amount, :flag, :cond, :cond_amount, :plan, :max, :date_, :text_, :start_date, :media_number, :type)");







    $stmt->bindParam(':code', $code);

    

    $stmt->bindParam(':amount', $amount);



    $stmt->bindParam(':flag', $flag);



    $stmt->bindParam(':cond', $cond);



    $stmt->bindParam(':cond_amount', $cond_amount);

    $stmt->bindParam(':plan', $plan);

    $stmt->bindParam(':max', $max);

    $stmt->bindParam(':date_', $date_);

    $stmt->bindParam(':text_', $text_);

    $stmt->bindParam(':start_date', $start_date);

    $stmt->bindParam(':media_number', $media_number);

    $stmt->bindParam(':type', $type);


$code = $_POST['coupon-code'];
$amount = $_POST['amount'];
$flag = $_POST['flag'];
$cond = $_POST['cond'];
$cond_amount = $_POST['cond_amount'];

$plan = 0;
$max = $_POST['max'];
$date_ = $_POST['end-date'];
$text_ = $_POST['text'];

$start_date = $_POST['start-date'];

$media_number = $_POST['media-number'];

$type = $_POST['type'];


$flag = $stmt->execute();













if ($flag) {

    echo "Coupon Generated Successfully!";

}


}







catch(PDOException $e)



    {



    echo "Error: ".$e->getMessage();



    }







$conn_pdo = null;





?>