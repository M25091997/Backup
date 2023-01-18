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

?>

<!DOCTYPE html>

<html>

<head>

  <title>DEFAULT PINCODES LIST</title>

  <!--Font-->

<link href='//fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>



<!-- JQUERY-->

<script src="//code.jquery.com/jquery-2.2.3.min.js"></script>



<!--Live Form-->

<script src="../../assets/js/liveform.js"></script>



<!--Drop Zone-->

<script src="../../assets/js/dropzone.js"></script>

<link rel="stylesheet" href="../../assets/css/dropzone.css">



<!--Latest compiled and minified CSS-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css" crossorigin="anonymous">



<!--Latest compiled and minified JavaScript-->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>



<!--FONT AWESOME-->

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">



<!--VIEWPORT-->

<meta name="viewport" content="width=device-width, initial-scale=1">





</script>



<style type="text/css">

  body{

    background-color: #efefef;

  }

</style>


<!-- Floating Button -->


<style type="text/css">
  .float{
  position:fixed;
  width:60px;
  height:60px;
  bottom:40px;
  right:40px;
  background-color:#000;
  color:#FFF;
  border-radius:50px;
  text-align:center;
  box-shadow: 2px 2px 3px #999;
}

.my-float{
  margin-top:22px;
}
</style>

<!-- Floating Button ENDS-->

</head>

<body style="background-color: #fff;">
<!-- Code begins here -->

<a href="index.php" class="float">
<i class="fa fa-home my-float"></i>
</a>

<!-- Code ENDS here -->
<div class="container" style="background-color: #fff;">

  

  <div class="row">

<div class="col-md-3">
    


  </div>

  <?php       


                                
                                $sel_grocery = "SELECT * FROM home_sliders where id ='1'";
                                $run_enquiry_grocery = mysqli_query($conn,$sel_grocery);
                               
                                if (mysqli_num_rows($run_enquiry_grocery)>0) {
                                foreach ($run_enquiry_grocery as $row_grocery) {
                                    
                                    $sliders_grocery = $row_grocery['sliders'];
                                    
                                   }
                               }

                               $sel_ladies = "SELECT * FROM home_sliders where id ='2'";
                                $run_enquiry_ladies = mysqli_query($conn,$sel_ladies);
                               
                                if (mysqli_num_rows($run_enquiry_ladies)>0) {
                                foreach ($run_enquiry_ladies as $row_ladies) {
                                    
                                    $sliders_ladies = $row_ladies['sliders'];
                                    
                                   }
                               }

                               $sel_beauty = "SELECT * FROM home_sliders where id ='3'";
                                $run_enquiry_beauty = mysqli_query($conn,$sel_beauty);
                               
                                if (mysqli_num_rows($run_enquiry_beauty)>0) {
                                foreach ($run_enquiry_beauty as $row_beauty) {
                                    
                                    $sliders_beauty = $row_beauty['sliders'];
                                    
                                   }
                               }

                               $sel_health = "SELECT * FROM home_sliders where id ='4'";
                                $run_enquiry_health = mysqli_query($conn,$sel_health);
                               
                                if (mysqli_num_rows($run_enquiry_health)>0) {
                                foreach ($run_enquiry_health as $row_health) {
                                    
                                    $sliders_health = $row_health['sliders'];
                                    
                                   }
                               }

                               $sel_wash = "SELECT * FROM home_sliders where id ='5'";
                                $run_enquiry_wash = mysqli_query($conn,$sel_wash);
                               
                                if (mysqli_num_rows($run_enquiry_wash)>0) {
                                foreach ($run_enquiry_wash as $row_wash) {
                                    
                                    $sliders_wash = $row_wash['sliders'];
                                    
                                   }
                               }

                                

  ?>

  <div class="col-md-6">
    

  <h2>Grocery Home Slider</h2>

  <form action="save-home-grocery.php" method="POST">

    <input type="hidden" name="slider_id" value="1">
    
    <h3>Item IDs</h3>
    <input type="text" value="<?php echo($sliders_grocery) ?>" name="sliders" placeholder="Enter Comma Separated Item IDs" class="form-control"> <br>


    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Add Grocery Items </button>
  </form>

  <hr>

  <h2>Ladies Wear Home Slider</h2>

  <form action="save-home-ladies.php" method="POST">
    <input type="hidden" name="slider_id" value="2">
    
    <h3>Pincode</h3>
    <input type="text" value="<?php echo($sliders_ladies) ?>" name="sliders" placeholder="Enter Comma Separated Item IDs" class="form-control"> <br>


    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Add Ladies Wear </button>
  </form>



  <hr>

  <h2>Health Drink & Supplements Home Slider</h2>

  <form action="save-home-health.php" method="POST">
    <input type="hidden" name="slider_id" value="4">
    
    <h3>Pincode</h3>
    <input type="text" name="sliders" value="<?php echo($sliders_health) ?>" placeholder="Enter Comma Separated Item IDs" class="form-control"> <br>


    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Add Health Drinks </button>
  </form>


  <hr>

  <h2>Cosmetics Home Slider</h2>

  <form action="save-home-beauty.php" method="POST">
    <input type="hidden" name="slider_id" value="3">
    
    <h3>Pincode</h3>
    <input type="text" value="<?php echo($sliders_beauty) ?>" name="sliders" placeholder="Enter Comma Separated Item IDs" class="form-control"> <br>


    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Add Cosmetics </button>
  </form>


  <h2>Cleaning & Household Home Slider</h2>

  <form action="save-home-wash.php" method="POST">
    <input type="hidden" name="slider_id" value="5">
    
    <h3>Pincode</h3>
    <input type="text" value="<?php echo($sliders_wash) ?>" name="sliders" placeholder="Enter Comma Separated Item IDs" class="form-control"> <br>


    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Add Washing Items </button>
  </form>


  </div>


  <div class="col-md-3">
    


  </div>


  </div>

</div>

</body>

</html>

<?php } ?>