<?php 

include ("../../../config.php");

if (isset($_POST['deleteFaqSection'])) {
    
  $query = "DELETE FROM faq_section WHERE id =' ".$_POST['del_id']."'";
  $result = mysqli_query($conn, $query);
  if($result){
    $res = array('response' => 1);
    echo json_encode($res);
  }
}

?>