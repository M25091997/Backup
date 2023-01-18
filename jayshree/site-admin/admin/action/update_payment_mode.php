<?php

include("../../../config.php");


// if (isset($_POST["updatePaymentMode"])) {

$ProcessId = $_POST["ProcessId"];
$modeId = $_POST["modeId"];
// print_r($_POST);
// die();

$sql = "UPDATE bookings set payment_mode = '$modeId' WHERE process_id = '$ProcessId'";

$run_query = mysqli_query($conn, $sql);

if ($run_query) {
    echo "Payment Mode successfully updated..";
} else {
    echo "Data not updated!";
}
// } else {
//     echo "you are not allowed!";
// }
