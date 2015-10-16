<?php session_start();
require "../sqlconnect.php";
require "../header.php";

echo "<br><br>";
echo "<center>This is the list of bids you have going on<br></center>";

mysql_select_db("bookbidder");

$tableName = "books";
$userArgument = "title";
$userValue = $_SESSION['id'];
$idvalue = "sellerid" ;

 extractdata($tableName, $userArgument, $userValue, $idvalue);



//---------------------

		
	
?>