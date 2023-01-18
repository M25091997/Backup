<?php 

include ("../../../config.php");


if (isset($_POST['del_user_id'])) {
    // print_r($_POST['del_user_id']);
    // exit();
    // $sql = "DELETE FROM `blog` WHERE id = '$BlogId' ";
      $query = "DELETE FROM accounts WHERE id =' ".$_POST['del_user_id']."'";
      $result = mysqli_query($conn, $query);
      if($result){
        $res = array('response' => 1);
        echo json_encode($res);
      }
  }

?>