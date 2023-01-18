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
    

  <h2>Add Contact Detail</h2>
  

  <form action="save-contact-detail.php" method="POST">
    
    <h3>Contact Detail</h3>
    
    <input type="text" name="mobile" placeholder="Enter Mobile No" class="form-control"> <br>
    <input type="text" name="phone" placeholder="Enter Phone No" class="form-control"> <br>
    <input type="text" name="email" placeholder="Enter Email" class="form-control"> <br>

    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Create Contact Detail</button>
  </form>

  </div>

  <div class="col-md-6">
  
  <h3>All Contact Details</h3>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Mobile</th>
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  
<?php $msg_query = $conn -> query("SELECT * FROM contact_detail");  

while ($sData = mysqli_fetch_array($msg_query)) { 
  $id = $sData['id'];
  $mobile = $sData['mobile'];
  $phone = $sData['phone'];
  $email = $sData['email'];
  ?>
    <tr>
      <th scope="row"><?php echo $id ?></th>
      <td><?php echo $mobile ?></td>
      <td><?php echo $phone ?></td>
      <td><?php echo $email ?></td>
      <td>
        <button class="btn btn-warning edit_contact_detail" contact_edit_id="<?php echo $id ?>" contact_edit_email="<?php echo $email ?>" contact_edit_mobile="<?php echo $mobile ?>" contact_edit_phone="<?php echo $phone ?>" data-toggle="modal" data-target="#editContact"><i class="fa fa-pencil" aria-hidden="true"></i></button>
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
<div id="editContact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Contact Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
          <form action="action/update_contact_deail.php" method="POST" enctype="multipart/form-data">
            <h3>Enter Mobile</h3>
            <input type="hidden" id="contact_edit_id" name="contact_edit_id" />
            <input type="text" name="contact_edit_mobile" placeholder="Faq Question" value="" id="contact_edit_mobile" class="form-control"> <br>

            <h3>Enter Phone</h3>
            <input type="text" name="contact_edit_phone" placeholder="Faq Answer" value="" id="contact_edit_phone" class="form-control"> <br>

            <h3>Enter Email</h3>
            <input type="email" name="contact_edit_email" placeholder="Faq Answer" value="" id="contact_edit_email" class="form-control"> <br>
            <button type="submit" class="btn btn-primary" name="edit_blog_section"> <i class="fa fa-plus"></i>Update Faq Section</button>

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

    $(".edit_contact_detail").click(function(){
        var contact_edit_id=$(this).attr('contact_edit_id');
        var contact_edit_email=$(this).attr('contact_edit_email');
        var contact_edit_phone=$(this).attr('contact_edit_phone');
        var contact_edit_mobile=$(this).attr('contact_edit_mobile');
        // alert(why_edit_id);
        $('#contact_edit_id').val(contact_edit_id);
        $('#contact_edit_email').val(contact_edit_email);
        $('#contact_edit_phone').val(contact_edit_phone);
        $('#contact_edit_mobile').val(contact_edit_mobile);

    });

  
  })
</script>