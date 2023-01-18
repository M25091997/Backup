<?php 

//FCM

$message = array(

    "message" => str_replace("\'", "'", "hi 1"),

    "body" => str_replace("\'", "'", "hi 1"),

    "type" => "TEXT"

    );

$str = 'eFmGr_ZGT2iyrVWGjCK_-u:APA91bG-cDhC3rUVs2Eqs_YLLfZwm0VFKAWVwJyMtY-cvln0BsONvp_F5G6HR1XJQxrgS9na_4eJuPP9W5JoHR1OYs8gS_4pOStl0LlILFejIUy3nRqcNgZFpMXWn_56M_LAB4yd--7B,dd0A8qDgRG6EJmo8_CzAbp:APA91bHusxv4BHjXdP3F06Zn2oRBwgYRsRL0GYRHPazThPi-JoAcycDQ9Ehq5TQgbbQxVyLFPMM5gkomdgx8t8RESABkwKhKSZYJeLcm8jKkeDFe5tQyih45zi7OXqbpqhRW2GuJc9L_,d0qq0BN2QIKe8B3qHfpBuO:APA91bH3ewshyfn8Hx1JiEWXKOEJypQNfmpPkYpPI5FxykRDLtF0IpVloGoxf8pm08UjBzvd2nqSymRYWD4tnH4sVkSCsDzFLUnSDqjuzNUQi4i8NPcr5KgE17O1ASXtVt-g8Q15NPUw';
$arr = explode(",", $str);

//print_r($arr);

$tokens =  array( );

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


    'Authorization:key=AAAABO1TdAk:APA91bH0Yj-xN13yr9oSs-N45xHmKiV29SoZttF0RmUCMDILu_Qkg9Fmz_Rp3vxnQ_J8lv4VhbzoTlDUxmVJWEHKLBRNcbqSeYeGkKvgIX58w7KcQxnagoj1LbTAkM4xOKC8maKEW_gl'



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

print_r($result);

?>