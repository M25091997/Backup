<?php session_start(); ?>
<?php include ('../../config.php');

// print_r($_POST);
// exit();

try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO slider ( media_number, cat_id, pro_id, slider_type ) VALUES ( :media_number, :cat_id, :pro_id, :slider_type )");

    
    $stmt->bindParam(':media_number', $media_number);
    $stmt->bindParam(':cat_id', $cat_id);
    $stmt->bindParam(':pro_id', $pro_id);
    $stmt->bindParam(':slider_type', $slider_type);

    $media_number = $_POST['media_number'];
    $cat_id = $_POST['category_id'];
    $pro_id = $_POST['product_id'];
    $slider_type = $_POST['slider_type'];

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { header("Location: manage-slider.php"); }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>