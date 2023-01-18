<?php
session_start();
include("../../config.php");
include("../../variables.php");

if (isset($_SESSION['username']) && isset($_SESSION['name'])) {
	include("dashboard.php");
} else {
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Admin Login</title>
		<!--Font-->
		<link href='//fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>

		<!-- JQUERY-->
		<script src="//code.jquery.com/jquery-2.2.3.min.js"></script>

		<!--Live Form-->
		<script src="../../assets/js/liveform.js"></script>

		<!--Drop Zone-->
		<script src="../../assets/js/dropzone.js"></script>
		<link rel="stylesheet" href="../../assets/css/dropzone.css">

		<link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

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

	</head>

	<body>
		<div class="container">
			<div class="row"><br><br><br><br><br>
				<center>
					<div class="col-md-12">
						<div class="panel" style="border-color: #cccccc !important; width: 70%;">
							<div class="panel-heading" style="border-color: #cccccc; background-color: none !important;">
								<h3 class="panel-title" style="color:#aaaaaa; font-size: 12px;"><strong>Admin Log in</strong></h3>
							</div>
							<form class="login-form" action="admin-login.php">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-3" style="line-height: 2;"><b>Username </b></div>
										<div class="col-md-9 text-left"><input type="email" name="email" class="form-control email" placeholder="username" required /></div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-3" style="line-height: 2;"><b>Password </b></div>
										<div class="col-md-9 text-left"><input type="password" name="password" class="form-control" placeholder="password" required /></div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-3" style="line-height: 2;"></div>
										<div class="col-md-9 text-left"><button type="submit" class="btn btn-info" style="font-size: 20px; width: 100%;"><b>Log in</b></button><br><span style="color:red; display: none;" class="error">*Invalid Username Or Password!</span></div>
									</div>
								</div>
							</form>
						</div>

						<script type="text/javascript">
							$('.login-form').ajaxForm({


								beforeSend: function() {


								},

								uploadProgress: function(event, position, total, percentComplete) {


								},
								success: function(r) {



									if (r == 1) {
										location.reload();
									} else {
										$(".error").fadeIn();
										$(".email").focus();

									}

								},
								complete: function(xhr) {

								}
							});


							$(document).ready(function() {
								$(".email").focus();
							});
						</script>


					</div>
				</center>
			</div>
		</div>
	</body>

	</html>
<?php
}
?>