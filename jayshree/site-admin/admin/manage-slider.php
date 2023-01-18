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

  <title>Manage Slider</title>

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
  .dis_none{
    display: none !important;
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

  <h2>Add Slider</h2>
  

  <div class="row">

  <div class="col-md-4">
    


  <form action="save-slider.php" method="POST">

     <h3>Select Type</h3>
    <select class="form-control" id="slider_type" name="slider_type">
        <option value="0"> Select Type </option>
        <option value="0"> Normal </option>
        <option value="1"> Category </option>
        <option value="2"> Product </option>

</select>
    <div class="super-category dis_none">
    <h3>Select Category</h3>
    <select class="form-control" name="category_id">
        <option value="0"> Select Category </option>
        <?php 
          $get_cat = $conn -> query("SELECT * FROM super_category");
          while($row_cat = mysqli_fetch_assoc($get_cat)){
        ?>
        <option value="<?php echo $row_cat['id'] ?>"><?php echo $row_cat['name'] ?> </option>

      <?php } ?>
        
</select>
</div>
  <div class="super-product dis_none">

<h3>Select Product</h3>
    <select class="form-control" name="product_id">
        <option value="0"> Select Product </option>
        <?php 
          $get_pro = $conn -> query("SELECT * FROM items");
          while($row_pro = mysqli_fetch_assoc($get_pro)){
        ?>
        <option value="<?php echo $row_pro['id'] ?>"><?php echo $row_pro['name'] ?> </option>

      <?php } ?>
        
</select>
</div>
    <input type="hidden" value="" id="media_number_pro" name="media_number"></input>
<br>
<button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Create Slider </button>
  </form>

  </div>



  <div class="col-md-3">
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
  </div>

  <div class="col-md-5">
    <h3>All Sliders</h3>
      <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Image</th>
      <th scope="col">Type</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  
<?php $msg_query = $conn -> query("SELECT * FROM slider ORDER BY id DESC");  

while ($sData = mysqli_fetch_array($msg_query)) { 
  $id = $sData['id'];
  $slider_type = $sData['slider_type'];
  $media_number = $sData['media_number'];

  $get_media = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number' ");
  $image = $site_url."/media/".mysqli_fetch_assoc($get_media)['file_name'];

  if($slider_type == 0){
    $type = "Normal";
  }
  if($slider_type == 1){
    $type = "Category";
  }
  if($slider_type == 2){
    $type = "Product";
  }

  ?>
    <tr>
      <th scope="row"><?php echo $id ?></th>
      <td><img src="<?php echo $image ?>" width="50" height="50"></td>
      <td><?php echo $type ?></td>


      <td>
        <!-- <button class="btn btn-warning edit_del_boy" del_edit_id=<?php echo $id ?> data-toggle="modal" data-target="#editDel"><i class="fa fa-pencil" aria-hidden="true"></i></button> -->
        <button class="btn btn-danger delete_sli" sli_delete_id=<?php echo $id ?>><i class="fa fa-trash" aria-hidden="true"></i></button>

      </td>
    </tr>
  <?php } ?>


  </tbody>
</table>

  </div>


  </div>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="col-md-6">
            <form action="img-parse-super-cat.php" class="dropzone d4 col-md-12 x-magic-form" 
            style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 57%;">

          </form> 
        </div>
        <div class="col-md-6">
            <form action="img-parse-cat-banner.php" class="dropzone d5 col-md-12 x-magic-form" 
            style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 57%;">

          </form> 
        </div>
      </div>
        <form method="post" action="action/update_super_cat.php">
          <input type="hidden" name="update_id" id="update_id">
          <input type="hidden" name="media_number_edit" class="media_number_edit">
          <input type="hidden" name="cat_banner_edit" class="cat_banner_edit">

          <input type="hidden" name="old_banner" id="cat_banner_edit">
          <input type="hidden" name="old_logo" id="media_number_edit">


          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="name" name="name" >
          </div>

          <!-- <div class="form-group cat_logo">
          <img src="" style="width:30%" id="cat_logo_image" />
          </div>
          
          

          <div class="form-group cat_banner">
            
          </div> -->

          <button type="submit" name="updateSuperCat" class="btn btn-primary">Submit</button>
        </form>
        
<script type="text/javascript">

  $(".d4").dropzone({
    addRemoveLinks: true,
    maxFiles: 1,

    dictDefaultMessage: '<img src="drop.png" style="width: 25%;"></img> <br><br> Circular Image (Only 1 Image)',

    acceptedFiles: 'image/*',

    init: function() {

    this.on('success', function( file, resp ){
      let dd = JSON.parse(resp);
      console.log(dd.media_number);
      $('#media_number_edit').val(dd.media_number);

    });

  },    

})


</script>
<script type="text/javascript">

  $(".d5").dropzone({

    
    addRemoveLinks: true,
    maxFiles: 1,

    dictDefaultMessage: '<img src="drop.png" style="width: 23%;"></img> <br><br> Upload Banner Image(Only 1 Image)',

    acceptedFiles: 'image/*',

    init: function() {

    this.on('success', function( file, resp ){
      let dd = JSON.parse(resp);
      console.log(dd.media_number);
      $('#cat_banner_edit').val(dd.media_banner);

    });

  },    

})

</script>
      </div>
    </div>
  </div>
</div>

<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="cat_name" id="cat_name" placeholder="Enter name">
            <small id="emailHelp" class="form-text text-muted">Enter name</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->

</body>

</html>

<?php } ?>
<script>
$(document).ready(function(){

  $('#slider_type').on('change',function(){
    
    var status=$(this).val();
    // alert(status);

    if(status == 0){
      $('.super-category').addClass('dis_none');
      $('.super-product').addClass('dis_none');

    }

    if(status == 1){
      $('.super-category').removeClass('dis_none');
      $('.super-product').addClass('dis_none');

    }

    if(status == 2){
      $('.super-product').removeClass('dis_none');
      $('.super-category').addClass('dis_none');

    }
    // var user_id=$(this).attr('user_id');
    // alert(status);
    // alert(user_id);
    // return;

    // if(status!=''){
    //   $.ajax({type:'POST',
    //     url:'action/update_approval_status.php',
    //     data:{updateApprovalStatus:1,UserId:user_id,StatusId:status},
    //     success:function(data)
    //   {
    //     console.log(data);
    //     let dd = JSON.parse(data);
    //     if(dd.response == 1){
    //       alert('Successfully Updated Status');
    //     }
    //   }
    //   });
    // }
  }); 

    $(".delete_sli").click(function(){
        var sli_delete_id=$(this).attr('sli_delete_id');
        // alert(sli_delete_id);
        $.ajax({
            url:"action/delete_slider.php",
            method:"POST",
            data:{deleteSlider:1,del_id:sli_delete_id},
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

  $(".edit_del_boy").click(function(){
        var cat_edit_id=$(this).attr('cat_edit_id');
        // alert(cat_edit_id);
        $.ajax({
            url:"action/get_modal_data.php",
            method:"POST",
            data:{updateCatData:1,cat_edit_id:cat_edit_id},
            dataType:"json",
            success:function(data){
                $('#update_id').val(data.id);
                $('#name').val(data.name);
                $('.media_number_edit').val(data.media_number);
                $('.cat_banner_edit').val(data.banner_number);

                // $('#cat_logo_image').attr('src', data.banner);

                // let url = "https://cms.cybertizeweb.com/jayshree-crm/media/";
                
                // $('.cat_logo').html('<img class="img-fluid" src="'data.banner'" />');

                
            }});
    });
  })
</script>