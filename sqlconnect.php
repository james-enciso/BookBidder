<?php 

//These variables can be modified
$databaseLocation = "localhost";
$databaseUsername = "root";
$databasePassword = "122593";


//DO NOT MODIFY BELOW
//This establishes the connection (returns fatal error if connection failed)
mysql_connect($databaseLocation, $databaseUsername, $databasePassword)
	or die(mysql_error())

?>