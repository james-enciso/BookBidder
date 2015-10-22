<?php
session_start();
require_once "header.php";

//This file checks the database from the log-in information and uses it to authenticate
//This file is referenced from index.php
require "sqlconnect.php";

//connect to login database
mysql_select_db("bookbidder");


//set variables
$username =mysql_real_escape_string( $_POST['username']);
$password = mysql_real_escape_string($_POST['password']);


$dbtablename = "login";
$dbcolumnname1 = "username";
$dbcolumnname2 = "pass";

//query to execute (do not alter)/searches for id based on username
$query = "SELECT * FROM $dbtablename WHERE $dbcolumnname1 = '$username'";


//finds id for 
$result = mysql_query($query);

	while($rows = mysql_fetch_assoc($result)){

	
		if($password != $rows['pass']){
				//blank function. Doesn't do anything. Passes over until all rows checked for username inputted
			}

		else{
					echo "<center>You are logged in! <br></center>";

						$name = $rows['username'];
						
						//start session
						//session_start();
						$_SESSION['name'] = $rows['username'];
						$_SESSION['id'] = $rows['id']; 
						$_SESSION['loggedin'] = 1; 
						
						echo "<center>welcome , $name <br></center>";

						
						echo '<center>Click <a href="/account/">Here</a> to Enter<br></center>';
						
						break;
			
			}

	}
	

if(!isset($_SESSION['name'])){
	
	//echo '<center><font color="#FF0000">Failed login.<br> Click <a href=/>Here</a> To Go Back<br></font></center>';
	}

require_once("footer.php");
?>
<script>window.location = "/";</script>
	
