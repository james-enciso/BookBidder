<?php session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/logincheckandredirect.php";

require_once "../sqlconnect.php";
require_once "../header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/classes/bookclasses.php";

?>

 <script>
// function appendbox(){
	function move(){
		$( ".searchbookprice" ).append("<p>Hello World</p>")
		}

 
 
 </script>



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
//gets all book listings as a single array of arrays with keys {bookid, bookprice, booktitle, booknegotiable, booksellername, bookauthor, bookISBN}
$allBooks = $booklist -> getAllBookInfoForUserID($_SESSION['id']);


//iterate through array to fetch out each single book
foreach($allBooks as $singleBook){
	
		
	require_once($_SERVER['DOCUMENT_ROOT'] . "/functions/printFormattedBookList.php");
	//var_dump($info);
	printFormattedBookList($singleBook);
	
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.php");
		
	
?>