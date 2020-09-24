<?php

session_start();

require_once "connection.php";

if(!isset($_SESSION['username'])) {
	unset($_SESSION['username']);
	$info = array();
	array_push($info, "You need to log in first");
	$_SESSION['errors'] = $info;
	$_SESSION['logout'] = "Logging out";
	header("refresh:0; url=print_errors.php");
}


foreach($_POST as $key=>$value){
    $bookID = $key;
}

$find_the_book = "SELECT * FROM books WHERE ISBN = '$bookID' LIMIT 1";
$result = mysqli_query($db, $find_the_book);

if($result) {
	$username = $_SESSION['username'];
	$reserve = "UPDATE books SET Reserved = 'Yes' WHERE ISBN = '$bookID'";
	$reserve_run = mysqli_query($db, $reserve);

	$find_number_of_books = "SELECT * FROM users WHERE UserName = '$username'";
	$find_number_of_books_run = mysqli_query($db, $find_number_of_books);
	$result = mysqli_fetch_assoc($find_number_of_books_run);
	$num = $result['No_of_books'];
	$num = $num + 1;
	
	$update_user_no_of_books = "UPDATE users SET No_of_books = '$num' WHERE UserName = '$username'";
	$update_run = mysqli_query($db, $update_user_no_of_books);

	$today = date("Y-m-d");
	$insert_into_res = "INSERT INTO reservations (ISBN, UserName, Date_of_res) VALUES ('$bookID', '$username', '$today')";
	$run_insert = mysqli_query($db, $insert_into_res);

	$bookRes = array();
	array_push($bookRes, "Book reserved");
	$_SESSION['book_reserved'] = "Set";
	$_SESSION['errors'] = $bookRes;
	header("refresh:0; url=print_errors.php");
} else {
	echo '<h2>Error occured, redirecting...</h2>';
	header("refresh:2; url=user_search.php");
}

?>