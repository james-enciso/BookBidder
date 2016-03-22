<?php
	
	/*
	This is the Book class. All information and methods regarding to books are defined here.
	There are 3 ways to use it
		- initWithBBID($BBIDval)
			- for fetching all book information by BBID
			- input: BBID
			- output (array{info, info, info, ...})
	
		- getAllBookInfoByTitle($titlequery)
			- for fetching list of all books having a given title  
			- input: any title
			- output: array{ array{info, info...}, array{info, info, ...}, array{info, info, info} }
	
		- getAllBookInfoForUserID($userid)
			- for fetching list of all books posted by a particular user (by sellerid)
			- input: user id number
	
	---
		- createNewBookWithGivenParameters()
			- for creating a new book using given parameters
	
	
	*/
	
	class Book {
		
		//input
	//	private $bookEntryDBID;
		private $BBID;
		
		//output variables
		private $title;
		private $author;
		private $ISBN;
		private $price;
		private $sellername;	
		private $isnegotiable;
		private $sellerid;
		
		
		
		//getters
		//public function setBookTitle(){ return $this -> title; }
		//public function setBookAuthor(){ return $this -> author; }
		//public function setBookISBN(){ return $this -> ISBN; }
		//public function setBookPrice(){ return $this -> price; }
		//public function getBookSellerName(){return $this -> sellername; }
		//public function getBookSellerID(){return $this -> sellerid; }
		//public function getBookIsNegotiable(){return $this -> isnegotiable; }
				
	
		
		//private attributes that preset arguments
		private $tableName = "books";
		private $idvalue = "id";
		public $bookDoesExist = 0;
		
		//function to call other private functions (called in other files to search by BBID)
		//initialises the class with all information regarding to a Book using the BBID given
		public function initWithBBID($BBIDval){
			require_once($_SERVER['DOCUMENT_ROOT'] . "/functions.php");
			
			$this -> BBID = $BBIDval;

			$this -> setBookTitle();
			if($this -> bookDoesExist == 1){
			
			
				$this -> setBookAuthor();
				$this -> setBookISBN();
				$this -> setBookPrice();
				$this -> setBookNegotiableStatus();
				$this -> setSellerNameFromSellerID();
				
				
					$SetOfBooksArray = array(
					  "bookid" => $this -> BBID ,
					  "booktitle" => $this -> title ,
					  "booknegotiable" => $this -> isnegotiable,
					  "booksellername" => $this -> sellername,
					  "booksellerid" => $this -> sellerid,
					  "bookauthor" => $this -> author,
					  "bookISBN" => $this -> ISBN,
					  "bookprice" => $this -> price
				
				);
			 
			// var_dump($SetOfBooksArray);
				return $SetOfBooksArray;
				
			}
		}
		
		//function to fetch all books containing a certain title requested 
		public function getAllBookInfoByTitle($titlequery){
			require_once($_SERVER['DOCUMENT_ROOT'] . "/functions.php");
			
			$tableName = $this -> tableName;
			$searchQuery = "SELECT id FROM $tableName WHERE title LIKE '%$titlequery%' ORDER BY id DESC";
			
			return $this -> performDataFetch($searchQuery);
		}
		
		//---
		//prints all items listed by a particular person (will add permissions later)
		public function getAllBookInfoForUserID($userid){
		 	require_once($_SERVER['DOCUMENT_ROOT'] . "/functions.php");
			
			$tableName = $this -> tableName;
			$searchQuery = "SELECT id FROM $tableName WHERE sellerid = '$userid' ORDER BY id DESC";
			
						//returned as array with keys

			$fetchedContents =  $this -> performDataFetch($searchQuery);
			return $fetchedContents;
		}
		
				
		//fetches all items given a SQL Query that outputs book data in a format
		private function performDataFetch($searchQuery){
			
			$SetOfBooksArray = array();
			/*
				"individualBook" => array(
					"bookid" => "" ,
					"booktitle" => "" ,
					"booknegotiable" => "",
					"booksellername" => "",
					"bookauthor" => "",
					"bookISBN" => "",
				
				)
			 );*/
			
			$booleanVariable = mysql_query($searchQuery);
			
			while($rows = mysql_fetch_assoc($booleanVariable)){
				
			 $this -> BBID = $rows['id'];
								
				//check if can get title from id
				$this -> setBookTitle();
				
				if(($this -> title) == NULL){
					$this -> bookDoesExist = 0;
					
				}else{
					$this -> bookDoesExist = 1;
				}
				
				if($this -> bookDoesExist == 1){
					$this -> setSellerNameFromSellerID();
					$this -> setBookAuthor();
					$this -> setBookISBN();
					$this -> setBookPrice();
					$this -> setBookNegotiableStatus();
				}
				
				 $individualBookArray =
				
				
				array(
				"bookid" => $this -> BBID,
				"booktitle" => $this -> title,
				"booknegotiable" => $this -> isnegotiable,
				"booksellername" => $this -> sellername,
				"booksellerid" => $this -> sellerid,
				"bookauthor" => $this -> author,
				"bookISBN" => $this -> ISBN,
				"bookprice" => $this -> price
				
				);
				
				
				//var_dump($individualBookArray);
				//$SetOfBooksArray = $individualBookArray;

				$SetOfBooksArray[] = $individualBookArray;

				
				/*
				//echo all values out
				echo '<a href="/searchbook.php?BBID=' . $this -> bookEntryDBID . '"><div class="searchbookbg">';
				echo '<span class="searchbookprice">$ ' .  $this -> price . "<br></span>";
				echo '<span class="searchbooktitle">'. $this -> title . "<br></span>";
				
				echo '<span class="searchbooknegotiate">Negotiable: ' . $this -> isnegotiable . "<br></span>";	
				
				echo '<span class="searchbookseller">Seller: '. $this -> sellername  ."</span>";
				
				echo '<span class="searchbookauthor">By: ' .  $this -> author . "<br></span>";
				echo '<span class="searchbookISBN">ISBN: ' .  $this -> ISBN . "<br></span>";
				
				echo "</div></a>";
				
				*/
				
			}
			if ($this -> BBID == NULL){
				echo '<p class="registrationError">No Books Found</p>';				
			}
			
			//var_dump($SetOfBooksArray);
			return $SetOfBooksArray;
			
	}
		

	public function createNewBookWithGivenParameters(){
		require_once $_SERVER['DOCUMENT_ROOT'] . "/sqlconnect.php";
		require_once $_SERVER['DOCUMENT_ROOT'] . "/selectdb.php";
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
	
		private function setBookTitle(){
			$this -> title = 
			extractdata($this -> tableName, "title", $this -> BBID, $this -> idvalue);
			$this -> sellerid = 
			extractdata($this -> tableName, "sellerid", $this -> BBID, $this -> idvalue);

			
			if(($this -> title) == NULL){
				
				echo '<p class="registrationError">Book Not Found</p>';				
				$this -> bookDoesExist = 0;
				
			}else{
				$this -> bookDoesExist = 1;
			}
			
		}
		
		private function setBookAuthor(){
			$userArgument = "author";
			$userValue = $this -> BBID;
			
			$this -> author = extractdata($this -> tableName, $userArgument, $userValue, $this ->idvalue);
		}
		
		private function setBookISBN(){
			$userArgument = "ISBN";
			$userValue = $this -> BBID;
			
			$this -> ISBN = extractdata($this -> tableName, $userArgument, $userValue, $this ->idvalue);
		}
		
		private function setBookPrice(){
			$userArgument = "price";
			$userValue = $this -> BBID;
			
			$this -> price = extractdata($this -> tableName, $userArgument, $userValue, $this ->idvalue);
		}
		
		private function setBookNegotiableStatus(){
			$userArgument = "isnegotiable";
			$userValue = $this -> BBID;
			
			$tmp = extractdata($this -> tableName, $userArgument, $userValue, $this ->idvalue);
			
			switch($tmp){
				case 0: $this -> isnegotiable = "NO";
					break;
				case 1: $this -> isnegotiable = "YES";
					break;
			}
		}
		
		private function setSellerNameFromSellerID(){
			require_once $_SERVER['DOCUMENT_ROOT'] ."/sqlconnect.php";
			require_once $_SERVER['DOCUMENT_ROOT'] . "/selectdb.php";
			
			
			$bookid = $this -> BBID;
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