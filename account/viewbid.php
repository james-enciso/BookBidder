<?php
require $_SERVER['DOCUMENT_ROOT'] . "/header.php";
require $_SERVER['DOCUMENT_ROOT'] . "/sqlconnect.php";
require $_SERVER['DOCUMENT_ROOT'] . "/selectdb.php";

require "bar.php";



//assign variable from given
$bookid = mysql_real_escape_string($_GET['id']);

//echo $bookid;



//make id from db be book id (from link)
$userValue = $bookid;
$idvalue = "id";
$tableName = "books";

//call function (listed below)
 extractdata($tableName, $userValue, $idvalue);



//---------------------
//function to print list of things requested from database


function extractdata($tableName, $userValue, $idvalue){
	
	
	//example: $searchQuery = "SELECT username FROM logindatabase WHERE username='$usernamevalue'";

	$searchQuery = "SELECT * FROM $tableName WHERE $idvalue='$userValue'";

	$booleanVariable = mysql_query($searchQuery);


	while($rows = mysql_fetch_assoc($booleanVariable)){
	
		//if finds something, print it out. Stop loop
		echo "<center>Title: " . $rows["title"] . "<br/>";
		echo "Author: " .  $rows["author"] . "<br/>";
		echo "ISBN: " . $rows["ISBN"] . "</center><br/><br/>";
		}
			
}		
		
	

?>