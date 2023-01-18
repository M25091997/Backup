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
				<input type="hidden" name="media-number" class="media_number_1" value="<?php echo time().rand(); ?>">
				<input type="text" name="coupon-code" class="form-control" placeholder="Coupon Code" required />
				



				<hr>
				<input type="text" name="max" class="form-control" placeholder="Max. No. of coupons to be used." required/>

				<hr>
				

				<input type="text" name="start-date" id="datepicker" class="form-control" placeholder="Coupon Start Date" required/>

				<hr>

				<input type="text" name="end-date" id="datepicker-" class="form-control" placeholder="Coupon End Date" required/>


				<hr>
				<select class="form-control" name="flag" class="flag">
					<option>DISCOUNT TYPE</option>
					<option value="FLAT">FLAT</option>
					<option value="PERCENT">PERCENT</option>
				</select>


				<hr>
				<input type="text" name="amount" class="form-control amount" placeholder="Discount Value" required />


				<select class="form-control" name="cond" class="cond">
					<option>SELECT CONDITION</option>
					<option value="G">GREATER THAN</option>
					<option value="G_E">GREATER THAN EQUALS</option>
					<option value="L">LESS THAN</option>
					<option value="L_E">LESS THAN EQUALS</option>
					<option value="E">EQUALS</option>
				</select>

				<hr>

				<select class="form-control" name="type" class="type">
					<option>SELECT TYPE</option>
					<option value="NORMAL">NORMAL</option>
					<option value="SECOND_ORDER">SECOND ORDER</option>
				</select>

				<hr>


				<textarea class="form-control" name="text" placeholder="Coupon Text [Ex: Get 10% Discount on Silver Plan before 25th may. ]"></textarea>

				<hr>

				<input type="text" name="cond_amount" class="form-control" placeholder="Condition Amount" />
				<hr>

				<button type="submit" class="btn btn-primary submit-btn" disabled>Generate Coupon</button>


			</form>
<br>

			<form action="parse-coupon-image.php" class="dropzone dropzone-af col-md-12" style="background-color:#fff; border: none; border: 1px dashed #ccc; border-radius: 10px; width: 65%; position: relative; left: 15%;">

<input type="hidden" value="0" class="media_number_2" name="media-number"></input>

</form> 
</center>
<script type="text/javascript">

  $(".dropzone-af").dropzone({

    
    addRemoveLinks: true,
    maxFiles: 1,

    dictDefaultMessage: '<img src="../../kartload-for-drivers/drop.png" style="width: 23%;"></img> <br><br> Drag And Drop Or Click here to upload Coupon Thumbnail [1024*512px]',

    acceptedFiles: 'image/*',

    init: function() {

    this.on('success', function( file, resp ){

      $(".submit-btn").prop('disabled', false);

    });

  },    

})

</script>


		</div>



		<div class="col-md-10">
			<h2>All Coupons</h2>

			<table class="table table-bordered">
				
				<thead>
					<tr>
						<th>COUPON CODE</th>
						<th>COUPON VALUE</th>
						<th>TYPE</th>
						
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







<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>






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

 $(document).ready(function(){
 	$(".media_number_2").val($(".media_number_1").val());
 });

</script>

<?php } ?>