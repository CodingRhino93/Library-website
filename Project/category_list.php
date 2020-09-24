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


if(isset($_POST['category_submit'])) {
	$category = mysqli_real_escape_string($db, $_POST['category']);

	$check_for_category = "SELECT * FROM books WHERE Category = '$category'";
	$result = mysqli_query($db, $check_for_category);

	while($row = mysqli_fetch_row($result)) {
			$book_list[] = $row;
		}

		$_SESSION['book_list_sesh'] = $book_list;
		$_SESSION['lock'] = "I am not set";

		header("refresh:0; url=display_search_results.php"); 
}
 ?>