<?php
include('config.php');
header('Access-Control-Allow-Origin: *');
$search_array = array();

$data = json_decode(file_get_contents('php://input'), true);
$keyword = $data['searchTerm'];

if (isset($keyword)) { 

// $keyword = $_POST['keyword'];

/*item Search*/
// $Q = $conn -> query("SELECT * FROM items WHERE name LIKE '%$keyword%' LIMIT 9");	
$Q = $conn -> query("SELECT * FROM items WHERE name LIKE '%$keyword%'");	

while ($QData = mysqli_fetch_array($Q)) {

$name = $QData['name'];
$slug = $QData['slug'];
$item_id = $QData['id'];
$url = $site_url."/item/".$QData['slug'];
$media_number = $QData['media_number'];
$category_id = $QData['category_id'];

$CPrice = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id'");
while ($CPriceData = mysqli_fetch_array($CPrice)) { $price = $CPriceData['price']; }

$media_q = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number'");
while ($media_D = mysqli_fetch_array($media_q)) { $image = $site_url."/media/".$media_D['file_name']; }

$media_q_c = $conn -> query("SELECT * FROM cover_media WHERE media_number = '$media_number'");
                if (mysqli_num_rows($media_q_c) != 0) {
                  while ($media_D_c = mysqli_fetch_array($media_q_c)) {
                  $image = $site_url."/media/".$media_D_c['file_name'];
                }
                }

$CQ = $conn -> query("SELECT * FROM super_category WHERE id = '$category_id'");
while ($CQData = mysqli_fetch_array($CQ)) { $category_name = $CQData['name']; }

array_push($search_array, array('id' => $QData['id'], 'name' => $name, 'slug' => $slug, 'price' => $price, 'url' => $url, 'image' => $image, 'result_type' => 'item', 'category' => $category_name, 'ratings' => 5, 'review' => 2 ));


}



/*Super Cat Search*/

// $Q = $conn -> query("SELECT * FROM super_category WHERE name LIKE '%$keyword%'");	

// while ($QData = mysqli_fetch_array($Q)) {

// $name = $QData['name'];
// $url = $site_url."/Category/".$QData['slug'];

// array_push($search_array, array('id' => $QData['id'], 'name' => $name, 'url' => $url, 'result_type' => 'super_category'));

// }


/*Cat Search*/

// $Q = $conn -> query("SELECT * FROM category WHERE name LIKE '%$keyword%'");	

// while ($QData = mysqli_fetch_array($Q)) {

// $name = $QData['name'];
// $url = $site_url."/Store/".$QData['slug'];

// array_push($search_array, array('id' => $QData['id'], 'name' => $name, 'url' => $url, 'result_type' => 'sub_category_category' ));


// }


/*sub Cat Search*/

// $Q = $conn -> query("SELECT * FROM category_2 WHERE name LIKE '%$keyword%'");	

// while ($QData = mysqli_fetch_array($Q)) {

// $name = $QData['name'];
// $url = $site_url."/Outlet/".$QData['slug'];

// array_push($search_array, array('id' => $QData['id'], 'name' => $name, 'url' => $url, 'result_type' => 'child_category' ));


// }




/*sub Cat Search*/

// $Q = $conn -> query("SELECT * FROM brand WHERE name LIKE '%$keyword%'");	

// while ($QData = mysqli_fetch_array($Q)) {

// $name = $QData['name'];
// $url = $site_url."/Brand/".$QData['slug'];

// array_push($search_array, array('id' => $QData['id'], 'name' => $name, 'url' => $url, 'result_type' => 'brand' ));


// }




} else { array_push($search_array, array('response' => '666' )); }

echo json_encode($search_array);

?>