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

  if (isset($_POST["updateProductPriority"])) {
    
    $item_id = $_POST["item_id"];
    $prior_id = $_POST["prior_id"];
    // print_r($_POST);
    // exit();

    $sql = "UPDATE items set priority_no = '$prior_id' WHERE id = '$item_id'";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      // $result =  array('response' => 1);
      echo "Priority Successfully Updated";
    }

    // echo json_encode($result);

  }

  if (isset($_POST["updateWalletUser"])) {
    
    $wallet_id = $_POST["wallet_id"];
    $prior_id = $_POST["prior_id"];
    
    // print_r($_POST);
    // exit();

    $get_wallet = $conn -> query("SELECT * FROM wallet WHERE id = '$wallet_id'");
    $row_wallet = mysqli_fetch_assoc($get_wallet);
    $wallet_amount = $row_wallet['amount'];

    $new_amt = $wallet_amount + $prior_id;

    // if($prior_id > $wallet_amount){
      $sql = "UPDATE wallet set amount = '$new_amt' WHERE id = '$wallet_id'";
      $run_query = mysqli_query($conn,$sql);

      $his_amount = $prior_id;

    $created_on = date("Y-m-d h:i:sa");
    $msg = "Rs. ".$his_amount." Cash Back Added in your wallet";
      $sql_history = "INSERT INTO `wallet_history`(`wallet_id`, `amount`, `tran_id`, `type`, `msg`, `created_on`) VALUES ('$wallet_id','$his_amount','TXNADMIN','credit','$msg','$created_on')";
      $run_query_his = mysqli_query($conn,$sql_history);
  
      if ($run_query && $run_query_his) {
        // $result =  array('response' => 1);
        echo "Wallet Successfully Updated";
      }else{
        echo "Something went wrong";
      }

    // }else{
    //   echo "Amount should be greator than existing wallet amount";
    // }

   

    // echo json_encode($result);

  }


?>