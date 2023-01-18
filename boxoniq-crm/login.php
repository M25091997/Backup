<?php include('head-meta.php'); ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Login</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>Login</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="">
        <div class="container">
            <div class="row">


<div class="alert alert-danger error-box error-box-invalid" style="display:none;">

<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

  <strong>Sorry!</strong> Invalid Username or Password.

</div>



<div class="alert alert-danger error-box error-box-account" style="display:none;">

<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

  <strong>Sorry!</strong> No Such Users Found.

</div>



<div class="panel" style="border-color: #cccccc !important; width: 70%;">

          <div class="panel-heading" style="border-color: #cccccc; background-color: none !important;">

          <h3 class="panel-title" style="color:#aaaaaa; font-size: 12px;"><strong>Log in</strong></h3>

</div>

 <div class="panel-body">

 <form action="<?php echo $site_url; ?>/make-login.php" class="login-form">

 <div class="row">

   <div class="col-md-3" style="line-height: 2;"><b>Email / Username <sup style="color: red; font-size: 8px;">*</sup></b></div>

   <div class="col-md-9 text-left"><input type="email" class="form-control email" name="email" placeholder="Email / Username" required/></div>

 </div>

 <br>

 <div class="row">

   <div class="col-md-3" style="line-height: 2;"><b>Password <sup style="color: red; font-size: 8px;">*</sup></b></div>

   <div class="col-md-9 text-left"><input type="password" class="form-control" name="password" minlength="8" placeholder="password" required/></div>

 </div>

 <br>

 <div class="row">

 <div class="col-md-3" style="line-height: 2;"></div>

   <div class="col-md-9 text-left"><button type="submit" class="btn btn-primary btn-lg log-in-btn" style="font-size: 20px;"><b>Log in</b></button></div>



   

 </div>

 </form>

 </div>

  <div class="panel-heading" style="border-color: #cccccc; background-color: none !important;">

          <h3 class="panel-title" style="color:#aaaaaa; font-size: 12px;"><strong><a href="register" class="btn btn-xs c-btn"> Create Account</a><a href="changePassword" class="btn btn-xs c-btn"> Forgot Password?</a></strong></h3>

<style type="text/css">
  .c-btn:hover{
    color: #000 !important;
  }
</style>

</div> 



 

</div>


            </div>
        </div>
    </section>
    <!-- Footer Section Begin -->
    <?php include('footer.php'); ?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>

</html>