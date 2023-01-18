<?php session_start(); ?>
<?php include ('../../config.php');


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo -> prepare("INSERT INTO attributes ( name, item_id, slug, price, availablity, mrp, discount, media_number, stock ) VALUES ( :name, :item_id, :slug, :price, :availablity, :mrp, :discount, :media_number, :stock )");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':item_id', $item_id);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':availablity', $avaiability);
    $stmt->bindParam(':mrp', $mrp);
    $stmt->bindParam(':discount', $discount);
    $stmt->bindParam(':media_number', $media_number);
    $stmt->bindParam(':stock', $stock);
    // $stmt->bindParam(':expiry_date', $expiry_date);
    
    $name = $_POST['name'];
    $item_id = $_POST['item_id'];
    $slug = slugify($_POST['name']);
    $price = $_POST['price'];
    $avaiability = $_POST['avaiability'];
    $mrp = $_POST['mrp'];
    $discount = $_POST['discount'];
    $media_number = $_POST['media-number-p'];
    // $expiry_date = $_POST['expiry'];
    $stock = $_POST['stock'];

    $execution_flag = $stmt -> execute(); // Executing the query

    if ($execution_flag) { header("Location: new-attribute.php"); }

    } 

    catch(PDOException $e) #try 1
    {
    echo $error_msg = "Error: ".$e->getMessage();
    }

    $conn_pdo = null;
?>