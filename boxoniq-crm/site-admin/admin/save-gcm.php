<?php

// $static_gcm = "https://cityindia.in/gcm-media/";

include ("../../config.php");

$media_number = $_REQUEST['media-number-head'];

$str = $_REQUEST['firebase-tokens'];
$arr = explode(",", $str);

$title = mysqli_real_escape_string($conn, $_REQUEST['title']);

$customer_id = $_REQUEST['customer-id'];

$is_image = $_REQUEST['is-image'];

$body = mysqli_real_escape_string($conn, $_REQUEST['body']);

$insert = $conn->query("INSERT INTO gcm (title, media_number, customer_id, body, is_image) VALUES('".$title."','".$media_number."','".$customer_id."','".$body."','".$is_image."')");


//Getting image

$iQ = $conn -> query("SELECT * FROM gcm_media WHERE media_number = '$media_number' LIMIT 1");

while ($imageRow = mysqli_fetch_array($iQ)) {

    $image = $site_url."/gcm-media/".$imageRow['file_name'];

}

//getting GCM id

$nQ = $conn -> query("SELECT * FROM gcm WHERE media_number = '$media_number'");

while ($nRow = mysqli_fetch_array($nQ)) {
    $gcm_id = $nRow['id'];
}


if ($insert) {

if ($is_image == "0") {

    $message = array(

    "message" => str_replace("\'", "'", $title),

    "body" => str_replace("\'", "'", $body),

    "type" => "TEXT",

    "intent-type" => $_REQUEST['intent-type'],

    "id" => $_REQUEST['intent-id'],

    "HEADER" => $_REQUEST['header-text']


    );

}else{

    $message = array(

    "message" => str_replace("\'", "'", $title),

    "body" => str_replace("\'", "'", $body),

    "image" => $image,

    "type" => "IMAGE",

    "intent-type" => $_REQUEST['intent-type'],

    "id" => $_REQUEST['intent-id'],

    "HEADER" => $_REQUEST['header-text']

    );

}

if ($_REQUEST['customer-id'] == "ALL") {

    # to all



$broadcast = "ALL";

$date_creation = date("Y-m-d");

$time_creation = date("h:i:s");

$broadcast_id = "0";



$insert_N = $conn->query("INSERT INTO NOTIFICATION_MANAGER (gcm_id, broadcast, date_creation, time_creation, broadcast_id) VALUES('".$gcm_id."','".$broadcast."','".$date_creation."','".$time_creation."','".$broadcast_id."')");


//FCM

$url = 'https://fcm.googleapis.com/fcm/send';

$fields = array(

    'registration_ids' => $arr, //tokens

    //"condition" => "'dogs' in topics || 'cats' in topics",

    //"to" => $firebaseToken, // to one token. sending single message

    //"to" => "/topics/news",

    'data' => $message

);

$headers = array('Content-Type: application/json',

    /*'Authorization:key=AAAA7JvrbTY:APA91bG-sIADHKinyKJ0MtiKcK2uE6eEq53of4w2RieAODZeZi_jPbA7RypxFLrW7VXHCkKPr4mXhb23qSftwMh6m6z-QRawTdCN-FVcohbf_YVsUVVHOTBtF1YA2_wWjnhl7GtFVO8n'*/


    'Authorization:key=AAAArNYULeM:APA91bHnvnJDrmOuxzIikuPEIftFwb9s4nBLiOu1QtAhI0b_DoJvQFQ8T7shKoC0i_Ekxp3fb6yotJeo59AwIzc2wktaj1irDMzkwuY1lbFxxd_7ya5WLiQntCefgOgx2-X26new-cOz'



);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

$result = curl_exec($ch);

if ($result == FALSE)

    die('Curl failed: ' . curl_error($ch));

curl_close($ch);



//END FCM

} else{ #ELSE TO CUSTOM CLIENT


    if ($_REQUEST['customer-id'] != "0") {

        #single client

$broadcast = "0";

$date_creation = date("Y-m-d");

$time_creation = date("h:i:s");

$broadcast_id = $_REQUEST['customer-id'];


$insert_N = $conn->query("INSERT INTO NOTIFICATION_MANAGER (gcm_id, broadcast, date_creation, time_creation, broadcast_id) VALUES('".$gcm_id."','".$broadcast."','".$date_creation."','".$time_creation."','".$broadcast_id."')");


//Fetching Token

$nnn = $conn -> query("SELECT * FROM accounts WHERE id = '$broadcast_id'");

while ($fsr = mysqli_fetch_array($nnn)) {

    $firebaseToken = $fsr['firebase_token'];

}


//FCM

$url = 'https://fcm.googleapis.com/fcm/send';

$fields = array(

    //'registration_ids' => $tokens, //tokens

    //"condition" => "'dogs' in topics || 'cats' in topics",

    "to" => $firebaseToken, // to one token. sending single message

    //"to" => "/topics/news",

    'data' => $message

);

$headers = array('Content-Type: application/json',

        /*'Authorization:key=AAAA7JvrbTY:APA91bG-sIADHKinyKJ0MtiKcK2uE6eEq53of4w2RieAODZeZi_jPbA7RypxFLrW7VXHCkKPr4mXhb23qSftwMh6m6z-QRawTdCN-FVcohbf_YVsUVVHOTBtF1YA2_wWjnhl7GtFVO8n'*/


    'Authorization:key=AAAArNYULeM:APA91bHnvnJDrmOuxzIikuPEIftFwb9s4nBLiOu1QtAhI0b_DoJvQFQ8T7shKoC0i_Ekxp3fb6yotJeo59AwIzc2wktaj1irDMzkwuY1lbFxxd_7ya5WLiQntCefgOgx2-X26new-cOz'

);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

$result = curl_exec($ch);

if ($result == FALSE)

    die('Curl failed: ' . curl_error($ch));

curl_close($ch);



//END FCM

    } else{ echo "Please Select Proper Broadcast type."; }

 } #CUSTOM SENDING ENDS

print_r("Push Notification Sent Successfully!.\nFCM RESPONSE :\n ".$result);


 }else{

    echo "Something went wrong, please try again.";

 }

?>

