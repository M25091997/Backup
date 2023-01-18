<?php
// the message
$message = '
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <title>Subscription Product Detail</title>
    </head>
    <body>
    <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
  <div style="margin:50px auto;width:70%;padding:20px 0">
    <div style="border-bottom:1px solid #eee">
      <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">Your Brand</a>
    </div>
    <p style="font-size:1.1em">Hi,</p>
    <p>Thank you for choosing Your Brand. Use the following OTP to complete your Sign Up procedures. OTP is valid for 5 minutes</p>
    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">324457</h2>
    <p style="font-size:0.9em;">Regards,<br />Your Brand</p>
    <hr style="border:none;border-top:1px solid #eee" />
    <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
      <p>Your Brand Inc</p>
      <p>1600 Amphitheatre Parkway</p>
      <p>California</p>
    </div>
  </div>
</div>
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
  </html>
  ';

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
// $headers .= 'From: <webmaster@example.com>' . "\r\n";
// $headers .= 'Cc: myboss@example.com' . "\r\n";

// send email
$result = mail("iamgolu9798@gmail.com","My subject",$message, $headers);

if($result){
    echo "mail sent";
}else{
    echo "not sent";
}


?>