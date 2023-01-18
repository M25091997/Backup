<?php 

session_start();

include ("../../config.php");

if (!isset($_SESSION['admin_id'])) {

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

	<title>NOTIFICATION SHOOTER</title>

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

<br>

<div class="container" style="background-color: #fff; width: 29%; border-radius: 5px; ">

<center>

<div class="row">

	<div class="col-md-12 col-xs-12" style="border-right: 1px solid #efefef; ">

	<form class="save-product-form" action="save-gcm-user.php" method="post">

	<input type="hidden" class="firebase-tokens" name="firebase-tokens">

	<input type="hidden" value="none" class="media_number_head" name="media-number-head"></input>

	<input type="hidden" value="0" name="is-image" class="is-image">

	<h4 class="text-left"><center>NOTIFICATION SHOOTER USER</center></h4>

	<div class="row" style="margin: 10px;">

	<h3 class="text-left">Notification Title <input type="submit" class="btn btn-info btn-xs btn-mini" style="display: inline;" name="submit" value="Shoot Notification" autofocus="true" /></h3>

	<input class="form-control p-title" name="title" placeholder="Notification Title" required></input>

	<br>

	<h3 class="text-left">Notification Body </h3>

	<textarea class="form-control" name="body" placeholder="Body Paragraph" required></textarea>

	<br>

		<select class="form-control category_selector category-val" name="customer-id">


	   <option value="ALL">MULTICAST</option>


	</select>
<br>
  <div class="row">

    <div class="col-md-6">
      <h6 class="text-left"> INTENT / PAGE OPENER </h6>

      <select class="form-control intent_type_selector intent-type" name="intent-type">
        <option value="HOME">HOME PAGE</option>
        <!-- <option value="SUPER">SUPER CATEGORY</option>
        <option value="SUB">SUB CATEGORY</option>
        <option value="CHILD">CHILD CATEGORY</option>
        <option value="PRODUCT">PRODUCT PAGE</option>
        <option value="RATING">GET REVIEW & RATING<sup><small>( After Order Complete )</small></sup></option> -->

      </select>


    </div>

    <div class="col-md-6">
      <h6 class="text-left"> INTENT ID </h6>

      <input class="form-control p-title intent-id" value="0" name="intent-id" placeholder="SUB, SUPER, ITEM ID" value="" required></input>


    </div>

    <hr>

    <!-- <div class="col-md-12">
      
    <h3 class="text-left">Page Header Text<br><small style="font-size: 10px;">This will be dislayed on the page header after clicking the notification</small>
      <input class="form-control header-text" name="header-text" placeholder="Groceries at 20% off! OR Super Saver Deals..." required></input>
    </h3>

    </div> -->

  </div>

<br>

<div  style="height: 347px;
    overflow-y: scroll;">
<center><?php

$q1 = $conn -> query("SELECT * FROM astrologer WHERE verification = '1' AND firebase_token != ''");
echo "<span style='color: green;'>LIVE: ".mysqli_num_rows($q1)."</span>";

?></center>
    <table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>NAME</th>
        <th style="width: 26%;">CHECK <input type="checkbox" class="check-all" title="Select All Customers" name=""></th>
      </tr>
    </thead>
    <tbody>
      
      <?php $q = $conn -> query("SELECT * FROM user WHERE verification = '1' ORDER BY id DESC");

  while ($row = mysqli_fetch_array($q)) {
    $id = $row['id'];
    $name = $row['f_name'];
    $phone = $row['phone']; ?>

    		<tr >
        <td><label for="<?php echo $id; ?>"><?php echo $id; ?></label> </td>
        <td><label style="font-weight: 400;" for="<?php echo $id; ?>"><?php echo $name; ?> <i style="color: <?php echo ( $row['firebase_token'] != "" ) ? "green;" : "#8e8e8e;"; ?>; font-size: 8px;" class="fa fa-circle" aria-hidden="true"></i> </label></td>
        <td><center><input type="checkbox" firebase="<?php echo $row['firebase_token']; ?>" value="<?php echo $id; ?>" id="<?php echo $id; ?>" class="chk"></center></td>
        
      </tr>
      

    <?php } ?>

    </tbody>
  </table>

</div>

	</div>

	</form>

	<center>

		<button class="btn btn-mini btn-xs btn-info x-magic-btn">Attach image <i class="fa fa-image"></i></button>

	</center>

			<form action="parser-gcm.php" class="dropzone col-md-12 x-magic-form" style="background-color:#fff; border: none; border: 1px solid #efefef; border-radius: 3px; display: none;">

<input type="hidden" value="<?php echo "GCM".time().rand(); ?>" class="media_number" name="media-number"></input>

</form>

<script type="text/javascript">

  $(".dropzone").dropzone({

    maxFiles: 1,

    dictDefaultMessage: '<img src="drop.png"></img> <br><br> Drag And Drop Or Click here to upload Notification Images',

    acceptedFiles: 'image/*',

    init: function() {

    this.on('success', function( file, resp ){

    });

  },    

})

</script>



		



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
        val_[i] = $(this).attr('firebase');
      	});

     	 $(".firebase-tokens").val(val_);

     	 });

$(".intent-type").change(function(){
  
  ($(".intent-type").val() == "HOME") ? $(".intent-id").val('0') : $(".intent-id").focus();
  ($(".intent-type").val() == "RATING") ? $(".intent-id").val('0') : $(".intent-id").focus();
  ($(".intent-type").val() == "RATING") ? $(".header-text").val('N/A') : $(".intent-id").focus();
  ($(".intent-type").val() == "HOME") ? $(".header-text").val('N/A') : $(".intent-id").focus();

});

$(".check-all").click(function(){
  var val_ = [];
    $('input:checkbox').not(this).prop('checked', this.checked);
    let x = 0;


    $('.chk:checked').each(function(i){
         if($(this).attr('firebase') != ''){
          val_[x] = $(this).attr('firebase');
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