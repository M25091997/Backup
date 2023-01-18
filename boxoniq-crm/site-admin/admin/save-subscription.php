<?php session_start(); ?>
<?php include ('../../config.php');

// print_r($_POST);
// exit();


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO `subscription_benefit`(`benefit`) VALUES (:benefit)");

    $stmt->bindParam(':benefit', $benefit);

    $benefit = $_POST['benefit'];

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { header("Location: subscription-benefit.php"); }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>