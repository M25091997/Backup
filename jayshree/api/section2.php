<?php

session_start();

include('../inc/app.php');
$result = array();
$msg_query = $conn -> query("SELECT * FROM section_2");

            while ($msg_q = mysqli_fetch_array($msg_query)) {

              $message = $msg_q['file_name'];

              $title = $msg_q['title'];
              $link = $msg_q['link'];

              array_push($result, array('img' => $message, 'title' => $title, 'link' => $link));

}

echo json_encode($result);



?>