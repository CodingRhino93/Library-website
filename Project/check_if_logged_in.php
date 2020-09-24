<?php
session_start();

require_once "connection.php";

if(!isset($_SESSION['username'])) {
	echo "<h1>You must log in first</h1>";
	header("refresh:2; url=login.html");
}

?>