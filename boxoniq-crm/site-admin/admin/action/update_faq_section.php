<?php session_start(); 

 //*************************************Create a new image from file *********************************

include ("../../../config.php");

// *******************************************Code to save form category*********************************

if (isset($_POST['edit_blog_section'])) {
// print_r($_POST);
// exit();
                $update_id = $_POST['faq_edit_id'];
                $faq_edit_faq = $_POST['faq_edit_faq'];
                $faq_edit_answer = $_POST['faq_edit_answer'];

try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn_pdo -> prepare("UPDATE faq_section SET faq = :faq, answer = :answer, created_on = :created_on WHERE id = :update_id");

                $stmt->bindParam(':faq', $faq_edit_faq);
                $stmt->bindParam(':answer', $faq_edit_answer);

                $stmt->bindParam(':update_id', $update_id);
                $stmt->bindParam(':created_on', $created_on);

                $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../add-faq-section.php"); }


    }

        catch(PDOException $e) #try 1

                {

                echo $error_msg = "Error: ".$e->getMessage();

                }

    $conn_pdo = null;

}







?>