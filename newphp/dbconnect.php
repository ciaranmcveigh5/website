<?php

 // this will avoid mysql_connect() deprecation error, 
 error_reporting( ~E_ALL & ~E_DEPRECATED &  ~E_NOTICE );
 // I strongly suggest you to use PDO or MySQLi.
 
 define('DBHOST', 'localhost'); // change to vm public ip if mysql is hosted on different host (Can be written as: $serverIP = "localhost";)
 define('DBUSER', 'cimcveigh'); // root user set up during installation of mysql then use root to create cimcveigh user
 define('DBPASS', 'password'); // password for user
 define('DBNAME', 'website'); // database to connect to 
 
 $conn = mysql_connect(DBHOST,DBUSER,DBPASS);
 $dbcon = mysql_select_db(DBNAME);
 
 if ( !$conn ) {
  die("Connection failed : " . mysql_error());
 }
 
 if ( !$dbcon ) {
  die("Database Connection failed : " . mysql_error());
 }
 ?>