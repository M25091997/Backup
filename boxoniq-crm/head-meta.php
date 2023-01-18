<?php 

$account_id = $_SESSION['account-id'];
$msg_query = $conn -> query("SELECT * FROM cart WHERE account_id = '$account_id' AND checkout = '0'");  
$ttc = mysqli_num_rows($msg_query);

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="description" content="Buy Online Grocery & Home Delivery Available.">
    <meta name="keywords" content="Grocery, Ecommerce, Home Delivery.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Category - CityIndia.in</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?php echo $site_url; ?>/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>/css/style.css" type="text/css">

    <style type="text/css">

.blur{
	filter: blur(18px);
}

.no-blur{
	filter: blur(0px);
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

.footer-list:hover, .footer-list:focus{
    color: #000;
}

.brand-names>.brand-names__item {
    margin-right: 20px;
}

.search-key{ color: #000 !important; }

.footer-heading {
    color: #1c1c1c;
    font-weight: 700;
    margin-bottom: 10px;
}

.header__menu__dropdown{
	z-index: 9999999 !important;
}

#preloder{

    background-color: rgb(0 0 0 / 88%) !important;
}

</style>

</head>

<body class="">
    <!-- Page Preloder -->
    <div id="preloder" style="display: none;">
        <!--<div class="loader"></div>-->
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart" style="    font-size: 27px; color: red;"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-cart" style="font-size: 27px; color: #215273;"></i> <span style="background-color: #000;" ><?php echo $ttc; ?></span></a></li>
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
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li><a href="#">Pulses</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.php">Arhar</a></li>
                        <li><a href="./cart">Moong</a></li>
                        <li><a href="./checkout.php">Urad</a></li>
                        <li><a href="./product-grid.php">Rajma</a></li>
                        <li><a href="./product-grid.php">Masoor</a></li>
                        <li><a href="./product-grid.php">Dried Peas & Others</a></li>
                    </ul>
                </li>

                <li><a href="#">Atta</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.php">Flours</a></li>
                        <li><a href="./cart">Besan</a></li>
                        <li><a href="./checkout.php">Sooji</a></li>
                        <li><a href="./product-grid.php">other Atta</a></li>
                    </ul>
                </li>


                <li><a href="#">Oils</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.php">Health Oils</a></li>
                        <li><a href="./cart">Musturd Oils</a></li>
                        <li><a href="./checkout.php">Sunflower Oils</a></li>
                        <li><a href="./product-grid.php">Soyabean Oils</a></li>
                        <li><a href="./product-grid.php">Rice Bran Oils</a></li>
                    </ul>
                </li>



                <li><a href="#">Edible Oils</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.php">Health Oils</a></li>
                        <li><a href="./cart">Musturd Oils</a></li>
                        <li><a href="./checkout.php">Sunflower Oils</a></li>
                        <li><a href="./product-grid.php">Soyabean Oils</a></li>
                        <li><a href="./product-grid.php">Rice Bran Oils</a></li>
                    </ul>
                </li>



                <li><a href="#">Spices</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.php">Whole Spices</a></li>
                        <li><a href="./shop-details.php">Powdered Spices</a></li>
                        <li><a href="./shop-details.php">Ready Masala</a></li>
                    </ul>
                </li>






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
                    <div class="col-lg-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> support@cityindia.in</li>
                                <li>Free Delivery on minumum order of <i class="fa fa-inr"></i>499</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
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
                            <li><a href="https://cityindia.in/cart"><i class="fa fa-heart" style="    font-size: 27px; color: red;"></i> <span>1</span></a></li>
                            <li><a href="https://cityindia.in/cart"><i class="fa fa-shopping-cart" style="    font-size: 27px;  color: #215273;
"></i> <span style="background-color: #000;"><?php echo $ttc; ?></span></a></li>
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
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Trending Categories</span>
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
                        <div class="hero__search__form" style="position: absolute; z-index: 999999; border: 1px solid #f7f7f7; border-radius: 1px; border-right: none; ">
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
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->