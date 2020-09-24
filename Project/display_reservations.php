<?php
session_start();

require_once "connection.php";


	$username = $_SESSION['username'];
	$query = "SELECT * FROM reservations WHERE UserName = '$username'";
	$query_run = mysqli_query($db, $query);

	while($row = mysqli_fetch_row($query_run)) {
			$book_list[] = $row;
		}

		$_SESSION['book_list_sesh'] = $book_list;
		$_SESSION['lock'] = "I am set";

		header("refresh:0; url=display_search_results.php");

?>