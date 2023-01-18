<?php
function CancelShipment($tracking_number)
{
$url = 'https://pickrr.com/api/order-cancellation/';
    $data = array (
        'tracking_id' => $tracking_number,
        'auth_token' => 'e2495ab1f1aa403c0fcb12e9e7fffed9135608'
        );

        $params = '';
    foreach($data as $key=>$value)
                $params .= $key.'='.$value.'&';

        $params = trim($params, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url.'?'.$params ); //Url together with parameters
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Return data instead printing directly in Browser
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT , 7); //Timeout after 7 seconds
    curl_setopt($ch, CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $result = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($result, true);

    print_r ($json);

    // for( $i = 0; $i<count(($json['track_arr'])); $i++ ){
    //     print_r ($json['track_arr'][$i]['status_array'][0]['status_time']); echo "\n";
    //     print_r ($json['track_arr'][$i]['status_array'][0]['status_body']); echo "\n";
    //     print_r ($json['track_arr'][$i]['status_array'][0]['status_location']); echo "\n";
    //     echo "\n";
    // }

}

CancelShipment("WSPC1054609357");   //example calls
?>