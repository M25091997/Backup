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

  <title>Bundle and Subscription Benefit</title>

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
    

  <h2>Add Category No for Bundle Benefit</h2>
  

  <form action="save-bundle-cat-no.php" method="POST">
    
    <h3>Add Category No</h3>
    
    <input type="number" name="bundle_cat_no" placeholder="Title" class="form-control"> <br>

    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Add Category No</button>
  </form>


  </div>


  <div class="col-md-6">
  
  <h3>Bundle Category Number</h3>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Bundle Category No</th>
      <!-- <th scope="col">Action</th> -->
    </tr>
  </thead>
  <tbody>
  
<?php $msg_query = $conn -> query("SELECT * FROM bundle_cat_no");  

while ($sData = mysqli_fetch_array($msg_query)) { 
  $id = $sData['id'];
  $bundle_cat_no = $sData['bundle_cat_no'];

  ?>
    <tr>
      <th scope="row"><?php echo $id ?></th>
      <td><?php echo $bundle_cat_no ?></td>
      <!-- <td>
        <button class="btn btn-warning edit_del_boy" del_edit_id=<?php echo $id ?> data-toggle="modal" data-target="#editDel"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <button class="btn btn-danger delete_subs" subs_delete_id=<?php echo $id ?>><i class="fa fa-trash" aria-hidden="true"></i></button>

      </td> -->
    </tr>
  <?php } ?>


  </tbody>
</table>

  </div>


  </div>

</div>

</body>

</html>

<?php } ?>

<script>
$(document).ready(function(){

    $(".delete_subs").click(function(){
        var subs_delete_id=$(this).attr('subs_delete_id');
        // alert(subs_delete_id);
        // return;
        $.ajax({
            url:"action/delete_subs_benefit.php",
            method:"POST",
            data:{deleteSubscriptionBenefit:1,del_id:subs_delete_id},
            dataType:"json",
            success:function(data){
                if(data.response == 1){
                  alert('Deleted Successfully');
                  location.reload();
                }else{
                  alert('Something went wrong');
                }
            }});
    });

  
  })
</script>