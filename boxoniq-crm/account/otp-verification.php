<?php include("../config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Account Verfication :: <?php echo $the_project; ?></title>
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
	
		<div class="limiter limiter-otp">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/signup-bg.png" alt="IMG">
				</div>

				<form class="login100-form validate-form otp-form" action="<?php echo $site_url; ?>/api/verify-otp.php">
					<span class="login100-form-title">
						Mobile Verification
					</span>
					<span>Enter the OTP we've sent to you number</span>
					<div class="wrap-input100 validate-input" data-validate = "OTP Verification">
						
						<input class="input100" type="text" name="otp-v" placeholder="Enter OTP">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-mobile" style="" aria-hidden="true"></i>
						</span>						

					</div>

<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Verify Account
						</button>
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
	  $('.otp-form').ajaxForm({

  beforeSend: function(xhr, opts) { },

  uploadProgress: function(event, position, total, percentComplete) {      },

  success: function(login_json) {

  	login_json = jQuery.parseJSON(login_json); /*Converting String to Json Data*/

   jQuery(login_json).each(function(i, object){

  	if (object.response == "1") { window.location.href="../cart"; }
  	else if (object.response == "333") { alert("Sorry an account with this number or email already exists!"); }
  	else { console.log( object.response ); }

  });


  },

  complete: function(xhr) {   }

 });


</script>