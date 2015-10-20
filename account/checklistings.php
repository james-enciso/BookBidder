<?php session_start();
require_once "../sqlconnect.php";
require_once "../header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/classes/bookclasses.php";
?>

<p class="listingtitle">Your Current Listings and Bids</p>

<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/selectdb.php";

/*
$tableName = "books";
$userArgument = "title";
$userValue = $_SESSION['id'];
$idvalue = "sellerid" ;
*/
// extractdata($tableName, $userArgument, $userValue, $idvalue);

$booklist = new Book;
$booklist -> getBookInfoForUserID($_SESSION['id']);

require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.php");
		
	
?>