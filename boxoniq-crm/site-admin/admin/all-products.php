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

  <title>All PRODUCTS</title>

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
    font-size: 12px;
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

  <div class="row"><center><h2>All Products</h2></center></div>

  <div class="row">

    <table class="table table-bordered">







      <thead>







        <tr>

          <th>ID</th>

          <th> PRODUCT NAME </th>

          <th> CATEGORY </th>

          <th> SUB CATEGORY </th>

          <th> BRAND </th>

          <th> SET PRIORITY</th>

          <th> ATTRIBUTES </th>

          <th> CREATED</th>

          <th> VIEWS</th>

          <th> SOLD </th>

        </tr>

      </thead>

      <tbody>

        <?php $cQ = $conn -> query("SELECT * FROM items ORDER BY id DESC "); 

        while ($rowD = mysqli_fetch_array($cQ)) {
          $id = $rowD['id'];
          $name = $rowD['name'];
          $creation_date = $rowD['creation_date'];
          $creation_time = $rowD['creation_time']; 
          $category_id = $rowD['category_id'];
          $sub_category_id = $rowD['sub_category_id'];
          $brand_id = $rowD['brand_id'];
          $priority_no = $rowD['priority_no'];


          $category_Q = $conn -> query("SELECT * FROM super_category WHERE id = '$category_id'");
          while ($iData = mysqli_fetch_array($category_Q)) {
            $category_name = $iData['name'];
          }

          $sub_category_Q = $conn -> query("SELECT * FROM category WHERE id = '$sub_category_id'");
          while ($iData = mysqli_fetch_array($sub_category_Q)) {
            $sub_category_name = $iData['name'];
          }

          $sub_category_Q = $conn -> query("SELECT * FROM brand WHERE id = '$brand_id'");
          while ($iData = mysqli_fetch_array($sub_category_Q)) {
            $brand_name = $iData['brand_name'];
          }

          $viewQ = $conn -> query("SELECT * FROM item_views WHERE item_id = '$id'");
          $total_views = mysqli_num_rows($viewQ);


          $attrQ = $conn -> query("SELECT * FROM attributes WHERE item_id = '$id'");
          $total_attributes = mysqli_num_rows($attrQ);


          // $purchaseQ = $conn -> query("SELECT * FROM cart WHERE item_id = '$id' AND checkout = '1'");
          // $total_purchased = mysqli_num_rows($purchaseQ);
          $purchaseQ = $conn -> query("SELECT SUM(quantity) as quan FROM cart WHERE item_id = '$id' AND checkout = '1'");
          $total_pur = mysqli_fetch_assoc($purchaseQ);
          $total_purchased = $total_pur['quan'];

          ?>

          <tr>
     
          <td><?php echo $id; ?></td>

          <td><?php echo $name; ?> <a href="edit-product.php?id=<?php echo $id; ?>" style="float: right;"> <i class="fa fa-edit"></i> </a> <a href="delete-product.php?id=<?php echo $id; ?>" style="float: right;  margin-right: 4%;"> <i class="fa fa-trash"></i> </a> </td>

          <td><?php echo $category_name; ?></td>
          <td><?php echo $sub_category_name; ?></td>
          <td><?php echo $brand_name; ?></td>
          <td>
              <input type="number" value="<?php echo $priority_no ?>" class="set_priority-<?php echo $id; ?>">
              <button class="btn btn-primary btn-xs set_prior" set_item_id="<?php echo $id; ?>">Set</button>
          </td>

          <td><?php echo $total_attributes; ?> <a title="View All Attributes & Sales" href="edit-product.php?id=<?php echo $id; ?>" target="_blank" style="float: right;"> View / Sales <i class="fa fa-eye"></i> </a> </td>

          <td><?php echo $creation_date; ?></td>

          <td><?php echo $total_views; ?></td>

          <td><?php echo $total_purchased; ?> <a href="item-wise-sales.php?id=<?php echo $id; ?>" target="_blank">View sale(s) <i class="fa fa-long-arrow-right" aria-hidden="true"></i> </a> </td>

          

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
   $(".set_prior").click(function() {   
    var set_item_id = $(this).attr('set_item_id');
    var prior_id = $('.set_priority-'+set_item_id).val();
    // alert(prior_id);
    // alert(set_item_id);

    // return;
     $.ajax({
                url:"action/update_priority.php",
                method:"POST",
                data:{updateProductPriority:1,prior_id:prior_id, item_id:set_item_id},
                // dataType:"json",
                success:function(data){
                    alert(data);
                }
            });
 });
</script>