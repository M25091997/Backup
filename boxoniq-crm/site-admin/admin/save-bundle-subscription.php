<?php session_start(); ?>
<?php include ('../../config.php');

// print_r($_POST);
// exit();


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO `bundle_benefit`(`name`, `slug`, `image`, `bundle_desc`) VALUES (:name,:slug,:image,:desc)");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':desc', $desc);
    $stmt->bindParam(':image', $image);


    $name = $_POST['name'];
    $desc = $_POST['desc'];

    $image = $_POST['image'];
    $slug = slugify($_POST['name']);

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { header("Location: bundle-subscription-benefit.php"); }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>