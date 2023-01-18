<?php 
 session_start();
header('Access-Control-Allow-Origin: *'); ?>
<?php include ("config.php"); 

$result = array();

$data = json_decode(file_get_contents('php://input'), true);

$id = $data['supercat'];

$msg_query = $conn -> query("SELECT * FROM super_category WHERE slug = '$id'");	

while ($msg_q = mysqli_fetch_array($msg_query)) {

              $category_id = $msg_q['id'];

	    }

$CQ = $conn -> query("SELECT * FROM category WHERE super_category_id = '$category_id'");

while ($LData = mysqli_fetch_array($CQ)) {
	$sub_cat_id = $LData['id'];
	$msg_query_T = $conn -> query("SELECT * FROM items WHERE sub_category_id = '$sub_cat_id'");

	$total_products = mysqli_num_rows($msg_query_T);

	array_push($result, array('subCatId' => $LData['id'], 'name' => $LData['name'], 'slug' => $LData['slug'], 'total_products' => $total_products));
}

echo json_encode($result);

?>