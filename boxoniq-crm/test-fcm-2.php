<?php
    $url = "https://fcm.googleapis.com/fcm/send";
    //device token
    $token = "dXkOo3OMSOOu0Ax7eBe1J0:APA91bHFkViw_uQ-ZXZT-LoI0v3Uhf1g5NlF-cv4UFhUCqiFhvXk32lXNdqyzV0XP_yVqwGkezJGFyGR4dmSNEH5Uy_gxbgHIJI87TDXp4y7wA14OvgYPgBeJ5bGG7CjVGJvCMSzG2dK";

    //firebase token
    $serverKey = 'AAAABO1TdAk:APA91bH0Yj-xN13yr9oSs-N45xHmKiV29SoZttF0RmUCMDILu_Qkg9Fmz_Rp3vxnQ_J8lv4VhbzoTlDUxmVJWEHKLBRNcbqSeYeGkKvgIX58w7KcQxnagoj1LbTAkM4xOKC8maKEW_gl';

    $title = "Hello ";

    $body = "Good Evening";

    $notification = array('title' =>$title , 'body' => $body, 'sound' => 'default', 'badge' => '1');
    $arrayToSend = array('notification' => $notification,'priority'=>'high');

    $json = json_encode($arrayToSend);    
    $headers = array();
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: key='. $serverKey;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
    //Send the request
    $response = curl_exec($ch);
    //Close request
    if ($response === FALSE) {
    die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
?>