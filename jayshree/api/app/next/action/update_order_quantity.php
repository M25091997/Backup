<?php 
  
  include ('../config.php');


  if (isset($_POST["updateOrderQuantity"])) {
    
    $qty = $_POST["qty"];
    $cart_id = $_POST["cart_id"];
    // $settle_status = 1;


    $sql = "UPDATE cart set quantity = '$qty' WHERE id = '$cart_id' ";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      echo "Quantity Updated Successfully..";

    }

  }

  if (isset($_POST["updatePujaPriority"])) {
    
    $prior_id = $_POST["prior_id"];
    $puja_id = $_POST["puja_id"];
    // $settle_status = 1;


    $sql = "UPDATE puja set priority = '$prior_id' WHERE id = '$puja_id' ";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      echo "Puja Priority Updated Successfully..";

    }

  }

  if (isset($_POST["updateBlogPriority"])) {
    
    $prior_id = $_POST["prior_id"];
    $blog_id = $_POST["blog_id"];
    // $settle_status = 1;


    $sql = "UPDATE blog set priority = '$prior_id' WHERE id = '$blog_id' ";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      echo "Blog Priority Updated Successfully..";

    }

  }

  if (isset($_POST["updateGemPriority"])) {
    
    $prior_id = $_POST["prior_id"];
    $gem_id = $_POST["gem_id"];
    // $settle_status = 1;


    $sql = "UPDATE gem_stones set priority = '$prior_id' WHERE id = '$gem_id' ";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      echo "Gem Priority Updated Successfully..";

    }

  }

  if (isset($_POST["updateDonationPriority"])) {
    
    $prior_id = $_POST["prior_id"];
    $donation_id = $_POST["donation_id"];
    // $settle_status = 1;


    $sql = "UPDATE donation set priority = '$prior_id' WHERE id = '$donation_id' ";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      echo "Donation Priority Updated Successfully..";

    }

  }

  if (isset($_POST["updateStoryPriority"])) {
    
    $prior_id = $_POST["prior_id"];
    $astro_id = $_POST["astro_id"];
    // $settle_status = 1;


    $sql = "UPDATE stories set priority = '$prior_id' WHERE id = '$astro_id' ";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      echo "Story Priority Updated Successfully..";

    }

  }

  if (isset($_POST["updateVideoPriority"])) {
    
    $prior_id = $_POST["prior_id"];
    $astro_id = $_POST["astro_id"];
    // $settle_status = 1;


    $sql = "UPDATE blog_video set priority = '$prior_id' WHERE id = '$astro_id' ";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      echo "Video Priority Updated Successfully..";

    }

  }

  if (isset($_POST["updateTestimonialPriority"])) {
    
    $prior_id = $_POST["prior_id"];
    $astro_id = $_POST["astro_id"];
    // $settle_status = 1;


    $sql = "UPDATE testimonial_video set priority = '$prior_id' WHERE id = '$astro_id' ";
    
    $run_query = mysqli_query($conn,$sql);

    if ($run_query) {
      echo "Testimonial Video Priority Updated Successfully..";

    }

  }

?>