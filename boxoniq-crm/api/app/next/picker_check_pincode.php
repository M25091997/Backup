<?php
$pincode= $_POST['pincode'];
function PincodeServiceCheck($from_pincode,$to_pincode)
{
	$url = 'https://pickrr.com/api/check-pincode-service/';

    $data = array (
        'from_pincode' => $from_pincode,
        'to_pincode' => $to_pincode,
        'auth_token' => 'e2495ab1f1aa403c0fcb12e9e7fffed9135608',
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
    echo $result;

}

PincodeServiceCheck("834004",$pincode);   //example calls
?>