<?php 

//FCM
$url = 'https://fcm.googleapis.com/fcm/send';

$fields = array(

    //'registration_ids' => $tokens, //tokens

    //"condition" => "'dogs' in topics || 'cats' in topics",

    //"to" => "dXkOo3OMSOOu0Ax7eBe1J0:APA91bHFkViw_uQ-ZXZT-LoI0v3Uhf1g5NlF-cv4UFhUCqiFhvXk32lXNdqyzV0XP_yVqwGkezJGFyGR4dmSNEH5Uy_gxbgHIJI87TDXp4y7wA14OvgYPgBeJ5bGG7CjVGJvCMSzG2dK", // to one token. sending single message

    "to" => "/topics/news",

    'data' => $message

);

$headers = array('Content-Type: application/json',
    'Authorization:key=AAAAryzXiv8:APA91bFkwgk8X4rX3Ad7uv8YldTKi25DCWU-JlBkKbOn4RKipRWRhu6wkCOuqPRZx6cvBlaFYPJICY8o9PtC6C0O1NYmW0QATbPv-T-T8H6M9VfVERSpLLocoVVLLnijDbHyBlAIVXNx'
);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

$result = curl_exec($ch);

print_r($result);


if ($result == FALSE)

    die('Curl failed: ' . curl_error($ch));

curl_close($ch);

//END FCM

?>
