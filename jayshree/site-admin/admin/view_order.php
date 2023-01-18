<?php 

session_start();

include ("../../config.php");

$get_del_id = $_GET['delivery_partner_id'];

$get_del = $conn -> query("SELECT * FROM delivery_boy WHERE id = '$get_del_id' ");
$del_name = mysqli_fetch_assoc($get_del)['name'];


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

.img-serve {
    background-color: #f9f9f9;
    height: 80px;
    width: 80px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.pro_card{
      -webkit-box-shadow: 1px 1px 5px 2px rgb(196 196 196);
    -moz-box-shadow: 1px 1px 5px 7px rgba(196,196,196,1);
    background-color: #ffffff;
    padding: 7px;
    border-radius: 15px;
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

  <div class="row"><center><h2>All Orders of <?php echo $del_name ?></h2></center></div>
  <br>

  <div class="row">

    <table class="table table-bordered">

      <thead>

        <tr>

          <th>ID</th>

          <th> CUSTOMER NAME </th>

          <th> ADDRESS </th>

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

          <th> ACTION </th>


        </tr>

      </thead>

      <tbody>

        <?php $cQ = $conn -> query("SELECT * FROM bookings WHERE assign_delivery = '$get_del_id' ORDER BY id DESC "); 

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
          $get_del = $conn -> query("SELECT * FROM delivery_boy WHERE id = '$assign_delivery' ");
          $del_name = mysqli_fetch_assoc($get_del)['name'];

          $coin = 0;
          $coin_earnedIn = 0;
          $amt = 0;


          $sCoin = $conn -> query("SELECT * FROM coin_wallet_history WHERE booking_id = '$order_id' && type = 'OUT' ");
          while ($sDcoin = mysqli_fetch_array($sCoin)) {
            $msg = $sDcoin['msg'];
            $amt = $sDcoin['amt'];

            $coin = strtok($msg, " ");
            
          }

          $sCoinIn = $conn -> query("SELECT * FROM coin_wallet_history WHERE booking_id = '$order_id' && type = 'IN' ");
          while ($sDcoinIn = mysqli_fetch_array($sCoinIn)) {
            $msgIn = $sDcoinIn['msg'];
            $coin_earnedIn = strtok($msgIn, " ");
          }
          


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
     
          <td>#<?php echo $order_id; ?></td>

          <td> <?php echo $account_name; ?> <br> <a href="<?php echo $site_url; ?>/billing-desk/?id=<?php echo $order_id; ?>" target="_blank">View Bill <i class="fa fa-long-arrow-right" aria-hidden="true"></i><br>OrderID: <?php echo $process_id ?></a> 
          </td>

          <td>
          Mobile: <?php echo $account_phone; ?> <br> Address: <?php echo $address; ?>
           <br>Landmark: <?php echo $landmark ?> <br>Pincode: <?php echo $pincode; ?>
          </td>

          <!-- <td>  <?php echo $account_phone; ?>  </td> -->

          <!-- <td> <?php echo $account_email; ?> </td> -->

          <!-- <td> <?php echo $address; ?> <br> <b>Landmark: <?php echo $landmark ?> <br> <?php echo $pincode; ?> </b> </td> -->

          <td> <a target="_empty" href="customer-order.php?account_id=<?php echo $account_id ?>&process_id=<?php echo $process_id ?>">View Order</a> </td>

          <!-- <td>

          <?php 

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
            $media_number = $sD['media_number'];


          }

          $aQssdsfs = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number'");
          while ($sD = mysqli_fetch_array($aQssdsfs)) {
            $pro_img = $site_url."/media/".$sD['file_name'];

          }

        } 
        ?>
            <div class="pro_card" style="padding:20px;">
              <span>ID: <?php echo $product_id ?></span>

        <center><div class="img-serve" style="background-image: url('<?php echo $pro_img ?>');"></div></center>
        <hr>

        <?php

          echo substr($product_name, 0,10)." - ".substr($attr, 0, 10)." <b>x".$quantity."</b> (".$xamount.")<br></div> <hr> "; ?> 

      <?php  }  ?>

        

          </td> -->

          <td> Rs. <?php echo $amount; ?> </td>

          <td> <?php echo $status_name; ?> </td>

          <!-- <td>Coins Redeemed: <?php echo $coin; ?> <hr> Amount Redeemed: Rs <?php echo $amt; ?><hr>Coins Earned: <?php echo $coin_earnedIn; ?>
           </td> -->

          <td> <?php echo $payment_mode_name; ?> </td>

          <!-- <td> <?php if( $payment_status == "0" ) { ?> 

<span style="background-color: yellow; color: #000;"> UNPAID </span>

          <?php } else {?> 

<span style="background-color: green; color: #fff;"> PAID </span>

          <?php } ?> </td> -->

          <!-- <td> PAYMENT DETAILS </td> -->

          <td> <?php echo $creation_date; ?> at <?php echo $creation_time ; ?> </td>
          <td>
            <select class="form-control sel_del_boy" booking_id="<?php echo $order_id ?>" >
                <option>Select Delivery Boy</option>
              <?php 
              $get_del = $conn->query("SELECT * FROM delivery_boy ORDER BY id DESC");
              while($row_del=mysqli_fetch_array($get_del)){
              ?>
              <option value="<?php echo $row_del['id']?>"><?php echo $row_del['name'] ?></option>
              
              <?php } ?>
            </select>

          </td>

          <td>

            <?php if ( $status_id == 5 ) { ?> 

              <span style="color: #fff; background-color: red;">CANCELLED</span>

            <?php }elseif ( $status_id == 4 ) { ?>

              <span style="color: #fff; background-color: green;">COMPLETED</span>              
                
            <?php } else { ?> 


             <select class="x-action-<?php  echo $order_id; ?>">
          <?php 

          $sQ = $conn -> query("SELECT * FROM status_id ");
          while ($sD = mysqli_fetch_array($sQ)) {
            if( $sD['id'] == $status_id ){ $s = "selected"; }else{ $s = "unselected"; }
            ?> <option value="<?php echo $sD['id']; ?>" <?php echo $s; ?>><?php echo $sD['name']; ?></option> <?php } ?>
            </select>


            <?php } ?>

            <script type="text/javascript">
            $(".x-action-<?php  echo $order_id; ?>").change(function(){
              if (confirm("Change Order Status?")) {                 

                if ( $(".x-action-<?php  echo $order_id; ?>").val() == "5" ) { 

                  var promt = prompt("Enter reason for cancelling this order");

                  if ( promt != null ) { window.location.href="cancel-order.php?order-id=<?php echo $order_id; ?>&reason="+promt+'&by=ADMIN'; }

                }
                else if( $(".x-action-<?php  echo $order_id; ?>").val() == "3" ) {

                    // var promt = prompt("Do you want to give Gift..");
                    // alert(promt);
                  //   if(confirm("Do you want to give Gift in this order..")){
                  //     var gLabel = prompt("Enter Gift label");
                  //     if(gLabel!=null){
                  //       var gAmount = prompt("Enter gift amount");

                  //        var order_id = <?php echo $order_id; ?>;
                  //        var status_id = $(".x-action-<?php  echo $order_id; ?>").val();

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
                         var status_id = $(".x-action-<?php  echo $order_id; ?>").val();
                      var order_data = {
                          "order_id" : order_id,
                          "status_id" : status_id,
                         };

                          $.ajax({
                            url    : "change-order-status-gift.php",
                            method :"POST",
                            data   : order_data,
                            success:function(data){
                              console.log(data);
                               }
                          })
                    // }

                } else { window.location.href="change-order-status.php?order-id=<?php echo $order_id; ?>&status-id="+$(".x-action-<?php  echo $order_id; ?>").val();  }

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

<script>
  $('.sel_del_boy').on('change',function(){
    // alert('hi');
    var status=$(this).val();
    var book_id=$(this).attr('booking_id');
    // alert(status);
    // alert(book_id);
    // return;

    if(status!=''){
      $.ajax({type:'POST',
        url:'action/update_booking_delivery.php',
        data:{updateDelBookStatus:1,BookingId:book_id,StatusId:status},
        success:function(data)
      {
        let dd = JSON.parse(data);
        if(dd.response == 1){
          alert('Successfully Added Delivery Boy');
        }
      }
      });
    }
  });
</script>