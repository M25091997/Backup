  <?php 



session_start();



include ("../../config.php");



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



	<title>CREATE BUNDLE</title>



	<!--Font-->



<link href='//fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>







<!-- JQUERY-->



<script src="//code.jquery.com/jquery-2.2.3.min.js"></script>


<!--Live Form-->



<script src="../../assets/js/liveform.js"></script>

<!--Drop Zone-->



<script src="https://forexblues.com/assets/js/dropzone.js"></script>



<link rel="stylesheet" href="https://forexblues.com/assets/css/dropzone.css">

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

  .img-serve{
                        background-color: #f9f9f9;
                        height: 50px;
                        width: 50px;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-size: cover;
                    }




/*Dropdown search for Customer*/
.dropbtn {
  background-color: #04AA6D;
  color: #000;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  background: #00ff89;
  height: 64px;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #00ff89;
  background: #00ff89;
  color: #3e3e3e !important;
}

#myInput {
  box-sizing: border-box;
  background-image: url('searchicon.png');
  background-position: 14px 12px;
  background-repeat: no-repeat;
  font-size: 16px;
  padding: 14px 20px 12px 45px;
  border: none;
  border-bottom: 1px solid #00ff89;
  width: 100%;
}

#myInput:focus {outline: 3px solid #00ff89;}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  min-width: 320px;
  overflow: auto;
  border: 1px solid #ddd;
  z-index: 1;
  height: 384px;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #00ff89;}

.show {display: block;}

.small-hint{
  font-size: 70%;
    position: absolute;
    left: 38px;
    top: 44px;
    color: #2c3a4c;
}



</style>


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
  z-index: 9999;
}

.my-float{
  margin-top:22px;
}
</style>

</head>

<body>

<a href="index.php" class="float">
<i class="fa fa-home my-float"></i>
</a>

<div class="container" style="background-color: #fff; width: 100%; border-radius: 5px; ">


<div class="row">


	<div class="col-md-6 col-xs-6" style="border-right: 1px solid #efefef; ">

	<form class="save-product-form11" action="save-bundle-creator.php" method="post">

	<input type="hidden" class="firebase-tokens" name="firebase-tokens">

	<h3 class="text-left"><center>CREATE BUNDLE</center></h3>

	<div class="row" style="margin: 10px;">

 <center><button type="submit" name="addBundle" class="btn btn-primary">Add to Bundle</button></center>

<div  style="height: 547px;
    overflow-y: scroll;">

    <table class="table table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Category</th>
        <th>Image</th>
        <th style="width: 26%;">CHECK <input type="checkbox" class="check-all" title="Select All Customers" name=""></th>
      </tr>
    </thead>
    <tbody>
      

      <?php 
      $q = $conn -> query("SELECT * FROM items ORDER BY id DESC");
      $item_url = "https://cms.cybertizeweb.com/boxoniq-crm/media/";

  while ($row = mysqli_fetch_array($q)) {
    $id = $row['id'];
    $name = $row['name'];
    $category_id = $row['category_id'];
    $media_number = $row['media_number'];

    $get_media = $conn -> query("SELECT file_name FROM media WHERE media_number = '$media_number'");
    $row_media = mysqli_fetch_assoc($get_media);
    $file_name = $row_media['file_name'];
    $item_img = $item_url.$file_name;


    $get_cat = $conn -> query("SELECT * FROM super_category WHERE id = '$category_id'");
    $row_cat = mysqli_fetch_assoc($get_cat);
    $cat_name = $row_cat['name']; 

    ?>

    		<tr >
        <td><label for="<?php echo $id; ?>"><?php echo $id; ?></label> </td>
        <td><?php echo $name ?></td>
        <td><?php echo $cat_name ?></td>
        <td>
          <div class="img-serve" style="background-image: url('<?php echo $item_img ?>');"></div>
      </td>

        <td>
          <center>
          <input type="checkbox" item_id="<?php echo $row['id']; ?>" value="<?php echo $id; ?>" id="<?php echo $id; ?>" class="chk">
        </center>
      </td>
        
      </tr>
      

    <?php } ?>

    </tbody>
  </table>

</div>


	</div>



	</form>

	</div>
  <div class="col-md-6">
  
  <h3>All Bundle Items</h3>
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
  
<?php 

$get_bundle_items = $conn -> query("SELECT * FROM bundle_creator");
$row_bundle = mysqli_fetch_assoc($get_bundle_items);
$item_ids = $row_bundle['item_ids'];
$id_arr = explode(",",$item_ids);

for($i = 0;$i<count($id_arr);$i++){

$msg_query = $conn -> query("SELECT * FROM items WHERE id = '$id_arr[$i]' ");  
$sData = mysqli_fetch_array($msg_query);

// while ($sData = mysqli_fetch_array($msg_query)) { 
  $id = $sData['id'];
  $name = $sData['name'];
  $media_number = $sData['media_number'];

  $get_img = $conn -> query("SELECT file_name FROM media WHERE media_number = '$media_number'");
  $row_img = mysqli_fetch_assoc($get_img);

  $img = $row_img['file_name'];
  
  $image = $site_url."/media/".$img;

  ?>
    <tr>
      <th scope="row"><?php echo $id ?></th>
      <td><img src="<?php echo $image ?>" width="50" height="50"></td>
      <td><?php echo $name ?></td>
      <td>
        <!-- <button class="btn btn-warning edit_bund_subs" bundle_edit_id="<?php echo $id ?>" bundle_edit_desc="<?php echo $desc ?>" bundle_edit_name="<?php echo $name ?>" bundle_edit_img="<?php echo $img ?>"  data-toggle="modal" data-target="#editBundleSubs"><i class="fa fa-pencil" aria-hidden="true"></i></button> -->
        <button class="btn btn-danger delete_item_bundle" bundle_delete_id=<?php echo $id ?>><i class="fa fa-trash" aria-hidden="true"></i></button>

      </td>
    </tr>
  <?php } ?>


  </tbody>
</table>

  </div>

	</div>

</center>

<br>

</div>

</body>
</html>

<script type="text/javascript"> 
$(".float").click(function(){ window.close(); });
</script>











<script type="text/javascript">







$(document).ready(function(){

  $(".delete_item_bundle").click(function(){
        var bundle_delete_id=$(this).attr('bundle_delete_id');
        // alert(bundle_delete_id);
        // return;
        $.ajax({
            url:"action/delete_bundle_item.php",
            method:"POST",
            data:{deleteBundleItem:1,del_id:bundle_delete_id},
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



	$(".media_number_head").val($(".media_number").val());

	$(".p-title").focus();



});





$(".x-magic-btn").click(function(){



	$(".x-magic-btn").hide();

	$(".x-magic-form").show();

	$(".is-image").val("1");

});





	$('.save-product-form').ajaxForm({


                beforeSend: function() {    



                  $( ".save-btn-right" ).prop( "disabled", true );



                  $("body").css("cursor", "wait");



                  $(".status-holder").html("<img src='../assets/icons/spin.gif' style='width: 13%;''>  Publishing, Please Wait...");


                },


                uploadProgress: function(event, position, total, percentComplete) {

                },



                success: function(r) { 

                  console.log(r);

                 if ( r == "Published" ) { location.reload(); }



                	else{ alert(r); location.reload(); }


                },



                complete: function(xhr) {


                }



            });



</script>

<style type="text/css">



	.save-btn-right{



		border-radius: 2px;



	}







	body .form-control{



		border-radius: 1px !important;



	}



</style>

<script type="text/javascript">
	/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
  $("#myInput").focus();
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

$(".all-a").click(function(e){
    //alert($(this).attr("item-name"));
    
   // $("tbody").append('<tr><td style="font-size: 10px;" >Platinum Plus Plan - 9 Currency Package for 3 months Forecast for 9 Currencie...</td> <td style="font-size: 10px;" ><center>1</center></td>  <td style="font-size: 10px;"><i class="fa fa-inr"></i>5,000</td> <td style="font-size: 10px;"><i class="fa fa-inr"></i>5,000</td> </tr>');
    document.getElementById("myDropdown").classList.toggle("show");

  $("[name=item_id]").val($(this).attr("item-id"));

  $(".a-holder").html('<i class="fa fa-user-circle-o" aria-hidden="true"></i> ' + $(this).html() + '<br><small class="small-hint">Click to Reselect <i class="fa fa-chevron-down" aria-hidden="true"></i></small> <br>');

  $("[name=price]").focus();

  //window.location.href="stocks-v2.php?item-id="+$(this).attr("item-id");

  });
</script>


<script type="text/javascript">
	

		$(".chk").click(function(){

      var val_ = [];
			
     	 $('.chk:checked').each(function(i){
        val_[i] = $(this).attr('item_id');
      	});

     	 $(".firebase-tokens").val(val_);

     	 });


$(".check-all").click(function(){
  var val_ = [];
    $('input:checkbox').not(this).prop('checked', this.checked);
    let x = 0;

    $('.chk:checked').each(function(i){
         if($(this).attr('item_id') != ''){
          val_[x] = $(this).attr('item_id');
          x++;
         }
        // val_[i] = ($(this).attr('firebase') != '') ? $(this).attr('firebase') : "";

        });

    $(".firebase-tokens").val(val_);

});

</script>
<?php 



}



?>