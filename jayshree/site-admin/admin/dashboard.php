<?php



$cQ = $conn->query("SELECT * FROM accounts WHERE verification = '1' AND account_type = '0' ORDER BY id DESC ");

$ALL_CUSTOMERS = mysqli_num_rows($cQ);


// ALL CORPORATE QUERY
$AcQ = $conn->query("SELECT * FROM accounts WHERE verification = '1' AND account_type = '1' ORDER BY id DESC ");
$ALL_CORPORATE_CUSTOMERS = mysqli_num_rows($AcQ);
// END ALL CORPORATE QUERY


$cQDel = $conn->query("SELECT * FROM delivery_boy ORDER BY id DESC ");

$ALL_DELIVERYBOYS = mysqli_num_rows($cQDel);

// pending booking
$podr = $conn->query("SELECT * FROM bookings WHERE order_status = 2 ORDER BY id DESC  ");

$ALL_PENDINGORDERS = mysqli_num_rows($podr);






$cQ = $conn->query("SELECT * FROM bookings ORDER BY id DESC ");

$total_orders = mysqli_num_rows($cQ);







$cQ = $conn->query("SELECT * FROM orders WHERE status_id = '4' ORDER BY id DESC ");

$total_c_orders = mysqli_num_rows($cQ);







$cQ = $conn->query("SELECT * FROM orders WHERE status_id < '4' ORDER BY id DESC ");

$total_p_orders = mysqli_num_rows($cQ);





$cQ = $conn->query("SELECT * FROM payment_history ORDER BY id DESC ");

$total_payment = mysqli_num_rows($cQ);



// payment history
$pH = $conn->query("SELECT * FROM bookings WHERE order_status = 5 ORDER BY id DESC ");
$payment_history = mysqli_num_rows($pH);
// end payment history





$cQ = $conn->query("SELECT * FROM items ORDER BY id DESC ");

$total_products = mysqli_num_rows($cQ);









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





              <!-- check user role start -->
              <!-- main admin -->
              <?php
              if ($_SESSION['role_id'] == '1') { ?>
                <a href="all-customers.php" class="list-group-item"> All Customers ( <?php echo $ALL_CUSTOMERS; ?> ) <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="all-corporate-customers.php" class="list-group-item"> All Corporate Customers ( <?php echo $ALL_CORPORATE_CUSTOMERS; ?> ) <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="manage-slider.php" class="list-group-item"> Manage Slider <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="stocks-v3.php" class="list-group-item"> All Attributes &amp; Stock Management <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="new-main-category.php" class="list-group-item"> Add New Customer Category<i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="view-super-category.php" class="list-group-item"> Set Prioriy Category<i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="new-corporate-category.php" class="list-group-item"> Add New Corporate Category<i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="view-corporate-category.php" class="list-group-item"> Set Prioriy Corporate Category<i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="add-delivery.php" class="list-group-item"> Manage Delivery Boy ( <?php echo $ALL_DELIVERYBOYS; ?> ) <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="new-product" class="list-group-item"> Add new Product <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="new-attribute.php" class="list-group-item"> Add New Attribute <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="all-products.php" class="list-group-item"> All Products ( <?php echo $total_products; ?> ) <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="payment-history" class="list-group-item"> Payment History ( <?php echo $payment_history; ?> ) <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="all-orders.php" class="list-group-item"> All Orders ( <?php echo $total_orders; ?> ) <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="all-c-orders.php" class="list-group-item"> Completed Orders<i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="all-p-orders.php" class="list-group-item"> Pending Orders<i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="notification-shooter.php" class="list-group-item"> PUSH NOTIFICATION<i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="logout.php" class="list-group-item"> Logout <i class="fa fa-angle-right" style="float: right;"></i> </a>
              <?php  } ?>
              <!-- check user role end -->


              <!-- stock manager start -->
              <?php
              if ($_SESSION['role_id'] == '2') { ?>
                <a href="stocks-v3.php" class="list-group-item"> All Attributes &amp; Stock Management <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="new-main-category.php" class="list-group-item"> Add New Category<i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="new-product" class="list-group-item"> Add new Product <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="all-products.php" class="list-group-item"> All Products ( <?php echo $total_products; ?> ) <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="logout.php" class="list-group-item"> Logout <i class="fa fa-angle-right" style="float: right;"></i> </a>
              <?php } ?>
              <!-- stock manager end -->

              <!-- stock manager start -->
              <?php
              if ($_SESSION['role_id'] == '3') { ?>
                <a href="payment-history" class="list-group-item"> Payment History ( <?php echo $payment_history; ?> ) <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="all-orders.php" class="list-group-item"> All Orders ( <?php echo $total_orders; ?> ) <i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="all-c-orders.php" class="list-group-item"> Completed Orders<i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="all-p-orders.php" class="list-group-item"> Pending Orders<i class="fa fa-angle-right" style="float: right;"></i> </a>
                <a href="logout.php" class="list-group-item"> Logout <i class="fa fa-angle-right" style="float: right;"></i> </a>
              <?php } ?>
              <!-- stock manager end -->








              <!-- <a href="home-sliders.php" class="list-group-item"> Home Slider Control<i class="fa fa-angle-right" style="float: right;"></i> </a> -->



              <!-- <a href="new-sub-category.php" class="list-group-item"> Add Sub Category  <i class="fa fa-angle-right" style="float: right;"></i> </a>

    <a href="new-sub-category-2.php" class="list-group-item"> Add Child Category  <i class="fa fa-angle-right" style="float: right;"></i> </a> -->



              <!-- <a href="new-brand.php" class="list-group-item"> Brand Management  <i class="fa fa-angle-right" style="float: right;"></i> </a>

    <a href="promo-banner.php" class="list-group-item"> Promo Banner Management  <i class="fa fa-angle-right" style="float: right;"></i> </a>
    
    <a href="coupons.php" class="list-group-item"> ADD / MANAGE COUPONS & DISCOUNTS<i class="fa fa-angle-right" style="float: right;"></i> </a> -->





              <!-- <a href="https://mail.hostinger.com/" target="blank" class="list-group-item"> WebMail Login<i class="fa fa-angle-right" style="float: right;"></i> </a>


    <a href="search-map.php" class="list-group-item"> User Search Map<i class="fa fa-angle-right" style="float: right;"></i> </a>


    

    <a href="popular-searches.php" class="list-group-item"> MANAGE POPULAR SEARCHES<i class="fa fa-angle-right" style="float: right;"></i> </a>

    <a href="default-pincode.php" class="list-group-item"> MANAGE DEFAULT PINCODES<i class="fa fa-angle-right" style="float: right;"></i> </a> -->






            </div>











          </div>



        </div>

      </div>











      <div class="col-md-8">







        <div class="jumbotron">







          <h1>Dashboard</h1>

          <p>Welcome <?php echo $_SESSION['name']; ?> <br>This is the admin section of Website / Application. <br> You can Manage Your Backend Here.<br> Version 2.0</b></p>



          <!-- cards -->
          <div class="row df">
            <?php if ($_SESSION['role_id'] == '1' || $_SESSION['role_id'] == '3' || $_SESSION['role_id'] == '2') { ?>
              <div class="no-pad" style="background-color: rgb(3,169,245);">
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
                </div>
              </div>
            <?php } ?>

            <?php if ($_SESSION['role_id'] == '1') { ?>
              <div class="no-pad" style="background-color: rgb(110,195,110);">
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
              </div>
            <?php } ?>

            <?php if ($_SESSION['role_id'] == '2') { ?>
              <div class="no-pad" style="background-color: rgb(40,150,136);">
                <div class="widget bg-inverse">
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
              </div>
            <?php } ?>


            <?php if ($_SESSION['role_id'] == '3') { ?>
              <div class="no-pad" style="background-color: rgb(42,180,180);">
                <div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    Pending Orders
                    <h2 class="bold" style="font-weight: 600;"><?php echo $ALL_PENDINGORDERS; ?></h2>
                  </div>
                </div>

              </div>
            <?php } ?>


          </div>

          <div class="row df" style="margin-top: 20px;">
            <?php if ($_SESSION['role_id'] == '1') { ?>
              <div class="no-pad" style="background-color: rgb(40,150,136);">
                <div class="widget bg-inverse">
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
              </div>
            <?php } ?>


            <?php if ($_SESSION['role_id'] == '1') { ?>
              <div class="no-pad" style="background-color: rgb(42,180,180);">
                <div class="widget bg-inverse">
                  <div class="widget-icon widget-icon-top bg-inverse-light" style="border-bottom: 2px solid;padding-bottom: 10px;">
                    <i class="fa fa-shopping-bag r-mar-10" style="font-size: 50px;"></i>
                  </div>
                  <div class="widget-progress">
                    <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                  </div>
                  <div class="widget-content to-center" style="padding-top: 10px;font-size: 20px;">
                    Pending Orders
                    <h2 class="bold" style="font-weight: 600;"><?php echo $ALL_PENDINGORDERS; ?></h2>
                  </div>
                </div>

              </div>
            <?php } ?>
            <!-- <div class="col-md-6"></div>
            <div class="col-md-6"></div> -->
          </div>

          <!-- end cards -->





          <!-- <p><a href="new-project.php" style="border-radius: 4px;" class="btn btn-info btn-lg"><i class="fa fa-plus"></i> Lets add a project</a></p> -->



        </div>







      </div>







    </div>







  </div>







</body>







</html>