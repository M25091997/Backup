<?php session_start(); ?>
<?php include ("config.php"); 

$amount = $_SESSION['total_cart_value'];
$booking_id = rand();

if ( $amount < 499 ) { $amount = ($amount + 50); }

/*Buyer Details*/

$account_id = $_SESSION['account-id'];
$msg_query = $conn -> query("SELECT * FROM accounts WHERE id = '$account_id'");  
            while ($msg_q = mysqli_fetch_array($msg_query)) {
            
            $buyer_name = $msg_q['name'];
            $buyer_phone = $msg_q['phone'];     
            $buyer_email = $msg_q['email'];

            }


//Payment Initiating
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:c681b7e5052a152610771614615bb439",
                  "X-Auth-Token:d2539cec35f22cf0c5d5d9e43af6f184"));
$payload = Array(

    'product' => "Booking ID: ".$booking_id,
    'paid_for' => "Booking ID: ".$booking_id,
    'purpose' => 'Payment for ORDER ID'.$booking_id,
    'amount' => $amount,
    'phone' => $buyer_phone,
    'buyer_name' => $buyer_name,
    'redirect_url' => $site_url."/payment-gateway-response.php",
    'send_email' => false,
    'webhook' => $site_url."/payment-hook.php",
    'send_sms' => false,
    'email' => $buyer_email,
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);

/*print_r( $response = curl_exec($ch) ); USING THIS FOR ANY ERRORS FROM INSTAMOJO SIDE*/

curl_close($ch); 

$myArray = json_decode($response, true);
$url = $myArray['payment_request']['longurl'];

header('Location: '.$url);