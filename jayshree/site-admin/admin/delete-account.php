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



	$q_delete = $conn -> query("DELETE FROM account WHERE id = '$ad_id'");



	if ($q_delete) {

		echo "Account Successfully Deleted!";



      ?>

  <script type="text/javascript">

    window.location.href="all-customers.php";

  </script>

  <?php



	} else{ 



echo mysqli_error($conn);



	}



} 

?>