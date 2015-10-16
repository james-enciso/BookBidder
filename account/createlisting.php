<?php session_start();
require "../header.php";



if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['ISBN']) && $_POST['title'] != ''		){
	

		require "../sqlconnect.php";
		
		mysql_select_db("bookbidder");
		
		$tableName = "books";
		$title = $_POST['title'];
		$author = $_POST['author'];
		$isbn = $_POST['ISBN'];
		//id gotten from cookie. Identifies user
		$sellerid = $_SESSION['id'];
		
		$sql = "INSERT INTO $tableName (title, author, ISBN, sellerid) VALUES ('$title', '$author', '$isbn', '$sellerid')";

		mysql_query($sql);

		header("Location:/account/checkbids.php");

	
	}










?>
<br>
<center>
This is where you create a new bid. Enter the info below.<br><br>

<form action="" method="post">Book Title: <br> <input name="title" type="text" value="<?php 
	if(isset($_POST['title'])){
		echo $_POST['title'];}?>" /><br><br>
Book Author: <br><input name="author" type="text" value="<?php 
	if(isset($_POST['author'])){
		echo $_POST['author'];}?>"/><br><br>
ISBN <br> <input name="ISBN" type="text" value="<?php 
	if(isset($_POST['ISBN'])){
		echo $_POST['ISBN'];}?>" /><br>
<br>
<input name="" type="submit" value="create" /></form>


</center>