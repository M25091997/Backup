<?php session_start(); ?>
<?php include ('../../config.php');


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO why_choose ( why_desc, why_photo) VALUES ( :why_desc, :why_photo )");

    $stmt->bindParam(':why_desc', $why_desc);
    $stmt->bindParam(':why_photo', $why_photo);

    $why_desc = $_POST['why_desc'];

    $why_photo = $_POST['why_photo'];

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { header("Location: manage-whychoose-section.php"); }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>