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

        $rating = $data['rating'];
        $comment = $data['comment'];
        $slug = $data['slug'];
        $accountId = $data['accountId'];
        $yr = date("Y-m-d");
        $tm = date("h:i:sa");

$result = array();

if (isset($rating) && isset($slug) && isset($comment) && isset($accountId) ) {

/*Adding*/

$p_check = $conn -> query("SELECT * FROM ratings WHERE account_id = '$accountId' && item_slug = '$slug' ");
$count = mysqli_num_rows($p_check);

if($count > 0){
$update_rating = $conn -> query("UPDATE ratings SET rating = '$rating', comment = '$comment' WHERE account_id = '$accountId' && item_slug = '$slug' ");
 if($update_rating){
   $result = array( 'response' => '1' ); 
}else{
    $result = array( 'response' => '0' );
}


}else{

try {
        $conn_P = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

        // set the PDO error mode to exception

        $conn_P->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         // prepare sql and bind parameters

        $stmt = $conn_P -> prepare("INSERT INTO ratings (account_id, rating, comment, item_slug, date_creation, time_creation) VALUES (:account_id, :rating, :comment, :slug, :yr, :tm)");

        $stmt->bindParam(':account_id', $accountId);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':slug', $slug);
        $stmt->bindParam(':yr', $yr);
        $stmt->bindParam(':tm', $tm);

    /*Checking Stock then executing*/
    $flag = $stmt -> execute();

    if ($flag) { $result = array( 'response' => '1' ); }

    }

    catch(PDOException $e)

        {
        echo "Error: ".$e->getMessage();
        }

    $conn_P = null;
 }

} else { $result = array( 'response' => '0' ); /* Post Vars Not Found */ } 

echo json_encode($result);