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

  <title>NEW BRAND</title>

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
    

  <h2>Add New Brand</h2>
  <div class="row">
	
  <form action="img-parse-brand.php" class="dropzone d2 col-md-12 x-magic-form" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

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

  <form action="save-brand.php" method="POST">
    
    <h3>Brand Name</h3>
    <input type="hidden" name="brand_img" id="media_number_pro">
    <input type="text" name="name" placeholder="Brand Full name" class="form-control"> <br>
    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Create Brand </button>
  </form>


  </div>


  <div class="col-md-6">
    
  <h3>All Brands</h3>
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
  
<?php $msg_query = $conn -> query("SELECT * FROM brand");  

while ($sData = mysqli_fetch_array($msg_query)) { 
  $id = $sData['id'];
  $name = $sData['brand_name'];
  $img = $sData['brand_img'];
  
  $image = $site_url."/img/brand/".$img;

  ?>
    <tr>
      <th scope="row"><?php echo $id ?></th>
      <td><img src="<?php echo $image ?>" width="50" height="50"></td>
      <td><?php echo $name ?></td>



      <td>
        <button class="btn btn-warning edit_brand" brand_edit_id="<?php echo $id ?>" brand_edit_name="<?php echo $name ?>" brand_edit_img="<?php echo $img ?>" data-toggle="modal" data-target="#subcat-modal-detail"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <button class="btn btn-danger delete_brand" brand_delete_id=<?php echo $id ?>><i class="fa fa-trash" aria-hidden="true"></i></button>

      </td>
    </tr>
  <?php } ?>


  </tbody>
</table>

  </div>


  </div>

</div>

<!-- *************************************************************** -->
<div id="subcat-modal-detail" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Brand</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
      
          <form action="action/update_brand.php" method="POST" enctype="multipart/form-data">
          
          <h3>Sub Category Name</h3>
          <input type="hidden" id="brand_edit_id" name="brand_edit_id" />
          
          <input type="text" name="brand_edit_name" placeholder="Full title" value="" id="brand_edit_name" class="form-control"> <br>

          <h3>Old Image</h3>
          <div id="show_img"></div>

          <h3>Upload New(Optional)</h3>
          <input type="hidden" name="old_photo" id="old_photo" />
          <input type="file" class="form-control" name="brand_edit_img"> <br/>

          <button type="submit" class="btn btn-primary" name="edit_brand_info"> <i class="fa fa-plus"></i> Update Brand </button>
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

    $(".delete_brand").click(function(){
      let text = "Do you really want to Delete!..";
        if (confirm(text) == true) {
          var brand_delete_id=$(this).attr('brand_delete_id');
          // alert(brand_delete_id);
          // return;
          $.ajax({
              url:"action/delete_brand.php",
              method:"POST",
              data:{deleteBrand:1,del_id:brand_delete_id},
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

    $(".edit_brand").click(function(){
        var brand_edit_id=$(this).attr('brand_edit_id');
        var brand_edit_name=$(this).attr('brand_edit_name');
        var brand_edit_img=$(this).attr('brand_edit_img');

        // alert(brand_edit_id);

        $('#brand_edit_id').val(brand_edit_id);
        $('#brand_edit_name').val(brand_edit_name);

        $('#old_photo').val(brand_edit_img);

                let url = "https://cms.cybertizeweb.com/boxoniq-crm/img/brand/";
                $('#show_img').html('<img src="'+url+ brand_edit_img + '" style="width:250px"/>');

    });

  
  })
</script>