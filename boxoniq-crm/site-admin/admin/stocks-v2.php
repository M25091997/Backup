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







  <title>STOCK MANAGEMENT</title>







  <!--Font-->







<link href='//fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>















<!-- JQUERY-->







<script src="//code.jquery.com/jquery-2.2.3.min.js"></script>







<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>









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

.pagination>li>a, .pagination>li>span {
    position: relative;
    float: left;
    padding: 8px 12px;
    line-height: 1.42857143;
    text-decoration: none;
    color: #584dff !important;
    font-weight: 800 !important;
    background-color: #ffffff;
    border: 1px solid #dddddd;
    margin-left: -1px;
}

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







.input-mini{



  width: 57px;



  height: 21px; 



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



<div class="container-fluid" style="background-color: #fff;">







  <div class="row"><center><h2>Attributes / Stock Management</h2> <div style="">
  


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

    <a href="javascript:(0)" style="text-align: left;"  class="all-a a" item-id="<?php echo $id; ?>"> <?php echo $id; ?> - <?php echo $name; ?> </a>

    <?php } ?>
  </div>
</div>

<button type="button" class="r dropbtn">Reset Page</button>
  <button class="va dropbtn" type="button" >View All</button>
  <button class="va-d dropbtn" type="button" >View Deactivated Stocks</button>

</div></center></div>


<br>




  <div class="row">







    <table class="table table-hover table-bordered">







      <thead>







        <tr>



          <th>ID</th>



          <th style="width: 4%;"> ATTR. NAME </th>



          <th style="width: 188px;"> PRODUCT HIERARCHY </th>



          <th style="width: 68px;"> PRICE </th>



          <th style="width: 5%;">MRP.</th>



          <th style="width: 69px;"> DISCOUNT </th>



          <th style="width: 85px;"> PHYSICAL STOCK </th>



          <th style="width: 78px;"> EXP. DATE </th>

          <th></th>
          <th></th>

          <!-- <th style="width: ;"> PINCODES </th>



          <th style="width: ;"> ADD NEW PINCODES </th> -->



          <th style=""></th>



        </tr>







      </thead>























      <tbody>







        <?php 

         //determine which page number visitor is currently on  
    if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }    



        //define total number of results you want per page  
    $results_per_page = 20;  

        //determine the sql LIMIT starting number for the results on the displaying page  
    $page_first_result = ($page-1) * $results_per_page;  
  
    //retrieve the selected results from database 

    if (!isset($_GET['q']) && !isset($_GET['item-id'])) {
      $cQ = $conn -> query("SELECT * FROM attributes ORDER BY id DESC LIMIT " . $page_first_result . ',' . $results_per_page); 
    } else {
      $item_id_q = $_GET['item-id'];
      $cQ = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id_q' ORDER BY id DESC LIMIT 200"); 
    }
    







        while ($rowD = mysqli_fetch_array($cQ)) {



          $id = $rowD['id'];



          $name = $rowD['name'];



          $item_id = $rowD['item_id'];



          $price = $rowD['price'];



          $mrp = $rowD['mrp'];



          $discount = $rowD['discount'];



          $media_number_A = $media_number = $rowD['media_number'];



          $stock = $rowD['stock'];



          $expiry_date = $rowD['expiry_date'];


          $deactivate = $rowD['deactive'];



          $q = $_GET['q'];

          if (isset($_GET['q'])) {
          $category_Q = $conn -> query("SELECT * FROM items WHERE name LIKE '%$q%' ");
          } else {
            $category_Q = $conn -> query("SELECT * FROM items WHERE id = '$item_id' ");
          } 

          if (mysqli_num_rows($category_Q) != 0) {

          while ($iData = mysqli_fetch_array($category_Q)) {



            $item_name = $iData['name'];



            $category_id = $iData['category_id'];



            $sub_category_id = $iData['sub_category_id'];



            $category_2_id = $iData['category_2_id'];


            $db_item_id = $iData['id'];



          }







          $cQ1 = $conn -> query("SELECT * FROM super_category WHERE id = '$category_id'");



          while ($iData = mysqli_fetch_array($cQ1)) {



            $super_category_name = $iData['name'];



          }







          $cQ2 = $conn -> query("SELECT * FROM category WHERE id = '$sub_category_id'");



          while ($iData = mysqli_fetch_array($cQ2)) {



            $sub_category_name = $iData['name'];



          }











          $cQ3 = $conn -> query("SELECT * FROM category_2 WHERE id = '$category_2_id'");



          while ($iData = mysqli_fetch_array($cQ3)) {



            $sub_category_2_name = $iData['name'];



          }
















          ?>







          <tr class="attr-row-<?php echo $id; ?>">     



          <td><?php echo $id; ?></td>



          <td><input type="text" name="name-<?php echo $id; ?>" style="width: 85px;" value="<?php echo $name; ?>"/>

            <br><br>

            <button type="button" style="display: <?php echo ( $deactivate == 0 ) ? "block" : "none"; ?>" class="btn btn-info btn-small btn-xs btn-mini input-xs attr-deactivate" id="activate-<?php echo $id; ?>" attr-id="<?php echo $id; ?>"> <i class="fa fa-eye-slash"></i> Deactivate Attribute</button>


           <button type="button" style="display: <?php echo ( $deactivate == 0 ) ? "none" : "block"; ?>" class="btn btn-success btn-small btn-xs btn-mini input-xs attr-activate" id="deactivate-<?php echo $id; ?>" attr-id="<?php echo $id; ?>"> <i class="fa fa-eye"></i> Activate Attribute</button>

         </td>



          <td style="font-size: 10px;"><?php echo $item_name ?> <br> <small><u><?php echo $super_category_name; ?></u> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <u><?php echo $sub_category_name; ?></u> <i class="fa fa-long-arrow-right" aria-hidden="true"></i> <u><?php echo $sub_category_2_name; ?></u></small> </td> 



          <td><input type="text" name="price-<?php echo $id; ?>" style="width: 63px;" value="<?php echo $price; ?>"/></td>       



          <td><input type="text" name="mrp-<?php echo $id; ?>" style="width: 63px;" value="<?php echo $mrp; ?>"/></td>



          <td><input type="text" name="discount-<?php echo $id; ?>" style="width: 63px;" value="<?php echo $discount; ?>"/></td>



          <td><input type="number" name="stock-<?php echo $id; ?>" style="width: 63px;" value="<?php echo $stock; ?>"/></td> 



          <td><input type="text" id="datepicker" name="expiry-<?php echo $id; ?>" style="width: 63px; font-size: 11px;" placeholder="YYYY-MM-DD" value="<?php echo $expiry_date; ?>"/></td> 

          <td></td>
          <td></td>


          <!-- <td style="font-size: 10px;" class="pincode-node-<?php echo $id; ?>">

            <table>

              <tbody>

            <?php



          $category_Q = $conn -> query("SELECT * FROM pincode WHERE media_number = '$media_number'");



          while ($iData = mysqli_fetch_array($category_Q)) {



            echo $pincode = "<tr id='tr-". $iData['id'] ."' ><td><u>".$iData['pincode']."</u>"." Price:  ";



            echo $price = $iData['price']." Delivery in ";



            echo $delivery = $iData['delivery']." <a title='Delete this Pin Code' href='#' class='delete-pin' pin-id='". $iData['id'] ."' id = '". $iData['id'] ."' ><i class='fa fa-minus-circle' aria-hidden='true'></i></a> <td> </tr>"; } ?>

            </tbody>

          </table>



          </td>     -->







            



           <!-- <td>



             



             <div class="row">







      <div class="col-md-3 col-xs-3"><input type="text" class="pincode input-xs input-mini" placeholder="Pincode" name="pin-<?php echo $id; ?>"/></div>



      <div class="col-md-3 col-xs-3"><input type="text" class="pin-price input-xs input-mini" placeholder="Price" name="price-attr-<?php echo $id; ?>"/></div>



      <div class="col-md-3 col-xs-3"><input type="text" class="pin-delivery input-xs input-mini" placeholder="Delivery Days" name="delivery-<?php echo $id; ?>"/></div>



      <div class="col-md-3 col-xs-3"><button type="button" class="add-pincode-btn input-xs input-mini update-p-btn-<?php echo $id; ?>" style="width: 24px; line-height: 1;" class=""><i class="fa fa-plus"></i></button><img src="spin.gif" class="spin-<?php echo $id; ?>" style="width: 27%; display: none;"></div>



<script type="text/javascript">

  $(".update-p-btn-<?php echo $id; ?>").click(function(r){

    $(".update-p-btn-<?php echo $id; ?>").hide();

    $(".spin-<?php echo $id; ?>").show();

    var data_str_p = 'media-number=' + '<?php echo $media_number_A; ?>' + '&pincode=' + $("[name=pin-<?php echo $id; ?>]").val() + '&price=' + $("[name=price-<?php echo $id; ?>]").val() + '&delivery=' + $("[name=delivery-<?php echo $id; ?>]").val();



    $.ajax({ /*AJAX */ type: "POST", url: '<?php echo $site_url; ?>/site-admin/admin/save-pincode-from-stocks.php', data: data_str_p, success: function(res) { if ( true ) {



      $(".pincode-node-<?php echo $id; ?>").append('<tr><td style="font-size: 10px;"><u>' + $("[name=pin-<?php echo $id; ?>]").val() + '</u> Price:  ' + $("[name=price-attr-<?php echo $id; ?>]").val() +' Delivery in '+ $("[name=delivery-<?php echo $id; ?>]").val() +' <a class="delete-pin" pin-id="'+ res +'" title="Delete this Pin Code" href="#"><i class="fa fa-minus-circle" aria-hidden="true"></i></a> <td></tr>');



    $(".update-p-btn-<?php echo $id; ?>").show(); $(".spin-<?php echo $id; ?>").hide(); 

    if ( parseInt($("[name=pin-<?php echo $id; ?>]").val()) == 834006 ) {
      $("[name=pin-<?php echo $id; ?>]").val( "834008" );
    }

    else if ( parseInt($("[name=pin-<?php echo $id; ?>]").val()) == 834009 ) {
      $("[name=pin-<?php echo $id; ?>]").val( "835215" );
    }


    else if ( parseInt($("[name=pin-<?php echo $id; ?>]").val()) == 835215 ) {
      $("[name=pin-<?php echo $id; ?>]").val( "835217" );
    }

    else if ( parseInt($("[name=pin-<?php echo $id; ?>]").val()) == 835217 ) {
      $("[name=pin-<?php echo $id; ?>]").val( "835219" );
    }


    else if ( parseInt($("[name=pin-<?php echo $id; ?>]").val()) == 835219 ) {
      $("[name=pin-<?php echo $id; ?>]").val( "835303" );
    }

    else{
      $("[name=pin-<?php echo $id; ?>]").val( parseInt( parseInt($("[name=pin-<?php echo $id; ?>]").val()) + 1) );
    }


  } }  /*AJAX 2*/ }); 





 });

</script>



    </div>







           </td> -->







           <td><button type="button" class="btn btn-primary btn-small btn-xs btn-mini input-xs update-btn-<?php echo $id; ?>"><i class="fa fa-edit"></i> Update</button> <button type="button" class="btn btn-danger btn-small btn-xs btn-mini input-xs attr-deleter" attr-id="<?php echo $id; ?>"> <i class="fa fa-trash"></i> Delete</button> 



            </td>





<script type="text/javascript">

  $(".update-btn-<?php echo $id; ?>").click(function(){



    var data_str = 'id=' + '<?php echo $id; ?>' + '&name=' + $("[name=name-<?php echo $id; ?>]").val() + '&price=' + $("[name=price-<?php echo $id; ?>]").val() + '&mrp=' + $("[name=mrp-<?php echo $id; ?>]").val() + '&discount=' + $("[name=discount-<?php echo $id; ?>]").val() + '&stock=' + $("[name=stock-<?php echo $id; ?>]").val() + '&expiry=' + $("[name=expiry-<?php echo $id; ?>]").val();



    $.ajax({ /*AJAX */ type: "POST", url: '<?php echo $site_url; ?>/site-admin/admin/update-attribute.php', data: data_str, success: function(res) { alert(res); }  /*AJAX 2*/ }); 





 });

</script>





          </tr>







        <?php 
      

			$item_name = "";



            $category_id = "";



            $sub_category_id = "";



            $category_2_id = "";


    } } ?>



          











      </tbody>







</table>















  </div>







</div>

<center>

  <?php if (!isset($_GET['q']) && !isset($_GET['item-id'])) { ?>
  <h3>Go to page:</h3>
<ul class="pagination">

  <?php

    
  
    //find the total number of results stored in the database  
    $query_paf = $conn -> query("SELECT * FROM attributes ORDER BY id DESC");   
    
    $number_of_result = mysqli_num_rows($query_paf);  
  
    //determine the total number of pages available  
    $number_of_page = ceil ($number_of_result / $results_per_page);  
  
   
    echo '<li><a title="Previous" href = "?page=' . ($_GET['page'] - 1) . '"> <i class="fa fa-angle-double-left" aria-hidden="true"></i> </a></li>'; 
    echo '<li><a title="Fast Rewind" href = "?page=' . ($page - 5) . '">... </a></li>';  
  
    //display the link of the pages in URL  
    $_op = ( !isset($_GET['page']) ) ? 1 : ( $_GET['page'] + 1 );
    for($page = $_op; $page <= ( $_GET['page'] + 10 ); $page++) {  
        echo '<li><a href = "?page=' . $page . '">' . $page . ' </a></li>';  
    }

    echo '<li><a title="Fast Forward" href = "?page=' . ($page + 5) . '">... </a></li>'; 
    echo '<li><a title="Next" href = "?page=' . ($_GET['page'] + 1) . '"> <i class="fa fa-angle-double-right" aria-hidden="true"></i> </a></li>';  

  
?>  
</ul>
<?php } ?>
</center>
</body>







</html>



<script type="text/javascript">

$(document).on( "click", ".delete-pin", function(e){

if (confirm("Are you sure you want to delete this pin code?")) {

var data_str = 'pin-id=' + $(this).attr('pin-id');

var node_id = $(this).attr('id');

$.ajax({ /*AJAX */ type: "POST", url: '<?php echo $site_url; ?>/site-admin/admin/delete-pin-node.php', data: data_str, success: function(res) { $( "#tr-" + node_id ).hide(); }  /*AJAX 2*/ }); 

}

} );



$(document).on( "click", ".attr-deleter", function(e){

if (confirm("Are you sure you want to delete this Entire Attribute?")) {

var data_str_a = 'id=' + $(this).attr('attr-id');
//alert(data_str_a);
var node_id = $(this).attr('attr-id');

$.ajax({ /*AJAX */ type: "POST", url: '<?php echo $site_url; ?>/site-admin/admin/delete-attr-node.php', data: data_str_a, success: function(res) { $( ".attr-row-" + node_id ).slideUp("slow", function(){}); }  /*AJAX 2*/ }); 

}

} );


$(".attr-deactivate").click(function(e){

if (confirm("Are you sure you want to deactivate this attribute?")) {
  $(this).html("Deactivating...");

  var domd = $(this);


var data_str_d = 'id=' + $(this).attr('attr-id');

var axr = $(this).attr('attr-id');

$.ajax({ /*AJAX */ type: "POST", url: '<?php echo $site_url; ?>/site-admin/admin/deactivate-attr.php', data: data_str_d, success: function(res) { $("#activate-" + axr ).hide(); $("#deactivate-" + axr ).show(); domd.html('<i class="fa fa-eye-slash"></i> Deactivate Attribute'); }  /*AJAX 2*/ }); 

}

});



$(".attr-activate").click(function(e){

if (confirm("Are you sure you want to activate this attribute?")) {
  $(this).html("Activating...");

 var domd = $(this);

var data_str_d = 'id=' + $(this).attr('attr-id');

var axr = $(this).attr('attr-id');

$.ajax({ /*AJAX */ type: "POST", url: '<?php echo $site_url; ?>/site-admin/admin/activate-attr.php', data: data_str_d, success: function(res) { $("#deactivate-" + axr ).hide(); $("#activate-" + axr ).show(); domd.html('<i class="fa fa-eye"></i> Activate Attribute'); }  /*AJAX 2*/ }); 

}

});

$(".r").click(function(){
  window.location.href="stocks-v2.php";
});

$(".va").click(function(){
  if(confirm("The page may take some time to load. Are you sure to proceed?")){
    window.location.href="stocks.php";
  }
});


$(".va-d").click(function(){
  if(confirm("The page may take some time to load. Are you sure to proceed?")){
    window.location.href="stocks-deactivated.php";
  }
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

  window.location.href="stocks-v2.php?item-id="+$(this).attr("item-id");

  });

  <?php 

  if (isset($_GET['item-id'])) { 

    $q = $conn -> query("SELECT * FROM items WHERE id = '$item_id_q'");

  while ($row = mysqli_fetch_array($q)) {
    $id = $row['id'];
    $name = $row['name'];

    ?>
    $(".a-holder").html('<i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo $_GET['item-id']; ?> - <?php echo $name; ?><br><small class="small-hint">Click to Reselect <i class="fa fa-chevron-down" aria-hidden="true"></i></small> <br>');
 <?php } } ?>

</script>

<?php } ?>