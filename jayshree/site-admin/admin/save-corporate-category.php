<?php session_start(); ?>
<?php include('../../config.php');


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo->prepare("INSERT INTO corporate_category ( name, slug, media_number, banner_number ) VALUES ( :name, :slug, :media_number, :banner_number )");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':media_number', $media_number);
    $stmt->bindParam(':banner_number', $banner_number);



    $name = $_POST['name'];
    $slug = slugify($_POST['name']);
    $media_number = $_POST['media_number'];
    $banner_number = $_POST['cat_banner'];



    $execution_flag = $stmt->execute(); // Executing the query

    if ($execution_flag) {
        header("Location: new-corporate-category.php");
    }
} catch (PDOException $e) #try 1
{
    echo $error_msg = "Error: " . $e->getMessage();
}

$conn_pdo = null;
?>