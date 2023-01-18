<?php session_start(); ?>
<?php include ('../../config.php');


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $get_sequence = $conn -> query("SELECT sequence FROM super_category ORDER BY id DESC");
    $row_sequence = mysqli_fetch_assoc($get_sequence);
    $sequence = $row_sequence['sequence'];
    // print_r($sequence);
    // exit();
    $new_seq = $sequence + 1;


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO super_category ( name, slug, image, cat_desc, sequence ) VALUES ( :name, :slug, :image, :cat_desc, :sequence )");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':cat_desc', $cat_desc);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':sequence', $new_seq);



    $name = $_POST['name'];
    $cat_desc = $_POST['cat_desc'];

    $image = $_POST['image'];
    $slug = slugify($_POST['name']);

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { header("Location: new-main-category.php"); }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>