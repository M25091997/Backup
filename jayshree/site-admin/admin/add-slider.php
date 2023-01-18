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

  <title>NEW MAIN CATEGORY</title>

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

  <div class="col-md-6">
    

  <h2>Add Slider</h2>

  <form action="save-super-slider.php" method="POST">
    
    <h3>Select Category</h3>
          <select class="form-control" name="cat_id">
            <option>Select Category</option>
           <?php 
            $sel_cat = $conn->query("SELECT * from super_category");
            while($row_cat = mysqli_fetch_array($sel_cat)){ ?>
            <option value="<?php echo $row_cat['id'] ?>"> <?php echo $row_cat['name'] ?> </option>

           <?php }
           ?>

          </select>
    
    <input type="hidden" value="" id="media_number_pro" name="media_number"></input>
    <br/>

    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Create Slider </button>
  </form>


  </div>

  <div class="col-md-3">
  <div class="row">
	
  <form action="img-parse-slider.php" class="dropzone d2 col-md-12 x-magic-form" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

<!-- <input type="hidden" value="<?php echo $media_number; ?>" class="media_number" name="media-number"></input> -->

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
      let dd = JSON.parse(resp);
      console.log(dd.media_number);
      $('#media_number_pro').val(dd.media_number);

    });

  },    

})


</script>

</div>
  </div>


  <div class="col-md-3">
    

  <h3>All Sliders</h3>


  <ul class="list-group list-group-flush">

  <?php $msg_query = $conn -> query("SELECT * FROM slider ORDER BY id DESC");  

  while ($sData = mysqli_fetch_array($msg_query)) 
  

  { ?>

  <li class="list-group-item">#<b><?php echo $sData['id']; ?></b>. <?php echo $sData['name']; ?> <a href="delete-super-category.php?id=<?php echo $sData['id']; ?>" style="float: right;"><i class="fa fa-trash"></i></a></li>


  <?php } ?>
</ul>

  </div>


  </div>

</div>

</body>

</html>

<?php } ?>