<?php session_start();

require_once "header.php";
require_once "sqlconnect.php";
require_once "selectdb.php";
require_once("./classes/bookclasses.php");

$currentBook = new Book;
if(isset($_GET['BBID'])){

//call initialiser. Returns array of attributes relating to specific book
$bookInfo =		$currentBook -> initWithBBID(mysql_real_escape_string($_GET['BBID']));
	
	//var_dump($bookInfo);

	if($currentBook -> bookDoesExist == 1){


	require_once($_SERVER['DOCUMENT_ROOT'] . "/functions/printFormattedBookList.php");
	printFormattedBookList($bookInfo);
	
	?>
<hr>
If you would like to place a bid on this book, enter your information below. The seller will contact you with your information provided.



<form action="placebid.php" method="post">
<table>
<tr><td>Name</td>
<td><input name="name" type="text" placeholder="John Doe"></td></tr>
<tr><td>Email Address<br></td>
<td><input name="email" type="text" placeholder="jdoe@bb.com" ></td></tr>
<tr><td>Phone Number (Optional)<br></td>
<td><input name="phone" type="text" placeholder="1-000-000-0000" ></td>
<tr><td>Price Offer $<br></td>
<td><input name="offer" type="text" placeholder="0.00" ></td></tr>
<br>
</table>
<input name="" class="buttonStyle" type="submit" value="Place Bid" >
<input name="bookid" type="hidden" value="<?php echo $bookid; ?>" >

</form>

    
    
    
	<?php
	}}
	
if(isset($_GET['searchtitle'])){

$info = $currentBook ->  getAllBookInfoByTitle($_GET['searchtitle']);

	require_once($_SERVER['DOCUMENT_ROOT'] . "/functions/printFormattedBookList.php");
	//var_dump($info);
	printFormattedBookList($info);


}

	require_once "footer.php";				


?>
