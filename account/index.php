<?php session_start();

require "../header.php";

if(isset($_SESSION['id'])){
	require_once "bar.php";
}
	else{
		echo "<center><font color='red'>Unauthorised Access!</font></center><br/>";
		echo "<center><a href='/'>Click Here To Go Back</a></center>";
		}

require "../footer.php";

?>

