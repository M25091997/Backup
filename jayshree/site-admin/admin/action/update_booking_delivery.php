<?php 
  
include ("../../../config.php");
  

  if (isset($_POST["updateDelBookStatus"])) {
    
    $BookingId = $_POST["BookingId"];
    $StatusId = $_POST["StatusId"];

    $get_del = $conn -> query("SELECT * FROM delivery_boy WHERE id = '$StatusId' ");
    $del_name = mysqli_fetch_assoc($get_del)['name'];

    $sql = "UPDATE bookings set assign_delivery = '$StatusId' WHERE id = '$BookingId'";

    $run_query = mysqli_query($conn,$sql);
    if ($run_query) {
      $result = array("response" => 1, "del_name" => $del_name);
    }

    echo json_encode($result);

  }


?>