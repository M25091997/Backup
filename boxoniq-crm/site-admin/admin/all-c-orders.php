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

  <title>ALL COMPLETED ORDERS</title>

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

  <div class="row"><center><h2>All Orders</h2></center></div>

  <div class="row">

    <table class="table table-bordered">







      <thead>







        <tr>

          <th>ID</th>

          <th> CUSTOMER NAME </th>

          <th> MOBILE NUMBER </th>

          <th> EMAIL </th>

          <th> DELIVERY ADDRESS </th>

          <th> PINCODE </th>

          <th> ORDERED ITEMS </th>

          <th> AMOUNT </th>

          <th> ORDER STATUS </th>

          

          <th> PAYMENT MODE </th>

          <th> PAYMENT STATUS </th>

          <th> ONLINE TRXN. ID </th>

          <th> DATE / TIME </th>
          <th> ACTION </th>


        </tr>







      </thead>





      <tbody>

        <?php $cQ = $conn -> query("SELECT * FROM bookings WHERE order_status = '4' ORDER BY id DESC "); 

        while ($rowD = mysqli_fetch_array($cQ)) {
          $order_id = $rowD['id'];
          $account_id = $rowD['account_id'];
          $order_date = $rowD['creation_date'];
          $order_time = $rowD['creation_time']; 

          $status_id = $rowD['order_status']; 
          $amount = $rowD['amount']; 
          $payment_mode_id = $rowD['payment_mode']; 
          $TRANSACTION_ID = $rowD['TRANSACTION_ID']; 
          $creation_date = $rowD['creation_date']; 
          $creation_time = $rowD['creation_time'];
          $process_id = $rowD['process_id'];

          


          $sQ = $conn -> query("SELECT * FROM status_id WHERE id = '$status_id'");
          while ($sD = mysqli_fetch_array($sQ)) {
            $status_name = $sD['name'];
            
          }

          if ($status_id == 0 ) { $status_name = "New Order"; }


          $pQ = $conn -> query("SELECT * FROM payment_method WHERE id = '$payment_mode_id'");
          while ($sD = mysqli_fetch_array($pQ)) {
            $payment_mode_name = $sD['name'];
          }


          $pQ_ = $conn -> query("SELECT * FROM payment_history WHERE process_id = '$process_id'");
          while ($sD_ = mysqli_fetch_array($pQ_)) {
            $TRANSACTION_ID = $sD_['transaction_id'];
          }


          $aQ = $conn -> query("SELECT * FROM accounts WHERE id = '$account_id'");
          while ($sD = mysqli_fetch_array($aQ)) {
            $account_name = $sD['name'];
            $account_email = $sD['email'];
            $account_phone = $sD['phone'];

          $address = $sD['full_address'];
          $landmark = $sD['landmark'];
          $pincode = $sD['pincode'];

          }


          ?>

          <tr>
     
          <td><?php echo $order_id; ?></td>

          <td> <?php echo $account_name; ?> </td>

          <td> <?php echo $account_phone; ?> </td>

          <td> <?php echo $account_email; ?> </td>

          <td> <?php echo $address; ?> <br> <b>Landmark: <?php echo $landmark ?></b> </td>

          <td> <?php echo $pincode; ?> </td>

          <td>

          <?php 


                    //ORDERED ITEMS

          $item_list_x = "";

          $aQzz = $conn -> query("SELECT * FROM orders WHERE process_id = '$process_id'");
          while ($sD = mysqli_fetch_array($aQzz)) {
            $cart_id = $sD['cart_id'];

            $aQz = $conn -> query("SELECT * FROM cart WHERE id = '$cart_id'");
          while ($sD = mysqli_fetch_array($aQz)) {
            $product_id = $sD['item_id'];
            $attribute_id = $sD['attribute_id'];
            $quantity = $sD['quantity'];
            $xamount = $sD['total_amount'];



          $aQss = $conn -> query("SELECT * FROM attributes WHERE id = '$attribute_id'");
          while ($sD = mysqli_fetch_array($aQss)) {
            $attr = $sD['name'];

          }



             $aQssssss = $conn -> query("SELECT * FROM items WHERE id = '$product_id'");
          while ($sD = mysqli_fetch_array($aQssssss)) {
            $product_name = $sD['name'];

          }

        } 

          echo $product_name." - ".$attr." <b>x".$quantity."</b> (".$xamount.")<br> <hr> "; ?> 

      <?php  }  ?>

          </td>

          <td> Rs. <?php echo $amount; ?> </td>

          <td> <?php echo $status_name; ?> </td>

          <td> <?php echo $payment_mode_name; ?> </td>

          <td> <span style="background-color: green; color: #fff;"> PAID </span> </td>

          <td> <?php echo $TRANSACTION_ID; ?> </td>

          <td> <?php echo $creation_date; ?> at <?php echo $creation_time ; ?> </td>

          <td>
            <select class="x-action-<?php  echo $order_id; ?>">
          <?php 

          $sQ = $conn -> query("SELECT * FROM status_id ");
          while ($sD = mysqli_fetch_array($sQ)) {
            if( $sD['id'] == $status_id ){ $s = "selected"; }else{ $s = "unselected"; }
            ?> <option value="<?php echo $sD['id']; ?>" <?php echo $s; ?>><?php echo $sD['name']; ?></option> <?php } ?>
            </select>

          <script type="text/javascript">
            $(".x-action-<?php  echo $order_id; ?>").change(function(){
              if (confirm("Change Order Status?")) { window.location.href="change-order-status.php?order-id=<?php echo $order_id; ?>&status-id="+$(".x-action-<?php  echo $order_id; ?>").val(); }
            });
          </script>


          </td>

        </tr>

        <?php } ?>


      </tbody>

</table>



  </div>

</div>

</body>

</html>

<?php } ?>