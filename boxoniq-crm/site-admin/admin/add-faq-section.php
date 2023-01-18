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

  <h2>Add Faq Section</h2>

  <form action="save-faq-section.php" method="POST">
    
    <h3>Faq Question</h3>
    <input type="text" name="faq_question" placeholder="Enter Question" class="form-control"> <br>
    <h3>Faq Answer</h3>
    <input type="text" name="faq_answer" placeholder="Enter Answer" class="form-control"> <br>
   
    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Create Faq Section</button>
  </form>

  </div>

  <div class="col-md-7">
  
  <h3>All Faq Details</h3>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Faq Question</th>
      <th scope="col">Faq Answer</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  
<?php $msg_query = $conn -> query("SELECT * FROM faq_section");  

while ($sData = mysqli_fetch_array($msg_query)) { 
  $id = $sData['id'];
  $faq = $sData['faq'];
  $answer = $sData['answer'];
  ?>
    <tr>
      <th scope="row"><?php echo $id ?></th>
      <td><?php echo $faq ?></td>
      <td><?php echo $answer ?></td>
      <td>
        <button class="btn btn-warning edit_faq_section" faq_edit_id="<?php echo $id ?>" faq_edit_faq="<?php echo $faq ?>" faq_edit_answer="<?php echo $answer ?>" data-toggle="modal" data-target="#editFaq"><i class="fa fa-pencil" aria-hidden="true"></i></button>
        <button class="btn btn-danger delete_faq" faq_delete_id=<?php echo $id ?>><i class="fa fa-trash" aria-hidden="true"></i></button>

      </td>
    </tr>
  <?php } ?>


  </tbody>
</table>

  </div>


  </div>

</div>

<!-- *************************************************************** -->
<div id="editFaq" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Edit Faq Section</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
          <form action="action/update_faq_section.php" method="POST" enctype="multipart/form-data">
            <h3>Faq Question</h3>
            <input type="hidden" id="faq_edit_id" name="faq_edit_id" />
            <input type="text" name="faq_edit_faq" placeholder="Faq Question" value="" id="faq_edit_faq" class="form-control"> <br>

            <h3>Faq Answer</h3>
            <input type="text" name="faq_edit_answer" placeholder="Faq Answer" value="" id="faq_edit_answer" class="form-control"> <br>
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

    $(".delete_faq").click(function(){
        var faq_delete_id=$(this).attr('faq_delete_id');
        // alert(faq_delete_id);
        // return;
        $.ajax({
            url:"action/delete_faq_section.php",
            method:"POST",
            data:{deleteFaqSection:1,del_id:faq_delete_id},
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

    $(".edit_faq_section").click(function(){
        var faq_edit_id=$(this).attr('faq_edit_id');
        var faq_edit_faq=$(this).attr('faq_edit_faq');
        var faq_edit_answer=$(this).attr('faq_edit_answer');
        // alert(why_edit_id);
        $('#faq_edit_id').val(faq_edit_id);
        $('#faq_edit_faq').val(faq_edit_faq);
        $('#faq_edit_answer').val(faq_edit_answer);

    });
  
  })
</script>