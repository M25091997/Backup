<?php 

session_start();

include ("../../config.php");

include ("../../variables.php");

$media_number = rand().time();

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

  <title>NEW PRODUCT</title>

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

  <div class="col-md-8">
    

  <h2>Add New Product</h2>

  <form action="save-product.php" method="POST">
    <input type="hidden" value="<?php echo $media_number; ?>" class="media_number" name="media-number-p"></input>
    <h3>Product Full Name</h3>
    <input type="text" name="name" placeholder="Product Full name" class="form-control" required> <br>

    <hr>

    <h2>Super Category</h2>
    <select class="form-control super-category" name="category_id">
    <option value="0"> Select </option>  
        <?php $msg_query = $conn -> query("SELECT * FROM super_category ORDER BY id DESC");  

  while ($sData = mysqli_fetch_array($msg_query)) { ?>

 <option value="<?php echo $sData['id']; ?>"><?php echo $sData['name']; ?> </option>
 


  <?php } ?>

    </select> 

    <hr>

    <h2>Sub Category</h2>
    <select class="form-control sub-category-holder" name="sub_category_id">
	<option value="0">Select Super Category first</option>
    </select> 

    <!-- <hr>

    <h2>Child Category</h2>
    <select class="form-control child-category-holder" name="child_category_id">
  <option value="0">Select Sub Category first</option>
    </select>  -->


     <br>



    <hr>

    <h2>Select Brand</h2>
    <select class="form-control" name="brand_id">
      
        <?php $msg_query = $conn -> query("SELECT * FROM brand ORDER BY id DESC");  

  while ($sData = mysqli_fetch_array($msg_query)) { ?>

 <option value="<?php echo $sData['id']; ?>"><?php echo $sData['brand_name']; ?> </option>
 


  <?php } ?>

    </select> 

    <br>

    <h3>Description</h3>
    <textarea name="description" placeholder="Product Description" class="form-control" required></textarea><br>


    <h3>Add GST (in percent)</h3>
    <input type="number" name="gst" placeholder="Add GST" class="form-control" required>
    <hr>

    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Create Product </button>
  </form>


  </div>


  <div class="col-md-4">
    
<div class="row">
  <h4>Upload Product Image<br><span style="font-size: 11px;">Size: 748x1024px</span></h4>



  <form action="img-parse.php" class="dropzone col-md-12 x-magic-form" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

<input type="hidden" value="<?php echo $media_number; ?>" class="media_number" name="media-number"></input>

</form> 
</center>
<script type="text/javascript">

  $(".dropzone").dropzone({

    
    addRemoveLinks: true,
    maxFiles: 7,

    dictDefaultMessage: '<img src="drop.png" style="width: 23%;"></img> <br><br> Drag And Drop Or Click here to upload Product Image (Upto 5 Images)',

    acceptedFiles: 'image/*',

    init: function() {

    this.on('success', function( file, resp ){

      

    });

  },    

})


</script>
</div>

<hr>

<br>
<br>
<br>

  <h4>Upload Product Cover / Front Image<br><span style="font-size: 11px;">Size: 748x1024px</span></h4>


<div class="row">
	
  <form action="img-parse-front.php" class="dropzone d2 col-md-12 x-magic-form" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

<input type="hidden" value="<?php echo $media_number; ?>" class="media_number" name="media-number"></input>

</form> 
</center>
<script type="text/javascript">

  $(".d2").dropzone({

    
    addRemoveLinks: true,
    maxFiles: 1,

    dictDefaultMessage: '<img src="drop.png" style="width: 23%;"></img> <br><br> Drag And Drop Or Click here to upload Product Front Image (Only 1 Image)',

    acceptedFiles: 'image/*',

    init: function() {

    this.on('success', function( file, resp ){

      

    });

  },    

})


</script>

</div>

  </div>


  </div>

</div>

</body>

</html>


<script type="text/javascript">

$(".super-category").on('change', function(){
$(".sub-category-holder").html("<option>Please Wait...</option>");

var dataString = 'id='+ this.value;

$.ajax({
type: "POST",
url: "get-sub-categories.php",
data: dataString,
cache: false,
success: function(html)
{
 $(".sub-category-holder").html(html);




 $(".child-category-holder").html("<option>Please Wait...</option>");

var dataString = 'id='+ $(".sub-category-holder").val();

$.ajax({
type: "POST",
url: "get-child-categories.php",
data: dataString,
cache: false,
success: function(html)
{
 $(".child-category-holder").html(html);
}
});




}
});


});	


$(".sub-category-holder").on('change', function(){
$(".child-category-holder").html("<option>Please Wait...</option>");

var dataString = 'id='+ this.value;

$.ajax({
type: "POST",
url: "get-child-categories.php",
data: dataString,
cache: false,
success: function(html)
{
 $(".child-category-holder").html(html);
}
});

}); 


</script>

<?php } ?>