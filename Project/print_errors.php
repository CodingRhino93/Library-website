<?php
session_start();

require_once "connection.php";

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="site.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Errors</title>
</head>
<body id="registration_page">

	<div id="main">

		<?php
			for($i = 0; $i < count($_SESSION['errors']); $i++ ) {
				echo '<p class="print">';
				echo $_SESSION['errors'][$i];
				echo '</p>';

				
			}
			if(isset($_SESSION['register'])) {
				unset($_SESSION['register']);
				unset($_SESSION['login']);
				unset($_SESSION['login01']);
				unset($_SESSION['logout']);
				unset($_SESSION['book_reserved']);
				header("refresh:2; url=registration.html");
			}

			if(isset($_SESSION['login'])) {
				unset($_SESSION['login']);
				unset($_SESSION['register']);
				unset($_SESSION['login01']);
				unset($_SESSION['logout']);
				unset($_SESSION['book_reserved']);
				header("refresh:2; url=login.html");
			}

			if(isset($_SESSION['login01'])) {
				unset($_SESSION['login']);
				unset($_SESSION['login01']);
				unset($_SESSION['register']);
				unset($_SESSION['logout']);
				unset($_SESSION['book_reserved']);
				header("refresh:2; url=home.php");
			}

			if(isset($_SESSION['logout'])) {
				unset($_SESSION['logout']);
				unset($_SESSION['login']);
				unset($_SESSION['login01']);
				unset($_SESSION['register']);
				session_destroy();
				unset($_SESSION['book_reserved']);
				header("refresh:2; url=index.html");
			}

			if(isset($_SESSION['book_reserved'])) {
				unset($_SESSION['book_reserved']);
				unset($_SESSION['logout']);
				unset($_SESSION['login']);
				unset($_SESSION['login01']);
				unset($_SESSION['register']);
				header("refresh:2; url=home.php");
			}


		?>
		
	</div>	
	


</body>
</html>

