<html lang="en">
<!--<!DOCTYPE html>-->
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
            
<head>
	<title>BookBidder</title>
	<link rel="stylesheet" type="text/css" href="/styles/index.css" >
    <link rel="stylesheet" type="text/css" href="/styles/deleteuser.css">
    <link rel="stylesheet" type="text/css" href="/styles/createaccount.css">
    <link rel="stylesheet" type="text/css" href="/styles/searchtitle.css">
    <link rel="stylesheet" type="text/css" href="/styles/listings.css">



</head>

<body>

<div id="headerbox">

<a href="/">
<img alt="BookBidder Logo" id="logoimage" src="/img/logo.png">
</a>

<p id="titleTag">BookBidder<br>
  Sell and Bid on Books!
</p>


</div> 

<?php 

if(isset($_SESSION['id'])){
	require_once $_SERVER["DOCUMENT_ROOT"] . "/account/bar.php";
	}

elseif(!isset($_SESSION['name']) || !isset($_SESSION['loggedin'])){
	require_once "loginbox.php";
}
?>

</body>
</html>
