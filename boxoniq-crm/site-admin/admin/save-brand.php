<?php session_start(); ?>
<?php include ('../../config.php');


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO brand ( brand_name, slug, brand_img, created_on ) VALUES ( :name, :slug, :brand_img, :created_on )");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':brand_img', $brand_img);

    $stmt->bindParam(':created_on', $created_on);

    $created_on = date('Y-m-d');


    $name = $_POST['name'];
    $brand_img = $_POST['brand_img'];

    $slug = slugify($_POST['name']);

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { header("Location: new-brand.php"); }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>