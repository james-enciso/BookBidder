<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php");
?>


<div class="warningtext">
<?php
//if not checked (or first time loading), display warning
if(!isset($_POST['delete'])){ require_once "deletewarning.php"; }
?>
</div>
<?php require_once $_SERVER['DOCUMENT_ROOT'] .  "/footer.php"; ?>


<?php
//---------------------------------
//if box checked, proceed with rest of deletion process
if(isset($_POST['delete'])){



//assign id value (from login)
$userid = $_SESSION['id'];

//connect to database
require_once $_SERVER['DOCUMENT_ROOT'] .  "/sqlconnect.php";
require_once $_SERVER['DOCUMENT_ROOT'] .  "/selectdb.php";

$sql = "DELETE FROM login WHERE id = $userid";
//execute deletion query
mysql_query($sql);


echo "Account Successfully Deleted<br>";

session_destroy();

echo "Click <a href='/'>Here</a> To Go Back<br>";
echo	'<script>window.location = "/";</script>';



}
?>
