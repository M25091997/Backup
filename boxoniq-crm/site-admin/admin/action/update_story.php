<?php session_start(); 

 //*************************************Create a new image from file *********************************

include ("../../../config.php");

// *******************************************Code to save form category*********************************

if (isset($_POST['edit_story_info'])) {
// print_r($_POST);
// print_r($_FILES);
// exit();
                $update_id = $_POST['story_edit_id'];
                $media_no = $_POST['media_no'];
                $title = $_POST['title'];
                $story = $_POST['story'];
                $slug = slugify($title);

try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $targetDir = "../../../img/stories/";
     
   if(!empty($_FILES["story_image"]["name"])) { 

    $fileName = time().$ad.rand().$_FILES['story_image']['name'];

    $targetFile = $targetDir.$fileName;
        
            if(move_uploaded_file($_FILES['story_image']['tmp_name'],$targetFile)){ 
                // prepare sql and bind parameters
                $story_image = $fileName;
                $insert_media = $conn -> query("INSERT INTO media (file_name, media_number) VALUES ('$story_image', '$media_no')");

                if($insert_media){
                    $stmt = $conn_pdo -> prepare("UPDATE story SET title = :title, media_no = :media_no, story = :story, slug = :slug, created_on = :created_on WHERE id = :update_id");
                
                $stmt->bindParam(':story', $story);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':media_no', $media_no);
                $stmt->bindParam(':slug', $slug);

                $stmt->bindParam(':update_id', $update_id);

                $stmt->bindParam(':created_on', $created_on);

                $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../new-stories.php"); }
                }

                } 

        } else{

            $stmt = $conn_pdo -> prepare("UPDATE story SET title = :title, story = :story, slug = :slug, created_on = :created_on WHERE id = :update_id");

                $stmt->bindParam(':story', $story);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':slug', $slug);

                $stmt->bindParam(':update_id', $update_id);

                $stmt->bindParam(':created_on', $created_on);

                $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../new-stories.php"); }

        }  

    }

        catch(PDOException $e) #try 1

                {

                echo $error_msg = "Error: ".$e->getMessage();

                }

    $conn_pdo = null;

}







?>