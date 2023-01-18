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

$product_id = $data['p_id'];
// $attribute_id = $data['attribute_id'];
$attribute_id = '1';

$product_price = $data['p_price'];
$quantity = $data['p_qty'];
$account_id = $data['account_id'];
$mrp = $product_price;


if (isset($account_id)) {

    // $check_stock = $conn -> query("SELECT * FROM attributes WHERE id = '$attribute_id'");
    // $DQ = $check_stock -> fetch_assoc();
    // $stock = $DQ['stock'];
    // $mrp = $DQ['mrp'];

    // if (($stock - $quantity) >= 0  ) {

//ADDING TO THE CART
try {

    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // prepare sql and bind parameters

    $stmt = $conn->prepare("INSERT INTO cart (item_id, attribute_id, account_id, date_creation, checkout, quantity, total_amount, mrp) 

    VALUES (:item_id, :attribute_id, :account_id, :date_creation, :checkout, :quantity, :total_amount, :mrp)");

    $stmt->bindParam(':item_id', $item_id);
    $stmt->bindParam(':attribute_id', $attribute_id);
    $stmt->bindParam(':account_id', $account_id);
    $stmt->bindParam(':date_creation', $date_creation);
    $stmt->bindParam(':checkout', $checkout);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':mrp', $mrp);
    $stmt->bindParam(':total_amount', $total_amount);


$item_id = $product_id;
$attribute_id = $attribute_id;
$account_id = $account_id;
$date_creation = date('Y-m-d');
$checkout = 0;
$quantity = $quantity;
$total_amount = ( $product_price * $quantity );

$flag = $stmt -> execute();

if ( $flag ) { $result = array('response' => '1'); }
else {$result = array('response' => '0'); }

}

catch(PDOException $e)

    {
    echo "Error: ".$e->getMessage();
    }

$conn = null;

// }else{
//    array_push($result,  array('response' => '5', 'stock' => $stock)); 
// }

} else { array_push($result,  array('response' => 'No Sessions Found')); }

echo json_encode($result);