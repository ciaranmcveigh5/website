<?php
require('dbconnect.php');
// print("Hello World");
session_start();

echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

print_r($_SESSION);
print_r($_SESSION[user_id]);

if (isset($_POST['submit'])) // check submit button has been selected
{
	$story = mysql_escape_string($_POST['story']);
	mysql_query("INSERT INTO stories (`user_id`, `story`) VALUES ('$_SESSION[user_id]', '$story')") or die(mysql_error());
	$_SESSION[story] = $story;
}

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

<form action="homepage.php" method="POST">
	<input type="text" name="story" style="width:300px; height:200px;" maxlength="255"><br>
	<input type="submit" value="Submit" name="submit" />
</form>

<button type="button" onclick="window.location.href='logout.php'">Sign Out</button>

<P> <?PHP print $_SESSION[story];?> </P>
	
</body>

</html>
