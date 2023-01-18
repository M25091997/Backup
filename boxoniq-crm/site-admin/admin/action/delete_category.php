<?php 

include ("../../../config.php");

if (isset($_POST['deleteSuperCategory'])) {
    
  $query = "DELETE FROM super_category WHERE id =' ".$_POST['del_id']."'";
  $result = mysqli_query($conn, $query);
  if($result){
    $res = array('response' => 1);
    echo json_encode($res);
  }
}

if (isset($_POST['deleteSubCategory'])) {
    
  $query = "DELETE FROM category WHERE id =' ".$_POST['del_id']."'";
  $result = mysqli_query($conn, $query);
  if($result){
    $res = array('response' => 1);
    echo json_encode($res);
  }
}

?>