<?php
// session_start();
include('../../../config.php');

// $result = array();

$email = $_POST['email'];
$password = $_POST['password'];

// print_r($_POST);
// exit();

if ( isset($_POST['email']) && isset($_POST['password']) ) {

$select_creator = $conn -> query("SELECT * FROM user WHERE email = '$email' AND password = '$password'");

if (mysqli_num_rows($select_creator) > 0) {
	while ( $row = mysqli_fetch_array($select_creator) ) {

	$user_id = $row['id'];
	$result = array( 'response' => 1, 'user-id' => $user_id, 'msg' => 'Successfully LoggedIn..');
	
	}
}else{$result = array( 'response' => 0, 'msg' => 'Email or Password field is wrong' ); }	
 
	

} else { $result = array( 'response' => 0, 'msg' => 'Email or Password field is blank' ); }

echo json_encode($result);

?>