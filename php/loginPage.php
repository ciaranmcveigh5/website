<?php

// Define variables
$serverIP = "localhost"; // change to public ip of another vm if mysql is running else where 
$serverUsername = "cimcveigh";
$serverPassword = "password";
$dbName = "website";
$tableName = "nametable";
$enteredUsername = "";
$enteredPassword = "";
$errorMessage = "";

//==========================================
//	ESCAPE DANGEROUS SQL CHARACTERS
//==========================================

// Avoid SQL injection
function quote_smart($value, $handle) {

   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value); 
   }

   if (!is_numeric($value)) {
       $value = "'" . mysql_real_escape_string($value, $handle) . "'";
   }
   return $value;
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') { // check if the form has been posted
	$enteredUsername = $_POST['username'];
	$enteredPassword = $_POST['password'];

	$required = array('username', 'password');

	$enteredUsername = htmlspecialchars($enteredUsername); //deal with unwanted HTML (scripting attacks)
	$enteredPassword = htmlspecialchars($enteredPassword);

	//==========================================
	//	CONNECT TO THE LOCAL DATABASE
	//==========================================


	$db_handle = mysql_connect($serverIP, $serverUsername, $serverPassword); // connect to database
	$db_found = mysql_select_db($dbName, $db_handle); // check if database is found

	if ($db_found) {

		$enteredUsername = quote_smart($enteredUsername, $db_handle); // call function to protedt against sql injection
		$enteredPassword = quote_smart($enteredPassword, $db_handle);

		$SQL = "SELECT * FROM $dbname WHERE username = $enteredUsername AND password = $enteredPassword"; // check that username and password match one found in database, (think about using md5 function to encrypt password)
		$result = mysql_query($SQL); // call query
		$num_rows = mysql_num_rows($result); // how many rows where returned in case of multiple matches

	//====================================================
	//	CHECK TO SEE IF THE $result VARIABLE IS TRUE
	//====================================================

		if ($result) { // if a match is found 
			if ($num_rows > 0) { // and more than one row is returned (why is this needed?)
				session_start();
				$_SESSION['login'] = "1"; // set up session variable (special type of variable), variable in this case is login with a value of one   
				header ("Location: homePage.php");
			}
			else {
				session_start();
				$_SESSION['login'] = "";
				header ("Location: registrationPage.php");
			}	
		}
		else {
			$errorMessage = "Error logging on";
		}

	mysql_close($db_handle);

	}

	else {
		$errorMessage = "Error logging on";
	}

}

?>


<html>

<head>

<title>Homepage</title>

<style type="text/css">

</style>

</head>

<body>

	<form name="loginForm" method="post" action="loginPage.php" >
	  
		Username: <input type="text" name="username" maxlength="50" placeholder="Username" value="<?PHP print $enteredUsername;?>" />

		<br />

		Password: <input type="password" name="password" maxlength="50" placeholder="Password" value="<?PHP print $enteredPassword;?>" />

		<br />

		<input type="submit" value="Login" />

	</form>

	<button type="button" onclick="window.location.href='registrationPage.php'">Sign Up</button>

	<P> <?PHP print $errorMessage;?> </P>
	
</body>

</html>