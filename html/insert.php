<?php

$servername = "localhost";
$serverUsername = "cimcveigh";
$serverPassword = "password";
$dbname = "website";
$enteredUsername = $_POST['username'];
$enteredPassword = $_POST['password'];

// Create connection
$conn = new mysqli($servername, $serverUsername, $serverPassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
echo '<br />';

$sql = "INSERT INTO nametable (username, password)
VALUES ('$enteredUsername', '$enteredPassword')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    echo '<br />';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

echo '<br />';
echo $_POST[$enteredUsername];
echo '<br />';
echo $_POST[$password];

?>
