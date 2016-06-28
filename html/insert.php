<?php

$servername = "localhost";
$username = "cimcveigh";
$password = "password";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

echo $_POST['username'];
echo '<br />';
echo $_POST['password'];

?>
