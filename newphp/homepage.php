<?php
require('dbconnect.php');
// print("Hello World");
session_start();

//if ( isset($_SESSION['user'])="" ) {
// 	header("Location: login.php");
//   	exit;
//}

// echo "$_SESSION['user']";

// function signOut() {
// 	session_unset();
//  	session_destroy();
// 	header("Location: login.php");
// 	print("function hit");
// }

//print "$_SESSION['user']";


?>


<html>

<head>

<title>Homepage</title>

<style type="text/css">

</style>

</head>

<body>

<button type="button" onclick="window.location.href='logout.php'">Sign Out</button>
	
</body>

</html>
