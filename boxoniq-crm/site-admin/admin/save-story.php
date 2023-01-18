<?php session_start(); ?>
<?php include ('../../config.php');

// print_r($_POST);
// exit();


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO story ( title, slug, media_no, story, created_on ) VALUES ( :title, :slug, :media_no, :story, :created_on )");

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':story', $story);
    $stmt->bindParam(':media_no', $media_no);
    $stmt->bindParam(':created_on', $created_on);



    $title = $_POST['title'];
    $story = $_POST['story'];

    $media_no = $_POST['media_no'];
    $slug = slugify($_POST['title']);
    $created_on = date("Y-m-d h:i:sa") ;

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { header("Location: new-stories.php"); }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>