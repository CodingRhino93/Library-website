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
	<title>Search results</title>
</head>
<body id="home_page">

	<div id="header2">
		<p>Welcome<br><?php echo $_SESSION['username']; ?></p>
		<form action="logout.php" method="post">
			<input id="logout_button" type="submit" value="Logout" name="logout"><br>
			<input id="my_reservations_button" type="submit" value="My Reservations" name="display_reservations">
		</form>
	</div>

	<?php 

		$_SESSION['lock'] = "I am not set";

		echo '<table id="printTable">';

			echo '<tr>';
			echo '<td>Book ID</td>';
			echo '<td>Book Title</td>';
			echo '<td>Author</td>';
			echo '<td>Edition</td>';
			echo '<td>Year</td>';
			echo '<td>Category ID</td>';
			echo '<td>Reserved</td>';
			echo '</tr>';

				$x = $_SESSION['counter'] % 5;
				$a = $_SESSION['counter2'];
				$loop_end = $a + 5;
				if($loop_end > $_SESSION['counter'])
				{
					$loop_end = $loop_end - 5;
					$loop_end = $loop_end + $x;
				}
				
				for($i = $a; $i < $loop_end; $i++) {
				echo '<tr>';
				for($j = 0; $j < 7; $j++) {
					if($_SESSION['book_list_sesh'][$i][$j] == "No") {
						echo '<td>';
						echo '<strong>';
						echo '<form action="reserve.php" method="post">
					<input type="submit" name='.$_SESSION['book_list_sesh'][$i]['0'].' value="Reserve">
					</form>';
						echo '</strong>';
						echo '</td>';
					} else {
						echo '<td>';
						echo '<strong>';
						echo $_SESSION['book_list_sesh'][$i][$j];
						echo '</strong>';
						echo '</td>';
					}
					
				}
				echo '</tr>';

			}

			echo '</table>';

			$a = $a + 5;
		
			$_SESSION['counter2'] = $a;
	

	?>

	<p><a class="previous_page_button" href="previous_page.php"><--- Previous Page</a></p>

	<p><a id="return_link2" href="home.php">Return to the Home Page</a></p>
	<?php 

		$b = $_SESSION['counter'] - $loop_end;
		if($b != 0) {
			echo '<p><a class="next_page_button" href="next_page.php">Next Page ---></a></p>';
		}
	?>
	
		<div id="home_page_spacer"></div>
	<div id="footer">
		<p>Website<br id="br01_no_div">made by<br id="br02_no_div">Jakub Zareba<br id="br03_no_div"></p>
	</div>

</body>
</html>