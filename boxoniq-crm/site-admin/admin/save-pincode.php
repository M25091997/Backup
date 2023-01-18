<?php session_start(); ?>
<?php include ('../../config.php');


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO pincode ( pincode, price, delivery, media_number ) VALUES ( :pincode, :price, :delivery, :media_number )");

    $stmt->bindParam(':pincode', $pincode);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':delivery', $delivery);
    $stmt->bindParam(':media_number', $media_number);

    $pincode = $_POST['pincode'];
    $price = $_POST['price'];
    $delivery = $_POST['delivery'];
    $media_number = $_POST['media-number'];

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { echo 1; } else { echo "error"; }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>