<?php session_start(); 

 //*************************************Create a new image from file *********************************

include ("../../../config.php");

// *******************************************Code to save form category*********************************

if (isset($_POST['edit_subs_benefit_info'])) {
// print_r($_POST);
// exit();
                $update_id = $_POST['subs_edit_id'];
                $subs_edit_name = $_POST['subs_edit_name'];

try { #try 1

    $conn_pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

    // set the PDO error mode to exception

    $conn_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn_pdo -> prepare("UPDATE subscription_benefit SET benefit = :benefit WHERE id = :update_id");

                $stmt->bindParam(':benefit', $subs_edit_name);

                $stmt->bindParam(':update_id', $update_id);

                // $created_on = date("Y-m-d h:i:sa");

                $execution_flag = $stmt -> execute(); // Executing the query

                if ($execution_flag) { header("Location: ../subscription-benefit.php"); }


    }

        catch(PDOException $e) #try 1

                {

                echo $error_msg = "Error: ".$e->getMessage();

                }

    $conn_pdo = null;

}







?>