<?php session_start(); ?>
<?php include ('../../config.php');


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO popular_searches ( name ) VALUES ( :name )");

    $stmt->bindParam(':name', $name);

    $name = $_POST['name'];

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { header("Location: popular-searches.php"); }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>