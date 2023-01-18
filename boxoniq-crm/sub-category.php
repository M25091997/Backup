<?php session_start(); ?>
<?php include('config.php'); ?>
<?php include('head-meta.php'); ?>


<?php 

$slug = $_GET['slug'];
$QC = $conn -> query("SELECT * FROM category WHERE slug = '$slug'");
while ($categoryData = mysqli_fetch_array($QC)) {
     $category_id = $categoryData['id'];
     $category_name = $categoryData['name'];
     $cat_img = str_replace(" ", "%20", $categoryData['img']);
}



$Q = $conn -> query("SELECT * FROM items WHERE sub_category_id = '$category_id'");
$total = mysqli_num_rows($Q);

?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section" style="background: url(https://cityindia.in/category_banners/<?php echo $cat_img; ?>); background-size: 100%; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2 style="text-shadow: 3px 3px 3px rgba(150, 150, 150, 1); font-size: 33px; margin-top: -21px;"><?php echo $category_name; ?></h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span><?php echo $_GET['slug']; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">

<script type="text/javascript">
 $("#preloder").hide();
</script>

<style>
#preloder{ display: none; }

#menu li {
  display:inline;
}
</style>
            <div class="row" style="margin-top: -40px;">
<div class="col-md-12 col-lg-12">
<h3 style="display: inline;"><b>Related:</b> </h3> 
<ul id="menu" style="display: inline;">

<?php 

$SQ = $conn -> query("SELECT * FROM category LIMIT 16");

while ( $listD = mysqli_fetch_array($SQ)) { 

    if ( $listD['slug'] == $_GET['slug'] ) { $c = "#215273;"; $font = "#fff;"; } else { $c = "#fff;"; $font = "#000;"; }

    ?>
    <li><a href="<?php echo $site_url; ?>/Store/<?php echo $listD['slug']; ?>" class="btn btn-primary" style="border-radius: 25px; background-color: #fff; border-color: #215273; background-color: <?php echo $c; ?> color: <?php echo $font; ?> margin-top: 2px; font-size: 12px;"><?php echo $listD['name']; ?></a></li>
<?php } ?>

</ul>  
</div>
            </div>

            <br>

            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>in <?php echo $category_name; ?></h4>
                            <ul>
                    <?php $subQ = $conn -> query("SELECT * FROM category_2 WHERE category_1_id = '$category_id'"); 
                    while ($subData = mysqli_fetch_array($subQ)) { ?>
                        <li><a href="<?php $site_url; ?>/Outlet/<?php echo $subData['slug'] ?>"><?php echo $subData['name'] ?></a></li>
                    <?php } ?>

                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option" style="display: none;">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text" style="display: none;">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="<?php echo $site_url; ?>/img/latest-product/lp-1.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span><i class="fa fa-inr"></i>30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="<?php echo $site_url; ?>/img/latest-product/lp-2.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span><i class="fa fa-inr"></i>30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="<?php echo $site_url; ?>/img/latest-product/lp-3.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span><i class="fa fa-inr"></i>30.00</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="<?php echo $site_url; ?>/img/latest-product/lp-1.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span><i class="fa fa-inr"></i>30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="<?php echo $site_url; ?>/img/latest-product/lp-2.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span><i class="fa fa-inr"></i>30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="<?php echo $site_url; ?>/img/latest-product/lp-3.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span><i class="fa fa-inr"></i>30.00</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount" style="display: none;">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="<?php echo $site_url; ?>/img/product/discount/pd-1.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price"><i class="fa fa-inr"></i>30.00 <span><i class="fa fa-inr"></i>36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="<?php echo $site_url; ?>/img/product/discount/pd-2.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Vegetables</span>
                                            <h5><a href="#">Vegetables’package</a></h5>
                                            <div class="product__item__price"><i class="fa fa-inr"></i>30.00 <span><i class="fa fa-inr"></i>36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="<?php echo $site_url; ?>/img/product/discount/pd-3.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Mixed Fruitss</a></h5>
                                            <div class="product__item__price"><i class="fa fa-inr"></i>30.00 <span><i class="fa fa-inr"></i>36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="<?php echo $site_url; ?>/img/product/discount/pd-4.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price"><i class="fa fa-inr"></i>30.00 <span><i class="fa fa-inr"></i>36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="<?php echo $site_url; ?>/img/product/discount/pd-5.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price"><i class="fa fa-inr"></i>30.00 <span><i class="fa fa-inr"></i>36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="<?php echo $site_url; ?>/img/product/discount/pd-6.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price"><i class="fa fa-inr"></i>30.00 <span><i class="fa fa-inr"></i>36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span><?php echo $total; ?></span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <?php 

                        $Q = $conn -> query("SELECT * FROM items WHERE sub_category_id = '$category_id' ORDER BY id DESC LIMIT 350 ");

                        while ($itemData = mysqli_fetch_array($Q)) { 

                            $item_id = $itemData['id'];
                            $media_number = $itemData['media_number'];
                            $item_url = $site_url."/item/".$itemData['slug'];
                            $QIMG = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number' ");

                            while ($img_data = mysqli_fetch_array($QIMG)) {
                                $img = $site_url."/media/".$img_data['file_name'];
                            }

                            ?>
                            
                            <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <a href="<?php echo $item_url; ?>">
                                <div class="product__item__pic set-bg">
                                    <div class="product__discount__percent" style="float: left; height: 56px; width: 56px;color: #fff; border-radius: 35px; line-height: 6; text-align: center; font-size: 10px; background: url(<?php echo $site_url; ?>/img/discount.png); background-position: 0px; background-repeat: no-repeat; background-size: 54px; "><?php $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 "); 
                                while ($item_Data = mysqli_fetch_array($attr_q)) { ?>
                                <?php echo "Rs. ".( $item_Data['mrp'] - $item_Data['price'] ). " Off" ; ?>
                                <?php } ?> </div>
                                
                                    <center>
                                    <img src="<?php echo $img; ?>" class="img-responsive" style="width: 74%;">
                                	</center>
                                    <!--<ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>-->
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="<?php echo $item_url; ?>"><?php echo $itemData['name']; ?></a></h6>
                                    <h5><i class="fa fa-inr"></i>

                                        <?php $attr_q = $conn -> query("SELECT * FROM attributes WHERE item_id = '$item_id' LIMIT 1 "); 
                                while ($item_Data = mysqli_fetch_array($attr_q)) { ?>
                                <?php echo $item_Data['price']." <span style='font-size: 13px; color: #828282;'> / ".$item_Data['name']."</span>"; ?>
                                <?php } ?>   

                                    </h5>
                                </div>
                                </a>
                            </div>
                        </div>

                        <?php } ?>
                        
                    </div>
                    <div class="product__pagination" style="display: none;">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Js Plugins -->
    <script src="<?php echo $site_url; ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo $site_url; ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $site_url; ?>/js/jquery.nice-select.min.js"></script>
    <script src="<?php echo $site_url; ?>/js/jquery-ui.min.js"></script>
    <script src="<?php echo $site_url; ?>/js/jquery.slicknav.js"></script>
    <script src="<?php echo $site_url; ?>/js/mixitup.min.js"></script>
    <script src="<?php echo $site_url; ?>/js/owl.carousel.min.js"></script>
    <script src="<?php echo $site_url; ?>/js/main.js"></script>


    <!-- Footer Section Begin -->
    <?php include('footer.php'); ?>
    <!-- Footer Section End -->



</body>

</html>