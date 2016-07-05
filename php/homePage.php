<?PHP

$uname = "";
$pword = "";
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

if ($_SERVER['REQUEST_METHOD'] == 'POST'){ // check if the form has been posted
	$uname = $_POST['username'];
	$pword = $_POST['password'];

	$uname = htmlspecialchars($uname); //deal with unwanted HTML (scripting attacks)
	$pword = htmlspecialchars($pword);

	//==========================================
	//	CONNECT TO THE LOCAL DATABASE
	//==========================================
	$user_name = "root";
	$pass_word = "";
	$database = "login";
	$server = "127.0.0.1"; // if mysql is on its own vm

	$db_handle = mysql_connect($server, $user_name, $pass_word); // connect to database
	$db_found = mysql_select_db($database, $db_handle); // check if database is found

	if ($db_found) {

		$uname = quote_smart($uname, $db_handle); // call function to protedt against sql injection
		$pword = quote_smart($pword, $db_handle);

		$SQL = "SELECT * FROM login WHERE L1 = $uname AND L2 = md5($pword)"; // check that username and password match one found in database
		$result = mysql_query($SQL); // call query
		$num_rows = mysql_num_rows($result); // how many rows where returned in case of multiple matches

	//====================================================
	//	CHECK TO SEE IF THE $result VARIABLE IS TRUE
	//====================================================

		if ($result) { // if a match is found 
			if ($num_rows > 0) { // and more than one row is returned (why is this needed?)
				session_start();
				$_SESSION['login'] = "1"; // set up session variable (special type of variable), variable in this case is login with a value of one   
				header ("Location: page1.php");
			}
			else {
				session_start();
				$_SESSION['login'] = "";
				header ("Location: signup.php");
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
<title>Basic Login Script</title>
</head>
<body>

<FORM NAME ="form1" METHOD ="POST" ACTION ="login.php">

Username: <INPUT TYPE = 'TEXT' Name ='username'  value="<?PHP print $uname;?>" maxlength="20">
Password: <INPUT TYPE = 'TEXT' Name ='password'  value="<?PHP print $pword;?>" maxlength="16">

<P align = center>
<INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Login">
</P>

</FORM>

<P>
<?PHP print $errorMessage;?>




</body>
</html>
