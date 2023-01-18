<?php session_start(); ?>
<?php include ('../../config.php');


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO items ( name, slug, details, media_number, category_id, creation_date, brand_id, sub_category_id, category_2_id, gst ) VALUES ( :name, :slug, :details, :media_n, :cid, :creation_date, :brand_id, :sub_category_id, :category_2_id, :gst )");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':gst', $gst);

    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':details', $details);
    $stmt->bindParam(':media_n', $mn);
    $stmt->bindParam(':cid', $category_id);
    $stmt->bindParam(':creation_date', $creation_date);
    $stmt->bindParam(':brand_id', $brand_id);
    $stmt->bindParam(':sub_category_id', $sub_category_id);
    $stmt->bindParam(':category_2_id', $category_2_id);

    $name = $_POST['name'];
    $gst = $_POST['gst'];

    $slug = slugify($_POST['name']);
    $details = $_POST['description'];
    $mn = $_POST['media-number-p'];
    $category_id = $_POST['category_id'];
    $creation_date = date('Y-m-d');
    // $brand_id = '1';
    $brand_id = $_POST['brand_id'];
    $sub_category_id = $_POST['sub_category_id'];
    $category_2_id = 0;

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { 
        // header("Location: new-product.php"); 
        echo "<script>alert('Product is added Successfully');</script>";
        echo "<script>window.location.href = 'https://cms.cybertizeweb.com/boxoniq-crm/site-admin/admin/new-product'</script>";
    }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>