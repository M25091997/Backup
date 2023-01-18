<?php
header('Content-Type:application/json');

// '' define all website access this api, or define custom website name inplace of ''.  
header('Access-Control-Allow-Origin: *');

// method post
header('Access-Control-Allow-Methods: POST');

// allow access all headers(use it for security reasons).
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include('config.php');
$result = array();

$data = json_decode(file_get_contents('php://input'), true);

$phone = $data['mobile'];
$name = $data['name'];
$email = $data['email'];
$password = $data['password'];
$baby_name = $data['baby_name'];
$baby_dob = $data['baby_dob'];

$refer_code = $data['refer_code'];

// print_r($_POST);
// exit();


    //CLEANUP

	
    //CLEANUP COMPLETED


if ( isset($name) && isset($email) && isset($phone) && isset($password) ) {

    $check_statement_mobile = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone' AND verification = '0'");

    while ($row_c = mysqli_fetch_array($check_statement_mobile)) {
        $to_delete_id = $row_c['id'];
        $conn -> query("DELETE FROM accounts WHERE id = '$to_delete_id'");
    }

$p_check = $conn -> query("SELECT * FROM accounts WHERE phone = '$phone'");
$p_check_2 = $conn -> query("SELECT * FROM accounts WHERE email = '$email'");

if (mysqli_num_rows($p_check) == 0 OR mysqli_num_rows($p_check_2) == 0) {

    if($refer_code==""){
        include('signup-without-refer.php');
    }else{
        $check_code = $conn -> query("SELECT COUNT(*) as check_count, id FROM accounts WHERE refer_code = '$refer_code'");
        $row_check_code = mysqli_fetch_assoc($check_code);
        $check_code_count = $row_check_code['check_count'];
        $refer_by = $row_check_code['id'];
        // print_r($check_code_count);
        // print_r($refer_by);
        // exit();
        if($check_code_count == 1){
            include('signup-with-refer.php');
        }else{
            $result = array( 'response' => '0' , 'msg' => "Invalid Refer Code. You Can Continue Register without Refer Code.."); 
        }
    }



} else { $result = array( 'response' => '0' , 'msg' => "Already Registered"); /* Account Already Exists*/ } 


} else { $result = array( 'response' => '0', 'msg' => "Something went wrong" ); /* Variable(s) not found */ } 

echo json_encode($result);
