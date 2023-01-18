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

    // $account_id = 4;
    // $process_id = "JAYS16865132";
    $account_id = $_GET['account_id'];
    $process_id = $_GET['process_id'];

    // $select_cart = $conn -> query("SELECT * FROM cart WHERE account_id = '$account_id' ");

?>

    <!DOCTYPE html>

    <html>

    <head>

        <title>Customer ORDER</title>

        <!--Font-->

        <link href='//fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">




        <!-- JQUERY-->

        <script src="//code.jquery.com/jquery-2.2.3.min.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>




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


            /*Dropdown search for Customer*/
            .dropbtn {
                background-color: #04AA6D;
                color: #000;
                padding: 16px;
                font-size: 16px;
                border: none;
                cursor: pointer;
                background: #00ff89;
                height: 64px;
            }

            .dropbtn:hover,
            .dropbtn:focus {
                background-color: #00ff89;
                background: #00ff89;
                color: #3e3e3e !important;
            }

            #myInput {
                box-sizing: border-box;
                background-image: url('searchicon.png');
                background-position: 14px 12px;
                background-repeat: no-repeat;
                font-size: 16px;
                padding: 14px 20px 12px 45px;
                border: none;
                border-bottom: 1px solid #00ff89;
                width: 100%;
            }

            #myInput:focus {
                outline: 3px solid #00ff89;
            }

            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f6f6f6;
                min-width: 320px;
                overflow: auto;
                border: 1px solid #ddd;
                z-index: 1;
                height: 384px;
            }

            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            .dropdown a:hover {
                background-color: #00ff89;
            }

            .show {
                display: block;
            }

            .small-hint {
                font-size: 70%;
                position: absolute;
                left: 38px;
                top: 44px;
                color: #2c3a4c;
            }

            .img-serve {
                background-color: #f9f9f9;
                height: 80px;
                width: 100px;
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
        </style>


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

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <form> -->
                        <div class="dropdown" id="acc">
                            <button type="button" onclick="myFunction()" class="dropbtn btn btn-primart a-holder"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Select Item Dropdown <i class="fa fa-chevron-down" aria-hidden="true"></i></button>
                            <div id="myDropdown" class="dropdown-content">
                                <input type="text" placeholder="Search by Product name, id..." id="myInput" onkeyup="filterFunction()">


                                <?php
                                $q = $conn->query("SELECT * FROM items ORDER BY id DESC");

                                while ($row = mysqli_fetch_array($q)) {
                                    $id = $row['id'];
                                    $name = $row['name'];
                                    $phone = $row['phone'];

                                ?>

                                    <a href="javascript:(0)" class="all-a a" item-id="<?php echo $id; ?>"> <?php echo $id; ?> -
                                        <?php echo $name; ?> </a>

                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" id="add_pro_item">
                            <input type="hidden" id="acc_id" value="<?php echo $account_id ?>">
                            <input type="hidden" id="pro_id" value="<?php echo $process_id ?>">


                            <label for="exampleInputPassword1">Add Quantity</label>
                            <input type="text" class="form-control up_qty" id="exampleInputPassword1" placeholder="Add Quantity">
                        </div>

                        <button type="submit" class="btn btn-primary add_qty_order">Add</button>
                        <!-- </form> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>

        <a href="index.php" class="float">
            <i class="fa fa-home my-float"></i>
        </a>

        <!-- Code ENDS here -->
        <div class="container-fluid" style="background-color: #fff;">

            <div class="row">
                <center>
                    <h2>Customer's Order</h2> <button data-toggle="modal" data-target="#exampleModal" class="btn btn-info">Add Product <i class="fa fa-plus" aria-hidden="true"></i></button>
                </center>
            </div>
            <br>

            <div class="row">

                <table class="table table-bordered">







                    <thead>







                        <tr>

                            <th>ID</th>

                            <th> CUSTOMER DETAIL </th>

                            <th> SHOP NAME </th>

                            <!-- <th> DELIVERY ADDRESS </th> -->

                            <th> ORDER ID </th>

                            <!-- <th> AMOUNT </th> -->

                            <th> Add Payment Detail </th>

                            <!-- <th> ACTION/Bank </th> -->

                            <th> Add Delivery Detail </th>

                            <!-- <th> ORDER STATUS </th> -->

                            <!-- <th> REDEEMED COINS </th> -->

                            <!-- <th> PAYMENT MODE </th> -->

                            <!-- <th> PAYMENT STATUS </th> -->

                            <!-- <th> ONLINE TRXN. ID </th> -->

                            <th> DATE / TIME </th>
                            <th> ACTION </th>


                        </tr>


                    </thead>

                    <tbody>

                        <?php
                        // $booking_id = 1;
                        $cQ = $conn->query("SELECT * FROM bookings WHERE process_id = '$process_id' && account_id = '$account_id' ORDER BY id DESC ");

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

                            $coin = 0;
                            $coin_earnedIn = 0;
                            $amt = 0;


                            // $sCoin = $conn -> query("SELECT * FROM coin_wallet_history WHERE booking_id = '$order_id' && type = 'OUT' ");
                            // while ($sDcoin = mysqli_fetch_array($sCoin)) {
                            //   $msg = $sDcoin['msg'];
                            //   $amt = $sDcoin['amt'];

                            //   $coin = strtok($msg, " ");

                            // }

                            // $sCoinIn = $conn -> query("SELECT * FROM coin_wallet_history WHERE booking_id = '$order_id' && type = 'IN' ");
                            // while ($sDcoinIn = mysqli_fetch_array($sCoinIn)) {
                            //   $msgIn = $sDcoinIn['msg'];
                            //   $coin_earnedIn = strtok($msgIn, " ");
                            // }



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
                                $shop_name = $sD['shop_name'];
                                $address = $sD['full_address'];
                                $landmark = $sD['landmark'];
                                $pincode = $sD['pincode'];
                            }

                            $sOrder = $conn->query("SELECT * FROM order_bank_detail WHERE process_id = '$process_id'");
                            while ($sDOr = mysqli_fetch_array($sOrder)) {
                                $bank_name = $sDOr['bank_name'];
                                $acc_no = $sDOr['acc_no'];
                                $acc_name = $sDOr['acc_name'];
                                $ifsc = $sDOr['ifsc'];
                                $phonepe = $sDOr['phonepe'];
                                $googlepe = $sDOr['googlepe'];
                                $qrcode = $sDOr['qrcode'];
                                $del_charge = $sDOr['del_charge'];
                                $pack_charge = $sDOr['pack_charge'];
                            }

                            $sDelevi = $conn->query("SELECT * FROM order_delivery_detail WHERE process_id = '$process_id'");
                            while ($sDe = mysqli_fetch_array($sDelevi)) {
                                $big_box = $sDe['big_box'];
                                $medium_box = $sDe['medium_box'];
                                $small_box = $sDe['small_box'];
                                // $del_charge = $sDe['del_charge'];
                                // $pack_charge = $sDe['pack_charge'];
                                $del_charge = $sDOr['del_charge'];
                                $pack_charge = $sDOr['pack_charge'];
                                $delivery_bill = $sDe['delivery_bill'];
                                $description = $sDe['description'];
                            }


                        ?>

                            <tr>

                                <td>#<?php echo $order_id; ?></td>

                                <td> <?php echo $account_name; ?> <br> <a href="<?php echo $site_url; ?>/billing-desk/?id=<?php echo $order_id; ?>" target="_blank">View Bill <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                    <br> BID: <?php echo "CTIND" . substr($process_id, 0, 8); ?><br>
                                    <h5>Delivery Address</h5>
                                    <?php echo $address; ?> <br> <b>Landmark: <?php echo $landmark ?> <br>
                                        <?php echo $pincode; ?> <br> Mobile: <?php echo $account_phone; ?></b>

                                </td>

                                <td><?php echo $shop_name; ?></td>


                                <!-- <td> <?php echo $address; ?> <br> <b>Landmark: <?php echo $landmark ?> <br> <?php echo $pincode; ?> <br> Mobile: <?php echo $account_phone; ?></b> </td> -->

                                <td>

                                    <?php


                                    //ORDERED ITEMS

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
                                                $pro_price = $sD['price'];
                                            }



                                            $aQssssss = $conn->query("SELECT * FROM items WHERE id = '$product_id'");
                                            while ($sD = mysqli_fetch_array($aQssssss)) {
                                                $product_name = $sD['name'];
                                                $media_number = $sD['media_number'];
                                            }

                                            $aQssserf = $conn->query("SELECT * FROM media WHERE media_number = '$media_number'");
                                            while ($sDFil = mysqli_fetch_array($aQssserf)) {
                                                $pro_img = $site_url . "/media/" . $sDFil['file_name'];
                                            }
                                        }
                                        // echo "ID: ".$product_id." ".substr($product_name,0,10)." - ".substr($attr,0,10)." <b>x".$quantity."</b> (".$xamount.") ";
                                    ?>


                                        <!-- ?>   -->
                                        <div class="pro_card">
                                            <div class="row">
                                                <!-- <div class="col-md-2"><?php echo $product_id ?></div> -->
                                                <div class="col-md-5">
                                                    <div class="img-serve" style="background-image: url('<?php echo $pro_img ?>');">
                                                    </div>
                                                </div>
                                                <div class="col-md-7"><?php echo substr($product_name, 0, 20) ?></div>

                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6"><b><?php echo substr($attr, 0, 10) ?></b></div>
                                                <!-- <div class="col-md-2">
            <?php echo $quantity ?>
          </div> -->
                                                <div class="col-md-6">
                                                    Rs.<b><?php echo $pro_price ?></b>
                                                </div>

                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="text" class="set-qty-<?php echo $cart_id ?> form-control" value="<?php echo $quantity ?>" name="">
                                                </div>

                                                <div class="col-md-6">
                                                    <button cart_id="<?php echo $cart_id ?>" class="btn btn-primary update_qty">Update</button>
                                                </div>

                                            </div>
                                        </div>

                                        <hr>

                                    <?php }  ?>
                                    <br>
                                    <center><b>Total: Rs. <?php echo $amount; ?></b></center>

                                </td>

                                <!-- <td> Rs. <?php echo $amount; ?> </td> -->

                                <td>
                                    <form action="action/add_bank_detail.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Bank Name</label>
                                            <input type="text" class="form-control" value="<?php echo $bank_name ?>" name="bank_name" placeholder="Enter Bank Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Bank Account No</label>
                                            <input type="hidden" name="bank_pro_id" value="<?php echo $process_id ?>">
                                            <input type="hidden" name="bank_acc_id" value="<?php echo $account_id ?>">


                                            <input type="text" class="form-control" value="<?php echo $acc_no ?>" name="bank_acc_no" aria-describedby="emailHelp" placeholder="Enter Account Number">
                                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Account Holder Name</label>
                                            <input type="text" class="form-control" value="<?php echo $acc_name ?>" name="bank_acc_holder_name" placeholder="Enter Account Holder Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Bank IFSC</label>
                                            <input type="text" class="form-control" value="<?php echo $ifsc ?>" name="bank_ifsc" placeholder="Enter Account Holder Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">PhonePay UPI</label>
                                            <input type="text" class="form-control" value="<?php echo $phonepe ?>" name="bank_phonepe" placeholder="Phone Pay Upi Id">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">GooglePay UPI</label>
                                            <input type="text" class="form-control" value="<?php echo $googlepe ?>" name="bank_googlepe" placeholder="Google Pay Upi Id">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Delivery Charge</label>
                                            <input type="text" class="form-control" id="dc" name="del_charge" value="<?php echo $del_charge ?>" placeholder="Enter Small Box No">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Packing Charge</label>
                                            <input type="text" class="form-control" name="pack_charge" value="<?php echo $pack_charge ?>" id="pc" placeholder="Enter Small Box No">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Upload QR Code</label>
                                            <input type="file" class="form-control" name="qr_code" placeholder="Upload QR Code">
                                        </div>

                                        <button type="submit" class="btn btn-primary" name="submit_bank_detail">Submit</button>
                                    </form>

                                </td>

                                <!-- <td>
            <div class="form-group">
              <select class="custom-select select_bank_status" process_id="<?php echo $process_id ?>">
                  <option>Change Status</option>
                  <option value="1">Active</option>
                  <option value="0">In Active</option>
              </select>
            </div>
          </td> -->

                                <td>
                                    <form action="action/add_delivery_detail.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Bags</label>
                                            <input type="hidden" name="process_id" value="<?php echo $process_id ?>">
                                            <input type="hidden" name="acc_del_id" value="<?php echo $account_id ?>">


                                            <input type="text" class="form-control" name="big_box" value="<?php echo $big_box ?>" aria-describedby="emailHelp" placeholder="Enter Big Box No">
                                            <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Peti</label>
                                            <input type="text" class="form-control" name="medium_box" value="<?php echo $medium_box ?>" placeholder="Enter Medium Box No">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Others</label>
                                            <input type="text" class="form-control" name="small_box" value="<?php echo $small_box ?>" placeholder="Enter Small Box No">
                                        </div>

                                        <!-- <div class="form-group">
                      <label for="exampleInputPassword1">Delivery Charge</label>
                      <input type="text" class="form-control" name="del_charge" value="<?php echo $del_charge ?>" placeholder="Enter Small Box No">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Packing Charge</label>
                      <input type="text" class="form-control" name="pack_charge" value="<?php echo $pack_charge ?>" placeholder="Enter Small Box No">
                    </div> -->

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Add Decription</label>
                                            <textarea class="form-control" name="description">
                  <?php echo $description ?>
                  </textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Upload Bill</label>
                                            <input type="file" class="form-control" name="delivery_bill" placeholder="Upload Bill">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Delivery Date</label>
                                            <input type="text" id="datepicker" name="delivery_date" placeholder="Enter Delivery Date">

                                        </div>

                                        <button type="submit" class="btn btn-primary" name="addDeliveryDetail">Submit</button>
                                    </form>

                                </td>

                                <td> <?php echo $status_name; ?><br>
                                    <h4>Delivery Status</h4>
                                    <?php echo $creation_date; ?> at <?php echo $creation_time; ?>
                                </td>

                                <!-- <td>Coins Redeemed: <?php echo $coin; ?> <hr> Amount Redeemed: Rs <?php echo $amt; ?><hr>Coins Earned: <?php echo $coin_earnedIn; ?>
           </td> -->

                                <!-- <td> <?php echo $payment_mode_name; ?> </td> -->

                                <!-- <td> <?php if ($payment_status == "0") { ?> 

<span style="background-color: yellow; color: #000;"> UNPAID </span>

          <?php } else { ?> 

<span style="background-color: green; color: #fff;"> PAID </span>

          <?php } ?> </td> -->

                                <!-- <td> <?php echo $TRANSACTION_ID; ?> </td> -->

                                <!-- <td> <?php echo $creation_date; ?> at <?php echo $creation_time; ?> </td> -->

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
                                            ?> <option value="<?php echo $sD['id']; ?>" <?php echo $s; ?>><?php echo $sD['name']; ?></option>
                                            <?php } ?>
                                        </select>


                                    <?php } ?>

                                    <script type="text/javascript">
                                        $(".x-action-<?php echo $order_id; ?>").change(function() {
                                            if (confirm("Change Order Status?")) {

                                                if ($(".x-action-<?php echo $order_id; ?>").val() == "5") {

                                                    var promt = prompt("Enter reason for cancelling this order");

                                                    if (promt != null) {
                                                        window.location.href =
                                                            "cancel-order.php?order-id=<?php echo $order_id; ?>&reason=" +
                                                            promt + '&by=ADMIN';
                                                    }

                                                } else if ($(".x-action-<?php echo $order_id; ?>").val() == "3") {

                                                    // var promt = prompt("Do you want to give Gift..");
                                                    // alert(promt);
                                                    if (confirm("Do you want to give Gift in this order..")) {
                                                        var gLabel = prompt("Enter Gift label");
                                                        if (gLabel != null) {
                                                            var gAmount = prompt("Enter gift amount");

                                                            var order_id = <?php echo $order_id; ?>;
                                                            var status_id = $(".x-action-<?php echo $order_id; ?>").val();

                                                            var order_data = {
                                                                "glabel": gLabel,
                                                                "gamount": gAmount,
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

                                                        }
                                                    } else {
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
                                                    }

                                                } else {
                                                    window.location.href =
                                                        "change-order-status.php?order-id=<?php echo $order_id; ?>&status-id=" +
                                                        $(".x-action-<?php echo $order_id; ?>").val();
                                                }

                                            }
                                        });
                                    </script>

                                    <br />
                                    <br />
                                    <hr>
                                    <b>Change Bank Status</b>
                                    <hr>
                                    <div class="form-group">
                                        <select class="custom-select select_bank_status" process_id="<?php echo $process_id ?>">
                                            <option>Change Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                    </div>



                                    <!-- change payment mode -->
                                    <br />
                                    <br />
                                    <hr>
                                    <b>Change Payment Mode</b>
                                    <hr>
                                    <div class="form-group">
                                        <select class="custom-select select_payment_mode" process_id="<?php echo $process_id ?>">
                                            <option>Change Mode</option>
                                            <option value="1">PhonePe</option>
                                            <option value="2">Bank</option>
                                            <option value="3">Google Pay</option>
                                        </select>
                                    </div>





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

<script>
    $(document).ready(function() {

        $("#datepicker").datepicker();

        $('.select_bank_status').on('change', function() {
            var status = $(this).val();
            var process_id = $(this).attr('process_id');

            if (status != '') {
                $.ajax({
                    type: 'POST',
                    url: 'action/update_bank_status.php',
                    data: {
                        updateBankStatus: 1,
                        ProcessId: process_id,
                        StatusId: status
                    },
                    success: function(data) {
                        alert(data);
                        location.reload();
                    }
                });
            }
        });

        $('.select_payment_mode').on('change', function() {
            var mode = $(this).val();
            var process_id = $(this).attr('process_id');

            if (mode != '') {
                $.ajax({
                    type: 'POST',
                    url: 'action/update_payment_mode.php',
                    data: {
                        ProcessId: process_id,
                        modeId: mode
                    },
                    success: function(data) {
                        alert(data);
                        // location.reload();
                    }
                });
            }
        });

        $(".update_qty").click(function() {
            var cart_id = $(this).attr('cart_id');
            var qty = $('.set-qty-' + cart_id).val();


            $.ajax({
                url: "action/update_order_quantity.php",
                method: "POST",
                data: {
                    updateOrderQuantity: 1,
                    qty: qty,
                    cart_id: cart_id
                },
                // dataType:"json",
                success: function(data) {
                    console.log(data);
                    // location.reload();
                    alert('Successfully Updated');
                }
            });
        });

        $(".add_qty_order").click(function() {
            // var cart_id = $(this).attr('cart_id');
            // var item_id = $('.all-a').attr('item_id');

            var qty = $('.up_qty').val();
            var account_id = $('#acc_id').val();
            var process_id = $('#pro_id').val();
            var item_id = $('#add_pro_item').val();

            $.ajax({
                url: "action/add_product_cart.php",
                method: "POST",
                data: {
                    addCartQuantity: 1,
                    qty: qty,
                    item_id: item_id,
                    account_id: account_id,
                    process_id: process_id
                },
                // dataType:"json",
                success: function(data) {
                    // alert(data);
                    location.reload();
                }
            });
        });

        $("#submit_delivery_detail").click(function() {
            // alert('hi');  
            // return;

            var big_box = $('#big_box').val();
            var medium_box = $('#medium_box').val();
            var small_box = $('#small_box').val();
            var delivery_date = $('#datepicker').val();
            var delivery_pro_id = $('#delivery_pro_id').val();
            var delivery_charge = $('#dc').val();
            var packing_charge = $('#pc').val();


            $.ajax({
                url: "action/add_delivery_detail.php",
                method: "POST",
                data: {
                    addDeliveryDetail: 1,
                    big_box: big_box,
                    medium_box: medium_box,
                    small_box: small_box,
                    process_id: delivery_pro_id,
                    delivery_date: delivery_date,
                    delivery_charge: delivery_charge,
                    packing_charge: packing_charge
                },
                // dataType:"json",
                success: function(data) {
                    let dd = JSON.parse(data);
                    if (dd.response) {
                        alert("Successfully added delivery detail");
                        location.reload();
                    } else {
                        alert("Something went wrong")
                    }
                }
            });
        });

        // $("#submit_bank_detail").click(function() { 
        // // alert('hi');  

        //    var bank_acc_no = $('#bank_acc_no').val();
        //    var bank_acc_holder_name = $('#bank_acc_holder_name').val();
        //    var bank_phonepe = $('#bank_phonepe').val();
        //    var bank_googlepe = $('#bank_googlepe').val();
        //    var bank_ifsc = $('#bank_ifsc').val();
        //    var bank_pro_id = $('#bank_pro_id').val();
        //    console.log(bank_pro_id);
        //    console.log(bank_acc_holder_name);
        //    console.log(bank_phonepe);
        //    console.log(bank_googlepe);
        //    console.log(bank_acc_no);

        //    // return;


        //     $.ajax({
        //                url:"action/add_bank_detail.php",
        //                method:"POST",
        //                data:{addBankDetail:1,bank_acc_no:bank_acc_no,bank_acc_holder_name:bank_acc_holder_name,bank_phonepe:bank_phonepe,bank_googlepe:bank_googlepe, bank_ifsc:bank_ifsc,bank_pro_id:bank_pro_id},
        //                // dataType:"json",
        //                success:function(data){
        //                  let dd = JSON.parse(data);
        //                    if(dd.response){
        //                      alert("Successfully added bank detail");
        //                      location.reload();
        //                    }else{
        //                      alert("Something went wrong")
        //                    }
        //                }
        //            });
        // });

    });
</script>

<script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        $("#myInput").focus();
    }

    function filterFunction() {
        var input, filter, ul, li, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    $(".all-a").click(function(e) {

        document.getElementById("myDropdown").classList.toggle("show");

        $("[name=item_id]").val($(this).attr("item-id"));
        $('#add_pro_item').val($(this).attr("item-id"));

        $(".a-holder").html('<i class="fa fa-user-circle-o" aria-hidden="true"></i> ' + $(this).html() +
            '<br><small class="small-hint">Click to Reselect <i class="fa fa-chevron-down" aria-hidden="true"></i></small> <br>'
        );

        $("[name=price]").focus();

    });
</script>