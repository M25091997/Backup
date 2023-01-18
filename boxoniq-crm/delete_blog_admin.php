<?php 

 include ('../../../config.php');

    $BlogId = $_GET["blog_id"];

    $sql = "DELETE FROM `blog` WHERE id = '$BlogId' ";

    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {

      header("Location: ../view-blog.php");

    }

  

?>