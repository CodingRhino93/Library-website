<?php

echo '<table border="1">' . "\n";
$db = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
mysqli_select_db($db, "Project") or die(mysqli_error());

mysqli_set_charset($db,"utf8");

?>