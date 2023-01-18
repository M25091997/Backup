<?php session_start(); ?>
<?php include ('../../config.php');

// print_r($_POST);
// exit();


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("UPDATE contact_detail SET mobile = :mobile, phone = :phone, email = :email");

    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);

    $mobile = $_POST['mobile'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { header("Location: add-contact-detail.php"); }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>