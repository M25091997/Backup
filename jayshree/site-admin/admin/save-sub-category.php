<?php session_start(); ?>
<?php include ('../../config.php');


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO category ( name, slug, super_category_id ) VALUES ( :name, :slug, :super_category_id )");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':super_category_id', $super_category_id);

    $name = $_POST['name'];
    $slug = slugify($_POST['name']);
    $super_category_id = slugify($_POST['super_category_id']);

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { header("Location: new-sub-category.php"); }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>