<?php
session_start();
include('../inc/app.php');

$result = array();

$msg_query = $conn -> query("SELECT * FROM main_slider");

            while ($msg_q = mysqli_fetch_array($msg_query)) {
              $message = $msg_q['image_file'];

              array_push($result, array('img' => $message));
}


echo json_encode($result);

?>