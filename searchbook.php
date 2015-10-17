<?php session_start();

require_once "header.php";
require_once "sqlconnect.php";
require_once "selectdb.php";
require_once("./classes/bookclasses.php");

$currentBook = new Book;
if(isset($_GET['BBID'])){

	$currentBook -> bookEntryDBID = mysql_real_escape_string($_GET['BBID']);
	$currentBook -> getBookInfoForID();
	

	if($currentBook -> bookDoesExist == 1){

echo "Title: " . $currentBook -> title . "<br>";
echo "Author: " .  $currentBook -> author . "<br>";
echo "ISBN: " .  $currentBook -> ISBN . "<br>";
echo "Asking Price: $ " .  $currentBook -> price . "<br>";
echo "Willing to Negotiate: " . $currentBook -> isnegotiable . "<br>";
echo "Seller: " .  $currentBook -> sellername . "<br>";
	
	?>
    <br>
------------------
<br>
If you'd like to place a bid on this book, enter your information below. If the seller is interested in your offer, he or she will contact you through the information provided.
<br><br>

<form action="placebid.php" method="post">Name:<br>
<input name="name" type="text" ><br>
Email Address:<br>
<input name="email" type="text" ><br>
Phone Number (Optional)<br>
<input name="phone" type="text" ><br>
Price Offer: (numbers only, please)<br>
$<input name="offer" type="text" >
<br>
<input name="" type="submit" value="submit" >
<input name="bookid" type="hidden" value="<?php echo $bookid; ?>" >

</form>

    
    
    
	<?php
	}}
	
if(isset($_GET['searchtitle'])){

$currentBook ->  getBookInfoForTitle($_GET['searchtitle']);
}

	require_once "footer.php";				


?>
