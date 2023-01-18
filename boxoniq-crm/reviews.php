<?php session_start();
include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>

    <style type="text/css">
        .card-inner{
    margin-left: 4rem;
}
    </style>
</head>
<body>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!--To Work with icons-->
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<br>
<div class="container">    
    

        <?php 

        $item_id = $_GET['pid'];
        $q = $conn -> query("SELECT * FROM ratings WHERE item_id = '$item_id' ORDER BY id DESC ");

        while ($R_D = mysqli_fetch_array( $q )) { 

            $account_id = $R_D['account_id'];

            $AQ = $conn -> query("SELECT * FROM accounts WHERE id = '$account_id'");

            while ($AD = mysqli_fetch_array($AQ)) {
                $account_name = $AD['name'];
            }

            $rating = $R_D['rating'];

            ?>


            <div class="card" style="left: -11%; border-right: 0; border-left: 0; border-radius: 0;">
             <div class="card-body">
            <div class="row">
                <div class="col-md-1 col-xs-1">
                    <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img-responsive img-rounded img-fluid"/>
                    
                </div>
                <div class="col-md-11 col-xs-11">
                    <p>
                        <a class="float-left" href="#"><strong><?php echo $account_name; ?></strong></a>
                        <?php for ($i=0; $i < $rating ; $i++) { ?>
                            <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                        <?php } ?>

                   </p>
                   <div class="clearfix"></div>
                    <p><?php echo $R_D['review']; ?></p>
                    <p class="text-secondary" style="font-size: 10px;"><?php echo time_elapsed_string($R_D['date_creation'].' '.$R_D['time_creation']); ?></p>
                    <p>
                        <!--<a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
                        <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a> -->
                   </p>
                </div>
            </div>
        </div>
    </div>


        <?php } ?>

       
    

</div>

</body>
</html>