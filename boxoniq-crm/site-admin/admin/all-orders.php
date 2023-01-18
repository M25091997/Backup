<?php

session_start();

include("../../config.php");


if (!isset($_SESSION['username']) && !isset($_SESSION['name'])) {

?>

  <script type="text/javascript">
    window.location.href = "index.php";
  </script>

<?php

} else {

?>

  <!DOCTYPE html>

  <html>

  <head>

    <title>ALL ORDERS</title>

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
      body {

        background-color: #efefef;

      }
    </style>


    <!-- Floating Button -->


    <style type="text/css">
      .float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color: #000;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        box-shadow: 2px 2px 3px #999;
      }

      .my-float {
        margin-top: 22px;
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

      <div class="row">
        <center>
          <h2>All Orders</h2> <a target="_empty" href="export-excel/export-all-order.php" class="btn btn-success" title="Click to export"><i class="dwn"></i> Export</a>
        </center>
      </div>

      <div class="row">

        <table class="table table-bordered">







          <thead>







            <tr>

              <th>ID</th>

              <th> CUSTOMER NAME </th>

              <th> MOBILE NUMBER </th>

              <th> EMAIL </th>

              <th> DELIVERY ADDRESS </th>

              <th> STATE </th>

              <th> ORDERED ITEMS </th>

              <th>GST</th>

              <th> AMOUNT </th>

              <th> ORDER STATUS </th>

              <!-- <th> REDEEMED COINS </th> -->

              <th> PAYMENT MODE </th>

              <!-- <th> PAYMENT STATUS </th> -->

              <th> ONLINE TRXN. ID </th>

              <th> DATE / TIME </th>
              <th> ACTION </th>


            </tr>







          </thead>





          <tbody>

            <?php $cQ = $conn->query("SELECT * FROM bookings WHERE subscription = '0' ORDER BY id DESC ");

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
              $payment_status = $rowD['payment_status'];
              $address_id = $rowD['address_id'];


              $coin = 0;
              $coin_earnedIn = 0;
              $amt = 0;


              $sCoin = $conn->query("SELECT * FROM coin_wallet_history WHERE booking_id = '$order_id' && type = 'OUT' ");
              while ($sDcoin = mysqli_fetch_array($sCoin)) {
                $msg = $sDcoin['msg'];
                $amt = $sDcoin['amt'];

                $coin = strtok($msg, " ");
              }

              $sCoinIn = $conn->query("SELECT * FROM coin_wallet_history WHERE booking_id = '$order_id' && type = 'IN' ");
              while ($sDcoinIn = mysqli_fetch_array($sCoinIn)) {
                $msgIn = $sDcoinIn['msg'];
                $coin_earnedIn = strtok($msgIn, " ");
              }



              $sQ = $conn->query("SELECT * FROM status_id WHERE id = '$status_id'");
              while ($sD = mysqli_fetch_array($sQ)) {
                $status_name = $sD['name'];
              }

              if ($status_id == 0) {
                $status_name = "New Order";
              }


              $pQ = $conn->query("SELECT * FROM payment_method WHERE id = '$payment_mode_id'");
              while ($sD = mysqli_fetch_array($pQ)) {
                $payment_mode_name = $sD['name'];
              }


              $pQ_ = $conn->query("SELECT * FROM payment_history WHERE process_id = '$process_id'");
              while ($sD_ = mysqli_fetch_array($pQ_)) {
                $TRANSACTION_ID = $sD_['transaction_id'];
              }


              $aQ = $conn->query("SELECT * FROM accounts WHERE id = '$account_id'");
              while ($sD = mysqli_fetch_array($aQ)) {
                $account_name = $sD['name'];
                $account_email = $sD['email'];
                $account_phone = $sD['phone'];
              }

              $aQadd = $conn->query("SELECT * FROM saved_address WHERE id = '$address_id'");
              while ($get_add = mysqli_fetch_array($aQadd)) {
                $address = $get_add['full_address'];
                $landmark = $get_add['landmark'];
                $pincode = $get_add['pincode'];
                $state = $get_add['state'];

              }

            ?>

              <tr>

                <td>#<?php echo $order_id; ?></td>

                <td> <?php echo $account_name; ?> <br> <a href="<?php echo $site_url; ?>/billing-desk/?id=<?php echo $process_id; ?>" target="_blank">View Bill <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a> <br> BID: <?php echo "CTIND" . substr($process_id, 0, 8); ?></td>

                <td> <?php echo $account_phone; ?> </td>

                <td> <?php echo $account_email; ?> </td>

                <td> <?php echo $address; ?> <br> <b>Landmark:</b> <?php echo $landmark ?><br> <b>Pincode:</b> <?php echo $pincode ?><br>  </td>

                <td> <?php echo $state; ?> </td>

                <td>

                  <?php


                  //ORDERED ITEMS

                  $item_list_x = "";
                  $total_gst_amount = 0;

                  $aQzz = $conn->query("SELECT * FROM orders WHERE process_id = '$process_id'");
                  while ($sD = mysqli_fetch_array($aQzz)) {
                    $cart_id = $sD['cart_id'];

                    $aQz = $conn->query("SELECT * FROM cart WHERE id = '$cart_id'");
                    while ($sD = mysqli_fetch_array($aQz)) {
                      $product_id = $sD['item_id'];
                      $attribute_id = $sD['attribute_id'];
                      $quantity = $sD['quantity'];
                      $xamount = $sD['total_amount'];



                      $aQss = $conn->query("SELECT * FROM attributes WHERE id = '$attribute_id'");
                      while ($sD = mysqli_fetch_array($aQss)) {
                        $attr = $sD['name'];
                        $attr_price = $sD['price'];
                      }



                      $aQssssss = $conn->query("SELECT * FROM items WHERE id = '$product_id'");
                      while ($sD = mysqli_fetch_array($aQssssss)) {
                        $product_name = $sD['name'];
                        $gst = $sD['gst'];

                      }
                    }
                    $gst_amt = $gst/100*$attr_price;
                    $total_gst_amount = $total_gst_amount + $gst_amt;

                    echo "ID: " . $product_id . " " . $product_name . " - " . $attr . " <b>x" . $quantity . "</b> (" . $xamount . ")<br><b>GST - </b>" . $gst . "% <br><b>GST AMOUNT - </b> Rs " . $gst_amt . " <hr> "; ?>

                  <?php  }  
                  echo "<b>Total GST : </b>Rs ".$total_gst_amount."";
                                    ?>


                </td>

                <td> Rs. <?php echo $total_gst_amount; ?> </td>


                <td> Rs. <?php echo $amount; ?> </td>

                <td> <?php echo $status_name; ?> </td>

                <!-- <td>Coins Redeemed: <?php echo $coin; ?> <hr> Amount Redeemed: Rs <?php echo $amt; ?><hr>Coins Earned: <?php echo $coin_earnedIn; ?>
           </td> -->

                <td> <?php echo $payment_mode_name; ?> </td>

                <!-- <td> <?php if ($payment_status == "0") { ?>

                    <span style="background-color: yellow; color: #000;"> UNPAID </span>

                  <?php } else { ?>

                    <span style="background-color: green; color: #fff;"> PAID </span>

                  <?php } ?>
                </td> -->

                <td> <?php echo $TRANSACTION_ID; ?> </td>

                <td> <?php echo $creation_date; ?> at <?php echo $creation_time; ?> </td>

                <td>

                  <?php if ($status_id == 5) { ?>

                    <span style="color: #fff; background-color: red;">CANCELLED</span>

                  <?php } elseif ($status_id == 4) { ?>

                    <span style="color: #fff; background-color: green;">COMPLETED</span>

                  <?php } else { ?>


                    <select class="x-action-<?php echo $order_id; ?>">
                      <?php

                      $sQ = $conn->query("SELECT * FROM status_id ");
                      while ($sD = mysqli_fetch_array($sQ)) {
                        if ($sD['id'] == $status_id) {
                          $s = "selected";
                        } else {
                          $s = "unselected";
                        }
                      ?> <option value="<?php echo $sD['id']; ?>" <?php echo $s; ?>><?php echo $sD['name']; ?></option> <?php } ?>
                    </select>


                  <?php } ?>

                  <script type="text/javascript">
                    $(".x-action-<?php echo $order_id; ?>").change(function() {
                      if (confirm("Change Order Status?")) {

                        if ($(".x-action-<?php echo $order_id; ?>").val() == "5") {

                          var promt = prompt("Enter reason for cancelling this order");

                          if (promt != null) {
                            window.location.href = "cancel-order.php?order-id=<?php echo $order_id; ?>&reason=" + promt + '&by=ADMIN';
                          }

                        } 
                        // else if ($(".x-action-<?php echo $order_id; ?>").val() == "3") {

                        //     var order_id = <?php echo $order_id; ?>;
                        //        var status_id = $(".x-action-<?php echo $order_id; ?>").val();
                        //     var order_data = {
                        //         "order_id" : order_id,
                        //         "status_id" : status_id,
                        //        };

                        //         $.ajax({
                        //           url    : "change-order-status-gift.php",
                        //           method :"POST",
                        //           data   : order_data,
                        //           success:function(data){
                        //             console.log(data);
                        //              }
                        //         })

                        // } 
                        else {
                          window.location.href = "change-order-status.php?order-id=<?php echo $order_id; ?>&status-id=" + $(".x-action-<?php echo $order_id; ?>").val();
                        }

                      }
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