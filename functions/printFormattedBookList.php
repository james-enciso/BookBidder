<?php

/*
This script prints the formatting for each listed book entry using the CSS format defined

This script is referenced by the following
	- searchbook.php
	

How to call
require_once ..../path/thisfile.php
printFormattedBookList($variableOfArray)


How it works
	- depending on the function used to receive the list of books, it can either return just 1 single book, or a list

printFormattedBookList() tries to determine if it's a list (if nested array) or just 1 book (single array)

Either way, it then calls the printFormat() function to output the data encoded with HTML and CSS formatting tags

*/




//called when printing information out in a fancy list format
//takes in an array of information corresponding to respective format defined in Book class
function printFormattedBookList($bookInfo){
	
//treat as nested array, in case multiple entries are to be printed
	//foreach($bookInf as $bookInfo){
	
	 $isNestedArray = 0;
	
	//check  item inside array, and determine if is an array too
	foreach ($bookInfo as $array){
	  if(is_array($array)){
		 // echo "multi";
		  $isNestedArray = 1;
		  break;
	  
	  }
	
	}
	//print HTML+CSS Formatting if it's either a list or single item
		if($isNestedArray == 1){
			foreach($bookInfo as $array)
			printFormat($array);
		}
		elseif ($isNestedArray == 0)
			printFormat($bookInfo);

	}

//follow-up function to do the printing, after determiing if nested array or just single array

function printFormat($singleBook){
	/*
	echo '<div class="searchbookbg">';
echo "Title: " . $bookInfo["booktitle"] . "<br>";
echo "Author: " .  $bookInfo["bookauthor"] . "<br>";
echo "ISBN: " .  $bookInfo["bookISBN"] . "<br>";
echo "Asking Price: $ " .  $bookInfo["bookprice"] . "<br>";
echo "Willing to Negotiate: " . $bookInfo["booknegotiable"]  . "<br>";
echo 'Seller: <a href="/account/profile.php?id=' .  $bookInfo["booksellerid"] . '">' .  $bookInfo["booksellername"] . "</a><br>";
echo "</div>";
	}
	
	*/
	
	//print out formatted code
echo '<a href="/searchbook.php?BBID=' . $singleBook["bookid"] . '"><div class="searchbookbg">';

echo '<span class="searchbookprice">$ ' .  $singleBook["bookprice"]  . "<br></span>";
echo '<span class="searchbooktitle">'. $singleBook["booktitle"] . "<br></span>";
				
echo '<span class="searchbooknegotiate">Negotiable: ' . $singleBook["booknegotiable"] . "<br></span>";	
				
echo '<a href='. '/account/profile.php?id=' . $singleBook["booksellerid"] . '"><span class="searchbookseller">Seller: '. "<span class='searchbooksellername'>" . $singleBook["booksellername"]  ."</span></span>";
				
echo '<span class="searchbookauthor">By: ' .  $singleBook["bookauthor"] . "<br></span>";
echo '<span class="searchbookISBN">ISBN: ' .  $singleBook["bookISBN"] . "<br></span>";
				
echo "</div></a>";
		
}
	

?>