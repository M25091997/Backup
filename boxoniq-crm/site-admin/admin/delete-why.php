<?php 

session_start();

include ("../../config.php");

include ("../../variables.php");



if (!isset($_SESSION['username']) && !isset($_SESSION['name'])) {

  ?>

  <script type="text/javascript">

    window.location.href="index.php";

  </script>

  <?php

}

else{





  $ad_id = $_GET['id'];



	$q_delete = $conn -> query("DELETE FROM super_category WHERE id = '$ad_id'");



	if ($q_delete) {

		echo "Super Category Successfully Deleted!";



      ?>

  <script type="text/javascript">

    window.location.href="new-main-category.php";

  </script>

  <?php



	} else{ 



echo mysqli_error($conn);



	}



} 

?>