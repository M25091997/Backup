<?php


$cQ = $conn->query("SELECT * FROM accounts WHERE verification = '1' ORDER BY id DESC ");

$ALL_CUSTOMERS = mysqli_num_rows($cQ);



// $cQ = $conn -> query("SELECT * FROM orders ORDER BY id DESC "); 
$cQ = $conn->query("SELECT * FROM bookings WHERE subscription = '0' ORDER BY id DESC  ");
$total_orders = mysqli_num_rows($cQ);

$scQ = $conn->query("SELECT * FROM subs_booking_history ORDER BY id DESC  ");
$total_sorders = mysqli_num_rows($scQ);

$sOh = $conn->query("SELECT * FROM sub_order_history ORDER BY id DESC  ");
$sub_sorders_history = mysqli_num_rows($sOh);


$cQ = $conn->query("SELECT * FROM orders WHERE status_id = '4' ORDER BY id DESC ");

$total_c_orders = mysqli_num_rows($cQ);


$cQ = $conn->query("SELECT * FROM orders WHERE status_id < '4' ORDER BY id DESC ");

$total_p_orders = mysqli_num_rows($cQ);



$cQ = $conn->query("SELECT * FROM payment_history ORDER BY id DESC ");

$total_payment = mysqli_num_rows($cQ);


$cQ = $conn->query("SELECT * FROM items ORDER BY id DESC ");

$total_products = mysqli_num_rows($cQ);

$cQ = $conn->query("SELECT * FROM super_category ORDER BY id DESC ");

$total_super_category = mysqli_num_rows($cQ);

$cQ = $conn->query("SELECT * FROM category ORDER BY id DESC ");

$total_sub_category = mysqli_num_rows($cQ);

$cQ = $conn->query("SELECT * FROM brand ORDER BY id DESC ");

$total_brands = mysqli_num_rows($cQ);


$cQ = $conn->query("SELECT * FROM slider ORDER BY id DESC ");

$total_slider = mysqli_num_rows($cQ);



?>



<!DOCTYPE html>







<html>







<head>







    <title>Dashboard</title>







    <!--Font-->







    <link href='//fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>















    <!-- JQUERY-->







    <script src="//code.jquery.com/jquery-2.2.3.min.js"></script>















    <!--Live Form-->







    <script src="../../assets/js/liveform.js"></script>















    <!--Drop Zone-->







    <script src="../../assets/js/Dropzone.js"></script>







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
        body {







            background-color: #efefef;







        }
    </style>

<style>
    .no-pad {
      padding: 15px;
      text-align: center;
      border-radius: 10px;
      box-shadow: 2px 2px 2px 2px #ccc;
      margin-right: 20px;
      width: calc(50% - 20px);
      color: white;
      cursor: pointer;
    }

    /* Extra small devices (phones, 600px and down) */
    @media (max-width: 600px) {
      .no-pad {
        width: 100%;
        margin-right: 0px;
        margin-bottom: 10px;
      }
    }

    /* tablet vertical */
    @media(min-width:600px) {
      .no-pad {
        width: 100%;
        margin-right: 0px;
        margin-bottom: 10px;
      }
    }

    /* tabler horizontal */
    @media(min-width:768px) {
      .df {
        display: flex;
      }

      .no-pad {
        margin-right: 20px;
        width: calc(100% - 50%);
      }
    }

    /* laptop screen */
    @media(min-width:992px) {
      .df {
        display: flex;
      }

      .no-pad {
        margin-right: 20px;
        width: calc(100% - 50%);
      }

    }

    @media(min-width:1200px) {}
  </style>


</head>







<body>







    <div class="container">







        <div class="row">















            <div class="col-md-4"><br><br><br><br>







                <div class="panel panel-primary">







                    <div class="panel-heading">







                        <h3 class="panel-title">Manage Website</h3>







                    </div>







                    <div class="panel-body" style="text-transform: uppercase !important;">







                        <div class="list-group">







                            <a href="javascript:(0)" class="list-group-item active">







                                Dashboard <i class="fa fa-angle-right" style="float: right;"></i>







                            </a>







                            <a href="all-customers.php" class="list-group-item"> All Customers (
                                <?php echo $ALL_CUSTOMERS; ?> ) <i class="fa fa-angle-right" style="float: right;"></i>
                            </a>

                            <a href="manage-slider.php" class="list-group-item"> Manage Slider <i class="fa fa-angle-right" style="float: right;"></i> </a>
                            
                            <a href="new-main-category.php" class="list-group-item"> Add New Category<i class="fa fa-angle-right" style="float: right;"></i> </a>


                            <!-- <a href="home-sliders.php" class="list-group-item"> Home Slider Control<i class="fa fa-angle-right" style="float: right;"></i> </a> -->



                            <a href="new-sub-category.php" class="list-group-item"> Add Sub Category  <i class="fa fa-angle-right" style="float: right;"></i> </a>

                            <!-- <a href="new-sub-category-2.php" class="list-group-item"> Add Child Category  <i class="fa fa-angle-right" style="float: right;"></i> </a> -->



                            <a href="new-brand.php" class="list-group-item"> Brand Management <i class="fa fa-angle-right" style="float: right;"></i> </a>
                            
                            <a href="new-product" class="list-group-item"> Add new Product <i class="fa fa-angle-right" style="float: right;"></i> </a>

                            
                            <a href="new-attribute.php" class="list-group-item"> Add New Attribute <i class="fa fa-angle-right" style="float: right;"></i> </a>



                            <a href="stocks-v2.php" class="list-group-item"> All Attributes &amp; Stock Management <i class="fa fa-angle-right" style="float: right;"></i> </a>



                            

                            <!-- <a href="promo-banner.php" class="list-group-item"> Promo Banner Management  <i class="fa fa-angle-right" style="float: right;"></i> </a> -->

                            <a href="coupons.php" class="list-group-item"> ADD / MANAGE COUPONS & DISCOUNTS<i class="fa fa-angle-right" style="float: right;"></i> </a>

                            <a href="manage-whychoose-section.php" class="list-group-item">MANAGE WHY CHOOSE SECTION<i class="fa fa-angle-right" style="float: right;"></i> </a>
                            
                            <a href="bundle-subscription-benefit.php" class="list-group-item">Manage Bundle Benefit<i class="fa fa-angle-right" style="float: right;"></i> </a>
                            
                            <a href="subscription-benefit.php" class="list-group-item">Manage Subscription Benefit<i class="fa fa-angle-right" style="float: right;"></i> </a>
                            <a href="new-blog.php" class="list-group-item">Manage Blogs<i class="fa fa-angle-right" style="float: right;"></i> </a>
                            <a href="bundle-benefit-category-no.php" class="list-group-item">Manage Subscription Benifit Category Count<i class="fa fa-angle-right" style="float: right;"></i> </a>
                            <a href="add-contact-detail.php" class="list-group-item">Manage Contact Detail<i class="fa fa-angle-right" style="float: right;"></i> </a>
                            <a href="new-stories.php" class="list-group-item">Manage Stories<i class="fa fa-angle-right" style="float: right;"></i> </a>
                            <a href="add-faq-section.php" class="list-group-item">Manage Faq Section<i class="fa fa-angle-right" style="float: right;"></i> </a>
                            
                            
                            <a href="all-products.php" class="list-group-item"> All Products (
                                <?php echo $total_products; ?> ) <i class="fa fa-angle-right" style="float: right;"></i>
                            </a>



                            <a href="payment-history" class="list-group-item"> Payment History (
                                <?php echo $total_payment; ?> ) <i class="fa fa-angle-right" style="float: right;"></i>
                            </a>



                            <a href="all-orders.php" class="list-group-item"> All Normal Orders ( <?php echo $total_orders; ?>
                                ) <i class="fa fa-angle-right" style="float: right;"></i> </a>


                            <a href="all-subs-orders.php" class="list-group-item"> All Subs Orders ( <?php echo $total_sorders; ?>
                                ) <i class="fa fa-angle-right" style="float: right;"></i>
                            </a>


                            <a href="subs-orders-history.php" class="list-group-item"> Subs Orders History ( <?php echo $total_sorders; ?>
                                ) <i class="fa fa-angle-right" style="float: right;"></i>
                            </a>



                            <a href="all-c-orders.php" class="list-group-item"> Completed Orders<i class="fa fa-angle-right" style="float: right;"></i> </a>



                            <a href="all-p-orders.php" class="list-group-item"> Pending Orders<i class="fa fa-angle-right" style="float: right;"></i> </a>

                            <!-- <a href="https://mail.hostinger.com/" target="blank" class="list-group-item"> WebMail Login<i class="fa fa-angle-right" style="float: right;"></i> </a> -->


                            <!-- <a href="search-map.php" class="list-group-item"> User Search Map<i class="fa fa-angle-right" style="float: right;"></i> </a> -->
                            
                            <a href="bundle-creator.php" class="list-group-item"> Create Bundle<i class="fa fa-angle-right" style="float: right;"></i> </a>


                            <a href="notification-shooter.php" class="list-group-item"> PUSH NOTIFICATION<i class="fa fa-angle-right" style="float: right;"></i> </a>

                            <!-- <a href="popular-searches.php" class="list-group-item"> MANAGE POPULAR SEARCHES<i class="fa fa-angle-right" style="float: right;"></i> </a> -->

                            <!-- <a href="default-pincode.php" class="list-group-item"> MANAGE DEFAULT PINCODES<i class="fa fa-angle-right" style="float: right;"></i> </a> -->

                            <a href="sales-report-normal.php" class="list-group-item">Sales Report(Normal)<i class="fa fa-angle-right" style="float: right;"></i> </a>
                            
                            <a href="sales-report-subscription.php" class="list-group-item">Sales Report(Subscription)<i class="fa fa-angle-right" style="float: right;"></i> </a>

                            <a href="logout.php" class="list-group-item"> Logout <i class="fa fa-angle-right" style="float: right;"></i> </a>





                        </div>











                    </div>



                </div>

            </div>











            <div class="col-md-8">







                <div class="jumbotron">







                    <h1>Dashboard</h1>







                    <p>Welcome Boxoniq Dashboard <br>This is the admin section of Website / Application. <br> You can
                        Manage Your Backend Here.<br> Version 2.0</b></p>







                    <!-- <p><a href="new-project.php" style="border-radius: 4px;" class="btn btn-info btn-lg"><i class="fa fa-plus"></i> Lets add a project</a></p> -->







                </div>

                <!-- cards -->
            <div class="row df">
              <div class="no-pad" style="background-color: rgb(3,169,245);">
              <a target="_blank" style="color:#fff;text-decoration:none" href="all-orders.php">
                <div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    All Orders
                    <h2 class="bold" style="font-weight: 600;"><?php echo $total_orders; ?> </h2>
                  </div>
                </div></a>
              </div>

              <div class="no-pad" style="background-color: rgb(110,195,110);">
               <a target="_blank" style="color:#fff;text-decoration:none" href="all-customers.php">
                  <div class="widget bg-inverse">
                    <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                      <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                    </div>
                    <div class="widget-progress">
                      <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                    </div>
                    <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                      All Customers
                      <h2 class="bold" style="font-weight: 600;"><?php echo $ALL_CUSTOMERS; ?></h2>
                    </div>
                  </div>
                 </a>
              </div>
              <div class="no-pad" style="background-color: rgb(40,150,136);">
              <a target="_blank" style="color:#fff;text-decoration:none" href="all-products.php"><div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    All Products
                    <h2 class="bold" style="font-weight: 600;"><?php echo $total_products; ?></h2>
                  </div>
                </div>
              </div></a>

            </div>

            <div class="row df">

            <div class="no-pad" style="background-color: rgb(42,180,180);">
            <a target="_blank" style="color:#fff;text-decoration:none" href="all-subs-orders.php"><div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    Subscription Orders
                    <h2 class="bold" style="font-weight: 600;"><?php echo $total_sorders; ?></h2>
                  </div>
                </div></a>

              </div>

            <div class="no-pad" style="background-color: rgb(40 64 150);">
            <a target="_blank" style="color:#fff;text-decoration:none" href="new-main-category.php"><div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    All Super Categories
                    <h2 class="bold" style="font-weight: 600;"><?php echo $total_super_category; ?></h2>
                  </div>
                </div></a>
              </div>

              <div class="no-pad" style="background-color: rgb(144 150 40);">
              <a target="_blank" style="color:#fff;text-decoration:none" href="new-sub-category.php"><div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                     All Sub Categories
                    <h2 class="bold" style="font-weight: 600;"><?php echo $total_sub_category; ?></h2>
                  </div>
                </div>
              </div></a>

          </div>

          <div class="row df">

            <div class="no-pad" style="background-color: rgb(71 20 20);">
            <a target="_blank" style="color:#fff;text-decoration:none" href="new-brand.php"><div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    All Brands
                    <h2 class="bold" style="font-weight: 600;"><?php echo $total_brands; ?></h2>
                  </div>
                </div></a>
              </div>
              
              <div class="no-pad" style="background-color: rgb(40,150,136);">
              <a target="_blank" style="color:#fff;text-decoration:none" href="manage-slider.php"><div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    All Sliders
                    <h2 class="bold" style="font-weight: 600;"><?php echo $total_sliders; ?></h2>
                  </div>
                </div></a>
              </div>


              <div class="no-pad" style="background-color: rgb(45 150 40);">
              <a target="_blank" style="color:#fff;text-decoration:none" href="stocks-v2.php"><div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    Price & Stock Management
                    <!-- <h2 class="bold" style="font-weight: 600;"><?php echo $total_sorders; ?></h2> -->
                  </div>
                </div></a>

              </div>


          </div>

          <div class="row df">

            <div class="no-pad" style="background-color: rgb(40 88 150);">
            <a target="_blank" style="color:#fff;text-decoration:none" href="bundle-subscription-benefit.php"><div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    Manage Bundle Benefit
                    <!-- <h2 class="bold" style="font-weight: 600;"><?php echo $total_products; ?></h2> -->
                  </div>
                </div></a>
              </div>
              
              <div class="no-pad" style="background-color: rgb(40,150,136);">
              <a target="_blank" style="color:#fff;text-decoration:none" href="subscription-benefit.php"><div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    Manage Subscription Benefit
                    <!-- <h2 class="bold" style="font-weight: 600;"><?php echo $total_products; ?></h2> -->
                  </div>
                </div></a>
              </div>


              <div class="no-pad" style="background-color: rgb(45 150 40);">
              <a target="_blank" style="color:#fff;text-decoration:none" href="coupons.php"><div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    Manage Coupons
                    <!-- <h2 class="bold" style="font-weight: 600;"><?php echo $total_sorders; ?></h2> -->
                  </div>
                </div></a>

              </div>


          </div>

          <div class="row df">

            <div class="no-pad" style="background-color: rgb(40 88 150);">
            <a target="_blank" style="color:#fff;text-decoration:none" href="stay-in-touch-section.php"><div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    Stay In Touch
                    <!-- <h2 class="bold" style="font-weight: 600;"><?php echo $total_products; ?></h2> -->
                  </div>
                </div></a>
              </div>
              
              <div class="no-pad" style="background-color: rgb(40,150,136);">
              <a target="_blank" style="color:#fff;text-decoration:none" href="manage-enquiry-detail.php"><div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    Manage Enquiry Detail
                    <!-- <h2 class="bold" style="font-weight: 600;"><?php echo $total_products; ?></h2> -->
                  </div>
                </div></a>
              </div>


              <div class="no-pad" style="background-color: rgb(45 150 40);">
              <a target="_blank" style="color:#fff;text-decoration:none" href="coupons.php"><div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    Manage Coupons
                    <!-- <h2 class="bold" style="font-weight: 600;"><?php echo $total_sorders; ?></h2> -->
                  </div>
                </div></a>

              </div>


          </div>

          

          <!-- end cards -->

         
            </div>


        </div>


    </div>


</body>







</html>