<?php 
  
include ("../../../config.php");
  

  if (isset($_POST["updateUserData"])) {
    // print_r($_POST);
    // exit();
    
    $user_name = $_POST["user_name"];
    $phone = $_POST["user_phone"];
    $address = $_POST["user_address"];
    $shop_name = $_POST["user_shop"];
    $update_id = $_POST["user_id"];

    $update_acc = $conn -> query("UPDATE accounts SET name = '$user_name', phone = '$phone', shop_name = '$shop_name', full_address = '$address' WHERE id = '$update_id'");
    // exit();
    if ($update_acc) {
      $result = array('response' => 1);
    }
    echo json_encode($result);
  }

?>