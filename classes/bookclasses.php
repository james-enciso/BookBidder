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
	
	//private attributes that preset arguments
	private $tableName = "books";
	private $idvalue = "id";
	public $bookDoesExist = 0;
	
	//main function to call other private functions
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
	
	public function getBookInfoForTitle($titlequery){
		require_once($_SERVER['DOCUMENT_ROOT'] . "/functions.php");
		
		
		$tableName = $this -> tableName;
		$searchQuery = "SELECT id FROM $tableName WHERE title LIKE '$titlequery'";

	$booleanVariable = mysql_query($searchQuery);


	while($rows = mysql_fetch_assoc($booleanVariable)){
		
		 	$this -> bookEntryDBID = 
		//extractdata($this -> tableName, "id", $titlequery, "title");	
				$rows['id'];

			//check if can get title from id
			$this -> getBookTitle();

		if(($this -> title) == NULL){
			$this -> bookDoesExist = 0;
					
				}else{
					$this -> bookDoesExist = 1;
				}
				
			if($this -> bookDoesExist == 1){
				$this -> getBookAuthor();
				$this -> getBookISBN();
				$this -> getBookPrice();
				$this -> getBookNegotiableStatus();
				$this -> getSellerNameFromSellerID();
			}

		//echo all values out
		echo '<div class="searchbookbg">';
		echo '<span class="searchbookprice">$ ' .  $this -> price . "<br></span>";
		echo '<span class="searchbooktitle">'. $this -> title . "<br></span>";

		echo '<span class="searchbooknegotiate">Negotiable: ' . $this -> isnegotiable . "<br></span>";	

		echo '<span class="searchbookseller">Seller: ' .  $this -> sellername . "<br></span>";

		echo '<span class="searchbookauthor">By: ' .  $this -> author . "<br></span>";
		echo '<span class="searchbookISBN">ISBN: ' .  $this -> ISBN . "<br></span>";
	
		echo "</div>";

		
	}
	if ($this -> bookEntryDBID == NULL){
		 	echo '<p class="registrationError">No Books Found</p>';				
 	 }
	/*
			//fetch book id for title requested, if any
		 	$this -> bookEntryDBID = 
		extractdata($this -> tableName, "id", $titlequery, "title");	

			//check if can get title from id
			$this -> getBookTitle();

		if(($this -> title) == NULL){
			$this -> bookDoesExist = 0;
					
				}else{
					$this -> bookDoesExist = 1;
				}
				
			if($this -> bookDoesExist == 1){
				$this -> getBookAuthor();
				$this -> getBookISBN();
				$this -> getBookPrice();
				$this -> getBookNegotiableStatus();
				$this -> getSellerNameFromSellerID();
			}

		*/
		
		
		
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
		$bookid = $this -> bookEntryDBID;
		$sql = "SELECT * FROM books WHERE id = $bookid";
		$booleanVariable = mysql_query($sql);
	while($rows = mysql_fetch_assoc($booleanVariable)){

		$selleridVal = $rows['id'];
	}

		$sql = "SELECT * FROM login WHERE id = $selleridVal";
		$booleanVariable = mysql_query($sql);
	while($rows = mysql_fetch_assoc($booleanVariable)){
			$this -> sellername = $rows['name'];

	}
		
		
		}
	
	
	
	}





?>