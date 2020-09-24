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

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="site.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home Page</title>
</head>
<body id="home_page">

	<div id="header2">
		<p>Welcome<br><?php echo $_SESSION['username']; ?></p>
		<form action="logout.php" method="post">
			<input id="logout_button" type="submit" value="Logout" name="logout"><br>
			<input id="my_reservations_button" type="submit" value="My Reservations" name="display_reservations">
		</form>
	</div>

	<div id="main02">
		
		<h3>Search a book by title or author</h3>
		<form action="user_search.php" method="post">
			<input type="text" name="userSearch"><br>
			<input type="radio" name="search" value="Search by title" checked><span>Search by title</span><br>
			<input style="margin-top: 1.5%;" type="radio" name="search" value="Search by author"><span>Search by author</span><br><br>
			<input type="radio" name="search" value="Search by both"><span>Search by both</span><br><br>
			<input type="submit" value="Search">
		</form><br>
		<h4>Or display all the books from one category</h4>
		<form action="category_list.php" method="post">
			<select name="category">
				<option value="1">Health</option>
				<option value="2">Business</option>
				<option value="3">Biography</option>
				<option value="4">Technology</option>
				<option value="5">Travel</option>
				<option value="6">Self-Help</option>
				<option value="7">Cookery</option>
				<option value="8">Fiction</option>
			</select>
			<input type="submit" name="category_submit" value="Search by category">
		</form>

		<div id="home_page_spacer"></div>
		<div id="footer">
			<p>Website<br id="br01">made by<br id="br02">Jakub Zareba<br id="br03"></p>
		</div>

	</div>


</body>
</html>