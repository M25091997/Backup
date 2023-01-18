<?php 

session_start();

include ("../../config.php");

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

  <title>NEW ATTRIBUTE</title>

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


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>





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
    

  <h2>Add New Attribute</h2>

  <form action="save-attribute.php" method="POST">
    <input type="hidden" value="<?php echo $media_number; ?>" class="media_number" name="media-number-p"></input>
    <h3>Attribute Name</h3>
    <input type="text" name="name" placeholder="Attribute full name" class="form-control" required> <br>

    <hr>

    <h2>Select Product</h2>
    

    <input type="hidden" class="account-id item_id" name="item_id" value="0" />
  
  <div class="dropdown" id="acc">
  <button type="button" onclick="myFunction()" class="dropbtn btn btn-primart a-holder"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Select Item Dropdown <i class="fa fa-chevron-down" aria-hidden="true"></i></button>
  <div id="myDropdown" class="dropdown-content">
    <input type="text" placeholder="Search by Product name, id..." id="myInput" onkeyup="filterFunction()">
    

    <?php $q = $conn -> query("SELECT * FROM items ORDER BY id DESC");

  while ($row = mysqli_fetch_array($q)) {
    $id = $row['id'];
    $name = $row['name'];
    $phone = $row['phone']; ?>

    <a href="javascript:(0)" class="all-a a" item-id="<?php echo $id; ?>"> <?php echo $id; ?> - <?php echo $name; ?> </a>

    <?php } ?>
  </div>
</div>


    <hr>

    <h3>Price (Common Price for All / Default Pincodes)</h3>
    <input type="text" name="price" id="item_pri" placeholder="Actual Price in Rs." class="form-control" required> <br>

    <hr>

    <h2>Product in Stock? </h2>
    <select class="form-control" name="avaiability">
      <option value="0">YES</option>
       <option value="1">NO</option>
    </select>



    <hr>


    <h3>MRP</h3>
    <input type="text" name="mrp" id="item_mrp" placeholder="Current Market Rate" class="form-control" required> <br>


    <h3>Discount</h3>
    <input type="text" name="discount" placeholder="discount you are providing" class="form-control" id="item_dis"> <br>

    <!-- <h3>Discount Percent(%)</h3>
    <input type="text" name="discount" placeholder="discount percent you are providing" class="form-control" id="item_dis_percent" disabled> <br> -->

    <h3>Physical Stock?</h3>
    <input type="numbers" name="stock" placeholder="Stock Quantity Available Ex: 100" min="1" class="form-control" required> <br>

    <!-- <h3>Expiry Date?</h3>
    <input type="text" name="expiry" id="datepicker" placeholder="Expiry Date (Click here to open calender)" min="1" class="form-control" required> <br>

    <script type="text/javascript">

    $( function() {

    // Get today's date
    var today = new Date();

    $("#datepicker").datepicker({
    //changeMonth: true,
    //changeYear: true,
    //minDate: today,
    dateFormat: "yy-mm-dd",
    /*onSelect: function (d,o){proceed(d);}*/

    // set the minDate to the today's date
    // you can add other options her
	});
	});

    </script> -->



    <!-- <h3>Pincodes Data</h3>

    <ul class="list-group list-group-flush">
    <li class="list-group-item pins">
      
    </li>
    </ul>

    <div class="row">

      <div class="col-md-3 col-xs-3"><input type="text" class="form-control pincode" placeholder="Pincode" name=""/></div>
      <div class="col-md-3 col-xs-3"><input type="text" class="form-control pin-price" placeholder="Price" name=""/></div>
      <div class="col-md-3 col-xs-3"><input type="text" class="form-control pin-delivery" placeholder="Delivery Days" name=""/></div>
      <div class="col-md-3 col-xs-3"><button type="button" class="btn btn-primary add-pincode-btn" class=""><i class="fa fa-plus"></i></button></div>
    </div>



    <hr> -->




    <button type="submit" class="btn btn-primary" > <i class="fa fa-plus"></i> Create Attribute </button>
  </form>


  </div>


  <div class="col-md-6">


      <h3>All Attributes</h3>


  <ul class="list-group list-group-flush">

  <?php $msg_query = $conn -> query("SELECT * FROM attributes ORDER BY id DESC");  

  while ($sData = mysqli_fetch_array($msg_query)) { 

    $attr_id = $sData['id'];
    $super_id = $sData['item_id'];
    $amount = $sData['price'];
    $availablity = $sData['availablity'];

    $sC = $conn -> query("SELECT * FROM items WHERE id = '$super_id'");  
    while ( $SD = mysqli_fetch_array($sC) ) { $name_m = $SD['name']; } ?>

  <li class="list-group-item"><?php echo $sData['name']; ?> <small style="color: #7d7d7d;">(in <?php echo $name_m; ?>)</small> - [Rs. <?php echo $amount; ?>] <?php if ( $availablity != 0 ) { ?> <small><a href="in-stock.php?id=<?php echo $attr_id; ?>" style="color: green;" >Set In Stock</a> </small> <?php } else { ?> <small><a href="out-of-stock.php?id=<?php echo $attr_id; ?>">Set Out of Stock</a> </small> <?php } ?> <form class="edit-form e-<?php echo $attr_id; ?>-form" style="display: none;"  method="POST" action="update-attribute.php"> <input type="hidden" name="id" value="<?php echo $attr_id; ?>">  <input type="text"  class="e-<?php echo $attr_id; ?>-input" name="price" placeholder="Update Pricing"> <button type="submit">Update Price</button></form> <div class="btn-actions-<?php echo $attr_id; ?>" style="position: absolute; left: 88%; top: 22%;"> <a href="delete-attribute.php?id=<?php echo $sData['id']; ?>" class="" style="float: right; "><i class="fa fa-trash"></i></a> <a href="javascript:(0)" class="e-<?php echo $attr_id; ?>" style="float: right;"><i class="fa fa-edit"></i></a> </div> </li>


  <script type="text/javascript">
    $(".e-<?php echo $attr_id; ?>").click(function(){ $(".e-<?php echo $attr_id; ?>-form").show(); $(".btn-actions-<?php echo $attr_id; ?>").hide(); $(".e-<?php echo $attr_id; ?>-input").focus(); });
  </script>

  <?php } ?>
</ul>
    

  </div>


  </div>

</div>

</body>

</html>

<script type="text/javascript">
$(".add-pincode-btn").click(function(){
var dataString = 'pincode='+ $(".pincode").val()+'&price='+ $(".pin-price").val()+'&delivery='+ $(".pin-delivery").val() + '&media-number=<?php echo $media_number; ?>';
$.ajax({
type: "POST",
url: "save-pincode.php",
data: dataString,
cache: false,
success: function(html)
{
 $(".pins").append("" + $(".pincode").val() + ", Rs. " + $(".pin-price").val() + ", Delivery in " + $(".pin-delivery").val() + " Days.<br>");
$(".pincode").val("");
$(".pin-delivery").val("");
$(".pin-price").val("");
}
});
});
</script>

<script>
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

  });

  $("#item_mrp").keyup(function(e){
    var item_pri = $("#item_pri").val();
    var item_mrp = $("#item_mrp").val();

    var item_discount = item_mrp - item_pri;
    // var item_discount_percent = (item_discount/item_mrp)*100;
    // alert(item_discount);
    $('#item_dis').val(item_discount);
    // $('#item_dis_percent').val(item_discount_percent + ' %');

  });

</script>



<?php } ?>