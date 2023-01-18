<?php session_start(); 

 //*************************************Create a new image from file *********************************

include ("../../../config.php");

// *******************************************Code to save form category*********************************

if (isset($_POST['edit_subcat_info'])) {
// print_r($_POST);
// exit();
                $update_id = $_POST['cat_edit_id'];
                $cat_edit_name = $_POST['cat_edit_name'];
                $cat_edit_super = $_POST['super_category_id'];
                $slug = slugify($cat_edit_name);


try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn_pdo -> prepare("UPDATE category SET name = :cat_edit_name, slug = :slug, super_category_id = :cat_edit_super WHERE id = :update_id");

                $stmt->bindParam(':cat_edit_super', $cat_edit_super);
                $stmt->bindParam(':cat_edit_name', $cat_edit_name);
                $stmt->bindParam(':slug', $slug);

                $stmt->bindParam(':update_id', $update_id);

                // $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../new-sub-category.php"); }


    }

        catch(PDOException $e) #try 1

                {

                echo $error_msg = "Error: ".$e->getMessage();

                }

    $conn_pdo = null;

}







?>