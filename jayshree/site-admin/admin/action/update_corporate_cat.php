<?php

include("../../../config.php");


if (isset($_POST["updateCorporateCat"])) {
    // print_r($_POST);
    // exit();

    $name = $_POST["name"];
    $media_number_edit = $_POST["media_number_edit"];
    $cat_banner_edit = $_POST["cat_banner_edit"];
    $update_id = $_POST["update_id"];

    if ($_POST['old_banner'] != "") {
        $cat_banner_edit = $_POST['old_banner'];
    }

    if ($_POST['old_logo'] != "") {
        $media_number_edit = $_POST['old_logo'];
    }
    // print_r($media_number_edit);echo '<br>';
    // print_r($cat_banner_edit);

    // exit();

    $sql = "UPDATE corporate_category set name = '$name', media_number = '$media_number_edit', banner_number = '$cat_banner_edit' WHERE id = '$update_id'";

    $run_query = mysqli_query($conn, $sql);

    if ($run_query) {
        header("Location: ../new-corporate-category.php");
    }
}
