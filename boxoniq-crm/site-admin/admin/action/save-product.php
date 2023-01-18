<?php session_start(); ?>
<?php include('../../../config.php');

// print_r($_POST);
// exit();


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo->prepare("INSERT INTO items ( name, hindi_name, slug, details, media_number, category_id, creation_date, corporate_id ) VALUES ( :name, :hindi_name, :slug, :details, :media_n, :cid, :creation_date, :corporate_id )");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':hindi_name', $hindi_name);

    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':details', $details);
    $stmt->bindParam(':media_n', $mn);
    $stmt->bindParam(':cid', $category_id);
    $stmt->bindParam(':creation_date', $creation_date);
    $stmt->bindParam(':corporate_id', $corporate_id);


    $name = $_POST['name'];
    $hindi_name = $_POST['hindi_name'];

    $slug = slugify($_POST['name']);
    $details = $_POST['description'];
    $mn = $_POST['media-number-p'];
    $category_id = $_POST['category_id'];
    $creation_date = date('Y-m-d');
    $corporate_id = $_POST['corporate_id'];


    $execution_flag = $stmt->execute(); // Executing the query

    if ($execution_flag) {
        $item_id = $conn_pdo->lastInsertId();

        $stmt_attr = $conn_pdo->prepare("INSERT INTO attributes ( name, item_id, slug, price, mrp, discount, media_number, stock, expiry_date ) VALUES ( :name, :item_id, :attr_slug, :price, :mrp, :discount, :media_number, :stock, :expiry )");

        $stmt_attr->bindParam(':name', $attr_name);
        $stmt_attr->bindParam(':item_id', $item_id);
        $stmt_attr->bindParam(':attr_slug', $attr_slug);
        $stmt_attr->bindParam(':discount', $discount);
        $stmt_attr->bindParam(':media_number', $media_number);
        $stmt_attr->bindParam(':stock', $stock);
        $stmt_attr->bindParam(':expiry', $expiry);
        $stmt_attr->bindParam(':price', $price);
        $stmt_attr->bindParam(':mrp', $mrp);





        $attr_name = $_POST['attr_name'];
        $attr_slug = slugify($attr_name);
        $price = $_POST['pro_price'];
        $mrp = $_POST['pro_mrp'];
        $discount = $mrp - $price;
        $stock = $_POST['pro_stock'];
        $media_number = $_POST['media-number-p'];
        $expiry = $_POST['expiry'];

        $execution_flag_attr = $stmt_attr->execute(); // Executing the query

        if ($execution_flag_attr) {
            header("Location: ../new-product.php");
        }

        // header("Location: new-product.php"); 

    }
} catch (PDOException $e) #try 1
{
    echo $error_msg = "Error: " . $e->getMessage();
}

$conn_pdo = null;
?>