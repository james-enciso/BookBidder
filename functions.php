<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/sqlconnect.php");
//all functions present in the website. This file may be imported to call functions present in this file.


//checks if user already exists on the database
//takes in the name of the table, the argument, and the input to check
function checkexisting($tableName, $userArgument, $userValue){
	
	
	//example: $searchQuery = "SELECT username FROM logindatabase WHERE username='$usernamevalue'";

	$searchQuery = "SELECT $userArgument FROM $tableName WHERE $userArgument='$userValue'";

	$booleanVariable = mysql_query($searchQuery);


	while($rows = mysql_fetch_assoc($booleanVariable)){
	
		if($rows["$userArgument"] == $userValue ){
			//echo "<font color='#FF0000'> $userArgument already exists </font><br/>";
			return 1;
			break;
			}
	
	}
		//if last value checked if not equal, report status available
		if($rows["$userArgument"] != $userValue ){
		//	echo "<font color='#00CC00'> $userArgument available </font><br/>";
			return 0;
			}	
	}


//------------------------------------------------------------
//censors profanity in a string of text

//takes in string, returns censored string
function censor($string){

//force string as lowercase
	$message = strtolower($string);

	//list of words. Feel free to add more
	$words[]= array('arse', 'fuck', 'ass');

	for($n = 0; $n < count($words); $n++){
		
		//replace the bad words  with "XX"
		$newMessage = str_replace($words[$n], '<font color="#FF0000">XX</font>', $message);
		
			//OR
	
			//replaces with blank
	//	$newMessage = str_replace($words[$n], '', $message);

		}
		
	//capitalise first word in sentence and print
	//echo ucfirst($newMessage);
	return $newMessage;

}

//------------------------------------------------------------



//---------------------
//function to print list of things requested from database


function extractdata($tableName, $userArgument, $userValue, $idvalue){
	
	
	//example: $searchQuery = "SELECT username FROM logindatabase WHERE username='$usernamevalue'";

	$searchQuery = "SELECT $userArgument FROM $tableName WHERE $idvalue='$userValue'";

	$booleanVariable = mysql_query($searchQuery);


	while($rows = mysql_fetch_assoc($booleanVariable)){
	
		//if finds something, print it out. Stop loop
		if ($rows["$userArgument"] != ''){

	//	echo $rows["$userArgument"] . "<br>";
			return $rows["$userArgument"];
		break;
		}
		
		
	}
}



//--------------







?>