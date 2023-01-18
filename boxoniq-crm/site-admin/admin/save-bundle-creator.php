<?php session_start(); ?>
<?php include ('../../config.php');


if(isset($_POST['addBundle'])){
    
    try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("UPDATE bundle_creator SET item_ids = :item_ids, created_on = :created_on WHERE id = 1 ");

    $stmt->bindParam(':item_ids', $item_ids);
    $stmt->bindParam(':created_on', $created_on);


    $item_ids = $_POST['firebase-tokens'];
    $created_on = date('Y-m-d');

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { header("Location: bundle-creator.php"); }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
}


?>