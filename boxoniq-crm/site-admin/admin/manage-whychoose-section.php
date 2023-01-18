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

  <title>Why Choose Us Section</title>

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

  <div class="col-md-5">
    

  <h2>Add Why Choose Us Content</h2>
  <div class="row">
	
  <form action="img-parse-why.php" class="dropzone d2 col-md-12 x-magic-form" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

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

  <form action="save-why-section.php" method="POST">
    
    <input type="hidden" value="" id="media_number_pro" name="why_photo"></input>
    
    <h3>Why Choose Us Content</h3>
    <input type="text" name="why_desc" placeholder="Category Description" class="form-control"> <br>

    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Create Category </button>
  </form>


  </div>


  <div class="col-md-7">
  
  <h3>All Why Choose Content</h3>
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
  
<?php $msg_query = $conn -> query("SELECT * FROM why_choose");  

while ($sData = mysqli_fetch_array($msg_query)) { 
  $id = $sData['id'];
  $why_desc = $sData['why_desc'];
  $img = $sData['why_photo'];
  
  $image = $site_url."/img/why/".$img;

  ?>
    <tr>
      <th scope="row"><?php echo $id ?></th>
      <td><img src="<?php echo $image ?>" width="50" height="50"></td>
      <td><?php echo $why_desc ?></td>

      <td>
        <button class="btn btn-warning edit_why_section" why_edit_id="<?php echo $id ?>" why_edit_desc="<?php echo $why_desc ?>" why_edit_img="<?php echo $img ?>" data-toggle="modal" data-target="#editWhyUs"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <button class="btn btn-danger delete_why" why_id=<?php echo $id ?>><i class="fa fa-trash" aria-hidden="true"></i></button>

      </td>
    </tr>
  <?php } ?>

  </tbody>
</table>

  </div>

  </div>

</div>

<!-- *************************************************************** -->
<div id="editWhyUs" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Blog</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
          <form action="action/update_why_section.php" method="POST" enctype="multipart/form-data">
            <h3>Title</h3>
            <input type="hidden" id="why_edit_id" name="why_edit_id" />
            
            <input type="text" name="why_edit_desc" placeholder="Full title" value="" id="why_edit_desc" class="form-control"> <br>

            <h3>Old Image</h3>
            <div id="show_img"></div>

            <h3>Upload New(Optional)</h3>
            <input type="hidden" name="old_photo" id="old_photo" />
            <input type="file" class="form-control" name="why_edit_img"> <br/>

            <button type="submit" class="btn btn-primary" name="edit_why_info"> <i class="fa fa-plus"></i> Update Why Section </button>
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

    $(".delete_why").click(function(){
      let text = "Do you really want to Delete!..";
        if (confirm(text) == true) {
          var why_id=$(this).attr('why_id');
          // alert(cat_delete_id);
          // return;
          $.ajax({
              url:"action/delete_why.php",
              method:"POST",
              data:{deleteWhy:1,del_id:why_id},
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

    $(".edit_why_section").click(function(){
        var why_edit_id=$(this).attr('why_edit_id');
        var why_edit_desc=$(this).attr('why_edit_desc');
        var why_edit_img=$(this).attr('why_edit_img');
        // alert(why_edit_id);
        $('#why_edit_id').val(why_edit_id);
        $('#why_edit_desc').val(why_edit_desc);

        $('#old_photo').val(why_edit_img);

                let url = "https://cms.cybertizeweb.com/boxoniq-crm/img/why/";
                $('#show_img').html('<img src="'+url+ why_edit_img + '" style="width:250px"/>');

    });

    
  
  })
</script>