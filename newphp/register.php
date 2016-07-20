<?php
require('dbconnect.php');

if (isset($_POST['submit'])) // check submit button has been selected
{
 $pass1 = $_POST['pass1'];
 $pass2 = $_POST['pass2'];

 if($pass1 == $pass2)
 {
   //All good
   $uname = mysql_escape_string($_POST['uname']); //
   $pass1 = mysql_escape_string($_POST['pass1']);
   $pass2 = mysql_escape_string($_POST['pass2']);

   $pass1 = md5($pass1);
   //Check if username is taken
   $check = mysql_query("SELECT * FROM nametable WHERE username = '$uname'")or die(mysql_error());
   if (mysql_num_rows($check)>=1) echo "Username already taken";
   //Put everyting in DB
   else{
   mysql_query("INSERT INTO `users` (`username`, `password`) VALUES (NULL, '$uname', '$pass1')") or die(mysql_error());
   echo "Registration Successful";
   }
 }
 else{
  echo "Sorry, your passwords do not match. <br />";
 }


}
else{
$form = <<<EOT
<form action="register.php" method="POST">
Username: <input type="text" name="uname" /><br />
Password: <input type="password" name="pass1" /><br />
Confirm Password: <input type="password" name="pass2" /><br />
<input type="submit" value="Register" name="submit" />
</form>
EOT;

echo $form;

}

?>