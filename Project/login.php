<?php
session_start();

require_once "connection.php";

$username = mysqli_real_escape_string($db, $_POST['UserName']);
$password = mysqli_real_escape_string($db, $_POST['Password']);

$errors = array();
$success = array();

if(empty($username)) {
	array_push($errors, "Username is required");
}
if(empty($password)) {
	array_push($errors, "Password Is required");
}

if(count($errors) == 0) {
	$query = "SELECT * FROM users WHERE UserName = '$username' AND Password = '$password'";
	$result = mysqli_query($db, $query);
	if(mysqli_num_rows($result) == 1) {
		$_SESSION['username'] = $username;
		array_push($success, "Logged in Successfully");
		$_SESSION['errors'] = $success;
		$_SESSION['login01'] = "Success";
		header("refresh:0; url=print_errors.php");
	} else {
		array_push($errors, "Wrong username or password");
	}
}

if(count($errors) > 0) {
	$_SESSION['errors'] = $errors;
	$_SESSION['login'] = "Errors";
	header("refresh:0; url=print_errors.php");
}

?>