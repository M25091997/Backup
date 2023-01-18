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

      .img-serve {
        background-color: #f9f9f9;
        height: 80px;
        width: 80px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }

      .pro_card {
        -webkit-box-shadow: 1px 1px 5px 2px rgb(196 196 196);
        -moz-box-shadow: 1px 1px 5px 7px rgba(196, 196, 196, 1);
        background-color: #ffffff;
        padding: 7px;
        border-radius: 15px;
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
          <h2>All Orders</h2>
        </center>
      </div>
      <br>

      <div class="row">

        <table class="table table-bordered">







          <thead>







            <tr>

              <th>ID</th>

              <th> CUSTOMER NAME </th>

              <th> SHOP NAME </th>

              <th> ADDRESS </th>

              <th> DELIVERY ADDRESS </th>

              <!-- <th> EMAIL </th> -->

              <!-- <th> DELIVERY ADDRESS </th> -->

              <th> View Order </th>

              <!-- <th> ORDERED ITEMS </th> -->

              <th> AMOUNT </th>

              <th> ORDER STATUS </th>

              <!-- <th> REDEEMED COINS </th> -->

              <th> PAYMENT DETAILS </th>

              <!-- <th> PAYMENT STATUS </th>

          <th> ONLINE TRXN. ID </th> -->

              <th> DATE / TIME </th>
              <th> ASSIGN DELIVERY </th>
              <th> DELIVERY BOY </th>

              <th> ACTION </th>


            </tr>

          </thead>

          <tbody>

            <?php $cQ = $conn->query("SELECT * FROM bookings ORDER BY id DESC ");

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
              $assign_delivery = $rowD['assign_delivery'];
              $get_del = $conn->query("SELECT * FROM delivery_boy WHERE id = '$StatusId' ");
              $del_name = mysqli_fetch_assoc($get_del)['name'];


              $coin = 0;
              $coin_earnedIn = 0;
              $amt = 0;

              $delivery_sql = "SELECT * FROM saved_address WHERE account_id = '$account_id' order by id DESC limit 1 ";
              $delivery_query = mysqli_query($conn, $delivery_sql);
              $delivery_count = mysqli_num_rows($delivery_query);
              if ($delivery_count > 0) {
                while ($delivery_row = mysqli_fetch_assoc($delivery_query)) {
                  $dsn = $delivery_row['shop_name'];
                  $dfa = $delivery_row['full_address'];
                  $dm = $delivery_row['mobile'];
                  $dtrn = $delivery_row['transport'];
                }
              }



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

                $address = $sD['full_address'];
                $landmark = $sD['landmark'];
                $pincode = $sD['pincode'];
                $shop_name = $sD['shop_name'];

                // echo "<pre>";
                // print_r($sD);
                // echo "<pre>";
              }


            ?>

              <tr>

                <td>#<?php echo $order_id; ?></td>

                <td> <?php echo $account_name; ?> <br> <a href="<?php echo $site_url; ?>/billing-desk/?id=<?php echo $order_id; ?>" target="_blank">View Bill <i class="fa fa-long-arrow-right" aria-hidden="true"></i><br>OrderID: <?php echo $process_id ?></a>
                </td>

                <td><?php echo $shop_name; ?></td>

                <td>
                  Mobile: <?php echo $account_phone; ?> <br> Address: <?php echo $address; ?>
                  <br>Landmark: <?php echo $landmark ?> <br>Pincode: <?php echo $pincode; ?>
                </td>

                <td>
                  Shop Name: <?php echo $dsn; ?> <br> Address: <?php echo $dfa; ?>
                  <br>Mobile: <?php echo $dm ?> <br>Transport: <?php echo $dtrn; ?>
                  <div>
                    <i class="fa fa-pencil view_astro_detail" data-toggle="modal" customer_id="<?php echo $account_id ?>" data-target="#astro-modal-detail" aria-hidden="true"></i>
                  </div>
                </td>

                <!-- <td>  <?php echo $account_phone; ?>  </td> -->

                <!-- <td> <?php echo $account_email; ?> </td> -->

                <!-- <td> <?php echo $address; ?> <br> <b>Landmark: <?php echo $landmark ?> <br> <?php echo $pincode; ?> </b> </td> -->

                <td> <a target="_empty" href="customer-order.php?account_id=<?php echo $account_id ?>&process_id=<?php echo $process_id ?>">View Order</a> </td>

                <!-- <td>

          <?php

              $item_list_x = "";

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
                  }



                  $aQssssss = $conn->query("SELECT * FROM items WHERE id = '$product_id'");
                  while ($sD = mysqli_fetch_array($aQssssss)) {
                    $product_name = $sD['name'];
                    $media_number = $sD['media_number'];
                  }

                  $aQssdsfs = $conn->query("SELECT * FROM media WHERE media_number = '$media_number'");
                  while ($sD = mysqli_fetch_array($aQssdsfs)) {
                    $pro_img = $site_url . "/media/" . $sD['file_name'];
                  }
                }
          ?>
            <div class="pro_card" style="padding:20px;">
              <span>ID: <?php echo $product_id ?></span>

        <center><div class="img-serve" style="background-image: url('<?php echo $pro_img ?>');"></div></center>
        <hr>

        <?php

                echo substr($product_name, 0, 10) . " - " . substr($attr, 0, 10) . " <b>x" . $quantity . "</b> (" . $xamount . ")<br></div> <hr> "; ?> 

      <?php  }  ?>

        

          </td> -->

                <td> Rs. <?php echo $amount; ?> </td>

                <td> <?php echo $status_name; ?> </td>

                <!-- <td>Coins Redeemed: <?php echo $coin; ?> <hr> Amount Redeemed: Rs <?php echo $amt; ?><hr>Coins Earned: <?php echo $coin_earnedIn; ?>
           </td> -->


                <?php
                // Booking id
                $bid_sql = "SELECT * FROM bookings WHERE process_id = '$process_id'";
                $bid_query = mysqli_query($conn, $bid_sql);
                while ($bid_row = mysqli_fetch_assoc($bid_query)) {
                  $PAYMENTMODEID = $bid_row['payment_mode'];
                  // payment method
                  $pmethod_sql = "SELECT * FROM payment_method WHERE id = '$PAYMENTMODEID'";
                  $pmethod_query = mysqli_query($conn, $pmethod_sql);
                  while ($pmethod_row = mysqli_fetch_assoc($pmethod_query)) {
                    $PAYMENTMODENAME = $pmethod_row['name'];
                    // order bank detail
                    $oBD_sql = "SELECT * FROM order_bank_detail WHERE process_id = '$process_id'";
                    $oBD_query = mysqli_query($conn, $oBD_sql);

                    while ($bd_ = mysqli_fetch_assoc($oBD_query)) {
                      // echo "<pre>";
                      // print_r($bd_['bank_name']);

                      // $bn = $db_[0]['bank_name'];
                      // $acn = $db[0]['acc_no'];
                      // $acnm = $db[0]['acc_name'];

                      if ($PAYMENTMODENAME == "phonepe") {
                        $data = "PhonePe: " . $bd_['phonepe'];
                        // echo "<pre>";
                        // $data = "phonepe" . print_r($bd_['phonepe']);
                      } else if ($PAYMENTMODENAME == "bank") {
                        // echo "<pre>";
                        // echo $bankname . "</br>";
                        // echo $accno . "</br>";
                        // echo $accname . "</br>";
                        // echo $b = $bd_['bank_name'] . $db_['acc_no'];
                        $data = "bank";
                      } else if ($PAYMENTMODENAME == "googlepe") {
                        $data = "GooglePay: " . $bd_['googlepe'];
                        // echo "<pre>";
                        // $data = print_r($bd_) . "googlepe";
                      }
                    }
                  }
                }
                ?>



                <td>
                  <?php
                  if ($data != '') {
                    echo $data;
                  }
                  // if ($data != '') {
                  //   echo $bn . "</br>";
                  //   echo $acn . "</br>";
                  //   echo $acnm . "</br>";
                  // }
                  ?> </td>










                <!-- <td> <?php if ($payment_status == "0") { ?> 

<span style="background-color: yellow; color: #000;"> UNPAID </span>

          <?php } else { ?> 

<span style="background-color: green; color: #fff;"> PAID </span>

          <?php } ?> </td> -->

                <!-- <td> PAYMENT DETAILS </td> -->

                <td> <?php echo $creation_date; ?> at <?php echo $creation_time; ?> </td>
                <td>
                  <select class="form-control sel_del_boy" booking_id="<?php echo $order_id ?>">
                    <option>Select Delivery Boy</option>
                    <?php
                    $get_del = $conn->query("SELECT * FROM delivery_boy ORDER BY id DESC");
                    while ($row_del = mysqli_fetch_array($get_del)) {
                    ?>
                      <option value="<?php echo $row_del['id'] ?>"><?php echo $row_del['name'] ?></option>

                    <?php } ?>
                  </select>

                </td>

                <?php
                // $db =  $assign_delivery;
                $dbsql = "SELECT * FROM delivery_boy WHERE id = '$assign_delivery'";
                $dbquery = mysqli_query($conn, $dbsql);
                $dbcount = mysqli_num_rows($dbquery);
                if ($dbcount) {
                  $row = mysqli_fetch_assoc($dbquery);
                  $dbmedia_no = $row['media_number'];
                  $dbname = $row['name'];
                  if ($dbmedia_no != '') {
                    $dbimgsql = "SELECT * FROM media WHERE media_number ='$dbmedia_no'";
                    $dbimgquery = mysqli_query($conn, $dbimgsql);
                    $dbimgcount = mysqli_num_rows($dbimgquery);
                    if ($dbimgcount > 0) {
                      $dbimgrow = mysqli_fetch_assoc($dbimgquery);
                      $dbfilename = $dbimgrow['file_name'];
                    } else {
                      $dbfilename = "user_default.png";
                    }
                  } else {
                    $dbfilename = "user_default.png";
                  }
                } else {
                  $dbfilename = "user_default.png";
                }

                ?>
                <td>
                  <center>
                    <a href="../../media/<?php echo $dbfilename; ?>" target="_blank">
                      <img src="../../media/<?php echo $dbfilename; ?>" width="50" height="50" style="border-radius: 50%;">
                    </a>
                    <h6><?php echo $dbname; ?></h6>
                  </center>

                </td>

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

                        } else if ($(".x-action-<?php echo $order_id; ?>").val() == "3") {

                          // var promt = prompt("Do you want to give Gift..");
                          // alert(promt);
                          //   if(confirm("Do you want to give Gift in this order..")){
                          //     var gLabel = prompt("Enter Gift label");
                          //     if(gLabel!=null){
                          //       var gAmount = prompt("Enter gift amount");

                          //        var order_id = <?php echo $order_id; ?>;
                          //        var status_id = $(".x-action-<?php echo $order_id; ?>").val();

                          //        var order_data = {
                          //         "glabel" : gLabel,
                          //         "gamount" : gAmount,
                          //         "order_id" : order_id,
                          //         "status_id" : status_id,
                          //        };

                          //   $.ajax({
                          //     url    : "change-order-status-gift.php",
                          //     method :"POST",
                          //     data   : order_data,
                          //     success:function(data){
                          //       console.log(data);
                          //   }
                          // })

                          //     }
                          //   }

                          // else{
                          var order_id = <?php echo $order_id; ?>;
                          var status_id = $(".x-action-<?php echo $order_id; ?>").val();
                          var order_data = {
                            "order_id": order_id,
                            "status_id": status_id,
                          };

                          $.ajax({
                            url: "change-order-status-gift.php",
                            method: "POST",
                            data: order_data,
                            success: function(data) {
                              console.log(data);
                            }
                          })
                          // }

                        } else {
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
    <div id="astro-modal-detail" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">View Customer Detail</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">

            <div class="form-group">
              <div class="col-md-12 m-b-20">
                <input type="hidden" class="form-control user_edit_id" id="">
                <label style="color:black">Shop Name:</label>
                <input type="text" class="form-control user_name" id="">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12 m-b-20">
                <label style="color:black">Address:</label>
                <textarea class="form-control user_address" rows="5" id=""></textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-12 m-b-20">
                <label style="color:black">Phone:</label>
                <input type="text" class="form-control user_phone" id="">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12 m-b-20">
                <label style="color:black">Transport:</label>
                <input type="text" class="form-control user_tran" id="">
              </div>
            </div>

            <div class="form-group">
              <button id="" class="btn btn-success waves-effect waves-light m-r-10 edit_user_detail">Submit</button>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
          </div>
        </div>

      </div>

    </div>

  </body>

  </html>

<?php } ?>

<script>
  $('.sel_del_boy').on('change', function() {
    // alert('hi');
    var status = $(this).val();
    var book_id = $(this).attr('booking_id');
    // alert(status);
    // alert(book_id);
    // return;

    if (status != '') {
      $.ajax({
        type: 'POST',
        url: 'action/update_booking_delivery.php',
        data: {
          updateDelBookStatus: 1,
          BookingId: book_id,
          StatusId: status
        },
        success: function(data) {
          let dd = JSON.parse(data);
          if (dd.response == 1) {
            alert('Successfully Added Delivery Boy');
            window.location.reload();
          }
        }
      });
    }
  });


  $(".view_astro_detail").click(function() {
    var customer_id = $(this).attr('customer_id');
    // alert(customer_id);
    // return;
    $.ajax({
      url: "action/get_modal_data.php",
      method: "POST",
      data: {
        fetchDeliveryDetail: 1,
        customer_id: customer_id
      },
      dataType: "json",
      success: function(data) {
        $('.user_edit_id').val(data.id);
        $('.user_name').val(data.shop_name);
        $('.user_address').val(data.full_address);
        $('.user_landmark').val(data.landmark);
        $('.user_shop').val(data.transport);
      }
    });
  });


  $(".edit_user_detail").click(function() {

    var user_id = $('.user_edit_id').val();
    var user_name = $('.user_name').val();
    var user_address = $('.user_address').val();
    var user_phone = $('.user_phone').val();
    var user_shop = $('.user_shop').val();
    var user_tran = $('.user_tran').val();

    // return;
    $.ajax({
      url: "action/update-address-data.php",
      method: "POST",
      data: {
        updateDeliveryData: 1,
        user_id: user_id,
        user_name: user_name,
        user_address: user_address,
        user_phone: user_phone,
        user_shop: user_shop,
        user_tran: user_tran
      },
      dataType: "json",
      success: function(data) {
        alert("Successfully updated details");
        location.reload();
        // console.log(data);
        //  let dd = JSON.parse(data);
        // //  console.log(dd.response);
        //  if(dd.response == 1){
        //      alert("Successfully updated details")
        //  }else{
        //      alert('Something went wrong');
        //  }
      }
    });
  });
</script>