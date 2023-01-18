<?php
$to = "prabhakar9374@gmail.com";

$subject = "Job Offer";

$message = "Would you be interested in working with us?";

$from = "nik2012roy@gmail.com";

 

//Sending email

if(mail($to, $subject, $message)) {

echo "Your mail has been sent successfully.";

} else{

echo "Unable to send email. Please try again.";

}

?>