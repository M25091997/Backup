<?php
session_start();
header('Access-Control-Allow-Origin: *');
include('config.php');

$result = array();

$data = json_decode(file_get_contents('php://input'), true);
$item_id = $data['productid'];


if (isset($item_id) && isset($item_id) != "" ) {

   	$attr_query = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id'");
                while ($attr_D = mysqli_fetch_array($attr_query)) { 

				$attr_name = $attr_D['name'];
				$attr_price = $attr_D['price'];

				array_push($result, array('id' => $attr_D['id'], 'name' => $attr_D['name'], 'price' => $attr_D['price'], 'mrp' => $attr_D['mrp'], 'off' => $attr_D['discount'], 'stock' => $attr_D['stock'] ));

                }

} else { array_push($result, array('Error' => "NO POST VARS FOUND")); }

echo json_encode($result);

?>