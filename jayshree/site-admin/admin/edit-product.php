<?php 

session_start();

include ("../../config.php");

include ("../../variables.php");

// $media_number = rand().time();

if (!isset($_SESSION['username']) && !isset($_SESSION['name'])) {

  ?>

<script type="text/javascript">
window.location.href = "index.php";
</script>

<?php

}

else{

?>

<!DOCTYPE html>

<html>

<head>

    <title>EDIT PRODUCT</title>

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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css"
        crossorigin="anonymous">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



    <!--Latest compiled and minified JavaScript-->

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>



    <!--FONT AWESOME-->

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">



    <!--VIEWPORT-->

    <meta name="viewport" content="width=device-width, initial-scale=1">





    </script>



    <style type="text/css">
    body {

        background-color: #efefef;

    }
    </style>


    <!-- Floating Button -->


    <style type="text/css">
    .float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color: #000;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        box-shadow: 2px 2px 3px #999;
    }

    .my-float {
        margin-top: 22px;
    }
    </style>

    <!-- Floating Button ENDS-->

</head>

<body style="background-color: #fff;">
    <!-- Code begins here -->

    <a href="index.php" class="float">
        <i class="fa fa-home my-float"></i>
    </a>
    <?php 


  $product_id = $_GET['id'];

  $cQ = $conn -> query("SELECT * FROM items WHERE id = '$product_id' ORDER BY id DESC "); 

        while ($rowD = mysqli_fetch_array($cQ)) {
          $pid = $id = $rowD['id'];
          $name = $rowD['name'];
          $hindi_name = $rowD['hindi_name'];
          $creation_date = $rowD['creation_date'];
          $creation_time = $rowD['creation_time']; 
          $category_id = $rowD['category_id'];
          $corporate_id = $rowD['corporate_id'];
          $description = $rowD['details'];
          $media_number = $rowD['media_number'];
        }

        $get_attr = $conn -> query("SELECT * FROM attributes WHERE item_id = '$pid' ");
        $rowGetAttr = mysqli_fetch_assoc($get_attr);
        $attr_id = $rowGetAttr['id'];
        $attr_name = $rowGetAttr['name'];
        $price = $rowGetAttr['price'];
        $mrp = $rowGetAttr['mrp'];
        $discount = $rowGetAttr['discount'];
        $stock = $rowGetAttr['stock'];
        $expiry = $rowGetAttr['expiry_date'];

  ?>

    <!-- Code ENDS here -->
    <div class="container" style="background-color: #fff;">

        <div class="row">

            <div class="col-md-8">

                <h2>Edit Product</h2>

                <form action="action/update-product.php" method="POST">
                    <input type="hidden" value="<?php echo $media_number; ?>" id="media_number_pro"
                        name="media-number-p"></input>
                    <input type="hidden" name="product_id" value="<?php echo $pid ?>">
                    <input type="hidden" name="attr_id" value="<?php echo $attr_id ?>">

                    <h3>Product Full Name</h3>
                    <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Product Full name"
                        class="form-control" required> <br>
                    <hr>

                    <h3>Product Full Name in Hindi</h3>
                    <input type="text" name="hindi_name" value="<?php echo $hindi_name; ?>"
                        placeholder="Product Full name" class="form-control" required> <br>
                    <hr>

                    <h2>Super Category</h2>
                    <select class="form-control super-category" name="category_id">
                        <option value="0">Select Category</option>

                        <?php $msg_query = $conn -> query("SELECT * FROM super_category ORDER BY id DESC");  

  while ($sData = mysqli_fetch_array($msg_query)) { 

    if ( $sData['id'] == $category_id ) { $s_ = "selected"; } else { $s_ = ""; }

    ?>

                        <option value="<?php echo $sData['id']; ?>" <?php echo $s_; ?>><?php echo $sData['name']; ?>
                        </option>


                        <?php } ?>

                    </select>

                    <hr>


                    <!-- corporate category -->
                    <h2>Corporate Category</h2>
                    <select class="form-control corporate-category" name="corporate_id">
                    <option value="0">Select Category</option>

                        <?php $cor_query = $conn -> query("SELECT * FROM corporate_category ORDER BY id DESC");  

  while ($cData = mysqli_fetch_array($cor_query)) { 

    if ( $cData['id'] == $corporate_id ) { $s_ = "selected"; } else { $s_ = ""; }

    ?>

                        <option value="<?php echo $cData['id']; ?>" <?php echo $s_; ?>><?php echo $cData['name']; ?>
                        </option>


                        <?php } ?>

                    </select>

                    <hr>

                    <h3>Attribute Name</h3>
                    <input type="text" name="attr_name" value="<?php echo $attr_name; ?>"
                        placeholder="Enter Attribute Name" class="form-control" required>
                    <hr>

                    <h3>Price</h3>
                    <input type="text" name="pro_price" value="<?php echo $price; ?>" placeholder="Enter Price"
                        class="form-control" required>
                    <hr>

                    <h3>MRP</h3>
                    <input type="text" name="pro_mrp" value="<?php echo $mrp; ?>" placeholder="Enter MRP"
                        class="form-control" required>
                    <hr>

                    <h3>Discount</h3>
                    <input type="text" name="pro_discount" value="<?php echo $discount; ?>" placeholder="Enter Discount"
                        class="form-control" required>
                    <hr>

                    <h3>Stock</h3>
                    <input type="text" name="pro_stock" placeholder="Enter Stock" value="<?php echo $stock; ?>"
                        class="form-control" required>
                    <hr>

                    <h3>Description</h3>
                    <textarea name="description" placeholder="Product Desctiption" class="form-control" required>
      <?php echo $description; ?>
    </textarea>
                    <hr>

                    <h3>Expiry Date?</h3>
                    <input type="text" name="expiry" id="datepicker" value="<?php echo $expiry; ?>"
                        placeholder="Expiry Date (Click here to open calender)" min="1" class="form-control" required>
                    <br>

                    <script type="text/javascript">
                    $(function() {

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
                    </script>

                    <hr>

                    <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> Update Product </button>
                </form>

            </div>


            <div class="col-md-4">

                <!-- <div class="row">
  <h4>Upload Product Image<br><span style="font-size: 11px;">Size: 748x1024px</span></h4>



  <form action="img-parse.php" class="dropzone col-md-12 x-magic-form" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

<input type="hidden" value="<?php echo $media_number; ?>" class="media_number" name="media-number"></input>

</form> 
</center>
<script type="text/javascript">

  $(".dropzone").dropzone({

    
    addRemoveLinks: true,
    maxFiles: 7,

    dictDefaultMessage: '<img src="drop.png" style="width: 23%;"></img> <br><br> Drag And Drop Or Click here to upload Product Image (Upto 5 Images)',

    acceptedFiles: 'image/*',

    init: function() {

    this.on('success', function( file, resp ){

      

    });

  },    

})


</script>
</div> -->

                <hr>

                <!-- <br>
<br>
<br> -->

                <h4>Upload Product Cover / Front Image<br><span style="font-size: 11px;">Size: 748x1024px</span></h4>


                <div class="row">

                    <form action="img-parse-front.php" class="dropzone d2 col-md-12 x-magic-form"
                        style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 67%;">

                        <input type="hidden" value="<?php echo $media_number; ?>" class="media_number"
                            name="media-number"></input>

                    </form>
                    </center>
                    <script type="text/javascript">
                    $(".d2").dropzone({


                        addRemoveLinks: true,
                        maxFiles: 1,

                        dictDefaultMessage: '<img src="drop.png" style="width: 23%;"></img> <br><br> Drag And Drop Or Click here to upload Product Front Image (Only 1 Image)',

                        acceptedFiles: 'image/*',

                        init: function() {

                            this.on('success', function(file, resp) {
                                // console.log(resp);
                                let dd = JSON.parse(resp);
                                console.log(dd.media_number);
                                $('#media_number_pro').val(dd.media_number);

                            });

                        },

                    })
                    </script>

                </div>

            </div>


        </div>

    </div>

</body>

</html>


<script type="text/javascript">
$(".super-category").on('change', function() {
    $(".sub-category-holder").html("<option>Please Wait...</option>");

    var dataString = 'id=' + this.value;

    $.ajax({
        type: "POST",
        url: "get-sub-categories.php",
        data: dataString,
        cache: false,
        success: function(html) {
            $(".sub-category-holder").html(html);




            $(".child-category-holder").html("<option>Please Wait...</option>");

            var dataString = 'id=' + $(".sub-category-holder").val();

            $.ajax({
                type: "POST",
                url: "get-child-categories.php",
                data: dataString,
                cache: false,
                success: function(html) {
                    $(".child-category-holder").html(html);
                }
            });




        }
    });


});


$(".sub-category-holder").on('change', function() {
    $(".child-category-holder").html("<option>Please Wait...</option>");

    var dataString = 'id=' + this.value;

    $.ajax({
        type: "POST",
        url: "get-child-categories.php",
        data: dataString,
        cache: false,
        success: function(html) {
            $(".child-category-holder").html(html);
        }
    });

});
</script>

<?php } ?>