<?php 

$site_url = "https://cityindia.in";

$the_project = "CityIndia";

/*Setting Timezone*/
date_default_timezone_set('Asia/Calcutta'); 

	$dbHost = 'localhost';

	$dbUsername = 'u565281308_nik';

	$dbPassword = 'V8^d@>KaBe!v';

	$dbName = 'u565281308_cityindia_test';

	//connect with the database

	$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

/*Message Sending Function*/
function _SEND_MESSAGE( $phone = "7004286568", $msg = "Hii, Test Message" ){
$api_key = '25EE86EAE2D99B';
$contacts = $phone;
$from = 'IALERT';
$sms_text = urlencode($msg);

//Submit to server

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, "http://kutility.in/app/smsapi/index.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&entity=&tempid=999999999999999&routeid=415&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text);
//$response = curl_exec($ch);
curl_close($ch);
return $response;

}



/*Message Sending NEW Function*/

function _SEND_MESSAGE_NEW( $phone = "7004286568", $msg = "Hii, Test Message", $template_id = "1207161761199657681" ){

$api_key = '4606EA01F14FA4';

$contacts = $phone;

$from = 'CYBSMS';

$template_id = $template_id;

$sms_text = urlencode($msg);



//Submit to server



$ch = curl_init();

curl_setopt($ch,CURLOPT_URL, "http://sms.kutility.com/app/smsapi/index.php");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS, "key=".$api_key."&campaign=11291&routeid=7&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text."&template_id=".$template_id);

$response = curl_exec($ch);

curl_close($ch);

return $response;



}



function slugify($string){
    $string = strtolower($string);
    $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return $slug."-".rand();
}

function reverseSlugify ( $slug ) { 

	$string = str_replace("-", " ", $slug);
	$string = ucfirst($string);
	return $string;

}


function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


function star_rating ( $rating = 0 ) {

    if ( $rating > 0 && $rating < 1  ) { #for 0 - 0.5
        echo '<i class="fa fa-star-half-o"></i>';
    } 

    if ( $rating >= 1 && $rating < 2  ) { #for 1 - 1.5

        if ( $rating == 1  ) { echo '<i class="fa fa-star"></i>'; }

        else if ( $rating < 2  ) { echo '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>'; }
        
    }

    if ( $rating >= 2 && $rating < 3  ) {

        if ( $rating == 2  ) { echo '<i class="fa fa-star"></i><i class="fa fa-star"></i>'; }

        else if ( $rating < 3  ) { echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>'; }
        
    } 

    if ( $rating >= 3 && $rating < 4  ) {

        if ( $rating == 3  ) { echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>'; }

        else if ( $rating < 4  ) { echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>'; }
        
    } 

    if ( $rating >= 4 && $rating < 5  ) {

        if ( $rating == 4  ) { echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>'; }

        else if ( $rating < 5  ) { echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>'; }
        
    } 


    if ( $rating == 5 ) {

        echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
        
    } 


}


function NumberFilter( $mobile = '7004286568' ){    

    if (strlen($mobile) == 13 && substr($mobile, 0, 3) == "+91")
    {
        $mobile = substr($mobile, 3, 10);
    }

    return $mobile;

} 


/*Coupon CODE Function*/



function APPLY_COUPON ($_coupon_code, $_amount, $_plan = 0 ) { #2 FUNCTION



global $conn;



$qC = $conn -> query("SELECT * FROM coupon WHERE code = '$_coupon_code'");





if ( mysqli_num_rows($qC) != 0 ) { #MAIN IF





while ($cData = mysqli_fetch_array($qC)) { #1

    $_AMOUNT_ = $cData['amount'];

    $_FLAG_ = $cData['flag'];

    $_CONDITION_ = $cData['cond'];

    $_CONDITION_AMOUNT_ = $cData['cond_amount'];

    $_plan_ = $cData['plan'];

    $_max = $cData['max'];

    $_max_used = $cData['max_used'];

    $_time = $cData['time_'];

    $_date = $cData['date_'];



    $_start_time = $cData['start_time'];

    $_start_date = $cData['start_date'];







  // Start date

  $date = $_start_date;

  // End date

  $end_date = $_date;



  //$now = date("h:i a");

  $now = date("Y-m-d");



  

if ( $now >= $date && $now <= $end_date ) {#TIME IF  



if ($_max_used < $_max) { #MAX IF





if ($_FLAG_ == "PERCENT") { #3 If Percentage discount





        if ($_CONDITION_ == "G") {

            //IF Amount Greater Than

            if ( $_amount > $_CONDITION_AMOUNT_ ) { return $__FINAL_AMOUNT = $_amount - ( $_amount * ($_AMOUNT_ / 100 )); }

            else{ return false; } #FAILED



        } elseif ($_CONDITION_ == "E") {

            //IF Amount EQUALS

            if ( $_amount == $_CONDITION_AMOUNT_ ) { return $__FINAL_AMOUNT = $_amount - ( $_amount * ($_AMOUNT_ / 100 )); }

            else{ return false; } #FAILED



        } elseif ($_CONDITION_ == "L") {

            //IF Amount Less Than

            if ( $_amount < $_CONDITION_AMOUNT_ ) { return $__FINAL_AMOUNT = $_amount - ( $_amount * ($_AMOUNT_ / 100 )); }

            else{ return false; } #FAILED



        } elseif ($_CONDITION_ == "L_E") {

            //IF Amount Less Than Equals

            if ( $_amount <= $_CONDITION_AMOUNT_ ) { return $__FINAL_AMOUNT = $_amount - ( $_amount * ($_AMOUNT_ / 100 )); }

            else{ return false; } #FAILED



        } elseif ($_CONDITION_ == "G_E") {

            //IF Amount Greater Than Equals

            if ( $_amount >= $_CONDITION_AMOUNT_ ) { return $__FINAL_AMOUNT = $_amount - ( $_amount * ($_AMOUNT_ / 100 )); }

            else{ return false; } #FAILED



        } else{  }





} #3



elseif ($_FLAG_ == "FLAT") { #4 If Flat discount



        if ($_CONDITION_ == "G") {

            //IF Amount Greater Than

            if ( $_amount > $_CONDITION_AMOUNT_ ) { return $__FINAL_AMOUNT = ($_amount - $_AMOUNT_ ); }

            else{ return false; } #FAILED



        } elseif ($_CONDITION_ == "E") {

            //IF Amount Equals

            if ( $_amount == $_CONDITION_AMOUNT_ ) { return $__FINAL_AMOUNT = ($_amount - $_AMOUNT_ ); }

            else{ return false; } #FAILED



        } elseif ($_CONDITION_ == "L") {

            //IF Amount Less Than

            if ( $_amount < $_CONDITION_AMOUNT_ ) { return $__FINAL_AMOUNT = ($_amount - $_AMOUNT_ ); }

            else{ return false; } #FAILED



        } elseif ($_CONDITION_ == "L_E") {

            //IF Amount Less Than Equals

            if ( $_amount <= $_CONDITION_AMOUNT_ ) { return $__FINAL_AMOUNT = ($_amount - $_AMOUNT_ ); }

            else{ return false; } #FAILED



        } elseif ($_CONDITION_ == "G_E") {

            //IF Amount Greater Than Equals

            if ( $_amount >= $_CONDITION_AMOUNT_ ) { return $__FINAL_AMOUNT = ($_amount - $_AMOUNT_ ); }

            else{ return false; } #FAILED



        } else{  }

    

}#4





} #MAX IF 

else{ return false; } #MAX INVALID





} #TIME IF 

else{ return false; } #TIME INVALID







} #1



} #MAIN IF

else{ return false; } #IF NOT VALID



} #2 FUNCTION CLOSE



?>