<?php
  include('config.php');
  $img_url = 'https://cms.cybertizeweb.com/boxoniq-crm/media/';

  $get_subscription_detail = $conn -> query("SELECT * FROM subs_booking_history WHERE iscancel = 0 ");
  $row_subs_detail = mysqli_fetch_assoc($get_subscription_detail);
  $user_id = $row_subs_detail['user_id'];
  $process_id = $row_subs_detail['process_id'];
  $subprocess_id = $row_subs_detail['subprocess_id'];
  $address_id = $row_subs_detail['address_id'];
  $date = $row_subs_detail['date'];

  $get_user_detail = $conn -> query("SELECT * FROM accounts WHERE id = '$user_id' ");
  $row_us_detail = mysqli_fetch_assoc($get_user_detail);
  $user_name = $row_us_detail['name'];
  $user_email = $row_us_detail['email'];
  $user_phone = $row_us_detail['phone'];

  $get_user_address = $conn -> query("SELECT * FROM saved_address WHERE id = '$address_id'");
  $row_add = mysqli_fetch_assoc($get_user_address);
  $address = $row_add['full_address'];
  $landmark = $row_add['landmark'];
  $pincode = $row_add['pincode'];

  $get_orders = $conn -> query("SELECT * FROM subs_order_history WHERE process_id = '$process_id' ");
  $count_orders = mysqli_num_rows($get_orders);


    $to = "$user_email";
    $subject = "Subscription Detail";
    $message = '
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <title>Subscription Product Detail</title>
        <link rel="stylesheet" href="style.css" media="all" />
        <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
          }
          
          a {
            color: #5D6975;
            text-decoration: underline;
          }
          
          body {
            position: relative;
            width: 21cm;  
            height: 29.7cm; 
            margin: 0 auto; 
            color: #001028;
            background: #FFFFFF; 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            font-family: Arial;
          }
          
          header {
            padding: 10px 0;
            margin-bottom: 30px;
          }
          
          #logo {
            text-align: center;
            margin-bottom: 10px;
          }
          
          #logo img {
            width: 90px;
          }
          
          h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
          }
          
          #project {
            float: left;
          }
          
          #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
          }
          
          #company {
            float: right;
            text-align: right;
          }
          
          #project div,
          #company div {
            white-space: nowrap;        
          }
          
          table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
          }
          
          table tr:nth-child(2n-1) td {
            background: #F5F5F5;
          }
          
          table th,
          table td {
            text-align: center;
          }
          
          table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;        
            font-weight: normal;
          }
          
          table .service,
          table .desc {
            text-align: left;
          }
          
          table td {
            padding: 20px;
            text-align: right;
          }
          
          table td.service,
          table td.desc {
            vertical-align: top;
          }
          
          table td.unit,
          table td.qty,
          table td.total {
            font-size: 1.2em;
          }
          
          table td.grand {
            border-top: 1px solid #5D6975;;
          }
          
          #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
          }
          
          footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
          }
        </style>
      </head>
      <body>
        <header class="clearfix">
          <div id="logo">
            <img src="https://cms.cybertizeweb.com/boxoniq-crm/img/logo.jpeg">
          </div>
          <h1>SUSCRIPTION PRODUCT DETAIL</h1>
          <div id="company" class="clearfix">
            <div>Boxoniq</div>
            <div>455 Foggy Heights,<br /> AZ 85004, Harmu</div>
            <div>(602) 23134211</div>
            <div><a href="mailto:company@example.com">company@example.com</a></div>
          </div>
          <div id="project">
            <div><span>Customer</span>'.$user_name.'</div>
            <div><span>ADDRESS</span>'.$address.'</div>
            <div><span>EMAIL</span> <a href="mailto:'.$user_email.'">'.$user_email.'</a></div>
            <div><span>DATE</span>'.$date.'</div>
            <div><span>DUE DATE</span>'.$date.'</div>
          </div>
        </header>
        <main>
          <table>
            <thead>
              <tr>
                <th class="service">Sl.No</th>
                <th class="desc">PRODUCT NAME</th>
                <th class="desc">Image</th>
                <th class="desc">PRICE</th>
                <th class="desc">QTY</th>
                <th class="desc">TOTAL</th>
              </tr>
            </thead>
            <tbody>
            ';

            if($count_orders > 0){
              $i=1;
              while($row_orders = mysqli_fetch_assoc($get_orders)){
                $sub_cart_id = $row_orders['sub_cart_id'];
                $sel_cart = $conn -> query("SELECT * FROM subs_cart WHERE id = '$sub_cart_id'");
                $row_sel_cart = mysqli_fetch_assoc($sel_cart);
                $item_id = $row_sel_cart['item_id'];
                $attr_id = $row_sel_cart['attr_id'];
                $attr_price = $row_sel_cart['attr_price'];
                $item_qty = $row_sel_cart['item_qty'];
                $total = $attr_price * $item_qty;

                $select_item = $conn -> query("SELECT * FROM items WHERE id = '$item_id'");
                $row_sel_item = mysqli_fetch_assoc($select_item);
                $item_name = $row_sel_item['name'];
                $media_number = $row_sel_item['media_number'];

                $select_media = $conn -> query("SELECT * FROM cover_media WHERE media_number = '$media_number'");
                $image = mysqli_fetch_assoc($select_media)['file_name'];
                $item_image = $img_url.$image;


                $message .= '<tr>';
                $message .= '<td class="service">'.$i.'</td>';
                $message .= '<td class="desc">'.$item_name.'</td>';
                $message .= '<td class="desc"><img src="'.$item_image.'" width="50" height="50" /></td>';
                $message .= '<td class="unit">'.$attr_price.'</td>';
                $message .= '<td class="qty">'.$item_qty.'</td>';
                $message .= '<td class="total">'.$total.'</td>';
                $message .= '</tr>';

                $i++;

              }
            }
             
              
             $message .= '</tbody>
          </table>
          <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
          </div>
        </main>
        <footer>
          Invoice was created on a computer and is valid without the signature and seal.
        </footer>
      </body>
    </html>';
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\b";
    $headers .= 'From: name' . "\r\n";
    mail($to, $subject, $message, $headers);
    if(mail){
        $result = array('msg' => 'Email sent successfully');
    }else{
        $result = array('msg' => 'something went wrong');
    }

    echo json_encode($result);
?>