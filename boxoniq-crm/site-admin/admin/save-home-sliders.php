<?php session_start(); ?>
<?php include ('../../config.php');

$sliders =  $_POST['sliders'];
$slider_id =  $_POST['slider_id'];

if ( $conn -> query("UPDATE home_sliders SET sliders = '$sliders' WHERE id = '$slider_id'") ){ 
        header("Location: default-pincode.php");   
    }else{
        echo "Error not updated..";
    }
?>