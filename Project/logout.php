<?php
session_start();

require_once "connection.php";

if(isset($_POST['logout'])) {
	unset($_SESSION['username']);
	$info = array();
	array_push($info, "Logging out");
	$_SESSION['errors'] = $info;
	$_SESSION['logout'] = "Logging out";
	header("refresh:0; url=print_errors.php");
}

if(isset($_POST['display_reservations'])) {
	header("refresh:0; url=display_reservations.php");
	exit();
}

?>