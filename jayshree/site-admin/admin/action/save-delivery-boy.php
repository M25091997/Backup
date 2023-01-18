<?php session_start(); ?>
<?php include('../../../config.php');


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception
    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // prepare sql and bind parameters
    $stmt = $conn_pdo->prepare("INSERT INTO delivery_boy ( name, contact, email, address, landmark, pincode, created_on, media_number ) 
    VALUES ( :name, :contact, :email, :address, :landmark, :pincode, :created_on, :media_number )");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':landmark', $landmark);
    $stmt->bindParam(':pincode', $pincode);
    $stmt->bindParam(':created_on', $created_on);
    $stmt->bindParam(':media_number', $media_number);


    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $landmark = $_POST['landmark'];
    $pincode = $_POST['pincode'];
    // $joining = $_POST['joining'];

    $created_on = date("Y-m-d");
    $media_number = $_POST['media_no'];


    $execution_flag = $stmt->execute(); // Executing the query

    if ($execution_flag) {
        header("Location: ../add-delivery.php");
    }
} catch (PDOException $e) #try 1
{
    echo $error_msg = "Error: " . $e->getMessage();
}

$conn_pdo = null;

?>