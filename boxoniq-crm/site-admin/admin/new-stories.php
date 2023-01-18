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

  <title>NEW STORIES</title>

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
	
  <form action="img-parse-stories.php" class="dropzone d2 col-md-12 x-magic-form" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

<input type="hidden" value="<?php echo $media_number; ?>" class="media_number" name="media-number"></input>

</form> 

<script type="text/javascript">

  $(".d2").dropzone({

    
    addRemoveLinks: true,
    maxFiles: 5,

    dictDefaultMessage: '<img src="drop.png" style="width: 23%;"></img> <br><br> Drag And Drop Or Click here to upload Circular Image (Upto 5 Images)',

    acceptedFiles: 'image/*',

    init: function() {

    this.on('success', function( file, resp ){
      // let dd = JSON.parse(resp);
      // console.log(dd.media_number);
      // $('#media_number_pro').val(dd.media_number);
      console.log('added photos');

    });

  },    

})

</script>

</div>

  <form action="save-story.php" method="POST">
    
    <h3>Story Name</h3>
    <input type="hidden" value="<?php echo $media_number; ?>" class="media_number" name="media_no"></input>
    
    <input type="text" name="title" placeholder="Full title" class="form-control"> <br>

    <h3>Story Description</h3>
    <textarea name="story" rows="10" class="form-control"></textarea><br>

    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Create Story </button>
  </form>


  </div>


  <div class="col-md-6">
  
  <h3>All Stories</h3>
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
  
<?php $msg_query = $conn -> query("SELECT * FROM story");  

while ($sData = mysqli_fetch_array($msg_query)) { 
  $id = $sData['id'];
  $name = $sData['title'];
  $story = $sData['story'];

  $media_no = $sData['media_no'];
  $get_img = $conn -> query("SELECT * FROM media WHERE media_number = '$media_no' ");
  $row_img = mysqli_fetch_assoc($get_img);

  $img = $row_img['file_name'];
  
  $image = $site_url."/img/stories/".$img;

  ?>
    <tr>
      <th scope="row"><?php echo $id ?></th>
      <td><img src="<?php echo $image ?>" width="50" height="50"></td>
      <td><?php echo $name ?></td>

      <td>
        <button class="btn btn-warning edit_story" story_edit_id="<?php echo $id ?>" story_edit_name="<?php echo $name ?>" story_edit_story="<?php echo $story ?>" story_edit_image="<?php echo $img ?>" data-toggle="modal" data-target="#user-modal-detail"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <button class="btn btn-danger delete_story" story_delete_id=<?php echo $id ?>><i class="fa fa-trash" aria-hidden="true"></i></button>

      </td>
    </tr>
  <?php } ?>


  </tbody>
</table>

  </div>


  </div>

</div>
<!-- *************************************************************** -->
<div id="user-modal-detail" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Story</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
      
          <form action="action/update_story.php" method="POST" enctype="multipart/form-data">
          
          <h3>Story Name</h3>
          <input type="hidden" value="<?php echo $media_number; ?>" class="media_number" name="media_no"></input>
          <input type="hidden" id="story_edit_id" name="story_edit_id" />
          
          <input type="text" name="title" placeholder="Full title" value="" id="story_edit_name" class="form-control"> <br>

          <h3>Story Description</h3>
          <textarea name="story" rows="10" class="form-control" id="story_edit_desc"></textarea><br>

          <h3>Old Image</h3>
          <div id="show_img"></div>

          <h3>Upload New(Optional)</h3>
          <input type="hidden" name="old_photo" id="old_photo" />
          <input type="file" class="form-control" name="story_image"> <br/>

          <button type="submit" class="btn btn-primary" name="edit_story_info"> <i class="fa fa-plus"></i> Create Story </button>
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

    $(".delete_story").click(function(){
        var story_delete_id=$(this).attr('story_delete_id');
        // alert(story_delete_id);
        // return;
        $.ajax({
            url:"action/delete_story.php",
            method:"POST",
            data:{deleteStory:1,del_id:story_delete_id},
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

    $(".edit_market").click(function(){
        // alert('hi');
        // return;
        // var market_place_id=$(this).attr('market_place_id');
        // var market_place_name=$(this).attr('market_place_name');
        // var market_place_city_id=$(this).attr('market_place_city_id');
        // var market_place_city_name=$(this).attr('market_place_city_name');
        // var market_place_state_id=$(this).attr('market_place_state_id');
        // var market_place_state_name=$(this).attr('market_place_state_name');
        // var market_place_image=$(this).attr('market_place_image');

        //         $('#market_edit_id').val(market_place_id);
        //         $('#market_edit_name').val(market_place_name);
        //         $('#state_edit_id').val(market_place_state_id);
        //         $('#city_edit_id').val(market_place_city_id);

        //         $('#old_photo').val(market_place_image);

        //         let url = "http://frontcyber.in/cms/ecom/vistox/site-admin/images/market/";
        //         $('#show_img').html('<img src="'+ url + market_place_image + '" />');

        // $.ajax({
        //     url:"../action/get_modal_data.php",
        //     method:"POST",
        //     data:{market_place_id:market_place_id},
        //     dataType:"json",
        //     success:function(data){
        //         $('#market_edit_id').val(data.id);
        //         $('#market_edit_name').val(data.market_name);
        //         $('#old_photo').val(data.market_image);

        //         let url = "http://frontcyber.in/cms/ecom/vistox/site-admin/images/market/";
        //         $('#show_img').html('<img src="'+ url + data.market_image + '" />');
        //     }});
    });

    $(".edit_story").click(function(){
        var story_edit_id=$(this).attr('story_edit_id');
        var story_edit_name=$(this).attr('story_edit_name');
        var story_edit_story=$(this).attr('story_edit_story');
        var story_edit_image=$(this).attr('story_edit_image');
        // alert(story_edit_name);

        $('#story_edit_id').val(story_edit_id);
        $('#story_edit_name').val(story_edit_name);
        $('#story_edit_desc').val(story_edit_story);

        $('#old_photo').val(story_edit_image);

                let url = "https://cms.cybertizeweb.com/boxoniq-crm/img/stories/";
                $('#show_img').html('<img src="'+url+ story_edit_image + '" style="width:250px"/>');

    });

  
  })
</script>