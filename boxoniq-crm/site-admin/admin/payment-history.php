<?php 

session_start();

include ("../../config.php");

include ("../../variables.php");



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

  <title>Online Payment History</title>

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





</script>



<style type="text/css">

  body{

    background-color: #efefef;

  }

</style>


<!-- Floating Button -->


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

<!-- Floating Button ENDS-->

</head>
<body style="background-color: #fff;">
<!-- Code begins here -->

<a href="index.php" class="float">
<i class="fa fa-home my-float"></i>
</a>

<!-- Code ENDS here -->
<div class="container-fluid" style="background-color: #fff;">

  <div class="row"><center><h2>Online Payment History</h2></center></div>

  <div class="row">

    <table class="table table-bordered">







      <thead>







        <tr>
          <th>Sl.No</th>

          <th>PROCESS ID</th>

          <th> TRANSACTION ID </th>

          <th>AMOUNT</th>

          <th> PAYMENT DATE </th>

          <th> PAYMENT TIME </th>

        </tr>

      </thead>

      <tbody>

        <?php $cQ = $conn -> query("SELECT * FROM payment_history ORDER BY id DESC "); 

        $i = 1;

        while ($rowD = mysqli_fetch_array($cQ)) { 
          $process_id = $rowD['process_id'];

          $get_amount = $conn -> query("SELECT * FROM bookings WHERE process_id = '$process_id'");
          $amount = mysqli_fetch_assoc($get_amount)['amount'];
          
          ?>

          <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $rowD['process_id']; ?>
          <a class="btn btn-primary" target="_blank" href="single-order.php?order_id=<?php echo $rowD['process_id'] ?>">View Order</a>
        </td>
          <td><?php echo $rowD['transaction_id']; ?></td>
          <td>Rs. <?php echo $amount ?></td>
          <td><?php echo $rowD['date_creation']; ?></td>
          <td><?php echo $rowD['time_creation']; ?></td>


        </tr>
        

        <?php $i++; } ?>


      </tbody>

</table>



  </div>

</div>

</body>

</html>

<?php } ?>