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







  <div class="row"><center><h2>Attributes / Stock Management</h2></center></div>







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



          <th style="width: ;"> PINCODES </th>



          <th style="width: ;"> ADD NEW PINCODES </th>



          <th style=""></th>



        </tr>







      </thead>























      <tbody>







        <?php $cQ = $conn -> query("SELECT * FROM attributes ORDER BY id DESC"); 







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




          $category_Q = $conn -> query("SELECT * FROM items WHERE id = '$item_id'");

          if (mysqli_num_rows($category_Q) != 0) {

          while ($iData = mysqli_fetch_array($category_Q)) {



            $item_name = $iData['name'];



            $category_id = $iData['category_id'];



            $sub_category_id = $iData['sub_category_id'];



            $category_2_id = $iData['category_2_id'];



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



          <td style="font-size: 10px;" class="pincode-node-<?php echo $id; ?>">

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



          </td>    







            



           <td>



             



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







           </td>







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


</script>



<?php } ?>