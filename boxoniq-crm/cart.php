<?php session_start(); ?>
<?php include('config.php'); ?>
<?php include('head-meta.php'); ?>

<style type="text/css">
    .address_change_btn:hover{
        color: #215273;
    }
</style>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="<?php echo $site_url; ?>">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>


<?php 


if (isset($_SESSION['account-id'])) {

    $total_cart_value = 0;
        $account_id = $_SESSION['account-id'];
        $msg_query = $conn -> query("SELECT * FROM cart WHERE account_id = '$account_id' AND checkout = '0'");  
            while ($msg_q = mysqli_fetch_array($msg_query)) {

                $cart_id = $msg_q['id'];
                $item_id = $msg_q['item_id'];
                $attribute_id = $msg_q['attribute_id'];
                $date_creation = $msg_q['date_creation'];
                $quantity = $msg_q['quantity'];
                $total_amount = $msg_q['total_amount'];


                $mq = $conn -> query("SELECT * FROM items WHERE id = '$item_id'");  
                while ($msg_q = mysqli_fetch_array($mq)) {
                $media_number = $msg_q['media_number'];
                $item_name = $msg_q['name'];
                }

                $aq = $conn -> query("SELECT * FROM attributes WHERE id = '$attribute_id'");    
                while ($msg_q = mysqli_fetch_array($aq)) {
                $attribute_name = $msg_q['name'];
                $attr_price = $msg_q['price'];
                }


                $media_q = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number'");
                while ($media_D = mysqli_fetch_array($media_q)) {

                    $product_img = $site_url."/media/".$media_D['file_name'];

                }


                array_push($cart_items_array, array('id' => $cart_id, 'item_id' => $item_id, 'item_name' => $item_name, 'attribute_name' => $attribute_name, 'quantity' => $quantity, 'total_amount' => $total_amount, 'image' => $product_img ));

                $total_cart_value += $total_amount; ?>


<tr>
                                    <td class="shoping__cart__item">
                                        <img src="<?php echo $product_img ?>" style="width: 20%;" alt="">
                                        <h5><?php echo $item_name; ?></h5><b> - <?php echo $attribute_name; ?></b>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <i class="fa fa-inr"></i><?php echo $attr_price; ?>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="<?php echo $quantity; ?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        <i class="fa fa-inr"></i><?php echo $total_amount; ?>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <button class="btn" onclick="delete_from_cart(<?php echo $cart_id; ?>);"><span class="icon_close"></span></button>
                                    </td>
</tr>



           <?php }


} else { array_push($result, array('response' => 'No Sessions Found' )); }


?>











                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="shoping__cart__btns">
                        <a href="<?php echo $site_url; ?>" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        
                    </div>
                </div>

                <div class="col-md-2 col-lg-2">

                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Payment Method</h5>

                    <select class="payment-mode" style="float: right;">
                           <?php 

                           $media_q = $conn -> query("SELECT * FROM payment_method");
                while ($media_D = mysqli_fetch_array($media_q)) { ?>

                    <option value="<?php echo $media_D['id'] ?>"><?php echo $media_D['name'] ?></option>

                <?php } ?>
                        </select>
                    </div>
                </div>
            </div>

                <div class="col-md-4 col-lg-4">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Have Coupon Code?</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter Code" style="width: 59%;">
                                <button type="submit" class="site-btn">Apply</button>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    

                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Delivery Address</h5>
                            <?php 

                            $ADDQ = $conn -> query("SELECT * FROM accounts WHERE id = $account_id");
                            while ($address_data = mysqli_fetch_array($ADDQ)) {
                                $full_address = $address_data['full_address'];
                                $landmark = $address_data['landmark'];
                                $pincode = $address_data['pincode'];          }

                            if ($full_address == "" OR $landmark == "" OR $pincode == "") {
                                    $address_display = "block;";
                                    $default_address_section_display = "none;"; ?>

                                    <input type="hidden" name="has_address" value="0">

                               <?php } else { $address_display = "none;"; $default_address_section_display = "block"; $has_default_address = "true";?> 

                               <input type="hidden" name="has_address" value="1">
                               <?php } ?>

                            <form class="address-form input-address" style="display: <?php echo $address_display; ?>" action="<?php echo $site_url; ?>/api/save-delivery-address.php">
                            <input type="text" class="form-control" name="pincode" style="text-align: left;" placeholder="Pincode">
                            <input type="text" class="form-control" name="landmark" style="text-align: left;" placeholder="Nearest Landmark">
                            <hr>
                            <textarea class="form-control" name="full_address" placeholder="Full Address"></textarea>
                            </form>
                            <div class="default_address_section" style="border-radius: 5px;  border: 1px dashed #651c1c; padding: 5%; display: <?php echo $default_address_section_display; ?>">
                            <span style="font-weight: 400; "><u style="color: #fff; background-color: #000;">PREVIOUS CHECKOUT ADDRESS</u> <a href="javascript:(0)" style="font-size: 13px; float: right;" class="address_change_btn"><i class=" fa fa-edit"></i> Change Address</a> <br><br></span>
                            <span><?php echo $full_address; ?><br><hr></span>
                            <span><?php echo $landmark; ?><br><hr></span>
                            <span><?php echo $pincode; ?></span>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5> 
                        <ul>
                            <li>Subtotal <span><i class="fa fa-inr"></i><?php echo $_SESSION['total_cart_value'] = $total_cart_value; ?></span></li>
                            <li>Total <span><i class="fa fa-inr"></i><?php echo $total_cart_value; ?></span></li>
                        </ul>
                        <button class="btn primary-btn proceed-to-cart">PROCEED TO CHECKOUT</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
    <script src="<?php echo $site_url; ?>/assets/js/liveform.js"></script>


    <!-- Footer Section Begin -->
    <?php include('footer.php'); ?>
    <!-- Footer Section End -->


</body>

</html>

<script type="text/javascript">
    $(".proceed-to-cart").click(function(){

        if ( !<?php echo $total_cart_value; ?> <= 0 ) {
            
        if ( /*<?php echo $total_cart_value; ?> > 500*/ true ) {

            <?php if ( $total_cart_value < 499 ) { ?> alert("Your Order value is below Rs. 499. Delivery charges Rs. 50 will be added extra to the final amount. "); <?php } ?>

        if ( $("[name=has_address]").val() != 0 ) {
        
        $("#preloder").html("<div class='loader'></div>");
        $("#preloder").show();

        /*Proceeding with the checkout*/
        if ($(".payment-mode").val() == 1) { window.location.href = "checkout-with-payment.php"; }
        else { window.location.href = "checkout-with-cod.php"; }


        } else if ($("[name=pincode]").val() != "" && $("[name=landmark]").val() != "" && $("[name=address]").val() != "") {

        $("#preloder").html("<div class='loader'></div>");
        $("#preloder").show();

        /*First Saving Address*/
        $(".address-form").submit();         

        } else { alert("Please Enter Full Address Details before proceeding with checkout."); $("[name=pincode]").focus(); }
  
} else { alert("Minimum Order Value should be Rs. 500.00"); window.location.href="<?php echo $site_url; ?>"; }

} else { alert("Add some items to your cart First to proceed with checkout."); window.location.href="<?php echo $site_url; ?>"; }

});


  $('.address-form').ajaxForm({

  beforeSend: function(xhr, opts) {  },

  uploadProgress: function(event, position, total, percentComplete) {      },

  success: function(delivery_json) {

  delivery_json = jQuery.parseJSON(delivery_json); /*Converting String to Json Data*/

  jQuery(delivery_json).each(function(i, object){

    if (object.response == "1") { 

        /*Proceeding with the checkout*/
        if ($(".payment-mode").val() == 1) { window.location.href = "checkout-with-payment.php"; }
        else { window.location.href = "checkout-with-cod.php"; }

    }
    else if (object.response == "333") { alert("Sorry, Something went wrong!"); }
    else { console.log( object.response ); }

  });


  },

  complete: function(xhr) {   }

 });


  function delete_from_cart ( id ) {

    $("#preloder").html("<div class='loader'></div>");
    $("#preloder").show();

  var keyword = 'id=' + id;

$.ajax({ /*AJAX */ type: "POST", url: '<?php echo $site_url; ?>/api/delete-from-cart.php', dataType: 'json', data: keyword, success: function(search_json) { 

jQuery(search_json).each(function(i, object){

if (object.response == 1 ) { window.location.reload(); }

});


}  /*AJAX 2*/ }); 

}

$(".address_change_btn").click(function(){
    $(".default_address_section").hide();
    $(".input-address").show();
    $("[name=pincode]").focus();
    $("[name=has_address]").val('0');
});

</script>