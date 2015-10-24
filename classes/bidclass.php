<?php

 function createBidWithVariables($bookid, $biddername, $bidderemail, $bidderphone, $bidderofferprice){
		
		require_once "sqlconnect.php";
		require_once "selectdb.php";
		$tableName = "offers";

		$sql = "INSERT INTO $tableName (bookid, name, email, phone, price) VALUES ('$bookid', '$biddername', '$bidderemail', '$bidderphone', '$bidderofferprice')";

		mysql_query($sql);

				
}
	




?>