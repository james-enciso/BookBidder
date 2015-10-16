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
	
	private function getBookTitle(){
			$userArgument = "title";
			$userValue = $this -> bookEntryDBID;
 			$this -> title = extractdata($this -> tableName, $userArgument, $userValue, $this -> idvalue);
	
				//echo "SSSS: " . $this -> title;
			

			if(($this -> title) == NULL){
				
				echo '<p class="registrationError">Book Not Found</p>';				$this -> bookDoesExist = 0;
					
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