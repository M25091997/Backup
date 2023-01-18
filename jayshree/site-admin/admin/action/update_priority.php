<?php 
  
include ("../../../config.php");
  

  if (isset($_POST["updateCategoryPriority"])) {
    
    $category_id = $_POST["category_id"];
    $prior_id = $_POST["prior_id"];
    // print_r($_POST);
    // exit();

    $sql = "UPDATE super_category set priority_no = '$prior_id' WHERE id = '$category_id'";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      // $result =  array('response' => 1);
      echo "Priority Successfully Updated";
    }

    // echo json_encode($result);

  }

  if (isset($_POST["updateCorporateCategoryPriority"])) {
    
    $corporate_category_id = $_POST["corporate_category_id"];
    $prior_id = $_POST["prior_id"];
    // print_r($_POST);
    // exit();

    $sql = "UPDATE corporate_category set priority_no = '$prior_id' WHERE id = '$corporate_category_id'";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      // $result =  array('response' => 1);
      echo "Corporate Priority Successfully Updated";
    }

    // echo json_encode($result);

  }


?>