<?php
session_start();
include ("../../config.php");
if (!isset($_SESSION['username']) && !isset($_SESSION['name'])) {?>

  <script type="text/javascript">
    window.location.href="index.php";
  </script>
  <?php
}
else{ ?><!DOCTYPE html>

<html>

<head>


  <title>User Search Map</title>
  <!--Font-->



<link href='//fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>







<!-- JQUERY-->



<script src="//code.jquery.com/jquery-2.2.3.min.js"></script>







<!--Live Form-->



<script src="../../assets/js/liveform.js"></script>







<!--Drop Zone-->



<script src="../../assets/js/dropzone.js"></script> <script src="../../assets/js/dashboard.js"></script>



<link rel="stylesheet" href="../../assets/css/dropzone.css">







<!--Latest compiled and minified CSS-->



<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css" crossorigin="anonymous">







<!--Latest compiled and minified JavaScript-->



<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>







<!--FONT AWESOME-->



<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">







<!--VIEWPORT-->



<meta name="viewport" content="width=device-width, initial-scale=1">


</head>

<body style="background-color: #efefef;">
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
  z-index: 9999;
}

.my-float{
  margin-top:22px;
}

textarea { resize: vertical; min-height: 140px !important; }

</style>
<a href="index.php" class="float">
<i class="fa fa-home my-float"></i>
</a>

<?php 

if (isset($_GET['callback'])) { ?>
  
  <div class="container-fluid" style="background: #f3f3f3;
    text-align: center;">
  <div class="row">
  <div class="col-md-12">
    <h3 style="color: #23b96a;"><strong>Data Updated Successfully.</strong></h3>
  </div>
  </div>
  </div>

<?php } ?>


<div class="container" style="width: 75%"><br><br>
  <center>
    <div style="background-color: #fff; padding: 39px; border-radius: 3px;">
    <h3>USER ACTIVITY MAP</h3><small><select>
          <option value="0">Select Account to Filter</option>
          <?php $Q = $conn -> query("SELECT * FROM accounts WHERE verification = '1' ORDER BY id DESC ");
        while ($Data = mysqli_fetch_array($Q)) { ?>
          <option value="<?php echo $Data['id']; ?>" <?php echo ( $Data['id'] == $_GET['id'] ) ? "selected" : ""; ?> ><?php echo $Data['id']; ?> - <?php echo $Data['name']; ?></option>
          <?php } ?>
        </select></small><br><br>
    
    <table class="table table-hover table-bordered">
      <thead>
       <tr>
        <th>Account</th>
        <th>Keyword</th>
        <th>Date</th>
        <th>Time</th>
      </tr>
      </thead>
      <tbody>
        <?php 
        if ( isset($_GET['id']) ) {
          $aid = $_GET['id'];
          $Q = $conn -> query("SELECT * FROM user_search_map WHERE account_id = '$aid' ORDER BY id DESC LIMIT 2500 ");
        } else {
          $Q = $conn -> query("SELECT * FROM user_search_map ORDER BY id DESC LIMIT 2500 ");
        }
        
        while ($Data = mysqli_fetch_array($Q)) { ?>
          <tr>
            <td><?php echo "#".$id = $Data['account_id']." "; 
                $AQ = $conn -> query("SELECT * FROM accounts WHERE id = '$id'");
                $AD = $AQ -> fetch_assoc();
                echo $AD['name'];
            ?></td>
            <td><?php echo $Data['keyword']; ?></td>
            <td><?php echo $Data['date_']; ?></td>
            <td><?php echo $Data['time_']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>
  </center>
</div>


  </body>

  </html>

  <script type="text/javascript">
    $("select").change(function (e) {
      window.location.href="?id=" + $(this).val();
    });
  </script>

  <?php } ?>