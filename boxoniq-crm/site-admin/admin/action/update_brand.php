<?php session_start(); 

 //*************************************Create a new image from file *********************************

include ("../../../config.php");

// *******************************************Code to save form category*********************************

if (isset($_POST['edit_brand_info'])) {
// print_r($_POST);
// print_r($_FILES);
// exit();
                $update_id = $_POST['brand_edit_id'];
                $brand_edit_name = $_POST['brand_edit_name'];
                $slug = slugify($brand_edit_name);
                $old_photo = $_POST['old_photo'];


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $targetDir = "../../../img/brand/";
     
   if(!empty($_FILES["brand_edit_img"]["name"])) { 

    $fileName = time().$ad.rand().$_FILES['brand_edit_img']['name'];

    $targetFile = $targetDir.$fileName;
        
            if(move_uploaded_file($_FILES['brand_edit_img']['tmp_name'],$targetFile)){ 
                // prepare sql and bind parameters
                $brand_edit_img = $fileName;

                    $stmt = $conn_pdo -> prepare("UPDATE brand SET brand_name = :brand_edit_name, slug = :slug, brand_img = :image, created_on = :created_on WHERE id = :update_id");
                
                $stmt->bindParam(':brand_edit_name', $brand_edit_name);
                $stmt->bindParam(':slug', $slug);

                $stmt->bindParam(':update_id', $update_id);
                $stmt->bindParam(':created_on', $created_on);

                $stmt->bindParam(':image', $brand_edit_img);

                $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../new-brand.php"); }

                } 

        } else{

            $stmt = $conn_pdo -> prepare("UPDATE brand SET brand_name = :brand_edit_name, slug = :slug, brand_img = :image, created_on = :created_on WHERE id = :update_id");

                $stmt->bindParam(':brand_edit_name', $brand_edit_name);
                $stmt->bindParam(':slug', $slug);

                $stmt->bindParam(':update_id', $update_id);
                $stmt->bindParam(':created_on', $created_on);

                $stmt->bindParam(':image', $old_photo);

                $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../new-brand.php"); }

        }  

    }

        catch(PDOException $e) #try 1

                {

                echo $error_msg = "Error: ".$e->getMessage();

                }

    $conn_pdo = null;

}







?>