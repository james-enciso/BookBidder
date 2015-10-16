<?php
//get variables
$bookid = mysql_real_escape_string($_POST['bookid']);
$buyerName = mysql_real_escape_string($_POST['name']);
$buyerEmail = mysql_real_escape_string($_POST['email']);
$buyerPhone = mysql_real_escape_string($_POST['phone']);
$buyerOffer = mysql_real_escape_string($_POST['offer']);


require_once "./classes/bidclass.php";
 createBidWithVariables($bookid, $buyerName, $buyerEmail, $buyerPhone, $buyerOffer);


?>



Thank You For Your Bid!<br>
If you are selected, you will be contacted by the seller with the information you provided.

<br><br>
Click <a href="/">Here To Go Back</a>