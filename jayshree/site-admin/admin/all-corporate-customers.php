<?php

session_start();

include("../../config.php");

include("../../variables.php");



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

        <title>All CORPORATE CUSTOMERS</title>

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

            td {
                background: #fff;
                font-size: 20px;
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
        <div class="container-fluid" style="background-color: #efeaea;">

            <div class="row">
                <center>
                    <h2>All Customers</h2>
                </center>
            </div>

            <div class="row">

                <table class="table table-bordered">







                    <thead>







                        <tr>

                            <th>ID</th>

                            <th> NAME </th>

                            <th> SHOP NAME </th>

                            <th> PHONE </th>

                            <th> ALT. PHONE </th>

                            <th> Address </th>

                            <th> SIGNUP D/T. </th>

                            <th> Orders </th>

                            <th> Change Approval </th>


                            <!-- <th> Available Coins </th> -->

                            <!-- <th> COD on / off </th> -->


                        </tr>







                    </thead>





                    <tbody>

                        <?php $cQ = $conn->query("SELECT * FROM accounts WHERE verification = '1' AND account_type = '1'  ORDER BY id DESC ");
                        $i = 1;
                        while ($rowD = mysqli_fetch_array($cQ)) {
                            $account_id = $rowD['id'];
                            $name = $rowD['name'];
                            $phone = $rowD['phone'];
                            $address = $rowD['full_address'];
                            $landmark = $rowD['landmark'];
                            $pincode = $rowD['pincode'];
                            $shop_name = $rowD['shop_name'];
                            $mobile = $rowD['mobile'];

                            // $coin_wallet_balance = $rowD['coin_wallet_balance'];
                            $creation_date = $rowD['creation_date'];
                            $creation_time = $rowD['creation_time'];
                            $cod = $rowD['cod'];
                            $approve = $rowD['approve'];

                            if ($approve == 0) {
                                $approve_sta = "OFF";
                            }
                            if ($approve == 1) {
                                $approve_sta = "ON";
                            }


                            // if ( $cod == 0 ) { $cod = "<a href='cod-on.php?id=".$account_id."' style='color:green;'>turn on</a>"; }
                            // else { $cod = "<a href='cod-off.php?id=".$account_id."' style='color:red;'>turn off</a>"; }

                            $oQ = $conn->query("SELECT * FROM orders WHERE account_id = '$account_id'");
                            $orders = mysqli_num_rows($oQ);

                        ?>

                            <tr>

                                <td><?php echo $i; ?> </td>

                                <td><?php echo $name; ?>
                                    <div style="float:right">
                                        <i class="fa fa-eye view_astro_detail" data-toggle="modal" customer_id="<?php echo $account_id ?>" data-target="#astro-modal-detail" aria-hidden="true"></i>
                                        <button class="btn delete_user_detail" del_user_id="<?php echo $account_id ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </div>
                                </td>

                                <td><?php echo $shop_name ?></td>

                                <!-- <td><?php echo $email; ?></td> -->

                                <td><?php echo $phone; ?></td>
                                <td><?php echo $mobile; ?></td>

                                <td><?php echo $address; ?><br>
                                    <?php echo $landmark; ?><br>
                                    <?php echo $pincode; ?>
                                </td>


                                <td><?php echo $creation_date; ?> at <?php echo $creation_time; ?></td>

                                <td> <?php echo $orders; ?> Orders </td>

                                <td>
                                    <div class="form-group">
                                        <select class="cus-sel select_approval_status form-control" user_id="<?php echo $account_id ?>">
                                            <option value="<?php echo $approve ?>"><?php echo $approve_sta ?></option>
                                            <option value="1">ON</option>
                                            <option value="0">OFF</option>
                                        </select>
                                    </div>
                                </td>

                                <!-- <td> <?php echo $coin_wallet_balance; ?>   </td> -->


                                <!-- <td> <?php echo $cod; ?>   </td> -->

                            </tr>

                        <?php $i++;
                        } ?>


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
                                <label style="color:black">Name:</label>
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
                                <label style="color:black">Shop Name:</label>
                                <input type="text" class="form-control user_shop" id="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 m-b-20">
                                <label style="color:black">Phone:</label>
                                <input type="text" class="form-control user_phone" id="">
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
    $('.select_approval_status').on('change', function() {

        var status = $(this).val();
        var user_id = $(this).attr('user_id');
        // alert(status);
        // alert(user_id);
        // return;

        if (status != '') {
            $.ajax({
                type: 'POST',
                url: 'action/update_approval_status.php',
                data: {
                    updateApprovalStatus: 1,
                    UserId: user_id,
                    StatusId: status
                },
                success: function(data) {
                    console.log(data);
                    let dd = JSON.parse(data);
                    if (dd.response == 1) {
                        alert('Successfully Updated Status');
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
                fetchUserDetail: 1,
                customer_id: customer_id
            },
            dataType: "json",
            success: function(data) {
                //  console.log(data);
                //  return;
                //   console.log(data.id);
                //   console.log(data.price);
                $('.user_edit_id').val(data.id);
                $('.user_name').val(data.name);
                $('.user_address').val(data.full_address);
                $('.user_phone').val(data.phone);
                $('.user_shop').val(data.shop_name);

            }
        });
    });

    $(".edit_user_detail").click(function() {

        var user_id = $('.user_edit_id').val();
        var user_name = $('.user_name').val();
        var user_address = $('.user_address').val();
        var user_phone = $('.user_phone').val();
        var user_shop = $('.user_shop').val();

        // return;
        $.ajax({
            url: "action/update_user_data.php",
            method: "POST",
            data: {
                updateUserData: 1,
                user_id: user_id,
                user_name: user_name,
                user_address: user_address,
                user_phone: user_phone,
                user_shop: user_shop
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


    $(".delete_user_detail").click(function() {

        if (confirm("Are you sure to delete?")) {
            var del_user_id = $(this).attr('del_user_id');
            // alert(del_user_id);
            // return;

            $.ajax({
                url: "action/delete_user.php",
                method: "POST",
                data: {
                    del_user_id: del_user_id
                },
                success: function(data) {
                    // alert(data);
                    let dd = JSON.parse(data);
                    if (dd.response == 1) {
                        alert("Successfully Deleted");
                        location.reload();
                    } else {
                        alert("Something went wrong");
                    }

                }

            })
        }
        return false;
    })
</script>