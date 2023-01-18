<?php
// session_start();
include('../../../config.php');

$result = array();
$url = $site_url.'/img/user/';

$product_id = $_POST['product_id'];

if ( $product_id!="") {

$get_rating_list = $conn -> query("SELECT * FROM ratings INNER JOIN accounts ON ratings.account_id = accounts.id WHERE product_id = '$product_id'");

$count = mysqli_num_rows($get_rating_list);


if (mysqli_num_rows($get_rating_list) > 0) {
	while ( $row_rating = mysqli_fetch_array($get_rating_list) ) {

	$rating_id = $row_rating['id'];
	$comment = $row_rating['comment'];
	$rating = (float)$row_rating['rating'];
	$name = $row_rating['name'];
	$image = $url.$row_rating['profile_img'];

	$trn_date = $row_rating['date_creation'];

	array_push($result, array('rating_id' => $rating_id, 'comment' => $comment, 'rating' => $rating, 'name' => $name, 'image' => $image, 'trn_date' => $trn_date ));
	
	}
	// $result = $x;
}else{ }	
 
	

} else {  }

echo json_encode($result);