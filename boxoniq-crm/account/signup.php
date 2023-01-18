<?php include("../config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Create Account :: CityIndia</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

<style type="text/css">
	@media (min-width:320px)  { /* smartphones, portrait iPhone, portrait 480x320 phones (Android) */ 

		.wrap-login100{ padding:none; }

	}

@media (min-width:480px)  { /* smartphones, Android phones, landscape iPhone */ 

	.wrap-login100{ padding:none; }

}


@media (min-width:600px)  { /* portrait tablets, portrait iPad, e-readers (Nook/Kindle), landscape 800x480 phones (Android) */ 
.wrap-login100{ padding:none; }

}


@media (min-width:801px)  { /* tablet, landscape iPad, lo-res laptops ands desktops */ 

.wrap-login100{ padding: 92px 130px 33px 95px; }


}


@media (min-width:1025px) { /* big landscape tablets, laptops, and desktops */

.wrap-login100{ padding: 92px 130px 33px 95px; }

 }


@media (min-width:1281px) { /* hi-res laptops and desktops */ 

.wrap-login100{ padding: 92px 130px 33px 95px; }

}
</style>

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/signup-bg.png" alt="IMG">
				</div>

				<form class="login100-form validate-form signup-form" method="POST" action="<?php echo $site_url; ?>/api/save-account.php">
					<span class="login100-form-title">
						Create Account
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Full Name">
						<input class="input100" type="text" name="name" placeholder="Full Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid Phone Number is: 8935822952">
						<input class="input100" type="text" name="phone" maxlength="10" minlength="10" placeholder="Mobile Number">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-mobile" aria-hidden="true"></i>
						</span>
					</div>



					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Signup
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="<?php echo $site_url; ?>/account/login">
							Already registered? Login
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>


			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>

	<script src="liveform.js"></script>

	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	

</body>
</html>

<script type="text/javascript">
	  $('.signup-form').ajaxForm({

  beforeSend: function(xhr, opts) {  },

  uploadProgress: function(event, position, total, percentComplete) {      },

  success: function(login_json) {

  	login_json = jQuery.parseJSON(login_json); /*Converting String to Json Data*/

   jQuery(login_json).each(function(i, object){

  	if (object.response == "1") { window.location.href="otp-verification.php"; }
  	else if (object.response == "333") { alert("Sorry an account with this number or email already exists!"); }
  	else { console.log( object.response ); }

  });


  },

  complete: function(xhr) {   }

 });


</script>