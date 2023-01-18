<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('../../config.php');
$orders_array = array();
$result = array();
$total = 0;



// $data = json_decode(file_get_contents('php://input'), true);

// $accountId = $data['accountId'];
$cart_id = $_POST['cart-id'];



if (isset($cart_id)) {
    // select query
    $sql =  "SELECT * FROM cart where id = '$cart_id' AND checkout = '0'";
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        $rQu = $conn->query("DELETE FROM cart WHERE id = '$cart_id' AND checkout = '0'");
        $result = array('response' => '1');
    } else {
        $result = array('response' => 'cart id not matched with checkout 0');
    }
} else {
    $result = array('response' => '0');
}



echo json_encode($result);
