<?php
include('../config.php');
$search_array = array();

if (isset($_POST['keyword'])) { 

$keyword = $_POST['keyword'];

/*item Search*/
$Q = $conn -> query("SELECT * FROM items WHERE name LIKE '%$keyword%' LIMIT 9");	

while ($QData = mysqli_fetch_array($Q)) {

$name = $QData['name'];
$url = $site_url."/item/".$QData['slug'];
$media_number = $QData['media_number'];
$category_id = $QData['category_id'];

$media_q = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number'");
while ($media_D = mysqli_fetch_array($media_q)) { $image = $site_url."/media/".$media_D['file_name']; }

$CQ = $conn -> query("SELECT * FROM super_category WHERE id = '$category_id'");
while ($CQData = mysqli_fetch_array($CQ)) { $category_name = $CQData['name']; }

array_push($search_array, array('id' => $QData['id'], 'name' => $name, 'url' => $url, 'image' => $image, 'result_type' => 'item', 'category' => $category_name ));


}



/*Super Cat Search*/

$Q = $conn -> query("SELECT * FROM super_category WHERE name LIKE '%$keyword%'");	

while ($QData = mysqli_fetch_array($Q)) {

$name = $QData['name'];
$url = $site_url."/Category/".$QData['slug'];

array_push($search_array, array('id' => $QData['id'], 'name' => $name, 'url' => $url, 'result_type' => 'super_category'));

}


/*Cat Search*/

$Q = $conn -> query("SELECT * FROM category WHERE name LIKE '%$keyword%'");	

while ($QData = mysqli_fetch_array($Q)) {

$name = $QData['name'];
$url = $site_url."/Store/".$QData['slug'];

array_push($search_array, array('id' => $QData['id'], 'name' => $name, 'url' => $url, 'result_type' => 'super_category' ));


}


/*sub Cat Search*/

$Q = $conn -> query("SELECT * FROM category_2 WHERE name LIKE '%$keyword%'");	

while ($QData = mysqli_fetch_array($Q)) {

$name = $QData['name'];
$url = $site_url."/Outlet/".$QData['slug'];

array_push($search_array, array('id' => $QData['id'], 'name' => $name, 'url' => $url, 'result_type' => 'child_category' ));


}




/*sub Cat Search*/

$Q = $conn -> query("SELECT * FROM brand WHERE name LIKE '%$keyword%'");	

while ($QData = mysqli_fetch_array($Q)) {

$name = $QData['name'];
$url = $site_url."/Brand/".$QData['slug'];

array_push($search_array, array('id' => $QData['id'], 'name' => $name, 'url' => $url, 'result_type' => 'brand' ));


}




} else { array_push($search_array, array('response' => '666' )); }

echo json_encode($search_array);

?>