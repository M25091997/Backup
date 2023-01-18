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
    

  <h2>Add New super Category</h2>
  <div class="row">
	
  <form action="img-parse-super-cat.php" class="dropzone d2 col-md-12 x-magic-form" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

<!-- <input type="hidden" value="<?php echo $media_number; ?>" class="media_number" name="media-number"></input> -->

</form> 

<script type="text/javascript">

  $(".d2").dropzone({

    
    addRemoveLinks: true,
    maxFiles: 1,

    dictDefaultMessage: '<img src="drop.png" style="width: 23%;"></img> <br><br> Drag And Drop Or Click here to upload Circular Image (Only 1 Image)',

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

  <form action="save-super-category.php" method="POST">
    
    <h3>Category Name</h3>
    <input type="hidden" value="" id="media_number_pro" name="image"></input>
    
    <input type="text" name="name" placeholder="Category Full name" class="form-control"> <br>

    <h3>Category Description</h3>
    <input type="text" name="cat_desc" placeholder="Category Description" class="form-control"> <br>

    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Create Category </button>
  </form>


  </div>


  <div class="col-md-6">
  
  <h3>All Super Categories</h3>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  
<?php $msg_query = $conn -> query("SELECT * FROM super_category");  

while ($sData = mysqli_fetch_array($msg_query)) { 
  $id = $sData['id'];
  $name = $sData['name'];
  $img = $sData['image'];
  $cat_desc = $sData['cat_desc'];
  
  $image = $site_url."/img/supercat/".$img;

  ?>
    <tr>
      <th scope="row"><?php echo $id ?></th>
      <td><img src="<?php echo $image ?>" width="50" height="50"></td>
      <td><?php echo $name ?></td>



      <td>
        <button class="btn btn-warning edit_main_cat" cat_edit_id="<?php echo $id ?>" cat_edit_desc="<?php echo $cat_desc ?>" cat_edit_name="<?php echo $name ?>" cat_edit_img="<?php echo $img ?>" data-toggle="modal" data-target="#cat-modal-detail"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <button class="btn btn-danger delete_super_cat" cat_delete_id=<?php echo $id ?>><i class="fa fa-trash" aria-hidden="true"></i></button>

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
        <h4 class="modal-title" id="myModalLabel">Edit Story</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
      
          <form action="action/update_main_cat.php" method="POST" enctype="multipart/form-data">
          
          <h3>Category Name</h3>
          <input type="hidden" id="cat_edit_id" name="cat_edit_id" />
          
          <input type="text" name="cat_edit_name" placeholder="Full title" value="" id="cat_edit_name" class="form-control"> <br>

          <h3>Category Name</h3>
          
          <input type="text" name="cat_edit_desc" placeholder="Enter Description" value="" id="cat_edit_desc" class="form-control"> <br>


          <h3>Old Image</h3>
          <div id="show_img"></div>

          <h3>Upload New(Optional)</h3>
          <input type="hidden" name="old_photo" id="old_photo" />
          <input type="file" class="form-control" name="cat_edit_img"> <br/>

          <button type="submit" class="btn btn-primary" name="edit_cat_info"> <i class="fa fa-plus"></i> Create Story </button>
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

    $(".delete_super_cat").click(function(){
      let text = "Do you really want to Delete!..";
        if (confirm(text) == true) {
              var cat_delete_id=$(this).attr('cat_delete_id');
              // alert(cat_delete_id);
              // return;
              $.ajax({
                  url:"action/delete_category.php",
                  method:"POST",
                  data:{deleteSuperCategory:1,del_id:cat_delete_id},
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

    $(".edit_main_cat").click(function(){
        var cat_edit_id=$(this).attr('cat_edit_id');
        var cat_edit_name=$(this).attr('cat_edit_name');
        var cat_edit_img=$(this).attr('cat_edit_img');
        var cat_edit_desc=$(this).attr('cat_edit_desc');

        // alert(cat_edit_id);

        $('#cat_edit_id').val(cat_edit_id);
        $('#cat_edit_name').val(cat_edit_name);
        $('#cat_edit_desc').val(cat_edit_desc);


        $('#old_photo').val(cat_edit_img);

                let url = "https://cms.cybertizeweb.com/boxoniq-crm/img/supercat/";
                $('#show_img').html('<img src="'+url+ cat_edit_img + '" style="width:250px"/>');

    });

  
  })
</script>