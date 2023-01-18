<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$result = array();

$data = json_decode(file_get_contents('php://input'), true);

// print_r($data);
// exit();


$product_id = $data['product_id'];
// $attribute_id = $data['attribute_id'];
// $attribute_id = '1';

$quantity = $data['qty'];
$account_id = $data['user_id'];
$attribute_id = $data['attr_id'];

// print_r($data);
// exit();

if (isset($account_id)) {

    $get_attr = $conn->query("SELECT * FROM attributes WHERE item_id = '$product_id' && id = '$attribute_id' ORDER BY id ASC LIMIT 1 ");
    $DQ = $get_attr->fetch_assoc();

    $mrp = $DQ['mrp'];
    
    
    $product_price = $DQ['price'];
    $stock = $DQ['stock'];

    $get_category_id = $conn -> query("SELECT category_id FROM items WHERE id = '$product_id'");
    $category_id = mysqli_fetch_assoc($get_category_id)['category_id'];



    // if (($stock - $quantity) >= 0) {

    //ADDING TO THE CART
    try {

        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

        // set the PDO error mode to exception

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // prepare sql and bind parameters

        $stmt = $conn->prepare("INSERT INTO cart (item_id, attribute_id, account_id, date_creation, checkout, quantity, total_amount, mrp, cat_id) 

    VALUES (:item_id, :attribute_id, :account_id, :date_creation, :checkout, :quantity, :total_amount, :mrp, :cat_id)");

        $stmt->bindParam(':item_id', $item_id);
        $stmt->bindParam(':attribute_id', $attribute_id);
        $stmt->bindParam(':account_id', $account_id);
        $stmt->bindParam(':date_creation', $date_creation);
        $stmt->bindParam(':checkout', $checkout);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':mrp', $mrp);
        $stmt->bindParam(':cat_id', $category_id);
        $stmt->bindParam(':total_amount', $total_amount);


        $item_id = $product_id;
        $attribute_id = $attribute_id;
        $account_id = $account_id;
        $date_creation = date('Y-m-d');
        $checkout = 0;
        $quantity = $quantity;
        $total_amount = ($product_price * $quantity);

        $flag = $stmt->execute();

        if ($flag) {
            $result = array('response' => '1');
        } else {
            $result = array('response' => '0');
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
    // } else {
    //     array_push($result,  array('response' => '5', 'stock' => $stock));
    // }
} else {
    array_push($result,  array('response' => 'No Sessions Found'));
}

echo json_encode($result);
