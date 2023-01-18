<?php 
  
include ("../../../config.php");
  

  if (isset($_POST["updateApprovalStatus"])) {
    
    $UserId = $_POST["UserId"];
    $StatusId = $_POST["StatusId"];
    // print_r($_POST);
    // exit();

    $sql = "UPDATE accounts set approve = '$StatusId' WHERE id = '$UserId'";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      $result =  array('response' => 1);
    }

    echo json_encode($result);

  }


?>