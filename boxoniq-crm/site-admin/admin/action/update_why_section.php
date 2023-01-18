<?php session_start(); 

 //*************************************Create a new image from file *********************************

include ("../../../config.php");

// *******************************************Code to save form category*********************************

if (isset($_POST['edit_why_info'])) {
// print_r($_POST);
// print_r($_FILES);
// exit();
                $update_id = $_POST['why_edit_id'];
                $why_edit_desc = $_POST['why_edit_desc'];
                $old_photo = $_POST['old_photo'];


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $targetDir = "../../../img/why/";
     
   if(!empty($_FILES["why_edit_img"]["name"])) { 

    $fileName = time().$ad.rand().$_FILES['why_edit_img']['name'];

    $targetFile = $targetDir.$fileName;
        
            if(move_uploaded_file($_FILES['why_edit_img']['tmp_name'],$targetFile)){ 
                // prepare sql and bind parameters
                $why_edit_img = $fileName;

                    $stmt = $conn_pdo -> prepare("UPDATE why_choose SET why_desc = :why_edit_desc, why_photo = :why_photo WHERE id = :update_id");
                
                $stmt->bindParam(':why_edit_desc', $why_edit_desc);

                $stmt->bindParam(':update_id', $update_id);

                $stmt->bindParam(':why_photo', $why_edit_img);

                // $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../manage-whychoose-section.php"); }

                } 

        } else{

            $stmt = $conn_pdo -> prepare("UPDATE why_choose SET why_desc = :why_edit_desc, why_photo = :why_photo WHERE id = :update_id");
                
                $stmt->bindParam(':why_edit_desc', $why_edit_desc);

                $stmt->bindParam(':update_id', $update_id);

                $stmt->bindParam(':why_photo', $old_photo);

                // $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../manage-whychoose-section.php"); }

        }  

    }

        catch(PDOException $e) #try 1

                {

                echo $error_msg = "Error: ".$e->getMessage();

                }

    $conn_pdo = null;

}







?>