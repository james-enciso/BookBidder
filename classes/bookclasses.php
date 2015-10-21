<?php
	
	class Book {
		
		//input
		public $bookEntryDBID;
		
		//output variables
		public $title;
		public $author;
		public $ISBN;
		public $price;
		public $sellername;	
		public $isnegotiable;
		public $sellerid;
		
		//private attributes that preset arguments
		private $tableName = "books";
		private $idvalue = "id";
		public $bookDoesExist = 0;
		
		//function to call other private functions (called in other files to search by BBID)
		public function getBookInfoForID(){
			require_once($_SERVER['DOCUMENT_ROOT'] . "/functions.php");
			
			$this -> getBookTitle();
			if($this -> bookDoesExist == 1){
				$this -> getBookAuthor();
				$this -> getBookISBN();
				$this -> getBookPrice();
				$this -> getBookNegotiableStatus();
				$this -> getSellerNameFromSellerID();
			}
		}
		
		//function to fetch all books containing a certain title requested 
		public function getBookInfoForTitle($titlequery){
		require_once($_SERVER['DOCUMENT_ROOT'] . "/functions.php");
			
			$tableName = $this -> tableName;
			$searchQuery = "SELECT id FROM $tableName WHERE title LIKE '%$titlequery%' ORDER BY id DESC";
			
			$this -> performDataFetch($searchQuery);
		}
		
		//---
		//prints all items listed by a particular person (will add permissions later)
		public function getBookInfoForUserID($userid){
			require_once($_SERVER['DOCUMENT_ROOT'] . "/functions.php");
			
			$tableName = $this -> tableName;
			$searchQuery = "SELECT id FROM $tableName WHERE sellerid = '$userid' ORDER BY id DESC";
			
			$this -> performDataFetch($searchQuery);
		}
		
				
		//fetches all items given a SQL Query that outputs book data in a format
		private function performDataFetch($searchQuery){
			
			$booleanVariable = mysql_query($searchQuery);
			
			while($rows = mysql_fetch_assoc($booleanVariable)){
				
			 $this -> bookEntryDBID = $rows['id'];
								
				//check if can get title from id
				$this -> getBookTitle();
				
				if(($this -> title) == NULL){
					$this -> bookDoesExist = 0;
					
				}else{
					$this -> bookDoesExist = 1;
				}
				
				if($this -> bookDoesExist == 1){
					$this -> getSellerNameFromSellerID();
					$this -> getBookAuthor();
					$this -> getBookISBN();
					$this -> getBookPrice();
					$this -> getBookNegotiableStatus();
				}
				
				//echo all values out
				echo '<a href="/searchbook.php?BBID=' . $this -> bookEntryDBID . '"><div class="searchbookbg">';
				echo '<span class="searchbookprice">$ ' .  $this -> price . "<br></span>";
				echo '<span class="searchbooktitle">'. $this -> title . "<br></span>";
				
				echo '<span class="searchbooknegotiate">Negotiable: ' . $this -> isnegotiable . "<br></span>";	
				
				echo '<span class="searchbookseller">Seller: '. $this -> sellername  ."</span>";
				
				echo '<span class="searchbookauthor">By: ' .  $this -> author . "<br></span>";
				echo '<span class="searchbookISBN">ISBN: ' .  $this -> ISBN . "<br></span>";
				
				echo "</div></a>";
				
				
			}
			if ($this -> bookEntryDBID == NULL){
				echo '<p class="registrationError">No Books Found</p>';				
			}
			
			
			}
		

	public function createNewBookWithGivenParameters(){
		
		if($this -> blankParametersFound() == 0){
		
		$title = $this -> title;
		$author = $this -> author;
		$isbn = $this -> ISBN;
		$sellerid = $this -> sellerid;
		$price = $this -> price;
		$isnegotiable = $this -> isnegotiable;
		
		$tableName = $this -> tableName;
		
				$sql = "INSERT INTO $tableName (title, author, ISBN, sellerid, price, isnegotiable) VALUES ('$title', '$author', '$isbn', '$sellerid', '$price', '$isnegotiable')";

		mysql_query($sql);
		}
		
		
		}

		
		
		
		//----------
	
		private function getBookTitle(){
			$this -> title = 
			extractdata($this -> tableName, "title", $this -> bookEntryDBID, $this -> idvalue);
			
			
			if(($this -> title) == NULL){
				
				echo '<p class="registrationError">Book Not Found</p>';				
				$this -> bookDoesExist = 0;
				
			}else{
				$this -> bookDoesExist = 1;
			}
			
		}
		
		private function getBookAuthor(){
			$userArgument = "author";
			$userValue = $this -> bookEntryDBID;
			
			$this -> author = extractdata($this -> tableName, $userArgument, $userValue, $this ->idvalue);
			
		}
		
		private function getBookISBN(){
			$userArgument = "ISBN";
			$userValue = $this -> bookEntryDBID;
			
			$this -> ISBN = extractdata($this -> tableName, $userArgument, $userValue, $this ->idvalue);
		}
		
		private function getBookPrice(){
			$userArgument = "price";
			$userValue = $this -> bookEntryDBID;
			
			$this -> price = extractdata($this -> tableName, $userArgument, $userValue, $this ->idvalue);
		}
		
		private function getBookNegotiableStatus(){
			$userArgument = "isnegotiable";
			$userValue = $this -> bookEntryDBID;
			
			$tmp = extractdata($this -> tableName, $userArgument, $userValue, $this ->idvalue);
			
			switch($tmp){
				case 0: $this -> isnegotiable = "NO";
					break;
				case 1: $this -> isnegotiable = "YES";
					break;
			}
			
		}
		
		private function getSellerNameFromSellerID(){
			require_once $_SERVER['DOCUMENT_ROOT'] ."/sqlconnect.php";
			require_once $_SERVER['DOCUMENT_ROOT'] . "/selectdb.php";
			
			
			$bookid = $this -> bookEntryDBID;
			$tableName = $this -> tableName;
			
		$this -> sellerid =	 $selleridVal = extractdata($tableName, "sellerid", $bookid, "id");
 			$this -> sellername = extractdata("login", "username", $selleridVal, "id");


			
			
		}
		
		
private function blankParametersFound(){
		$tmpTitle = $this -> title;
		$tmpAuthor = $this ->author;
		$tmpISBN = $this -> ISBN;
		$tmpPrice = $this -> price;
		$tmpisNegotiable = $this -> isnegotiable;
		
		if($tmpTitle == NULL){echo '<p class="registrationError">Title cannot be blank</p><br>'; 
		return 1;}
		if($tmpAuthor == NULL){echo '<p class="registrationError">Author cannot be blank</p><br>';
		 return 1;}
		 	if($tmpISBN == NULL){echo '<p class="registrationError">  ISBN address cannot be blank</p><br>';
		return 1;}
		if($tmpPrice == NULL){echo '<p class="registrationError">Price cannot be blank</p><br>';
		return 1;}
		if($tmpisNegotiable == NULL){echo '<p class="registrationError">Please make a negotiable selection</p><br>';
		return 1;}
	
		
		//echo "No empty fields found<br>";
		return 0;
		
		}
		
		
	}
	
	
	
	
	
	?>