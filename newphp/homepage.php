<?php
require('dbconnect.php');

if ( isset($_SESSION['user'])!="" ) {
	header("Location: home.php");
  	exit;
}

echo "$_SESSION['user']"

?>