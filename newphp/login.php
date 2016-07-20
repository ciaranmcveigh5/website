<?php
require('dbconnect.php');

if(isset($_POST['submit']))
{
 $uname = mysql_escape_string($_POST['username']);
 $pass = mysql_escape_string($_POST['password']);
 $pass = md5($pass);

 $check = mysql_query("SELECT * FROM `nametable` WHERE `username` = '$uname' AND `password` = '$pass'");
 if(mysql_num_rows($check) >= 1){
  echo "You are now logged in!";
  exit();
 }
 else{

  echo "Wrong password";
 }
}
else{

 $form = <<<EOT
 <form action="login.php" method="POST">
 Username: <input type="text" name="uname"><br>
 Password: <input type="password" name="pass"><br>
 <input type="submit" name="submit" value="Log in">
 <button type="button" onclick="window.location.href='register.php'">Sign Up</button>

EOT;

echo $form;
}
?>