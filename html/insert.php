<?php

// Define variables
$servername = "localhost";
$serverUsername = "cimcveigh";
$serverPassword = "password";
$dbname = "website";
$enteredUsername = $_POST['username'];
$enteredPassword = $_POST['password'];
$confirmedPassword = $_POST['confirmedPassword'];
$formValid = true;
$errorMessage = "";

$required = array('username', 'password', 'confirmedPassword');

// Ensure fields are not empty
foreach($required as $field) {
	if(empty($_POST[$field])) {
		$formValid = false;
		if($formValid==false) {
			echo "Error, empty fields";
			echo '<br />';
			break;
		}
	}
}

if(preg_match('/[A-Z]+[a-z]+[0-9]+/', $enteredPassword)) {
	echo 'secure password';
	echo '<br />';
}else {
	echo 'insecure password';
	echo '<br />';
	$formValid = false;
}

// Validates Username and checks its not in database
/*if (empty($enteredUsername)) {
        $errorMessage = "You Forgot to Enter Your Username!";
        echo "<script type='text/javascript'>alert('$errorMessage');</script>";
        $formValid = false;
}*/ 

$checkUsernameSql = mysql_query("SELECT username FROM nametable WHERE username=$enteredUsername");

if($checkUsernameSql) {
	$errorMessage = "username already in use";
	$formValid = false;
}

/*if(mysqli_num_rows($checkUsernameSql)>=1) {
    $errorMessage = "name already exists";
    echo "<script type='text/javascript'>alert('$errorMessage');</script>";
    $formValid = false;
}
else {
	//enter situation
}*/  
    
//Validates password & confirm passwords.
/*if(!empty($enteredPassword) && ($enteredPassword] == $confirmedPassword)) {
    if (strlen($enteredPassword) <= '8') {
        $errorMessage = "Your Password Must Contain At Least 8 Characters!";
        echo "<script type='text/javascript'>alert('$errorMessage');</script>";
        $formValid = false;
    }
    elseif(!preg_match("#[0-9]+#",$enteredPassword)) {
        $errorMessage = "Your Password Must Contain At Least 1 Number!";
        echo "<script type='text/javascript'>alert('$errorMessage');</script>";
        $formValid = false;
    }
    elseif(!preg_match("#[A-Z]+#",$enteredPassword)) {
        $errorMessage = "Your Password Must Contain At Least 1 Capital Letter!";
        echo "<script type='text/javascript'>alert('$errorMessage');</script>";
        $formValid = false;
    }
    elseif(!preg_match("#[a-z]+#",$enteredPassword)) {
        $errorMessage = "Your Password Must Contain At Least 1 Lowercase Letter!";
        echo "<script type='text/javascript'>alert('$errorMessage');</script>";
        $formValid = false;
    } else {
        $errorMessage = "Please Check You've Entered Or Confirmed Your Password!";
        echo "<script type='text/javascript'>alert('$errorMessage');</script>";
        $formValid = false;
    }
}*/

// Create connection
$conn = new mysqli($servername, $serverUsername, $serverPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
echo '<br />';

$insertDataSql = "INSERT INTO nametable (username, password)
VALUES ('$enteredUsername', '$enteredPassword')";

if ($formValid==true) {
	if ($conn->query($insertDataSql) === TRUE) {
    	echo "New record created successfully";
    	echo '<br />';
	} else {
    	echo "Error: " . $insertDataSql . "<br>" . $conn->error;
	}
} else {
	header ("Location: login_form.html");
}

/*if (mysqli_query($conn, $insertDataSql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}*/

$conn->close();

echo '<br />';
echo $enteredUsername;
echo '<br />';
echo $enteredPassword;

?>
