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

  <title>BANNER MANAGEMENT</title>

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
<div class="container-fluid" style="background-color: #fff;">

  <div class="row"><center><h2>All Banners</h2></center></div>
  <div class="row">
  
    <?php $q = $conn -> query("SELECT * FROM banners WHERE id = '1'"); 
    while ($banner_Data = mysqli_fetch_array($q)) {
      $banner_id = $banner_Data['id'];
      $banner = $site_url."/media/".$banner_Data['file_name'];
      echo "<div class='banner-".$banner_Data['id']."'><center><h2>BANNER".$banner_Data['id']."<button class='btn btn-primary banner-change-btn-".$banner_Data['id']."'>Change</button></h2><a href='".$banner_Data['link']."' target='_blank'><img src='".$banner."' class='img-responsive' /></a></center></div>"; ?>


      <div class="pic-uploader--<?php echo $banner_Data['id']; ?>" style="display: none;">
      <center>
  <h3>Re-Upload Banner <br><span style="font-size: 11px;">Size: 1130x400px</span></h3>
  <form action="parse-banner.php" class="dropzone dropzone-<?php echo $banner_Data['id']; ?> x-magic-form" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

<input type="text" placeholder="Url link" class="link" name="link"/>
<input type="hidden" value="<?php echo $banner_id; ?>" name="banner-id"/>

</form> 

<script type="text/javascript">

  $(".dropzone-<?php echo $banner_Data['id']; ?>").dropzone({

    
    addRemoveLinks: true,
    maxFiles: 5,

    dictDefaultMessage: '<img src="drop.png" style="width: 23%;"></img> <br><br> Drag And Drop Or Click here to upload Banner Image',

    acceptedFiles: 'image/*',

    init: function() {

    this.on('success', function( file, resp ){

      window.reload();

    });

  },    

})


</script>
</center>

  </div>

      <script type="text/javascript">
      	$(".banner-change-btn-<?php echo $banner_Data['id']; ?>").click(function(){
      		$(".banner-<?php echo $banner_Data['id']; ?>").hide();
      		$(".pic-uploader--<?php echo $banner_Data['id']; ?>").show();
      	});
      </script>


	<br><hr>
    <?php } ?>
  

  </div>



      <?php $q = $conn -> query("SELECT * FROM banners WHERE id = '2'"); 
    while ($banner_Data = mysqli_fetch_array($q)) {
      $banner_id = $banner_Data['id'];
      $banner = $site_url."/media/".$banner_Data['file_name'];
      echo "<div class='banner-".$banner_Data['id']."'><center><h2>BANNER".$banner_Data['id']."<button class='btn btn-primary banner-change-btn-".$banner_Data['id']."'>Change</button></h2><a href='".$banner_Data['link']."' target='_blank'><img src='".$banner."' class='img-responsive' /></a></center></div>"; ?>


      <div class="pic-uploader--<?php echo $banner_Data['id']; ?>" style="display: none;">
      <center>
  <h3>Re-Upload Banner <br><span style="font-size: 11px;">Size: 1130x400px</span></h3>
  <form action="parse-banner.php" class="dropzone dropzone-<?php echo $banner_Data['id']; ?> x-magic-form" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

<input type="text" placeholder="Url link" class="link" name="link"/>
<input type="hidden" value="<?php echo $banner_id; ?>" name="banner-id"/>

</form> 

<script type="text/javascript">

  $(".dropzone-<?php echo $banner_Data['id']; ?>").dropzone({

    
    addRemoveLinks: true,
    maxFiles: 5,

    dictDefaultMessage: '<img src="drop.png" style="width: 23%;"></img> <br><br> Drag And Drop Or Click here to upload Banner Image',

    acceptedFiles: 'image/*',

    init: function() {

    this.on('success', function( file, resp ){

      window.reload();

    });

  },    

})


</script>
</center>

  </div>

      <script type="text/javascript">
      	$(".banner-change-btn-<?php echo $banner_Data['id']; ?>").click(function(){
      		$(".banner-<?php echo $banner_Data['id']; ?>").hide();
      		$(".pic-uploader--<?php echo $banner_Data['id']; ?>").show();
      	});
      </script>


	<br><hr>
    <?php } ?>
  

  </div>

</div>

</body>

</html>

<?php } ?>