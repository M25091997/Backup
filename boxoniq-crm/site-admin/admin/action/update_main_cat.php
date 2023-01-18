<?php session_start(); 

 //*************************************Create a new image from file *********************************

include ("../../../config.php");

// *******************************************Code to save form category*********************************

if (isset($_POST['edit_cat_info'])) {
// print_r($_POST);
// print_r($_FILES);
// exit();
                $update_id = $_POST['cat_edit_id'];
                $cat_edit_name = $_POST['cat_edit_name'];
                $cat_edit_desc = $_POST['cat_edit_desc'];
                $slug = slugify($cat_edit_name);
                $old_photo = $_POST['old_photo'];


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $targetDir = "../../../img/supercat/";
     
   if(!empty($_FILES["cat_edit_img"]["name"])) { 

    $fileName = time().$ad.rand().$_FILES['cat_edit_img']['name'];

    $targetFile = $targetDir.$fileName;
        
            if(move_uploaded_file($_FILES['cat_edit_img']['tmp_name'],$targetFile)){ 
                // prepare sql and bind parameters
                $cat_edit_img = $fileName;

                    $stmt = $conn_pdo -> prepare("UPDATE super_category SET name = :cat_edit_name, image = :image, cat_desc = :cat_desc, slug = :slug WHERE id = :update_id");
                
                $stmt->bindParam(':cat_desc', $cat_edit_desc);
                $stmt->bindParam(':cat_edit_name', $cat_edit_name);
                $stmt->bindParam(':slug', $slug);

                $stmt->bindParam(':update_id', $update_id);

                $stmt->bindParam(':image', $cat_edit_img);

                // $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../new-main-category.php"); }

                } 

        } else{

            $stmt = $conn_pdo -> prepare("UPDATE super_category SET name = :cat_edit_name, image = :image, cat_desc = :cat_desc, slug = :slug WHERE id = :update_id");

                $stmt->bindParam(':cat_desc', $cat_edit_desc);
                $stmt->bindParam(':cat_edit_name', $cat_edit_name);
                $stmt->bindParam(':slug', $slug);

                $stmt->bindParam(':update_id', $update_id);

                $stmt->bindParam(':image', $old_photo);

                // $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../new-main-category.php"); }

        }  

    }

        catch(PDOException $e) #try 1

                {

                echo $error_msg = "Error: ".$e->getMessage();

                }

    $conn_pdo = null;

}







?>