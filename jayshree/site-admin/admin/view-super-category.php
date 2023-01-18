<?php

session_start();

include("../../config.php");

$media_number = rand() . time();

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

    <title>View Super Category</title>

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


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>





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
    </style>

    <!-- Floating Button ENDS-->

  </head>

  <body style="background-color: #fff;">
    <!-- Code begins here -->

    <a href="index.php" class="float">
      <i class="fa fa-home my-float"></i>
    </a>

    <!-- Code ENDS here -->
    <div class="container" style="background-color: #fff;">



      <div class="row">

        <div class="col-md-12">

          <h3>All Super Category</h3>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Set Priority</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>

              <?php $msg_query = $conn->query("SELECT * FROM super_category");

              while ($sData = mysqli_fetch_array($msg_query)) {
                $id = $sData['id'];
                $name = $sData['name'];
                $media_no = $sData['media_number'];
                $priority_no = $sData['priority_no'];

                if ($media_no != '') {
                  $sql = "SELECT * FROM media WHERE media_number='$media_no'";
                  $query = mysqli_query($conn, $sql);
                  $count = mysqli_num_rows($query);
                  if ($count > 0) {
                    $row = mysqli_fetch_assoc($query);
                    $filename = $row['file_name'];
                  }
                } else {
                  $filename = "user_default.png";
                }
                $img = $filename;

              ?>
                <tr>
                  <th scope="row"><?php echo $id ?></th>
                  <td><?php echo $name ?></td>
                  <td><img src="../../media/<?php echo $img;  ?>" width="50" height="50"></td>
                  <td>
                    <input type="number" value="<?php echo $priority_no ?>" class="set_priority-<?php echo $id ?>">
                    <button class="btn btn-primary btn-xs set" set_category_id="<?php echo $id ?>">Set</button>
                  </td> 
                  <td>
                    <!-- <button class="btn btn-warning edit_del_boy" del_edit_id=<?php echo $id ?> data-toggle="modal" data-target="#editDel"><i class="fa fa-pencil" aria-hidden="true"></i></button> -->
                    <button class="btn btn-danger delete_super" del_delete_id=<?php echo $id ?>><i class="fa fa-trash" aria-hidden="true"></i></button>
                  </td>
                </tr>
              <?php } ?>


            </tbody>
          </table>




        </div>


      </div>

    </div>

    <div class="modal fade" id="editDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Delivery Boy</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" action="action/update_delivery_boy.php">
              <input type="hidden" name="update_id" id="update_id">
              <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" id="name" name="name">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Contact No</label>
                <input type="text" class="form-control" id="contact_no" name="contact">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="email_id" name="email">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Address</label>
                <input type="text" class="form-control" id="address" name="address">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Landmark</label>
                <input type="text" class="form-control" id="landmark" name="landmark">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Pincode</label>
                <input type="text" class="form-control" id="pincode" name="pincode">
              </div>

              <!-- <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div> -->

              <button type="submit" name="updateDelBoy" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </body>

  </html>

  <script>
    $(document).ready(function() {

      $(".edit_del_boy").click(function() {
        var del_edit_id = $(this).attr('del_edit_id');
        // alert(del_edit_id);
        $.ajax({
          url: "action/get_modal_data.php",
          method: "POST",
          data: {
            updateDelBoy: 1,
            del_id: del_edit_id
          },
          dataType: "json",
          success: function(data) {
            $('#update_id').val(data.id);
            $('#name').val(data.name);
            $('#contact_no').val(data.contact);
            $('#email_id').val(data.email);
            $('#address').val(data.address);
            $('#landmark').val(data.landmark);
            $('#pincode').val(data.pincode);
          }
        });
      });

      $(".delete_super").click(function() {
        var del_delete_id = $(this).attr('del_delete_id');
        // alert(del_delete_id);
        $.ajax({
          url: "action/delete_category.php",
          method: "POST",
          data: {
            deleteSuperCategory: 1,
            del_id: del_delete_id
          },
          dataType: "json",
          success: function(data) {
            if (data.response == 1) {
              alert('Deleted Successfully');
              location.reload();
            } else {
              alert('Something went wrong');
            }
          }
        });
      });

    })
  </script>

  <!-- <script type="text/javascript">
$(".add-pincode-btn").click(function(){
var dataString = 'pincode='+ $(".pincode").val()+'&price='+ $(".pin-price").val()+'&delivery='+ $(".pin-delivery").val() + '&media-number=<?php echo $media_number; ?>';
$.ajax({
type: "POST",
url: "save-pincode.php",
data: dataString,
cache: false,
success: function(html)
{
 $(".pins").append("" + $(".pincode").val() + ", Rs. " + $(".pin-price").val() + ", Delivery in " + $(".pin-delivery").val() + " Days.<br>");
$(".pincode").val("");
$(".pin-delivery").val("");
$(".pin-price").val("");
}
});
});
</script> -->

  <script>
    /* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
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
      //alert($(this).attr("item-name"));

      // $("tbody").append('<tr><td style="font-size: 10px;" >Platinum Plus Plan - 9 Currency Package for 3 months Forecast for 9 Currencie...</td> <td style="font-size: 10px;" ><center>1</center></td>  <td style="font-size: 10px;"><i class="fa fa-inr"></i>5,000</td> <td style="font-size: 10px;"><i class="fa fa-inr"></i>5,000</td> </tr>');
      document.getElementById("myDropdown").classList.toggle("show");

      $("[name=item_id]").val($(this).attr("item-id"));

      $(".a-holder").html('<i class="fa fa-user-circle-o" aria-hidden="true"></i> ' + $(this).html() + '<br><small class="small-hint">Click to Reselect <i class="fa fa-chevron-down" aria-hidden="true"></i></small> <br>');

      $("[name=price]").focus();

    });

    $(".set").click(function() {   
    var set_category_id = $(this).attr('set_category_id');
    var prior_id = $('.set_priority-'+set_category_id).val();
    // alert(prior_id);
    // alert(set_category_id);

    // return;
     $.ajax({
                url:"action/update_priority.php",
                method:"POST",
                data:{updateCategoryPriority:1,prior_id:prior_id, category_id:set_category_id},
                // dataType:"json",
                success:function(data){
                    alert(data);
                }
            });
 });
  </script>



<?php } ?>