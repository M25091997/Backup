<?php 
include ("config.php");
$Q = $conn -> query("SELECT * FROM items WHERE category_id = '1' ORDER BY id DESC LIMIT 3 ");
$row = mysqli_fetch_assoc($Q);
$hindi = $row['hindi_name'];

        // $hindi = "प्राकृतिक अगरबत्ती";
       echo json_encode(array('res' => $hindi), JSON_UNESCAPED_UNICODE);
        // print_r($hindi);


?>