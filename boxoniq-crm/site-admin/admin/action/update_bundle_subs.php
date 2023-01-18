<?php session_start(); 

 //*************************************Create a new image from file *********************************

include ("../../../config.php");

// *******************************************Code to save form category*********************************

if (isset($_POST['edit_bundle_info'])) {
// print_r($_POST);
// print_r($_FILES);
// exit();
                $update_id = $_POST['bundle_edit_id'];
                $bundle_edit_name = $_POST['bundle_edit_name'];
                $bundle_edit_desc = $_POST['bundle_edit_desc'];
                
                $slug = slugify($bundle_edit_name);
                $old_photo = $_POST['old_photo'];


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $targetDir = "../../../img/bundle/";
     
   if(!empty($_FILES["bundle_edit_img"]["name"])) { 

    $fileName = time().rand().$_FILES['bundle_edit_img']['name'];

    $targetFile = $targetDir.$fileName;
        
            if(move_uploaded_file($_FILES['bundle_edit_img']['tmp_name'],$targetFile)){ 
                // prepare sql and bind parameters
                $bundle_edit_img = $fileName;

                    $stmt = $conn_pdo -> prepare("UPDATE bundle_benefit SET name = :bundle_edit_name, slug = :slug, image = :bundle_image, bundle_desc = :bundle_edit_desc WHERE id = :update_id");
                
                $stmt->bindParam(':bundle_edit_name', $bundle_edit_name);
                $stmt->bindParam(':bundle_edit_desc', $bundle_edit_desc);

                $stmt->bindParam(':slug', $slug);

                $stmt->bindParam(':update_id', $update_id);
                // $stmt->bindParam(':created_on', $created_on);

                $stmt->bindParam(':bundle_image', $bundle_edit_img);

                // $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../bundle-subscription-benefit.php"); }

                } 

        } else{


            $stmt = $conn_pdo -> prepare("UPDATE bundle_benefit SET name = :bundle_edit_name, slug = :slug, image = :bundle_image, bundle_desc = :bundle_edit_desc WHERE id = :update_id");
                
                $stmt->bindParam(':bundle_edit_name', $bundle_edit_name);
                $stmt->bindParam(':bundle_edit_desc', $bundle_edit_desc);

                $stmt->bindParam(':slug', $slug);

                $stmt->bindParam(':update_id', $update_id);
                // $stmt->bindParam(':created_on', $created_on);

                $stmt->bindParam(':bundle_image', $old_photo);

                // $created_on = date("Y-m-d h:i:sa");
                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../bundle-subscription-benefit.php"); }

        }  

    }

        catch(PDOException $e) #try 1

                {

                echo $error_msg = "Error: ".$e->getMessage();

                }

    $conn_pdo = null;

}







?>