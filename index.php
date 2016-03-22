<?php session_start(); ?>
<?php require_once "header.php"; ?>

<div class="headertofooterspacer">
<span class="searchBlock">
<br>Bidding on a Book?<br><br>

Find Listing by BBID<br>
<form action="searchbook.php" method="get">
	<input name="BBID" type="text" placeholder="BBID">
	<input class="buttonStyle" type="submit"  value="Check">
</form>

Search For A Title<br>
<form action="searchbook.php" method="get">
	<input name="searchtitle" type="text" placeholder="Book Title" >
	<input class="buttonStyle" type="submit"  value="Search">
</form>

<span>Browse Categories
<br>
	- Category1<br>
	- Category1<br>
	- Category1<br>
	- Category1<br>
	- Category1<br>
	- Category1<br>
	- Category1<br><br>
</span>
<span>Latest Books
<br>
	- Book1<br>
	- Book1<br>
	- Book1<br>
	- Book1<br>
	- Book1<br>
    - Book1<br>


</span>

</span>

<span id="aboutbox"><?php  require nl2br("./img/about.txt") ?></span>

<span id="rightsidebar">
Recent Activity
</span>

</div>

<?php require_once("footer.php"); ?>
