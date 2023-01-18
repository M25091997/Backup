<?php 
  
include ("../../../config.php");
  

  if (isset($_POST["updateDelBoy"])) {
    // print_r($_POST);
    // exit();
    
    $name = $_POST["name"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $landmark = $_POST["landmark"];
    $pincode = $_POST["pincode"];
    $update_id = $_POST["update_id"];

    $sql = "UPDATE delivery_boy set name = '$name', contact = '$contact', email = '$email', address = '$address', landmark = '$landmark', pincode = '$pincode' WHERE id = '$update_id'";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      header("Location: ../add-delivery.php");
      
    }

  }


?>