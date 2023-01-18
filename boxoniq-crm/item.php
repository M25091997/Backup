<?php session_start(); ?>
<?php include('config.php'); ?>
<?php include('head-meta.php'); ?>
<script src="<?php echo $site_url; ?>/js/jquery-3.3.1.min.js"></script>
<?php 
$item_slug = $_GET['slug'];
$iQ = $conn -> query("SELECT * FROM items WHERE slug = '$item_slug'");
while ($iData = mysqli_fetch_array($iQ)) {
    $Product_name = $iData['name'];
    $Product_description = $iData['details'];
    $media_number = $iData['media_number'];
    $child_cat = $iData['category_2_id'];
    $MAIN_item_id = $item_id = $iData['id'];
}

$QIMG = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number' ");
while ($img_data = mysqli_fetch_array($QIMG)) {
      $img = $site_url."/media/".$img_data['file_name'];
} ?>


<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v8.0&appId=274528506503691&autoLogAppEvents=1" nonce="IubfCji2"></script>

<input type="hidden" class="live-stock" value="0">

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="<?php echo $site_url; ?>/img/breadcrumb.jpg" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Item</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <a href="./index.html">Catergory</a>
                            <span>Sub Catageory</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
<input type="hidden" class="main-price-param" value="0">
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large pic-holder holder-img"
                                src="<?php echo $img; ?>" alt="">

                                <?php 

                                $QIMG = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number' ");
                                while ($img_data = mysqli_fetch_array($QIMG)) {
                                     $img = $site_url."/media/".$img_data['file_name']; ?>

                                <img src="<?php echo $img; ?>" class="i-h-<?php echo $img_data['id']; ?> holder-img" style="display: none;" alt="">

                               <?php } ?>


                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            

                                <?php 

                                $QIMG = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number' ");
                                while ($img_data = mysqli_fetch_array($QIMG)) {
                                     $img = $site_url."/media/".$img_data['file_name']; ?>

                                <img src="<?php echo $img; ?>" class="i-<?php echo $img_data['id']; ?>" alt=""/>


                               <?php } ?>

                               <?php 

                                $QIMG = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number' ");
                                while ($img_data = mysqli_fetch_array($QIMG)) {
                                     $img = $site_url."/media/".$img_data['file_name']; ?>

                            <script type="text/javascript">
                                    $(".i-<?php echo $img_data['id']; ?>").click(function(){
                                        $(".holder-img").hide();
                                        $(".i-h-<?php echo $img_data['id']; ?>").show();

                                    });
                                </script>

                               <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $Product_name; ?></h3>
                        <div class="product__details__rating">

                        <?php $q = $conn -> query("SELECT * FROM ratings WHERE item_id = '$MAIN_item_id' ORDER BY id DESC ");
                            $divident = 0;
                            $divisor = 0;
                            while ($R_D = mysqli_fetch_array( $q )) { 
                                $divisor += $R_D['rating'];
                                $divident ++;
                            } ?>

                            <?php star_rating(($divisor / $divident)); ?>

                            <span>( <?php echo mysqli_num_rows($q); ?> reviews)</span>
                        </div>
                        <div class="product__details__price price-holder"><i class="fa fa-inr"></i>00.0</div>
                        <p><?php echo $Product_description; ?></p>
                        <div class="product__details__quantity">

                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Select Package</h4>
                                    <select class="package selected-attribute-id">
                                <?php $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' "); 
                                while ($item_Data = mysqli_fetch_array($attr_q)) { ?>
                                <option value="<?php echo $item_Data['id']; ?>" ><?php echo $item_Data['name']; ?></option>
                                <?php } ?>                                       
                                    </select>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="pin-status-holder"><span style="font-size: 14px;">Check pincode availability first</span></h4>
                                    <input type="text" class="form-control pincode" placeholder="ex: 834002" maxlength="8" style="display: inline;" name="pincode"> 
                            
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary pin-btn" style="display: inline; margin-top: 29%;"><i class="fa fa-location-arrow" aria-hidden="true"></i> Check</button>
                                </div>
                            </div>

                            <br>

                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1" class="selected-quantity">
                                </div>
                            </div>
                        </div>

                            <?php if (isset($_SESSION['account-id'])) { ?>
                                <button class="btn primary-btn add_to_cart_btn add-to-cart-sheet">ADD TO CART</button>
                            <?php } else { ?> 

                                <a href="<?php echo $site_url; ?>/account/login" class="btn primary-btn">ADD TO CART</a>

                            <?php } ?>
                        

                        <button class="primary-btn add_to_cart_btn continue-to-cart-sheet" style="display: none;">CONTINUE TO CART</button>
                        

                        <?php if (isset($_SESSION['account-id'])) { ?>
                                <a href="javascript:(0)" class="heart-icon fav-btn"><span class="icon_heart_alt"></span></a>
                            <?php } else { ?> 

                                <a href="<?php echo $site_url; ?>/account/login" class="heart-icon"><span class="icon_heart_alt"></span></a>

                            <?php } ?>

                        <ul>
                            <li><b>Availability</b> <span class="stock-holder">In Stock</span></li>
                            <li><b>Shipping</b> <span class="shipping-holder">Enter Pin Code.</span></li>
                            <li><b>Discount</b> <span class="discount-holder">--</span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                            <!--<li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Reviews <span>(<?php echo mysqli_num_rows($q); ?>)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p><?php echo $Product_description; ?></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                            <?php if (isset($_SESSION['account-id'])) { ?>

                                <h4 style="font-family: 'Merriweather', serif;">Submit Your Rating &amp; Review</h4>

                               <iframe src="<?php echo $site_url; ?>/rating.php?pid=<?php echo $MAIN_item_id; ?>" width="100%" height="100" frameBorder="0">Browser not compatible.</iframe>

                            <?php } else { ?> 

                                <a href="<?php echo $site_url; ?>/account/login" class="btn btn-lg primary-btn">LOGIN TO POST REVIEW</a>

                            <?php } ?>

                                    <hr>

                                    <h4 style="font-family: 'Merriweather', serif;">Customer Rating &amp; Review</h4>
                                    <iframe src="<?php echo $site_url; ?>/reviews.php?pid=<?php echo $MAIN_item_id; ?>" width="100%" height="800" frameBorder="0">Browser not compatible.</iframe>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Similar Items</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                        
                        <?php 

                        $Q = $conn -> query("SELECT * FROM items WHERE category_2_id = '$child_cat' ORDER BY id DESC LIMIT 12 ");

                        while ($itemData = mysqli_fetch_array($Q)) { 

                            $item_id = $itemData['id'];
                            $media_number = $itemData['media_number'];
                            $item_url = $site_url."/item/".$itemData['slug'];
                            $QIMG = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number' ");

                            while ($img_data = mysqli_fetch_array($QIMG)) {
                                $img = $site_url."/media/".$img_data['file_name'];
                            }

                            ?>
                            
                            <div class="col-lg-3 col-md-3 col-sm-3">
                            <div class="product__item">
                                <a href="<?php echo $item_url; ?>">
                                <div class="product__item__pic set-bg">
                                    <img src="<?php echo $img; ?>" class="img-responsive">
                                    <!--<ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>-->
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#"><?php echo $itemData['name']; ?></a></h6>
                                    <h5><i class="fa fa-inr"></i>

                                        <?php $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 "); 
                                while ($item_Data = mysqli_fetch_array($attr_q)) { $main_price = $item_Data['price']; ?>
                                <?php echo $item_Data['price']." <span style='font-size: 13px; color: #828282;'> / ".$item_Data['name']."</span>"; ?>
                                <?php } ?>   

                                    </h5>
                                </div>
                                </a>
                            </div>
                        </div>

                        <?php } ?>
                        
                    </div>
        </div>
    </section>
    <!-- Related Product Section End -->

    <!-- Footer Section Begin -->
    <?php include('footer.php'); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    
    <script src="<?php echo $site_url; ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $site_url; ?>/js/jquery.nice-select.min.js"></script>
    <script src="<?php echo $site_url; ?>/js/jquery-ui.min.js"></script>
    <script src="<?php echo $site_url; ?>/js/jquery.slicknav.js"></script>
    <script src="<?php echo $site_url; ?>/js/mixitup.min.js"></script>
    <script src="<?php echo $site_url; ?>/js/owl.carousel.min.js"></script>
    <script src="<?php echo $site_url; ?>/js/main.js"></script>


</body>

</html>

<script type="text/javascript">

var main_price = 0;
var site_url = "<?php echo $site_url; ?>";

$(".package").change(function(){
var dataString = 'item-id='+ $(".package").val();
$.ajax({ 
type: "POST",
url: "<?php echo $site_url; ?>/api/get_attribute_data.php",
data: dataString,
cache: false,
success: function(json)
{
 
json2 = jQuery.parseJSON(json); 
jQuery(json2).each(function(i, object){
$(".price-holder").html("<strike> <i class='fa fa-inr'></i>" + object.mrp + "</strike> <i class='fa fa-inr'></i> "+object.price);


$(".discount-holder").html("RS. " + object.off);
$(".main-price-param").val(object.price);

$(".live-stock").val(object.stock);

if ( object.stock <= 0 ) { $(".stock-holder").html('<span style="color:red;" >Out of Stock</span>');

$(".add_to_cart_btn").prop("disabled", true);

} else { $(".stock-holder").html('<span style="color:green;" >in Stock</span>'); }

})


}
});

});

$(document).ready(function(){
    load_price();
});


function load_price() {

    var dataString = 'item-id='+ $(".package").val();
$.ajax({ 
type: "POST",
url: "<?php echo $site_url; ?>/api/get_attribute_data.php",
data: dataString,
cache: false,
success: function(json)
{
 
json2 = jQuery.parseJSON(json); 
jQuery(json2).each(function(i, object){
$(".price-holder").html("<strike> <i class='fa fa-inr'></i>" + object.mrp + "</strike> <i class='fa fa-inr'></i> "+object.price);
$(".stock-holder").html("in Stock");
$(".discount-holder").html("RS. " + object.off);
$(".main-price-param").val(object.price);

$(".live-stock").val(object.stock);

if ( object.stock <= 0 ) { $(".stock-holder").html('<span style="color:red;" >Out of Stock</span>');

$(".add_to_cart_btn").prop("disabled", true);

} else { $(".stock-holder").html('<span style="color:green;" >in Stock</span>'); }

})


}
});

}

$(".pin-btn").click(function(){
var dataString = 'pincode='+ $(".pincode").val() + '&attribute-id=' + $(".package").val();
$.ajax({ 
type: "POST",
url: "<?php echo $site_url; ?>/api/check-pincode.php",
data: dataString,
cache: false,
success: function(json)
{

json_pin = jQuery.parseJSON(json); 

jQuery(json_pin).each(function(i, object){

if (object.availability != '0') {

	$(".pin-status-holder").html('<span style="font-size: 14px; color:#007bff;"> <i class="fa fa-map-marker"></i> '+ object.days +' at your place</span>');



if ( object.price != "SAME" ) { 

$(".price-holder").html("<i class='fa fa-inr'></i> "+object.price); 

$(".main-price-param").val(object.price); 

}

$(".add_to_cart_btn").prop("disabled", false);



} else {  

$(".pin-status-holder").html('<span style="font-size: 11px; color:red;">Sorry, this item is not deliverable at your place.</span>');

$(".add_to_cart_btn").prop("disabled", true);
$(".pincode").val(""); $(".pincode").focus();
$(".pincode").prop("placeholder", "Try another pincode...");

}

})

}
});

});

$(".add_to_cart_btn").click(function () {
add_to_cart( '<?php echo $MAIN_item_id; ?>', $(".selected-attribute-id").val(), $(".selected-quantity").val(), $(".main-price-param").val() );
});

function add_to_cart( item_id, attribute_id, quantity, total_amount, account_id = "<?php echo $_SESSION['account_id']; ?>" ){

var dataString = 'item_id='+item_id+'&attribute_id='+attribute_id+'&quantity='+quantity+'&total-amount='+total_amount+'&account-id='+account_id;

$.ajax({ /*AJAX */ type: "POST", url: site_url + '/api/add-to-cart.php', dataType: 'json', data: dataString, success: function(cart_json) { window.location.href= site_url + "/cart";

cart_json = jQuery.parseJSON(cart_json); /*Converting String to Json Data*/

jQuery(cart_json).each(function(i, resp_obj){ 

    if ( resp_obj.response == "No Sessions Found" ) { window.location.href = site_url + "/account/login"; }
    else if ( resp_obj.response == "1" ) { $(".add-to-cart-sheet").hide(); $(".continue-to-cart-sheet").show();  }  


 });

}, complete: function(){ } /*AJAX CART FINISH*/ });

}

/*$(".qtybtn").click(function(){ if( $(".selected-quantity").val() > $(".live-stock").val() ) { 

alert("Sorry, Product out of stock.");
$(".add_to_cart_btn").prop("disabled", true);

} else { $(".add_to_cart_btn").prop("disabled", false); } });*/


$(".fav-btn").click(function(){

$(".fav-btn").html('<span class="icon_heart" style="color: #000;"></span> added to favourites');

var dataString = 'item-id=<?php echo $MAIN_item_id; ?>';
$.ajax({ 
type: "POST",
url: "<?php echo $site_url; ?>/api/add-to-favourites.php",
data: dataString,
cache: false,
success: function(json) {  } }); });

</script>