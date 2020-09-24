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

if(isset($_POST['search'])) {
	if($_POST['search'] == "Search by title") {
		$user_search = mysqli_real_escape_string($db, $_POST['userSearch']);

		$search_for_title = "SELECT * FROM books WHERE BookTitle LIKE '%$user_search%'";
		$result = mysqli_query($db, $search_for_title);

		while($row = mysqli_fetch_row($result)) {
			$book_list[] = $row;
		}

		$_SESSION['book_list_sesh'] = $book_list;
		$_SESSION['lock'] = "I am not set";

		header("refresh:0; url=display_search_results.php");


} elseif($_POST['search'] == "Search by author") {
		$user_search = mysqli_real_escape_string($db, $_POST['userSearch']);

		$search_for_title = "SELECT * FROM books WHERE Author LIKE '%$user_search%'";
		$result = mysqli_query($db, $search_for_title);

		while($row = mysqli_fetch_row($result)) {
			$book_list[] = $row;
		}

		$_SESSION['book_list_sesh'] = $book_list;
		$_SESSION['lock'] = "I am not set";

		header("refresh:0; url=display_search_results.php");
	} else {
		$user_search = mysqli_real_escape_string($db, $_POST['userSearch']);

		$search_for_both = "SELECT * FROM books WHERE BookTitle LIKE '%$user_search%' OR Author LIKE '%$user_search%'";
		$result = mysqli_query($db, $search_for_both);

		while($row = mysqli_fetch_row($result)) {
			$book_list[] = $row;
		}

		$_SESSION['book_list_sesh'] = $book_list;
		$_SESSION['lock'] = "I am not set";

		header("refresh:0; url=display_search_results.php");

	}
}

?>