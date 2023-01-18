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

  <title>All CUSTOMERS</title>

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

  <div class="row"><center><h2>All Customers</h2><a target="_empty" href="export-excel/export-all-customer.php" class="btn btn-success" title="Click to export"><i class="dwn"></i> Export</a></center></div>

  <div class="row">

    <table class="table table-bordered">







      <thead>







        <tr>

          <th>ID</th>

          <th> NAME </th>

          <th> USERNAME / EMAIL </th>

          <th> AVAILABLE BALANCE </th>

          <th> WALLET AMOUNT </th>

          <th> PHONE </th>
          <th> BABY NAME </th>
          <th> DOB </th>

          <th> SIGNUP D/T. </th>

          <th> Orders </th>

          <!-- <th> Available Coins </th> -->

          <th> Action </th>


        </tr>







      </thead>





      <tbody>

        <?php $cQ = $conn -> query("SELECT * FROM accounts WHERE verification = '1' ORDER BY id DESC "); 

        while ($rowD = mysqli_fetch_array($cQ)) {
          $account_id = $rowD['id'];
          $name = $rowD['name'];
          $baby_name = $rowD['baby_name'];
          $baby_dob = $rowD['baby_dob'];

          $phone = $rowD['phone'];
          $email = $rowD['email'];
          $coin_wallet_balance = $rowD['coin_wallet_balance'];
          $creation_date = $rowD['creation_date'];
          // $creation_time = $rowD['creation_time']; 
          $cod = $rowD['cod'];

          if ( $cod == 0 ) { $cod = "<a href='cod-on.php?id=".$account_id."' style='color:green;'>turn on</a>"; }
          else { $cod = "<a href='cod-off.php?id=".$account_id."' style='color:red;'>turn off</a>"; }

          $oQ = $conn -> query("SELECT * FROM orders WHERE account_id = '$account_id'");
          $orders = mysqli_num_rows($oQ);

          $get_wallet = $conn -> query("SELECT * FROM wallet WHERE user_id = '$account_id'");
          $row_wallet = mysqli_fetch_assoc($get_wallet);
          $wallet_amount = $row_wallet['amount'];
          $wallet_id = $row_wallet['id'];


          ?>

          <tr>
     
          <td><?php echo $account_id; ?></td>

          <td><?php echo $name; ?></td>

          <td><?php echo $email; ?></td>
          <td><?php echo $wallet_amount ?></td>

          <td>
              <input type="number" placeholder="Enter Amount" value="" class="set_share-<?php echo $wallet_id ?>">
              <button class="btn btn-primary btn-xs set" set_wallet_id="<?php echo $wallet_id ?>">Set</button>
          </td>


          <td><?php echo $phone; ?></td>

          <td><?php echo $baby_name; ?></td>

          <td><?php echo $baby_dob; ?></td>


          <td><?php echo $creation_date; ?></td>

          <td> <?php echo $orders; ?> Orders   </td>

          <!-- <td> <?php echo $coin_wallet_balance; ?>   </td> -->
          

          <td> <button class="btn btn-danger btn-xs setdelete" delete_id="<?php echo $account_id ?>"><i class="fa fa-trash" aria-hidden="true"></i></button>   </td>

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
 $(".set").click(function() {   
    var set_wallet_id = $(this).attr('set_wallet_id');
    var prior_id = $('.set_share-'+set_wallet_id).val();
    // alert(prior_id);
    // alert(set_wallet_id);
    if(prior_id < 0){
      alert('Amount should be greator than 0');
      // return;
    }

    // return;
     $.ajax({
                url:"action/update_priority.php",
                method:"POST",
                data:{updateWalletUser:1,prior_id:prior_id, wallet_id:set_wallet_id},
                // dataType:"json",
                success:function(data){
                    alert(data);
                    location.reload();
                }
            });
 });

 $(".setdelete").click(function() {   
    var user_id = $(this).attr('delete_id');
    
     $.ajax({
                url:"action/delete_user.php",
                method:"POST",
                data:{deleteUser:1,user_id:user_id},
                // dataType:"json",
                success:function(data){
                    alert(data);
                    location.reload();
                }
            });
 });
</script>