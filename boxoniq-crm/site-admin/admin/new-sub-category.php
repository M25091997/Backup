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

  <div class="col-md-6">
    

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


  <div class="col-md-6">
    

  <h3>All Sub Categories</h3>

  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Super Category</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  
<?php $msg_query = $conn -> query("SELECT * FROM category");  

while ($sData = mysqli_fetch_array($msg_query)) { 
  $id = $sData['id'];
  $name = $sData['name'];
  $cat_desc = $sData['cat_desc'];
  $super_cat_id = $sData['super_category_id'];

  $get_super_cat = $conn -> query("SELECT * FROM super_category WHERE id = '$super_cat_id'");
  $row_super_cat = mysqli_fetch_assoc($get_super_cat);
  $super_cat = $row_super_cat['name'];

  
  // $image = $site_url."/img/supercat/".$img;

  ?>
    <tr>
      <th scope="row"><?php echo $id ?></th>
      <td><?php echo $name ?></td>
      <td><?php echo $super_cat ?></td>

      <td>
        <button class="btn btn-warning edit_sub_cat" cat_edit_id="<?php echo $id ?>" cat_edit_super="<?php echo $super_cat_id ?>" cat_edit_name="<?php echo $name ?>" data-toggle="modal" data-target="#cat-modal-detail"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <button class="btn btn-danger delete_sub_cat" cat_delete_id=<?php echo $id ?>><i class="fa fa-trash" aria-hidden="true"></i></button>

      </td>
    </tr>
  <?php } ?>


  </tbody>
</table>

  </div>


  </div>

</div>

<!-- *************************************************************** -->
<div id="cat-modal-detail" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Sub Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
      
          <form action="action/update_sub_cat.php" method="POST" enctype="multipart/form-data">
          
          <h3>Category Name</h3>
          <input type="hidden" id="cat_edit_id" name="cat_edit_id" />
          
          <input type="text" name="cat_edit_name" placeholder="Full title" value="" id="cat_edit_name" class="form-control"> <br>

          <h2>Super Category</h2>
    <select class="form-control" name="super_category_id" id="cat_edit_super">
      
        <?php $msg_query = $conn -> query("SELECT * FROM super_category ORDER BY id DESC");  

  while ($sData = mysqli_fetch_array($msg_query)) { ?>

 <option value="<?php echo $sData['id']; ?>"><?php echo $sData['name']; ?> </option>

  <?php } ?>

    </select> <br>

          <button type="submit" class="btn btn-primary" name="edit_subcat_info"> <i class="fa fa-plus"></i> Update Sub Category </button>
        </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
    </div>
    </div>

    </div>

</div>
<!-- ********************************** -->

</body>

</html>

<?php } ?>

<script>
$(document).ready(function(){

    $(".delete_sub_cat").click(function(){
      let text = "Do you really want to Delete!..";
        if (confirm(text) == true) {
              var cat_delete_id=$(this).attr('cat_delete_id');
              // alert(cat_delete_id);
              // return;
              $.ajax({
                  url:"action/delete_category.php",
                  method:"POST",
                  data:{deleteSubCategory:1,del_id:cat_delete_id},
                  dataType:"json",
                  success:function(data){
                      if(data.response == 1){
                        alert('Deleted Successfully');
                        location.reload();
                      }else{
                        alert('Something went wrong');
                      }
                  }});
        } else {
        }
    });

    $(".edit_sub_cat").click(function(){
        var cat_edit_id=$(this).attr('cat_edit_id');
        var cat_edit_name=$(this).attr('cat_edit_name');
        var cat_edit_super=$(this).attr('cat_edit_super');

        // alert(cat_edit_super);

        $('#cat_edit_id').val(cat_edit_id);
        $('#cat_edit_name').val(cat_edit_name);
        $('#cat_edit_super').val(cat_edit_super);

    });

  
  })
</script>