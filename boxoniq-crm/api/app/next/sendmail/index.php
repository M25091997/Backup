<?php
include('../config.php');
  
$img_url = 'https://cms.cybertizeweb.com/boxoniq-crm/media';

$get_subscription_detail = $conn -> query("SELECT * FROM subs_booking WHERE user_id = 2 && iscancel = 0 && isskip = 0");
$row_subs_detail = mysqli_fetch_assoc($get_subscription_detail);
$user_id = $row_subs_detail['user_id'];
$process_id = $row_subs_detail['process_id'];
$date = $row_subs_detail['date'];
$address_id = $row_subs_detail['address_id'];
$final_total = $row_subs_detail['total'];



$get_user_detail = $conn -> query("SELECT * FROM accounts WHERE id = '$user_id' ");
$row_us_detail = mysqli_fetch_assoc($get_user_detail);
$user_name = $row_us_detail['name'];
$user_email = $row_us_detail['email'];
$user_phone = $row_us_detail['phone'];

$get_user_address = $conn -> query("SELECT * FROM saved_address WHERE id = '$address_id' ");
$row_us_address = mysqli_fetch_assoc($get_user_address);

$address = $row_us_address['full_address'];
$landmark = $row_us_address['landmark'];
$pincode = $row_us_address['pincode'];

$get_user_wallet = $conn -> query("SELECT * FROM wallet WHERE user_id = '$user_id' ");
$row_us_wallet = mysqli_fetch_assoc($get_user_wallet);

$wallet_balance = $row_us_wallet['amount'];


$get_orders = $conn -> query("SELECT * FROM subs_order WHERE process_id = '$process_id' ");
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
        <p>Dear '.$user_name.'</p></br>
        <p>Thank you for choosing our subscription plan. We hope you’ve been enjoying our services so far! </p></br>
        <p>As a friendly reminder, your next subscription box is ready to ship on DD/MM/YYYY.If you wish to continue the same bundle box, no action is required. Please maintain sufficient balance in your boxoniq wallet for your upcoming shipment. </p></br>
        <p><b>Wallet Balance :</b> Rs '.$wallet_balance.'</p></br>
        <p><b>Bundle Price :</b> Rs '.$final_total.'</p></br>

        <p>Below are the details of your subscribed product lists :</p></br>
        <p>Table of product along with price</p></br>
        

        <h1>SUSCRIPTION PRODUCT DETAIL</h1>
      </header>
      <main>
        <table>
          <thead>
            <tr>
              <th class="service">Sl.No</th>
              <th class="desc">PRODUCT NAME</th>
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
              $cart_id = $row_orders['sub_cart_id'];
              $sel_cart = $conn -> query("SELECT * FROM subs_cart WHERE id = '$cart_id'");
              $row_sel_cart = mysqli_fetch_assoc($sel_cart);
              $item_id = $row_sel_cart['item_id'];
              $attr_id = $row_sel_cart['attr_id'];
              $item_qty = $row_sel_cart['item_qty'];
              $attr_price = $row_sel_cart['attr_price'];
              $total = $attr_price * $item_qty;

              $select_item = $conn -> query("SELECT * FROM items WHERE id = '$item_id'");
              $row_sel_item = mysqli_fetch_assoc($select_item);
              $item_name = $row_sel_item['name'];
              $media_number = $row_sel_item['media_number'];

              $select_media = $conn -> query("SELECT * FROM media WHERE media_number = '$media_number'");
              $image = mysqli_fetch_assoc($select_media)['file_name'];
              $item_image = $img_url.$image;


              $message .= '<tr>';
              $message .= '<td class="service">'.$i.'</td>';
              $message .= '<td class="desc">'.$item_name.'</td>';
              // $message .= '<td class="desc"><img src="'.$item_image.'" width="50" height="50" /></td>';
              $message .= '<td class="desc">'.$attr_price.'</td>';
              $message .= '<td class="desc">'.$item_qty.'</td>';
              $message .= '<td class="desc">'.$total.'</td>';
              $message .= '</tr>';

              $i++;

            }
          }
           
            
           $message .= '</tbody>
        </table>
        <p><b>Modify Bundle:</b> To modify your bundle, Go to My subscription page and modify your bundle (before shipment date) as per your requirement for that particular month. Your updated bundle and amount will be processed on the shipment date</p></br>
        <p><b>Skip Subscription:</b> To skip the subscription for any particular month, just click on “skip for this month” button under my subscription page. Your box will be skipped for that month and will be resumed from next month. No amount will be deducted from wallet for that particular month</p></br>
        <p><b>Cancel Subscription:</b> To cancel subscription, click on “Cancel Subscription” under my subscription page and the subscription plan will be cancelled.</p></br>
        <p>If you have any questions, comments or suggestions, please reach out to hello@boxoniq.com</p></br>
        <p>Thank you again for choosing boxoniq subscription plan.</p></br>
        <p>Regards</p></br>
        <p>Team Boxoniq</p></br>
        <div id="notices">
          <div>NOTICE:</div>
          <div class="notice">Your bundle order will be skipped if wallet balance is not sufficient.</div>
        </div>
      </main>
      <footer>
        Invoice was created on a computer and is valid without the signature and seal.
      </footer>
    </body>
  </html>';

use PHPMailer\PHPMailer\PHPMailer;

function sendEmail($from, $to, $sub, $msg, $cc='', $bcc='') {

$body = $msg; 
$subject = $sub;

$email_to = $to;
$from = $from;
require 'vendor/autoload.php';
$mail = new PHPMailer();
$mail->From = $from;
$mail->FromName = 'Boxoniq';
$mail->addAddress($email_to);     // Add a recipient
// $mail->addAddress('ellen@example.com');               // Name is optional
// $mail->addReplyTo('info@example.com', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject;
$mail->Body    = $body;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

}

// $message = "testing email sent";

sendEmail('admin@boxoniq.com', $user_email, 'Order Detail', $message);
		