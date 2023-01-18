<?php session_start(); ?>
<?php include ('../../config.php');

// print_r($_POST);
// exit();


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO faq_section (faq, answer, created_on) VALUES (:faq, :answer, :created_on)");

    $stmt->bindParam(':faq', $faq);
    $stmt->bindParam(':answer', $answer);
    $stmt->bindParam(':created_on', $created_on);


    $faq = $_POST['faq_question'];
    $answer = $_POST['faq_answer'];
    $created_on = date('Y-m-d');

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { header("Location: add-faq-section.php"); }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>