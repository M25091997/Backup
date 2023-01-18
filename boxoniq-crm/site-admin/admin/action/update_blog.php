<?php session_start(); 

 //*************************************Create a new image from file *********************************

include ("../../../config.php");

// *******************************************Code to save form category*********************************

if (isset($_POST['edit_blog_info'])) {
// print_r($_POST);
// print_r($_FILES);
// exit();
                $update_id = $_POST['blog_edit_id'];
                $blog_edit_name = $_POST['blog_edit_name'];
                $blog_edit_desc = $_POST['blog_edit_desc'];

                $slug = slugify($blog_edit_name);
                $old_photo = $_POST['old_photo'];


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $targetDir = "../../../img/blog/";
     
   if(!empty($_FILES["blog_edit_img"]["name"])) { 

    $fileName = time().$ad.rand().$_FILES['blog_edit_img']['name'];

    $targetFile = $targetDir.$fileName;
        
            if(move_uploaded_file($_FILES['blog_edit_img']['tmp_name'],$targetFile)){ 
                // prepare sql and bind parameters
                $blog_edit_img = $fileName;

                    $stmt = $conn_pdo -> prepare("UPDATE blog SET title = :blog_edit_name, image = :blog_image, blog_desc = :blog_desc, slug = :slug, created_on = :created_on WHERE id = :update_id");
                
                $stmt->bindParam(':blog_edit_name', $blog_edit_name);
                $stmt->bindParam(':slug', $slug);
                $stmt->bindParam(':blog_desc', $blog_edit_desc);

                $stmt->bindParam(':update_id', $update_id);
                $stmt->bindParam(':created_on', $created_on);

                $stmt->bindParam(':blog_image', $blog_edit_img);

                $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../new-blog.php"); }

                } 

        } else{

            $stmt = $conn_pdo -> prepare("UPDATE blog SET title = :blog_edit_name, image = :blog_image, blog_desc = :blog_desc, slug = :slug, created_on = :created_on WHERE id = :update_id");
                
                $stmt->bindParam(':blog_edit_name', $blog_edit_name);
                $stmt->bindParam(':slug', $slug);
                $stmt->bindParam(':blog_desc', $blog_edit_desc);

                $stmt->bindParam(':update_id', $update_id);
                $stmt->bindParam(':created_on', $created_on);

                $stmt->bindParam(':blog_image', $old_photo);

                $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../new-blog.php"); }

        }  

    }

        catch(PDOException $e) #try 1

                {

                echo $error_msg = "Error: ".$e->getMessage();

                }

    $conn_pdo = null;

}







?>