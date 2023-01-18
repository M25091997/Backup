<?php session_start();
header('Access-Control-Allow-Origin: *'); ?>
<?php include ("config.php"); 

$result = array();

$CQ = $conn -> query("SELECT * FROM super_category");

while ($LData = mysqli_fetch_array($CQ)) {
	array_push($result, array('superCatId' => $LData['id'], 'name' => $LData['name'], 'slug' => $LData['slug'], 'icon' => $site_url."/api/app/icons/".$LData['icon_new'], 'coming-soon' => $LData['coming_soon']));
}

echo json_encode($result);

?>