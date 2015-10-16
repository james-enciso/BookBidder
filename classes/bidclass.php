<?php

 function createBidWithVariables($bookid, $biddername, $bidderemail, $bidderphone, $bidderofferprice){
		
		require_once "sqlconnect.php";
		mysql_select_db("bookbidder");
		$tableName = "offers";

		$sql = "INSERT INTO $tableName (bookid, name, email, phone, price) VALUES ('$bookid', '$biddername', '$bidderemail', '$bidderphone', '$bidderofferprice')";

		mysql_query($sql);

				
}
	




?>