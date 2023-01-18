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

  <title>PRODUCT EDITING</title>

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

  <?php 


  $product_id = $_GET['id'];

  $cQ = $conn -> query("SELECT * FROM items WHERE id = '$product_id' ORDER BY id DESC "); 

        while ($rowD = mysqli_fetch_array($cQ)) {
          $pid = $id = $rowD['id'];
          $name = $rowD['name'];
          $creation_date = $rowD['creation_date'];
          $creation_time = $rowD['creation_time']; 
          $category_id = $rowD['category_id'];
          $description = $rowD['details'];
          $media_number = $rowD['media_number'];
          $brand_id = $rowD['brand_id'];
          $sub_category_id = $rowD['sub_category_id'];
          $child_category_id = $rowD['category_2_id']; 
          $gst = $rowD['gst'];

        }
        ?>

  <div class="row">

  <div class="col-md-8">
    

  <h2>Product Editing</h2>

  <form action="update-product.php" method="POST">
    <input type="hidden" value="<?php echo $id; ?>" class="product_id" name="product_id"></input>
    <h3>Product Full Name</h3>
    <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Product Full name" class="form-control"> <br>

    <hr>

    <h2>Category</h2>
    <select class="form-control super-category" name="category_id">
      
        <?php $msg_query = $conn -> query("SELECT * FROM super_category ORDER BY id DESC");  

  while ($sData = mysqli_fetch_array($msg_query)) { 

    if ( $sData['id'] == $category_id ) { $s_ = "selected"; } else { $s_ = ""; }

    ?>

 <option value="<?php echo $sData['id']; ?>" <?php echo $s_; ?>><?php echo $sData['name']; ?> </option>
 


  <?php } ?>

    </select> <br>


    <h2>Sub Category</h2>
    <select class="form-control sub-category-holder" name="sub_category_id">
    <?php $msg_query = $conn -> query("SELECT * FROM category WHERE super_category_id = '$category_id' ORDER BY id DESC");  

  while ($sData = mysqli_fetch_array($msg_query)) { 

    if ( $sData['id'] == $sub_category_id ) { $s_ = "selected"; } else { $s_ = ""; }

    ?>

 <option value="<?php echo $sData['id']; ?>" <?php echo $s_; ?>><?php echo $sData['name']; ?> </option>
 


  <?php } ?>
    </select> 

    <!-- <hr>

    <h2>Child Category</h2>
    <select class="form-control child-category-holder" name="child_category_id">
    

    <?php $msg_query = $conn -> query("SELECT * FROM category_2 WHERE category_1_id = '$sub_category_id' ORDER BY id DESC");  

  while ($sData = mysqli_fetch_array($msg_query)) { 

    if ( $sData['id'] == $child_category_id ) { $s_ = "selected"; } else { $s_ = ""; }

    ?>

 <option value="<?php echo $sData['id']; ?>" <?php echo $s_; ?>><?php echo $sData['name']; ?> </option>
 


  <?php } ?>
    </select> 


     <br> -->



    <hr>

    <h2>Select Brand</h2>
    <select class="form-control" name="brand_id">
      
        <?php $msg_query = $conn -> query("SELECT * FROM brand ORDER BY id DESC");  

  while ($sData = mysqli_fetch_array($msg_query)) { 
  if ( $sData['id'] == $brand_id ) { $s_ = "selected"; } else { $s_ = ""; } ?>

 <option value="<?php echo $sData['id']; ?>" <?php echo $s_; ?>> <?php echo $sData['brand_name']; ?> </option>
 


  <?php } ?>

    </select> 




    <h3>Description</h3>
    <textarea name="description" placeholder="Product Description" class="form-control"><?php echo $description; ?></textarea><br>

    <h3>Update GST(in percent)</h3>
    <input type="number" name="gst" value="<?php echo $gst; ?>" placeholder="Update GST" class="form-control"> <br>

    <hr>




    <button type="submit" class="btn btn-primary" > <i class="fa fa-edit"></i> Update Product </button>
  </form>


  </div>


  <div class="col-md-4">
    


<div class="row">
<div class="pic-uploader" style="display: none;">
  <h3>Re-Upload Image <br><span style="font-size: 11px;">Size: 748x1024px</span></h3>
  <form action="img-parse.php" class="dropzone col-md-12 x-magic-form" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

<input type="hidden" value="<?php echo $media_number; ?>" class="media_number" name="media-number"/>

</form> 

<script type="text/javascript">

  $(".dropzone").dropzone({

    
    addRemoveLinks: true,
    maxFiles: 7,

    dictDefaultMessage: '<img src="drop.png" style="width: 23%;"></img> <br><br> Drag And Drop Or Click here to upload Product Cover Front Image',

    acceptedFiles: 'image/*',

    init: function() {

    this.on('success', function( file, resp ){

      

    });

  },    

})


</script>

  </div>
</div>

<hr>

<div  class="row pic-uploader-cover" style="display: none;">

  <div>

  <h3>Re-Upload Cover Image <br><span style="font-size: 11px;">Size: 748x1024px</span></h3>
  <form action="img-parse-front.php" class="dropzone d2 col-md-12 x-magic-form" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

<input type="hidden" value="<?php echo $media_number; ?>" class="media_number" name="media-number"/>

</form> 

<script type="text/javascript">

  $(".d2").dropzone({

    
    addRemoveLinks: true,
    maxFiles: 1,

    dictDefaultMessage: '<img src="drop.png" style="width: 23%;"></img> <br><br> Drag And Drop Or Click here to upload Product Image',

    acceptedFiles: 'image/*',

    init: function() {

    this.on('success', function( file, resp ){

      

    });

  },    

})


</script>

  </div>
</div>


<div class="product-pic">
  
<h4>Product Image <button class="new-uploader" style="font-size: 11px;">Upload New Image</button></h4>

<?php 

$media_q = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number'");
while ($media_D = mysqli_fetch_array($media_q)) {
$product_img = $site_url."/media/".$media_D['file_name']; 

$deactivate = $media_D['deactive'];
$id = $media_D['id'];
?>
<img src="<?php echo $product_img; ?>" class="img-responsive thumbnail">

<button type="button" style="display: <?php echo ( $deactivate == 0 ) ? "block" : "none"; ?>;
    
    z-index: 99; width: 100%;
    background: #000; position: relative;
    top: -20px;" class="btn btn-info btn-small btn-xs btn-mini input-xs attr-deactivate" id="activate-<?php echo $id; ?>" attr-id="<?php echo $id; ?>"> <i class="fa fa-eye-slash"></i> Deactivate Image</button>


    <button type="button" style="display: <?php echo ( $deactivate == 0 ) ? "none" : "block"; ?>;
    z-index: 99; width: 100%; position: relative;
    top: -20px; " class="btn btn-success btn-small btn-xs btn-mini input-xs attr-activate" id="deactivate-<?php echo $id; ?>" attr-id="<?php echo $id; ?>"> <i class="fa fa-eye"></i> Activate Image</button>

    <hr>
<?php } ?>

</div>

<br>

<div class="row product-pic-cover">
  <h4>Cover Front Image <button class="new-uploader-cover" style="font-size: 11px;">Upload New Cover</button></h4>

<?php 

$media_q_c = $conn -> query("SELECT * FROM cover_media WHERE media_number = '$media_number'");
while ($media_D_c = mysqli_fetch_array($media_q_c)) {
$product_img_c = $site_url."/media/".$media_D_c['file_name']; ?>
<img src="<?php echo $product_img_c; ?>" class="img-responsive thumbnail">

<?php } ?>
</div>



<hr>

<div class="attributes">
  

<h2>Attributes <a href="new-attribute.php" class="" style="font-size: 11px;">Add New</a></h2>

  <ul class="list-group list-group-flush">

  <?php $msg_query = $conn -> query("SELECT * FROM attributes WHERE item_id = '$pid' ORDER BY id DESC");  

  while ($sData = mysqli_fetch_array($msg_query)) { 

    $attr_id = $sData['id'];
    $super_id = $sData['item_id'];
    $amount = $sData['price'];
    $availablity = $sData['availablity'];

    $purchaseQ = $conn -> query("SELECT * FROM cart WHERE attribute_id = '$attr_id' AND checkout = '1'");
    $total_purchased = mysqli_num_rows($purchaseQ);
    $tx = 0;
    while ($tD = mysqli_fetch_array($purchaseQ)) { $tx += $tD['quantity']; }

    $sC = $conn -> query("SELECT * FROM items WHERE id = '$super_id'");  
    while ( $SD = mysqli_fetch_array($sC) ) { $name_m = $SD['name']; } ?>

  <li class="list-group-item"><?php echo $sData['name']; ?> <small style="color: #7d7d7d;">(in <?php echo $name_m; ?>)</small> - [Rs. <?php echo $amount; ?>] <?php if ( $availablity != 0 ) { ?> <small><a href="in-stock.php?id=<?php echo $attr_id; ?>" style="color: green;" >Set In Stock</a> </small> <?php } else { ?> <small><a href="out-of-stock.php?id=<?php echo $attr_id; ?>">Set Out of Stock</a> </small> <?php } ?> <form class="edit-form e-<?php echo $attr_id; ?>-form" style="display: none;"  method="POST" action="update-attribute.php"> <input type="hidden" name="id" value="<?php echo $attr_id; ?>">  <input type="text"  class="e-<?php echo $attr_id; ?>-input" name="price" placeholder="Update Pricing"> <button type="submit">Update Price</button></form> <div class="btn-actions-<?php echo $attr_id; ?>" style="position: absolute; left: 88%; top: 22%;"> <a href="delete-attribute.php?id=<?php echo $sData['id']; ?>" class="" style="float: right; "><i class="fa fa-trash"></i></a> <a href="javascript:(0)" class="e-<?php echo $attr_id; ?>" style="float: right;"><i class="fa fa-edit"></i></a>  </div> <br> <b>SOLD : <?php echo $tx; ?></b> <a href="attribute-wise-sales.php?id=<?php echo $attr_id; ?>" target="_blank">View sale(s) <i class="fa fa-long-arrow-right" aria-hidden="true"></i> </a> </li>


  <script type="text/javascript">
    $(".e-<?php echo $attr_id; ?>").click(function(){ $(".e-<?php echo $attr_id; ?>-form").show(); $(".btn-actions-<?php echo $attr_id; ?>").hide(); $(".e-<?php echo $attr_id; ?>-input").focus(); });
  </script>

  <?php } ?>
</ul>


</div>




</div>





  </div>

</div>

</body>

</html>

<script type="text/javascript">
    $(".new-uploader").click(function() { 

var dataString = 'media-number=<?php echo $media_number; ?>';
$.ajax({
type: "POST",
url: "remove-old-images.php",
data: dataString,
cache: false,
success: function(html)
{
 alert("Old Images Removed. Upload New Images");
}
});

$(".product-pic").hide(); $(".pic-uploader").show(); 

});


        $(".new-uploader-cover").click(function() { 

var dataString = 'media-number=<?php echo $media_number; ?>';
$.ajax({
type: "POST",
url: "remove-old-cover-images.php",
data: dataString,
cache: false,
success: function(html)
{
 alert("Old Cover Removed. Upload New Cover");
 $("html, body").animate({ scrollTop: 0 }, "fast");
}
});

$(".product-pic-cover").hide(); $(".pic-uploader-cover").show(); 

});
</script>


<script type="text/javascript">

$(".super-category").on('change', function(){
$(".sub-category-holder").html("<option>Please Wait...</option>");

var dataString = 'id='+ this.value;

$.ajax({
type: "POST",
url: "get-sub-categories.php",
data: dataString,
cache: false,
success: function(html)
{
 $(".sub-category-holder").html(html);
}
});

}); 


$(".sub-category-holder").on('change', function(){
$(".child-category-holder").html("<option>Please Wait...</option>");

var dataString = 'id='+ this.value;

$.ajax({
type: "POST",
url: "get-child-categories.php",
data: dataString,
cache: false,
success: function(html)
{
 $(".child-category-holder").html(html);
}
});

}); 

$(".attr-deactivate").click(function(e){

if (confirm("Are you sure you want to deactivate this image?")) {
  $(this).html("Deactivating...");

  var domd = $(this);


var data_str_d = 'id=' + $(this).attr('attr-id');

var axr = $(this).attr('attr-id');

$.ajax({ /*AJAX */ type: "POST", url: '<?php echo $site_url; ?>/site-admin/admin/deactivate-image.php', data: data_str_d, success: function(res) { $("#activate-" + axr ).hide(); $("#deactivate-" + axr ).show(); domd.html('<i class="fa fa-eye-slash"></i> Deactivate Attribute'); }  /*AJAX 2*/ }); 

}

});


$(".attr-activate").click(function(e){

if (confirm("Are you sure you want to activate this image?")) {
  $(this).html("Activating...");

 var domd = $(this);

var data_str_d = 'id=' + $(this).attr('attr-id');

var axr = $(this).attr('attr-id');

$.ajax({ /*AJAX */ type: "POST", url: '<?php echo $site_url; ?>/site-admin/admin/activate-image.php', data: data_str_d, success: function(res) { $("#deactivate-" + axr ).hide(); $("#activate-" + axr ).show(); domd.html('<i class="fa fa-eye"></i> Activate Attribute'); }  /*AJAX 2*/ }); 

}

});

</script>

<?php } ?>


