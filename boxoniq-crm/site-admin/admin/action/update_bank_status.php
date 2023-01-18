<?php 
  
include ("../../../config.php");
  

  if (isset($_POST["updateBankStatus"])) {
    
    $ProcessId = $_POST["ProcessId"];
    $StatusId = $_POST["StatusId"];
    // print_r($_POST);
    // exit();

    $sql = "UPDATE bookings set bank_status = '$StatusId' WHERE process_id = '$ProcessId'";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      echo "Bank Status successfully updated..";
    }

  }


?>