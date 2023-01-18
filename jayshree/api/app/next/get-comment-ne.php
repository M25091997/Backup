<?php

header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');

$data = json_decode(file_get_contents('php://input'), true);
$slug = $data['slug'];

$result = array();
$item_slug = $slug;
$Q = $conn -> query("SELECT * FROM ratings WHERE item_slug = '$item_slug' ORDER BY rand() LIMIT 3");
while ($DQ = mysqli_fetch_array($Q)) {

$acc_id = $DQ['account_id'];
$R = $conn -> query("SELECT * FROM accounts WHERE id = '$acc_id'");
$DR = mysqli_fetch_assoc($R);
$name = $DR['name'];


	array_push($result, array('response' => '1', 'name' => $name, 'rating' => $DQ['rating'], 'comment' => $DQ['comment'], 'date_creation' => $DQ['date_creation'], 'time_creation' => $DQ['time_creation'] ));
}
echo json_encode($result);

?>