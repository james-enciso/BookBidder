<?php session_start(); ?>
<?php require_once "header.php"; ?>

<div class="searchBlock">
Bidding on a book?<br>
Enter the BBID number below<br>


<form action="searchbook.php" method="get">
	<input name="BBID" type="text">
	<input class="buttonStyle" type="submit"  value="search">
</form>

Or Search For A Title Below<br>
<form action="searchbook.php" method="get">
	<input name="searchtitle" type="text" >
	<input class="buttonStyle" type="submit"  value="search">
</form>

</div>



<div id="aboutbox"><?php  require nl2br("./img/about.txt") ?></div>



<?php
require_once("footer.php");
?>
