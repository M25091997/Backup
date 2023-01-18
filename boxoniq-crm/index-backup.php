<?php session_start();
include ("config.php");
$account_id = $_SESSION['account-id'];
$msg_query = $conn -> query("SELECT * FROM cart WHERE account_id = '$account_id' AND checkout = '0'");  
$ttc = mysqli_num_rows($msg_query);

?> <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Buy Online Grocery & Home Delivery Available.">
    <meta name="keywords" content="Grocery, Ecommerce, Home Delivery.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Shopping Site for Mobiles, Electronics, Furniture, Grocery, Lifestyle, Books &amp; More. Best Offers! - CityIndia.in</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">

<style type="text/css">
.product__discount__percent {
    background: url(img/discount.png);
    background-position: 0px;
    background-repeat: no-repeat;
    background-size: 54px;
}


    .brand-names {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -ms-flex-pack: justify;
    justify-content: space-between;
    line-height: 24px;
    list-style: none;
    padding: 0;
    text-align: justify;
    color:  #1c1c1c !important;
}

.footer-list{
    color: #969696;
}

.header__menu__dropdown{
	z-index: 9999999 !important;
}

.footer-list:hover, .footer-list:focus{
    color: #000;
}

.brand-names>.brand-names__item {
    margin-right: 20px;
}


.footer-heading {
    color: #1c1c1c;
    font-weight: 700;
    margin-bottom: 10px;
}

#preloder{

    background-color: rgb(0 0 0 / 88%) !important;
}

</style>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder" style="display: none;">
        <div class="loader" style="display: none;"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="https://CityIndia.in/cart"><i class="fa fa-heart" style="font-size: 27px; color: red;"></i> <span>1</span></a></li>
                <li><a href="https://CityIndia.in/cart"><i class="fa fa-shopping-cart" style="font-size: 27px; color: #215273;"></i> <span style="background-color: #000;"><?php echo $ttc; ?></span></a></li>
            </ul>
            <div class="header__cart__price">Cart Value: <span><i class="fa fa-inr"></i>150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="<?php echo $site_url; ?>/account/login"><i class="fa fa-user"></i> Login</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Home</a></li>
                <li><a href="./shop-grid.php">Shop</a></li>
                <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.php">Shop Details</a></li>
                        <li><a href="./cart">Shoping Cart</a></li>
                        <li><a href="./checkout.php">Check Out</a></li>
                        <li><a href="./product-grid.php">Product Category</a></li>
                    </ul>
                </li>
                <li><a href="./blog.php">Blog</a></li>
                <li><a href="./contact.php">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> support@cityindia.in</li>
                <li>Free Delivery on minumum order of <i class="fa fa-inr"></i>499</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> support@cityindia.in</li>
                                <li>Free Delivery on minumum order of <i class="fa fa-inr"></i>499</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            

                            <?php 
                            if( isset($_SESSION['account-id']) ) {
                            $aQ = $conn -> query("SELECT * FROM accounts WHERE id = '$account_id'");
                            while ($aD = mysqli_fetch_array($aQ)) {
                                $name = $aD['name'];
                            } ?>

                            <div class="header__top__right__auth">
                                <a href="<?php echo $site_url; ?>/account/my-account"><i class="fa fa-user"></i> <?php echo $name; ?></a>
                            </div>

                            <?php } else{ ?>

                            <div class="header__top__right__auth">
                                <a href="<?php echo $site_url; ?>/account/login"><i class="fa fa-user"></i> Login</a>
                            </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="<?php echo $site_url; ?>"><img src="<?php echo $site_url; ?>/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="#" style="font-size: 12px;">Grocery <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="header__menu__dropdown">
                        <?php $subQ = $conn -> query("SELECT * FROM category WHERE super_category_id = '27'"); 
                    while ($subData = mysqli_fetch_array($subQ)) { ?>
                        <li><a href="<?php $site_url; ?>/Store/<?php echo $subData['slug'] ?>"><?php echo $subData['name'] ?></a></li>
                    <?php } ?>
                    <li><a href="<?php $site_url; ?>/Category/grocery">VIEW ALL</a></li>

                    </ul>
                </li>

                <li><a href="#" style="font-size: 12px;">Mobiles <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="header__menu__dropdown">
                        <?php $subQ = $conn -> query("SELECT * FROM category WHERE super_category_id = '16'"); 
                    while ($subData = mysqli_fetch_array($subQ)) { ?>
                        <li><a href="<?php $site_url; ?>/Store/<?php echo $subData['slug'] ?>"><?php echo $subData['name'] ?></a></li>
                    <?php } ?>
                    <li><a href="<?php $site_url; ?>/Category/mobiles-computers">VIEW ALL</a></li>

                    </ul>
                </li>


                <li><a href="#" style="font-size: 12px;">Beauty <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="header__menu__dropdown">
                        <?php $subQ = $conn -> query("SELECT * FROM category WHERE super_category_id = '18'"); 
                    while ($subData = mysqli_fetch_array($subQ)) { ?>
                        <li><a href="<?php $site_url; ?>/Store/<?php echo $subData['slug'] ?>"><?php echo $subData['name'] ?></a></li>
                    <?php } ?>
                    <li><a href="<?php $site_url; ?>/Category/beauty-health">VIEW ALL</a></li>

                    </ul>
                </li>



                <li><a href="#" style="font-size: 12px;">Fashion <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="header__menu__dropdown">
                        <?php $subQ = $conn -> query("SELECT * FROM category WHERE super_category_id = '23'"); 
                    while ($subData = mysqli_fetch_array($subQ)) { ?>
                        <li><a href="<?php $site_url; ?>/Store/<?php echo $subData['slug'] ?>"><?php echo $subData['name'] ?></a></li>
                    <?php } ?>
                    <li><a href="<?php $site_url; ?>/Category/women-s-fashion">VIEW ALL</a></li>

                    </ul>
                </li>



                <li><a href="#" style="font-size: 12px;">Swadeshi <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="header__menu__dropdown">
                        <?php $subQ = $conn -> query("SELECT * FROM category WHERE super_category_id = '10'"); 
                    while ($subData = mysqli_fetch_array($subQ)) { ?>
                        <li><a href="<?php $site_url; ?>/Store/<?php echo $subData['slug'] ?>"><?php echo $subData['name'] ?></a></li>
                    <?php } ?>
                    <li><a href="<?php $site_url; ?>/Category/swadeshi-">VIEW ALL</a></li>

                    </ul>
                </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-2">
                    <div class="header__cart">
                        <ul>
                            <li><a href="https://cityindia.in/cart"><i class="fa fa-heart" style="color: red; font-size: 27px;"></i> <span>1</span></a></li>
                            <li><a href="https://cityindia.in/cart"><i class="fa fa-shopping-cart" style="font-size: 27px; color: #215273;"></i> <span style="background-color: #000;"><?php echo $ttc; ?></span></a></li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All Categories</span>
                        </div>
                        <ul>
                    <?php $subQ = $conn -> query("SELECT * FROM super_category LIMIT 12"); 
                    while ($subData = mysqli_fetch_array($subQ)) { 

                    	if ($subData['coming_soon']) { ?>

                    		<li><a style="font-size: 13px;" href="javascript:(0)"><?php echo $subData['name'] ?><small><sup style="color: #215273;"> coming soon</sup></small></a></li>

                    	<?php }else { ?>

                    		<li><a style="font-size: 13px;" href="<?php $site_url; ?>/Category/<?php echo $subData['slug'] ?>"><?php echo $subData['name'] ?></a></li>

                    	<?php } ?>
                        
                    <?php } ?>

                            </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form" style="position: absolute; z-index: 999999; border: none;">
                            <form action="#" style="background-color: #fff;" class="search-form">
                                <input type="text" style="background-color: #f7f7f7; width: 82%;" class="search-key" placeholder="Search for product, brands...">
                                <button type="submit" class="site-btn">SEARCH</button>
                                <div class="search-result-holder" style="position: absolute; width: 80%; background-color: #fff;"></div>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+91 7004776271</h5>
                                <span>Customer Support 24x7</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg" style="border-radius: 6px;">
                        <div class="hero__text">
                            <!--<h2>Happiness Ka</h2>
                            <h2>Home Delivery</h2>
                            <h2>💕</h2>
                            <a href="#" class="primary-btn">SHOP NOW</a>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/grocery.jpg">
                            <h5><a href="https://cityindia.in/Category/grocery">Grocery</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/mobiles.jpg">
                            <h5><a href="https://cityindia.in/Store/mobile">Mobiles</a></h5>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/laptops.jpg">
                            <h5><a href="https://cityindia.in/Outlet/laptops">Laptops</a></h5>
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categories/womens.jpg">
                            <h5><a href="https://cityindia.in/Category/women-s-fashion">Women's Fashion</a></h5>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->



    <br>

    
    <!--<div class="container">
        <div class="col-md-12">
            <div class="row">
                <img src="banner/1.jpg" class="img-responsive">
            </div>
        </div>
    </div>-->



    <!-- Featured Section Begin -->
    <br>

<section class="">
        <div class="container">
            <div class="row">
            	<h4><b>Kitchen Items</b></h4><br>
                <div class="categories__slider_2 owl-carousel">
                    

                	<?php 

                        $Q = $conn -> query("SELECT * FROM items WHERE category_id = '27' ORDER BY id DESC LIMIT 16 ");

                        while ($itemData = mysqli_fetch_array($Q)) { 

                            $item_id = $itemData['id'];
                            $media_number = $itemData['media_number'];
                            $item_url = $site_url."/item/".$itemData['slug'];
                            $QIMG = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number' ");

                            while ($img_data = mysqli_fetch_array($QIMG)) {
                                $img = $site_url."/media/".$img_data['file_name'];
                            }

                            ?>
                            
                            
                            <div class=""><center>
                                <a href="<?php echo $item_url; ?>">
                                <div class="">

                                    <div class="product__discount__percent" style="float: left; height: 56px; width: 56px;color: #fff; border-radius: 35px; line-height: 6; text-align: center; font-size: 10px; background: url(img/discount.png); background-position: 0px; background-repeat: no-repeat; background-size: 54px; "><?php $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 "); 
                                while ($item_Data = mysqli_fetch_array($attr_q)) { ?>
                                <?php echo "Rs. ".( $item_Data['mrp'] - $item_Data['price'] ). " Off" ; ?>
                                <?php } ?> </div>
                                    
                                    <img src="<?php echo $img; ?>" class="img-responsive" style="width: 70%;">
                                	
                                </div>
                                <br>
                                <div class="">
                                    <h5><a href="#" style="color: #000;"><?php echo substr($itemData['name'], 0,20)."..."; ?></a></h5>
                                    <h5><i class="fa fa-inr"></i>

                                        <?php $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 "); 
                                while ($item_Data = mysqli_fetch_array($attr_q)) { ?>
                                <?php echo $item_Data['price']." <span style='font-size: 13px; color: #828282;'> / ".$item_Data['name']."</span>"; ?>
                                <?php } ?>   

                                    </h5>
                                </div>
                                
                                </a>
                            </center>
                            
                        </div>

                        <?php } ?>

                    
                </div>
            </div>
        </div>
    </section>

    <br>




        <br>

<section class="">
        <div class="container">
            <div class="row">
            	<h4><b>Handpicked Ladies Fashion</b></h4> <br>
                <div class="categories__slider_2 owl-carousel">
                    

                	<?php 

                        $Q = $conn -> query("SELECT * FROM items WHERE category_id = '23' ORDER BY id DESC LIMIT 16 ");

                        while ($itemData = mysqli_fetch_array($Q)) { 

                            $item_id = $itemData['id'];
                            $media_number = $itemData['media_number'];
                            $item_url = $site_url."/item/".$itemData['slug'];
                            $QIMG = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number' ");

                            while ($img_data = mysqli_fetch_array($QIMG)) {
                                $img = $site_url."/media/".$img_data['file_name'];
                            }

                            ?>
                            
                            
                            <div class=""><center>
                                <a href="<?php echo $item_url; ?>">
                                <div class="">
                                    
                                    <div class="product__discount__percent" style="float: left; height: 56px; width: 56px;color: #fff; border-radius: 35px; line-height: 6; text-align: center; font-size: 10px; background: url(img/discount.png); background-position: 0px; background-repeat: no-repeat; background-size: 54px; "><?php $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 "); 
                                while ($item_Data = mysqli_fetch_array($attr_q)) { ?>
                                <?php echo "Rs. ".( $item_Data['mrp'] - $item_Data['price'] ). " Off" ; ?>
                                <?php } ?> </div>

                                    <img src="<?php echo $img; ?>" class="img-responsive" style="width: 70%;">
                                	
                                </div>
                                <br>
                                <div class="">
                                    <h5><a href="#" style="color: #000;"><?php echo substr($itemData['name'], 0,20)."..."; ?></a></h5>
                                    <h5><i class="fa fa-inr"></i>

                                        <?php $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 "); 
                                while ($item_Data = mysqli_fetch_array($attr_q)) { ?>
                                <?php echo $item_Data['price']." <span style='font-size: 13px; color: #828282;'> / ".$item_Data['name']."</span>"; ?>
                                <?php } ?>   

                                    </h5>
                                </div>
                                
                                </a>
                            </center>
                            
                        </div>

                        <?php } ?>

                    
                </div>
            </div>
        </div>
    </section>

    <br>




<section class="">
        <div class="container">
            <div class="row">
            	<h4><b>Top Drinks from Horlicks</b></h4>
                <div class="categories__slider_2 owl-carousel">
                    

                	<?php 

                        $Q = $conn -> query("SELECT * FROM items WHERE brand_id = '175' ORDER BY id DESC LIMIT 16 ");

                        while ($itemData = mysqli_fetch_array($Q)) { 

                            $item_id = $itemData['id'];
                            $media_number = $itemData['media_number'];
                            $item_url = $site_url."/item/".$itemData['slug'];
                            $QIMG = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number' ");

                            while ($img_data = mysqli_fetch_array($QIMG)) {
                                $img = $site_url."/media/".$img_data['file_name'];
                            }

                            ?>
                            
                            
                            <div class=""><center>
                                <a href="<?php echo $item_url; ?>">
                                <div class="">
                                    
                                    <div class="product__discount__percent" style="float: left; height: 56px; width: 56px;color: #fff; border-radius: 35px; line-height: 6; text-align: center; font-size: 10px; background: url(img/discount.png); background-position: 0px; background-repeat: no-repeat; background-size: 54px; "><?php $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 "); 
                                while ($item_Data = mysqli_fetch_array($attr_q)) { ?>
                                <?php echo "Rs. ".( $item_Data['mrp'] - $item_Data['price'] ). " Off" ; ?>
                                <?php } ?> </div>

                                    <img src="<?php echo $img; ?>" class="img-responsive" style="width: 70%;">
                                	
                                </div>
                                <br>
                                <div class="">
                                    <h5><a href="#" style="color: #000;"><?php echo substr($itemData['name'], 0,20)."..."; ?></a></h5>
                                    <h5><i class="fa fa-inr"></i>

                                        <?php $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 "); 
                                while ($item_Data = mysqli_fetch_array($attr_q)) { ?>
                                <?php echo $item_Data['price']." <span style='font-size: 13px; color: #828282;'> / ".$item_Data['name']."</span>"; ?>
                                <?php } ?>   

                                    </h5>
                                </div>
                                
                                </a>
                            </center>
                            
                        </div>

                        <?php } ?>

                    
                </div>
            </div>
        </div>
    </section>

    <br>





<section class="">
        <div class="container">
            <div class="row">
            	<h4><b>Washing Ease Items</b></h4>
                <div class="categories__slider_2 owl-carousel">
                    

                	<?php 

                        $Q = $conn -> query("SELECT * FROM items WHERE category_2_id = '108' ORDER BY id DESC LIMIT 20 ");

                        while ($itemData = mysqli_fetch_array($Q)) { 

                            $item_id = $itemData['id'];
                            $media_number = $itemData['media_number'];
                            $item_url = $site_url."/item/".$itemData['slug'];
                            $QIMG = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number' ");

                            while ($img_data = mysqli_fetch_array($QIMG)) {
                                $img = $site_url."/media/".$img_data['file_name'];
                            }

                            ?>
                            
                            
                            <div class=""><center>
                                <a href="<?php echo $item_url; ?>">
                                <div class="">
                                    
                                    <div class="product__discount__percent" style="float: left; height: 56px; width: 56px;color: #fff; border-radius: 35px; line-height: 6; text-align: center; font-size: 10px; background: url(img/discount.png); background-position: 0px; background-repeat: no-repeat; background-size: 54px; "><?php $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 "); 
                                while ($item_Data = mysqli_fetch_array($attr_q)) { ?>
                                <?php echo "Rs. ".( $item_Data['mrp'] - $item_Data['price'] ). " Off" ; ?>
                                <?php } ?> </div>
                                
                                    <img src="<?php echo $img; ?>" class="img-responsive" style="width: 70%;">
                                	
                                </div>
                                <br>
                                <div class="">
                                    <h5><a href="#" style="color: #000;"><?php echo substr($itemData['name'], 0,20)."..."; ?></a></h5>
                                    <h5><i class="fa fa-inr"></i>

                                        <?php $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 "); 
                                while ($item_Data = mysqli_fetch_array($attr_q)) { ?>
                                <?php echo $item_Data['price']." <span style='font-size: 13px; color: #828282;'> / ".$item_Data['name']."</span>"; ?>
                                <?php } ?>   

                                    </h5>
                                </div>
                                
                                </a>
                            </center>
                            
                        </div>

                        <?php } ?>

                    
                </div>
            </div>
        </div>
    </section>


    <!-- Featured Section End -->

    <!-- Banner Begin 
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <a href="<?php echo $site_url; ?>/Category/grocery"><img src="img/banner/banner-1.jpg" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <a href="<?php echo $site_url; ?>/Outlet/tea"><img src="img/banner/banner-2.jpg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
     Banner End -->

<br>

    
    <!--<div class="container">
        <div class="col-md-12">
            <div class="row">
                <?php $q = $conn -> query("SELECT * FROM banners WHERE id = '1'"); 
    while ($banner_Data = mysqli_fetch_array($q)) {
      $banner_id = $banner_Data['id'];
      $banner = $site_url."/media/".$banner_Data['file_name']; ?>
      <img src="<?php echo $banner; ?>" class="img-responsive">
      <?php  } ?>
                
            </div>
        </div>
    </div>-->




    <!-- Latest Product Section Begin -->
    <section class="latest-product spad" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Demo Product</h6>
                                        <span><i class="fa fa-inr"></i>30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->





<!--<section>
    
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <?php $q = $conn -> query("SELECT * FROM banners WHERE id = '2'"); 
    while ($banner_Data = mysqli_fetch_array($q)) {
      $banner_id = $banner_Data['id'];
      $banner = $site_url."/media/".$banner_Data['file_name']; ?>
      <img src="<?php echo $banner; ?>" class="img-responsive">
      <?php  } ?>
            </div>
        </div>
    </div>

</section>-->

<br>

    

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

    <!-- Footer Section Begin -->
    <?php include('footer.php'); ?>
    <!-- Footer Section End -->



</body>

</html>