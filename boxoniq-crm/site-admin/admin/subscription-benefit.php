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

  <div class="col-md-5">
    

  <h2>Add New Benifit for Subscription</h2>
  

  <form action="save-subscription.php" method="POST">
    
    <h3>Subscription Benefit</h3>
    
    <input type="text" name="benefit" placeholder="Title" class="form-control"> <br>

    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Create Subscription Benefit</button>
  </form>


  </div>


  <div class="col-md-7">
  
  <h3>All Bundle Benefits</h3>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  
<?php $msg_query = $conn -> query("SELECT * FROM subscription_benefit");  

while ($sData = mysqli_fetch_array($msg_query)) { 
  $id = $sData['id'];
  $name = $sData['benefit'];
  ?>
    <tr>
      <th scope="row"><?php echo $id ?></th>
      <td><?php echo $name ?></td>
      <td style="width:100px">
        <button class="btn btn-warning edit_subs" subs_edit_id="<?php echo $id ?>" subs_edit_name="<?php echo $name ?>" data-toggle="modal" data-target="#editBundleSubs"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <button class="btn btn-danger delete_subs" subs_delete_id=<?php echo $id ?>><i class="fa fa-trash" aria-hidden="true"></i></button>

      </td>
    </tr>
  <?php } ?>


  </tbody>
</table>

  </div>


  </div>

</div>

<!-- *************************************************************** -->
<div id="editBundleSubs" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Subscription Benifit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
          <form action="action/update_subs_benefit.php" method="POST" enctype="multipart/form-data">
            <h3>Title</h3>
            <input type="hidden" id="subs_edit_id" name="subs_edit_id" />
            
            <input type="text" name="subs_edit_name" placeholder="Full title" value="" id="subs_edit_name" class="form-control"> <br>

            <!-- <h3>Title</h3>
            <input type="text" name="bundle_edit_desc" placeholder="Full title" value="" id="bundle_edit_desc" class="form-control"> <br>

            <h3>Old Image</h3>
            <div id="show_img"></div>

            <h3>Upload New(Optional)</h3>
            <input type="hidden" name="old_photo" id="old_photo" />
            <input type="file" class="form-control" name="bundle_edit_img"> <br/> -->

            <button type="submit" class="btn btn-primary" name="edit_subs_benefit_info"> <i class="fa fa-plus"></i> Update Bundle Section </button>
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

    $(".edit_subs").click(function(){
        var subs_edit_id=$(this).attr('subs_edit_id');
        // var bundle_edit_desc=$(this).attr('bundle_edit_desc');
        var subs_edit_name=$(this).attr('subs_edit_name');
        // var bundle_edit_img=$(this).attr('bundle_edit_img');
        // alert(subs_edit_id);
        $('#subs_edit_id').val(subs_edit_id);
        // $('#bundle_edit_desc').val(bundle_edit_desc);
        $('#subs_edit_name').val(subs_edit_name);


        // $('#old_photo').val(bundle_edit_img);

        //         let url = "https://cms.cybertizeweb.com/boxoniq-crm/img/bundle/";
        //         $('#show_img').html('<img src="'+url+ bundle_edit_img + '" style="width:250px"/>');

    });

  
  })
</script>