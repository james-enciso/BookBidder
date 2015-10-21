<?php session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/logincheckandredirect.php";


require_once $_SERVER['DOCUMENT_ROOT'] . "/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/sqlconnect.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/selectdb.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/classes/bookclasses.php";

$newbook = new Book;


if(isset($_POST['title'])){

$newbook -> title = $_POST['title'];
$newbook -> author = $_POST['author'];
$newbook -> ISBN =  $_POST['ISBN'];
$newbook -> price = 	$_POST['price'];
$newbook -> sellerid = $_SESSION['id'];

if(isset( $_POST['negotiable']) && ( $_POST['negotiable'] == 0)){
	$newbook -> isnegotiable = 0;
	}else{
		$newbook -> isnegotiable = 1;
}

	$newbook -> createNewBookWithGivenParameters();
	echo '<script>window.location = "/account/checklistings.php";</script>';



}


?>
<p class="listingtitle">To create a new item, enter the information below</p>


<form action="" method="post">
<table>
<tr><td>Title </td>
<td> <input name="title" type="text" placeholder="Book Title" value="<?php 
	if(isset($_POST['title'])){
		echo $_POST['title'];}?>" ></td></tr>
<tr><td>Author</td>
<td><input name="author" type="text" placeholder="Author" value="<?php 
	if(isset($_POST['author'])){
		echo $_POST['author'];}?>" ></td>
<tr><td>ISBN</td>
<td><input name="ISBN" type="text" placeholder="ISBN" value="<?php 
	if(isset($_POST['ISBN'])){
		echo $_POST['ISBN'];}?>"  ></td>
<tr><td> Price $</td>
<td> <input name="price" type="text" placeholder="0.00" value="<?php 
	if(isset($_POST['ISBN'])){
		echo $_POST['ISBN'];}?>"  ></td>
        
<tr><td>Negotiable<br></td><td>
  <label>
    <input type="radio" name="negotiable" value="0" id="RadioGroup1_0" />
    No</label>
  <br>
  <label>
    <input type="radio" name="negotiable" value="1" id="RadioGroup1_1" />
    Yes</label>
  </td></tr>
        </table>
        <hr>
<input class="buttonStyle" name="" type="submit" value="Post Book!" ></form>



<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/footer.php");
?>