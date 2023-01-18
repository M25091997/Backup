<?php
session_start();
include('config.php');

session_destroy();
unset($_SESSION['username']);
unset($_SESSION['account-id']);

header("Location: ".$site_url);

?>