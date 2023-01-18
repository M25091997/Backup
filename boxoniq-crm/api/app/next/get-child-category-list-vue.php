<?php session_start();
header('Access-Control-Allow-Origin: *'); ?>
<?php include ("config.php"); 

$result = array();

$_data = json_decode(file_get_contents('php://input'), true);

$id = $_data['subcat'];

$msg_query = $conn -> query("SELECT * FROM category WHERE slug = '$id'");	

while ($msg_q = mysqli_fetch_array($msg_query)) {

              $category_id = $msg_q['id'];

	    }

$CQ = $conn -> query("SELECT * FROM category_2 WHERE category_1_id = '$category_id'");

while ($LData = mysqli_fetch_array($CQ)) {

	$child_cat_id = $LData['id'];

	$msg_query_T = $conn -> query("SELECT * FROM items WHERE category_2_id = '$child_cat_id'");

	$total_products = mysqli_num_rows($msg_query_T);

	array_push($result, array('subCatId' => $LData['id'], 'name' => $LData['name'], 'slug' => $LData['slug'], 'total_products' => $total_products));
}

echo json_encode($result);

?>