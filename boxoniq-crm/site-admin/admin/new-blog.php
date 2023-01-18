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
    

  <h2>Add New Blog</h2>
  <div class="row">
	
  <form action="img-parse-blog.php" class="dropzone d2 col-md-12 x-magic-form" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

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

  <form action="save-blog.php" method="POST">
    
    <h3>Blog Name</h3>
    <input type="hidden" value="" id="media_number_pro" name="image"></input>
    
    <input type="text" name="title" placeholder="Full title" class="form-control"> <br>

    <h3>Blog Description</h3>
    <textarea name="blog_desc" rows="10" class="form-control"></textarea><br>
    <!-- <input type="text" name="blog_desc" placeholder="Blog Description" class="form-control"> <br> -->

    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Create Blog </button>
  </form>


  </div>


  <div class="col-md-6">
  
  <h3>All Blogs</h3>
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
  
<?php $msg_query = $conn -> query("SELECT * FROM blog");  

while ($sData = mysqli_fetch_array($msg_query)) { 
  $id = $sData['id'];
  $name = $sData['title'];
  $img = $sData['image'];
  $blog_desc = $sData['blog_desc'];
  
  $image = $site_url."/img/blog/".$img;

  ?>
    <tr>
      <th scope="row"><?php echo $id ?></th>
      <td><img src="<?php echo $image ?>" width="50" height="50"></td>
      <td><?php echo $name ?></td>



      <td>
        <button class="btn btn-warning edit_blog" blog_edit_id="<?php echo $id ?>" blog_edit_desc="<?php echo $blog_desc ?>" blog_edit_name="<?php echo $name ?>" blog_edit_img="<?php echo $img ?>"  data-toggle="modal" data-target="#editBlog"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <button class="btn btn-danger delete_blog" blog_delete_id=<?php echo $id ?>><i class="fa fa-trash" aria-hidden="true"></i></button>

      </td>
    </tr>
  <?php } ?>


  </tbody>
</table>

  </div>


  </div>

</div>

<!-- *************************************************************** -->
<div id="editBlog" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Blog</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
      
          <form action="action/update_blog.php" method="POST" enctype="multipart/form-data">
            <h3>Blog Title</h3>
            <input type="hidden" id="blog_edit_id" name="blog_edit_id" />
            
            <input type="text" name="blog_edit_name" placeholder="Full title" value="" id="blog_edit_name" class="form-control"> <br>

            <h3>Blog Description</h3>
            <textarea name="blog_edit_desc" id="blog_edit_desc" rows="10" class="form-control"></textarea><br>

            <h3>Old Image</h3>
            <div id="show_img"></div>

            <h3>Upload New(Optional)</h3>
            <input type="hidden" name="old_photo" id="old_photo" />
            <input type="file" class="form-control" name="blog_edit_img"> <br/>

            <button type="submit" class="btn btn-primary" name="edit_blog_info"> <i class="fa fa-plus"></i> Update Blog </button>
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

    $(".delete_blog").click(function(){
        var blog_delete_id=$(this).attr('blog_delete_id');
        // alert(blog_delete_id);
        // return;
        $.ajax({
            url:"action/delete_blog.php",
            method:"POST",
            data:{deleteBlog:1,del_id:blog_delete_id},
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

    $(".edit_blog").click(function(){
        var blog_edit_id=$(this).attr('blog_edit_id');
        var blog_edit_desc=$(this).attr('blog_edit_desc');
        var blog_edit_name=$(this).attr('blog_edit_name');
        var blog_edit_img=$(this).attr('blog_edit_img');

        // alert(blog_edit_id);

        $('#blog_edit_id').val(blog_edit_id);
        $('#blog_edit_name').val(blog_edit_name);
        $('#blog_edit_desc').val(blog_edit_desc);


        $('#old_photo').val(blog_edit_img);

                let url = "https://cms.cybertizeweb.com/boxoniq-crm/img/blog/";
                $('#show_img').html('<img src="'+url+ blog_edit_img + '" style="width:250px"/>');

    });

  
  })
</script>