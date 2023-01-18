<?php session_start(); ?>
<?php include("../config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Orders :: CityIndia</title>
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

  <link rel="stylesheet" type="text/css" href="https://esabbji.com/assets/css/PreloaderAnimation.css">

  
<!--===============================================================================================-->


  
<!--===============================================================================================-->  
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->


</head>
<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100" style="padding: 92px 130px 33px 95px ;">
        <div class="login100-pic js-tilt" data-tilt>
          <img src="images/myaccount.png" alt="IMG">
        </div>

        <form class="login100-form validate-form">
          <span class="login100-form-title">
            My Orders
          </span>

<br>
<div class="row">
      <div class="" style="margin-left: 19%;
    width: 85%;
    margin-top: -25%;">
        <center>

<br> 
          <ul class="list-group">

<?php


if (isset($_SESSION['account-id'])) {

  $account_id = $_SESSION['account-id'];

    $msg_query = $conn -> query("SELECT * FROM bookings WHERE account_id = '$account_id' AND order_status != '5' ");  
            while ($msg_q = mysqli_fetch_array($msg_query)) {

              $process_id = $msg_q['process_id'];
              $creation_time = $msg_q['creation_time'];
              $creation_date = $msg_q['creation_date'];
              $order_status = $msg_q['order_status'];
              $amount = $msg_q['amount'];
              $booking_id = $msg_q['id'];
              $process_id = $msg_q['process_id'];

              $sQ = $conn -> query("SELECT * FROM status_id WHERE id = '$order_status'");
              while ($SData = mysqli_fetch_array($sQ)) {
                $status = $SData['name'];
              }

              if ( $order_status == 0 ) { $status = "Processing";  } ?>

<li class="list-group-item d-flex justify-content-between align-items-center">
    <a href="<?php echo $site_url; ?>/billing-desk/?id=<?php echo $booking_id; ?>" target="_blank"> ORDER ID: <u>#<?php echo $booking_id; ?></u> | STATUS: <?php echo $status; ?> | <b> <i class="fa fa-inr"></i> <?php echo $amount; ?></b>  </a>

<button type="button" class="cn-<?php echo $booking_id; ?> btn btn-primary btn-xs" >Cancel Order</button>

    <script type="text/javascript">
            $(".cn-<?php echo $booking_id; ?>").click(function(){  

                var promt = prompt("Are you sure you want to cancel this order? if yes Enter reason for cancelling this order");
                if ( promt != null ) { 
                  window.location.href="<?php echo $site_url; ?>/site-admin/admin/cancel-order.php?order-id=<?php echo $booking_id; ?>&reason="+promt+'&by=CUSTOMER';
                }

            });
    </script>
  
</li>

            <?php }

} else { header("Location: ".$site_url."/account/login"); }


?>

</ul>

        </center>

      </div>


    </div>

        </form>
      </div>
    </div>
  </div>
  
  


  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/tilt/tilt.jquery.min.js"></script>
  <script >
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>
<!--===============================================================================================-->
  <script src="js/main.js"></script>

</body>
</html>

<!-- <script type="text/javascript">
  /*Loading Account Data*/

  var site_url = "<?php echo $site_url; ?>";

var dataString = "";

$.ajax({ /*ACCOUNT AJAX */ type: "POST", url: '<?php echo $site_url; ?>/api/load-account.php', dataType: 'json', data: dataString, success: function(account_json) { 


jQuery(account_json).each(function(i, object){ 

if ( object.response != "666" ) {
$(".account-container").html("");

$(".account-container").html("<center><div class='' style='margin-top: -1%; height: 100px; border-radius: 50%; /* background-color: #ccc; */ width: 100px;'><img style='width: 100%;' src='" + site_url + "/account/gravator.png' class='img-circle'></div>  <div class='holder-cup'> <div class='' style='margin-top: 5%; width: 68%; height: 15px;'> " + object.name + " </div>  <div class='' style='margin-top: 3%; width: 80%; height: 30px;'><i class='fa fa-envelope' aria-hidden='true'></i> " + object.email + " </div> <div class='' style='width: 68%; margin-top:6%; height: 50px; font-size: 24px;'><i class='fa fa-mobile' aria-hidden='true'></i> " + object.phone + "</div> <div class='' style='width: 68%; height: 50px;'>" + object.orders + " Orders Till Now</div> <div class='' style='width: 68%; height: 50px;'><a href='#alert' class='btn btn-primary' style='background-color: #000; width: 100%;'>My Orders <i class='fa fa-list' aria-hidden='true'></i></a> <hr> <a href='" + site_url + "/logout.php' class='btn btn-primary' style='background-color: red; width: 100%;'>Logout <i class='fa fa-sign-out' aria-hidden='true'></i></a> </div> </div> </center>");

} else { window.location.href= site_url + "/login"; }

}) }, complete: function(){  




}

/*ACCOUNT AJAX ENDS*/ });
</script> -->