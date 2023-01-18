<?php 

session_start();

include ("../../config.php");



if (!isset($_SESSION['username']) && !isset($_SESSION['name'])) {

	?>

	<script type="text/javascript">

		window.location.href="index.php";

	</script>

	<?php

}

else{

?>

<!DOCTYPE html>

<html>

<head>

	<title>Manage Coupons</title>

	<!--Font-->

<link href='//fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>



<!-- JQUERY-->

<script src="//code.jquery.com/jquery-2.2.3.min.js"></script>



<!--Live Form-->

<script src="../../assets/js/liveform.js"></script>



<!--Drop Zone-->

<script src="../../assets/js/dropzone.js"></script>

<link rel="stylesheet" href="../../assets/css/dropzone.css">



<!--Latest compiled and minified CSS-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css" crossorigin="anonymous">



<!--Latest compiled and minified JavaScript-->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>



<!--FONT AWESOME-->

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">



<!--VIEWPORT-->

<meta name="viewport" content="width=device-width, initial-scale=1">



<!--TINE MCE-->

<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5v5kn3p7q2v385g8mya78lovcvcm4okduo2x1wb1m1q92plc'></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style type="text/css">

	body{

		background-color: #fff;

	}

</style>

<style type="text/css">
  .float{
  position:fixed;
  width:60px;
  height:60px;
  bottom:40px;
  right:40px;
  background-color:#000;
  color:#FFF;
  border-radius:50px;
  text-align:center;
  box-shadow: 2px 2px 3px #999;
  z-index: 9999;
}

.my-float{
  margin-top:22px;
}
</style>

</head>

<body style="background-color: #fff;">


<a href="index.php" class="float">
<i class="fa fa-home my-float"></i>
</a>

	<?php $Qc = $conn -> query("SELECT * FROM account_mode ORDER BY id DESC");
					while ($D = mysqli_fetch_array($Qc)) { ?> <input type="hidden" name="h<?php echo $D['name']; ?>" value="<?php echo $D['amount'] ?>">  <?php } ?>

<div class="container-fluid">



	<div class="row">

		<div class="col-md-2" style="border-right: 1px solid #ccc;">
			<h2>Create New Coupon</h2>
			<form class="coupon-form" method="POST" action="save-coupon.php">
				<input type="text" name="coupon-code" class="form-control" placeholder="Coupon Code" required />
				


				<hr>

				<select class="form-control" name="plan">
					<option>SELECT PLAN</option>
					<option value="2">SILVER</option>
					<option value="3">GOLD</option>
					<option value="4">DIAMOND</option>
					<option value="5">PLATINUM</option>
				</select>



				<hr>
				<input type="text" name="max" class="form-control" placeholder="Max. No. of coupons to be used." required/>

				<hr>
				

				<input type="text" name="start-date" id="datepicker" class="form-control" placeholder="Coupon Start Date" required/>

				<hr>

				<input type="text" name="end-date" id="datepicker-" class="form-control" placeholder="Coupon End Date" required/>


				<hr>
				<select class="form-control" name="flag" class="flag">
					<option>DISCOUNT TYPE</option>
					<option value="FLAT">FlAT</option>
					<option value="PERCENT">PERCENT</option>
				</select>


				<hr>
				<input type="text" name="amount" class="form-control amount" placeholder="Discount Value" required />


				<input type="hidden" value="E"  name="cond">

				<hr>


				<textarea class="form-control" name="text" placeholder="Coupon Text [Ex: Get 10% Discount on Silver Plan before 25th may. ]"></textarea>

				<hr>

				<input type="hidden" name="cond_amount" class="form-control" value="0" />
				<hr>

				<button type="submit" class="btn btn-primary">Generate Coupon</button>


			</form>
		</div>



		<div class="col-md-10">
			<h2>All Coupons</h2>

			<table class="table table-bordered">
				
				<thead>
					<tr>
						<th>COUPON CODE</th>
						<th>COUPON VALUE</th>
						<th>TYPE</th>
						<th>PLAN</th>
						<th>MAX USABLE</th>
						<th>USED</th>
						<th>VALID THRU</th>
						<th>COUPON TEXT</th>
						<th>DEACTIVATE / DELETE</th>
					</tr>
				</thead>

				<tbody>

				<?php 

					$Qc = $conn -> query("SELECT * FROM coupon ORDER BY id DESC");
					while ($D = mysqli_fetch_array($Qc)) { ?>
					<tr>
						<td><?php echo $D['code']; ?></td>
						<td><?php echo $D['amount']; ?></td>
						<td><?php echo $D['flag']; ?></td>

						<td><?php $plan_id = $D['plan']; 

						$pQ = $conn -> query("SELECT * FROM account_mode WHERE id = '$plan_id'");
						while ($pD = mysqli_fetch_array($pQ)) {
							echo "<span style='background-color:green; color: white;'>".$p_name = $pD['name']."</span>";
						}

						?>
							


						</td>
						<td><?php echo $D['max']; ?></td>
						<td><?php echo $D['max_used']; ?></td>

						<td><?php echo $D['start_date']." - ".$D['date_']; ?></td>
					

						<td><?php echo $D['text_']; ?></td>

						<td><a href="delete-coupon.php?id=<?php echo $D['id']; ?>"><i class="fa fa-trash"></i></a></td>
					</tr>

				<?php } ?>
				</tbody>

			</table>

		</div>



	</div>
</div>


</body>

</html>






    <?php footer($site_url); ?>






       <script type="text/javascript">
                       $( function() {

    // Get today's date
    var today = new Date();

    $("#datepicker").datepicker({
    //changeMonth: true,
    //changeYear: true,
    //minDate: today,
    dateFormat: "yy-mm-dd",
    /*onSelect: function (d,o){proceed(d);}*/

    // set the minDate to the today's date
    // you can add other options here
});

});



                                              $( function() {

    // Get today's date
    var today = new Date();

    $("#datepicker-").datepicker({
    //changeMonth: true,
    //changeYear: true,
    //minDate: today,
    dateFormat: "yy-mm-dd",
    /*onSelect: function (d,o){proceed(d);}*/

    // set the minDate to the today's date
    // you can add other options here
});

});
       </script>

       <script type="text/javascript">

       	var ex = 0;


       	$(".amount").keyup(function(){


       		if ($("[name=flag]").val() == "FLAT") {
       			

       			if ($("[name=plan]").val() == "2") { ex = $("[name=hSILVER]").val(); }
       			if ($("[name=plan]").val() == "3") { ex = $("[name=hGOLD]").val(); }
       			if ($("[name=plan]").val() == "4") { ex = $("[name=hDIAMOND]").val(); }
       			if ($("[name=plan]").val() == "5") { ex = $("[name=hPLATINUM]").val(); }


       			if (parseFloat($("[name=amount]").val()) > ex) {alert("invalid Amount!"); $("[name=amount]").val(""); }
       		}else {
       			if (parseFloat($("[name=amount]").val()) > 100) {alert("invalid Amount!"); $("[name=amount]").val(""); }
       		}
       	});


       	$("[name=plan]").change(function(){

       			if ($("[name=plan]").val() == "2") { $("[name=cond_amount]").val($("[name=hSILVER]").val()); }
       			if ($("[name=plan]").val() == "3") { $("[name=cond_amount]").val($("[name=hGOLD]").val()); }
       			if ($("[name=plan]").val() == "4") { $("[name=cond_amount]").val($("[name=hDIAMOND]").val()); }
       			if ($("[name=plan]").val() == "5") { $("[name=cond_amount]").val($("[name=hPLATINUM]").val()); }
       	});

       </script>

<?php } ?>