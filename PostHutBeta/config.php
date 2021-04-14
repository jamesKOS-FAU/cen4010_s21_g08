<?php

/* Database credentials. Assuming you are running MySQLserver with default 
setting (user 'root' with no password) */

define('DB_SERVER', 'lamp.cse.fau.edu');
define('DB_USERNAME', 'cen4010_s21_g08');
define('DB_PASSWORD', 'sure97decimal24');
define('DB_NAME', 'cen4010_s21_g08'); 

/* Attempt to connect to MySQL database */

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME); 

// Check connection
if($link === false){    
	
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>