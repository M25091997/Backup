<?php

include("../../../config.php");


if (isset($_POST["updateDeliveryData"])) {
    // print_r($_POST);
    // exit();


    $user_name = $_POST["user_name"];
    $phone = $_POST["user_phone"];
    $address = $_POST["user_address"];
    $shop_name = $_POST["user_shop"];
    $user_id = $_POST["user_id"];
    $user_tran = $_POST["user_tran"];

    $update_acc = $conn->query("UPDATE saved_address SET full_address = '$address', mobile = '$phone', shop_name = '$shop_name', transport = '$user_tran' WHERE id = '$user_id'");
    // exit();
    if ($update_acc) {
        $result = array('response' => 1);
    }
    echo json_encode($result);
}
