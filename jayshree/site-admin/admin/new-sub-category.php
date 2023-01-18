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

  <title>NEW SUB CATEGORY</title>

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
    

  <h2>Add New Sub Category</h2>

  <form action="save-sub-category.php" method="POST">
    
    <h3>Category Name</h3>
    <input type="text" name="name" placeholder="Category Full name" class="form-control"> <br>

    <hr>

    <h2>Super Category</h2>
    <select class="form-control" name="super_category_id">
      
        <?php $msg_query = $conn -> query("SELECT * FROM super_category ORDER BY id DESC");  

  while ($sData = mysqli_fetch_array($msg_query)) { ?>

 <option value="<?php echo $sData['id']; ?> "><?php echo $sData['name']; ?> </option>
 


  <?php } ?>

    </select> <br>
    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Create Category </button>
  </form>


  </div>


  <div class="col-md-4">
    

  <h3>All Sub Categories</h3>


  <ul class="list-group list-group-flush">

  <?php $msg_query = $conn -> query("SELECT * FROM category ORDER BY id DESC");  

  while ($sData = mysqli_fetch_array($msg_query)) { 

    $super_id = $sData['super_category_id'];
    $sC = $conn -> query("SELECT * FROM super_category WHERE id = '$super_id'");  
    while ( $SD = mysqli_fetch_array($sC) ) { $name_m = $SD['name']; }
      ?>

  <li class="list-group-item">#<b><?php echo $sData['id']; ?></b>. <?php echo $sData['name']; ?> <small style="color: #7d7d7d;">(in <?php echo $name_m; ?>)</small> <a href="delete-sub-category.php?id=<?php echo $sData['id']; ?>" style="float: right;"><i class="fa fa-trash"></i></a></li>


  <?php } ?>
</ul>

  </div>


  </div>

</div>

</body>

</html>

<?php } ?>