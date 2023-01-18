<?php include("../config.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice :: <?php echo $the_project; ?></title>
    <link rel="stylesheet" href="style.css" media="all" />

<!--FONT AWESOME-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">

<style type="text/css">

body, h1, h2, h3, h4, h5, h6, div, p, span, button, a, label, table, tr, td, th{
  font-family: "Montserrat",Sans-Serif !Important;
}

</style>

<style type="text/css">
  *{
    font-size: 12px !important;
  }
  td{
        padding: 4px !important;
  }

  table th, table td {
    padding: 20px;
    background:#e2e2e2;
  }

  .no-border{
    border-top: 0 !important;
  }
</style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="<?php echo $site_url; ?>/img/logo.jpeg">
      </div>
      <div id="company">
        <h2 class="name"><b><?php echo $the_project ?></b></h2>
        <div>157 A ZONE 4, <br>HARMU, RANCHI - 834002, <br>
        </div>
        <!-- <div>GST: 20ANLPN8822H1ZY</div> -->
        <div>(+91) 8988989899</div>
        <div>(+91) 9878987898</div>

        <div><a href="mailto:info@boxoniq.in">info@boxoniq.in</a></div>
      </div>
      </div>
    </header>

        <?php 

        $booking_id = $_GET['id'];

        $cQ = $conn -> query("SELECT * FROM bookings WHERE process_id = '$booking_id' ORDER BY id DESC "); 

        $MAIN_TOTAL = 0;

        while ($rowD = mysqli_fetch_array($cQ)) {
          $order_id = $rowD['id'];
          $account_id = $rowD['account_id'];
          $order_date = $rowD['creation_date'];
          $order_time = $rowD['creation_time']; 

          $status_id = $rowD['order_status']; 
          $AMT = $amount = $rowD['amount']; 
          $payment_mode_id = $rowD['payment_mode']; 
          $TRANSACTION_ID = $rowD['TRANSACTION_ID']; 
          $creation_date = $rowD['creation_date']; 
          $creation_time = $rowD['creation_time'];
          $process_id = $rowD['process_id'];

          $gift_amount = $rowD['gift_amount'];
          $gift_label = $rowD['gift_label'];

          $payment_status_id = $rowD['payment_status'];
          
          $sQ = $conn -> query("SELECT * FROM status_id WHERE id = '$status_id'");
          while ($sD = mysqli_fetch_array($sQ)) {
            $status_name = $sD['name'];
            
          }

          if ($payment_status_id == 0 ) { $payment_status_name = "<b style='color: red;'>UNPAID</b>"; }
          else { $payment_status_name = "<b style='color: green;'>PAID</b>"; }

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

          }

          $aQwallet = $conn -> query("SELECT * FROM wallet WHERE user_id = '$account_id'");
          while ($sD = mysqli_fetch_array($aQwallet)) {
            $wallet_amount = $sD['amount'];
          }

          // ***************************************************************************************
          $billQ = $conn -> query("SELECT * FROM bill_address WHERE process_id = '$process_id'");
          $count_bill_row = mysqli_num_rows($billQ);
          if($count_bill_row > 0) {
            while ($billD = mysqli_fetch_array($billQ)) {
            
              $address = $billD['full_address'];
              $landmark = $billD['landmark'];
              $pincode = $billD['pincode'];

              }
            }else{
              $aQBill = $conn -> query("SELECT * FROM accounts WHERE id = '$account_id'");
              while ($sDBill = mysqli_fetch_array($aQBill)) {
                $address = $sDBill['full_address'];
                $landmark = $sDBill['landmark'];
                $pincode = $sDBill['pincode'];

              }
            }
          
// **********************************************************************************************

      $pQCoin_ = $conn -> query("SELECT * FROM coin_wallet_history WHERE booking_id = '$order_id' && type = 'OUT'");
        if(mysqli_num_rows ($pQCoin_) > 0) {
          while ($sDCoin_ = mysqli_fetch_array($pQCoin_)) {
            $coin_amt = $sDCoin_['amt'];
          }
        }else{
          $coin_amt = 0;
        }

}
          ?>


    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name"><?php echo $account_name; ?></h2>
          <div class="address"><?php echo $address."<br>Landmark: ".$landmark."<br>".$pincode.", Ph: ".$account_phone; ?></div>
          <div class="email"><a href="mailto:<?php echo $account_email; ?>"><?php echo $account_email; ?></a></div>
          <hr>
        <div>Wallet Balance: Rs. <b><?php echo $wallet_amount; ?></b></div>
        </div>
        <div id="invoice">
          <h1> INVOICE NO: #<?php echo $order_id; ?></h1>
          <div class="date">Date of Invoice: <?php echo $creation_date; ?></div>
          <!-- <div class="date">Due Date: <?php echo $creation_date; ?></div> -->
                  <hr>

        <div>Mode of Payment: <b><?php echo $payment_mode_name; ?></b></div>
        </div>

      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc" style="padding: 2px !important;" ><h4 style="font-size: 14px;     color: #000; "><b>DESCRIPTION</b></h4></th>

            <th class="qty" style="padding: 2px !important;"><h4 style="font-size: 14px;     color: #000; "><b>QUANTITY</b></h4></th>


            <th class="unit" style="padding: 2px !important;"><h4 style="font-size: 14px;     color: #000; "><b>MRP</b></h4></th>

            <th class="unit" style="padding: 2px !important;"><h4 style="font-size: 14px;     color: #000; "><b>UNIT PRICE</b></h4></th>
            <th class="qty" style="padding: 2px !important;"><h4 style="font-size: 14px;     color: #000; "><b>GST(%)</b></h4></th>

            <th class="qty" style="padding: 2px !important;"><h4 style="font-size: 14px;     color: #000; "><b>GST</b></h4></th>
            <th class="total" style="padding: 2px !important;"><h4 style="font-size: 14px;     color: #fff; "><b>TOTAL</b></h4></th>
          </tr>
        </thead>
        <tbody>

<?php 


                    //ORDERED ITEMS

          $item_list_x = 1;
          $TOTAL_MRP = 0;

          $aQzz = $conn -> query("SELECT * FROM orders WHERE process_id = '$process_id'");
          while ($sD = mysqli_fetch_array($aQzz)) {
            $cart_id = $sD['cart_id'];

            $aQz = $conn -> query("SELECT * FROM cart WHERE id = '$cart_id'");
          while ($sD = mysqli_fetch_array($aQz)) {
            $product_id = $sD['item_id'];
            $attribute_id = $sD['attribute_id'];
            $quantity = $sD['quantity'];
            $xamount = $sD['total_amount'];
            $attr_mrp = $sD['mrp'];
            if($attr_mrp>0){
              $attr_mrp = $sD['mrp'];
            }
            
            


          $aQss = $conn -> query("SELECT * FROM attributes WHERE id = '$attribute_id'");
          while ($sD = mysqli_fetch_array($aQss)) {
            $attr = $sD['name'];
            $attr_price = $sD['price'];
            if($attr_mrp == ''){
              $attr_mrp = $sD['mrp'];
            }
            

          }

          $attr_price = ( $xamount / $quantity ); 



             $aQssssss = $conn -> query("SELECT * FROM items WHERE id = '$product_id'");
          while ($sD = mysqli_fetch_array($aQssssss)) {
            $product_name = $sD['name'];

          }

        } 
        $gst = $xamount*(10/100);
        $sho_attr_price = $xamount - $gst;
        ?>

        <!-- $attr_price =  -->

          <tr>
            <td class="no"><center><?php echo $item_list_x; ?></center></td>
            <td class="desc" ><h3 style="color: #000 !important;"><?php echo $product_name; ?> | <?php echo $attr; ?></h3></td>
            <td class="qty"><center><?php echo $quantity; ?></center></td>
            <td class="mrp"> <center> <i class="fa fa-inr"></i> <?php echo $attr_mrp; ?>.00</center></td>
            <td class="unit"> <center> <i class="fa fa-inr"></i> <?php echo $sho_attr_price; ?>.00</center></td>
            <td class="qty"><center><?php echo $gst; ?> %</center></td>
            <td class="qty"><center><?php echo $gst; ?></center></td>
            <td class="total"> <center> <i class="fa fa-inr"></i> <?php $MAIN_TOTAL = $MAIN_TOTAL + $xamount; echo $xamount; ?>.00</center></td>
          </tr>

      <?php $TOTAL_MRP = ( $TOTAL_MRP + ( $attr_mrp * $quantity) ); ?>
      <?php $item_list_x ++; }  ?>





          
          
        </tbody>
        <tfoot>
          <tr><td></td>
            <td colspan="2" class="no-border"></td>
            <td colspan="3" >SUBTOTAL</td>
            <td><i class="fa fa-inr"></i> <?php echo $TOTAL_MRP; ?>.00</td>
          </tr>
          <tr><td></td>
            <td colspan="2" class="no-border"></td>
            <td colspan="3">DISCOUNT</td>
            <td> - <i class="fa fa-inr"></i> <?php echo ( $TOTAL_MRP - $MAIN_TOTAL ); ?>.00</td>
          </tr>

           <?php 
          if($MAIN_TOTAL<499){
            $del_charge = 49;
          }else{
            $del_charge = 0;
          }
         ?>
            <!-- <tr><td></td>
              <td colspan="2"></td>
              <td colspan="2">Delivery Charge</td>
              <td> + <i class="fa fa-inr"></i> <?php echo $del_charge; ?></td>
            </tr> -->
           <?php if ($del_charge > 0) { ?>
            <tr>
              <td colspan="2"></td>
              <td colspan="4">Delivery Charge</td>
              <td><i class="fa fa-inr"></i><?php echo $del_charge; ?>.00</td>
            </tr>
          <?php } else{
              echo '';
          } ?>

          <?php if ($coin_amt > 0) { ?>
            <tr><td></td>
              <td colspan="2"></td>
              <td colspan="2">Redeemed Coins</td>
              <td> - <i class="fa fa-inr"></i> <?php echo $coin_amt; ?>.00</td>
            </tr>
          <?php } else {
            echo '';
          } ?>

          <?php 
         if($gift_amount>0) {?>

            <tr><td></td>
              <td colspan="2"></td>
              <td class="no" colspan="2"><?php echo $gift_label; ?></td>
              <td class="no"> <i class="fa fa-inr"></i> <?php echo $gift_amount; ?></td>
            </tr>
          
         <?php }
          ?>

          <tr><td></td>
            <td colspan="2" class="no-border"></td>
            <td colspan="3" style="color:#000; font-weight: bold;">GRAND TOTAL</td>
            <td style="color:#000; font-weight: bolder;"><i class="fa fa-inr"></i> <?php echo ($MAIN_TOTAL + $del_charge - $coin_amt)  ; ?>.00</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Thank you!</div>
      <div id="notices">
        <div>ORDER STATUS:</div>
        <div class="notice"><?php echo $status_name; ?></div>
      </div>
    </main><br>
    <div>
      Invoice was created on a computer and is valid without the signature and seal.
    </div>
  </body>
</html>