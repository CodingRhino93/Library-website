<?php
session_start();

require_once "connection.php";

$username = mysqli_real_escape_string($db, $_POST['UserName']);
$password01 = mysqli_real_escape_string($db, $_POST['Password01']);
$password02 = mysqli_real_escape_string($db, $_POST['Password02']);
$phone = mysqli_real_escape_string($db, $_POST['PhoneNo']);

$errors = array();

$check_for_user = "SELECT * FROM users WHERE UserName = '$username' LIMIT 1";
$result = mysqli_query($db, $check_for_user);
$user = mysqli_fetch_assoc($result);

if($user) {
	if ($user['UserName'] === $username) {
		array_push($errors, "Username already taken");
	}
}

if(empty($username)) { array_push($errors, "Username is required");}
if(empty($password01)) { array_push($errors, "Password cannot be empty");}
if($password01 != $password02) {array_push($errors, "Passwords do not match");}

if(count($errors) == 0) {
	$query = "INSERT INTO users (UserName, Password, Phone)
			  VALUES('$username', '$password01', '$phone')";

	$success = array();
	array_push($success, "Registered Successfully");
	$_SESSION['errors'] = $success;
	$_SESSION['register'] = "Success";
	header("refresh:0; url=print_errors.php");
}

if(count($errors) > 0) {
	$_SESSION['errors'] = $errors;
	$_SESSION['register'] = "Errors";
	header("refresh:0; url=print_errors.php");
}

?>