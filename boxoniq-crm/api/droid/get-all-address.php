<?php
// header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('../../config.php');
$a = array();

$account_id = $_POST['account_id'];

if ($account_id) {

    $a_sql = "SELECT * FROM saved_address WHERE account_id = '$account_id' ORDER BY id DESC";
    $a_query = mysqli_query($conn, $a_sql);

    // true
    if ($a_query) {
        while ($row = mysqli_fetch_assoc($a_query)) {
            $id = $row['id'];
            $fa = $row['full_address'];
            $l = $row['landmark'];
            $p = $row['pincode'];
            $state = $row['state'];
            $phone = $row['phone'];
            $name = $row['user_name'];


            array_push($a, array('response' => '1', 'id' => $id, 'full_address' => $fa, 'landmark' => $l, 'pincode' => $p, 'state' => $state, 'phone' => $phone, 'name' => $name));
        }

        $result = array('response' => '1', 'address' => $a);
    } else {
        $result = array('response' => '0');
    }
} else {
    $result = array('response' => 'account id missing');
}



echo json_encode($result);
