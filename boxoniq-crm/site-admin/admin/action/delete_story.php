<?php 

include ("../../../config.php");

if (isset($_POST['deleteStory'])) {
    
  $query = "DELETE FROM story WHERE id =' ".$_POST['del_id']."'";
  $result = mysqli_query($conn, $query);
  if($result){
    $res = array('response' => 1);
    echo json_encode($res);
  }
}

?>