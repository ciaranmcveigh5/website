<?php

// Define variables
$servername = "localhost"; // change to public ip of another vm if mysql is running else where 
$serverUsername = "cimcveigh";
$serverPassword = "password";
$dbname = "website";
$formValid = true;
$errorMessage = "";
$enteredUsername = "";
$enteredPassword = "";
$confirmedPassword = "";

function quote_smart($value, $handle) {

   if (get_magic_quotes_gpc()) {
       $value = stripslashes($value); 
   }

   if (!is_numeric($value)) {
       $value = "'" . mysql_real_escape_string($value, $handle) . "'";
   }
   return $value;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

	$enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['password'];
    $confirmedPassword = $_POST['cPassword'];
    
    $required = array('username', 'password', 'cPassword');


	// Ensure fields are not empty
	foreach($required as $field) {
		if(empty($_POST[$field])) {
			$formValid = false;
			if($formValid==false) {
				$errorMessage = "Error, empty fields";
				break;
			}
		}
	}

	//Check Password
	// if(preg_match('/[A-Z]+[a-z]+[0-9]+/', $enteredPassword)) {
	// 	break;
	// }else {
	// 	$errorMessage = "password must contain one upper case letter one lower case letter and one number";
	// 	$formValid = false;
	// }

	$checkUsernameSql = mysql_query("SELECT username FROM nametable WHERE username=$enteredUsername");

	if($checkUsernameSql) {
		$errorMessage = "username already in use";
		$formValid = false;
	}	

	// Create connection
	$conn = new mysqli($servername, $serverUsername, $serverPassword, $dbname);

	// Check connection
	if ($conn->connect_error) {
     		die("Connection failed: " . $conn->connect_error);
	} 

	$insertDataSql = "INSERT INTO nametable (username, password) VALUES ('$enteredUsername', '$enteredPassword')";

	if ($formValid==true) {
		if ($conn->query($insertDataSql) === TRUE) {
	 		header ("Location: loginPage.php");
		} else {
     			$errorMessage = "Error";
	 	}
	}

	$conn->close();

}

?>


<html>

<head>

<title>Homepage</title>

<style type="text/css">

</style>

</head>

<body>

	<form name="registrationForm" method="post" action="registrationPage.php" >
	  
		Username: <input type="text" name="username" maxlength="50" placeholder="Username" value="<?PHP print $enteredUsername;?>" />

		<br />

		Password: <input type="password" name="password" maxlength="50" placeholder="Password" value="<?PHP print $enteredPassword;?>" />

		<br />

		Confirm Password: <input type="password" name="cPassword" maxlength="50" placeholder="Password" value="<?PHP print $confirmedPassword;?>" />

		<br />

		<input type="submit" value="submit" />

	</form>

	<P> <?PHP print $errorMessage;?> </P>
	
</body>

</html>
