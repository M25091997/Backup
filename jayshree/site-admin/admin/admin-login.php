<?php 
session_start();
include ('../../config.php');
$username = $_REQUEST['email'];
$password = $_REQUEST['password'];




	$sql_res = $conn -> query("SELECT * FROM admin WHERE username = '$username' AND password = '$password'");

	if ( mysqli_num_rows($sql_res) != 0 ) {
	
   	while($row=mysqli_fetch_array($sql_res)){
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role_id'] = $row['role_id'];

            $userQ = $conn -> query("SELECT * FROM admin_roles WHERE id = '$role_id'");
			while ($userMETA = mysqli_fetch_array($userQ)) { $_SESSION['role'] = $userMETA['value']; }


            }

            echo 1;

	}

	

	else{

		echo 2;

	}
