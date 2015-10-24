<?php

/*
Documentation
This class defines a registering user. Parameters are fetched from the registration page. When declaring, values of each input field are assigned to their respective public variable within the class.

Set the marked status of the terms and conditions checkbox by passing the BOOL (1/0) value to 	
	 setAcceptedTermsStatus($termsBOOL)

Then, call 
	verifyNewAccountEntry()
	to initialize the error checking and output all errors encountered
	If passes, the user will be registered on the system and redirected to the home page.

*/


class NewUser{
	
	public $name;
	public $username;
	public $password1;
	public $password2;
	public $emailaddress;
	
	//boolean that will be set when proper function calleds
	private  $didAcceptAgreements = 0;
	
	//private attributes that preset arguments
	private $tableName = "login";
	private $idvalue = "id";

	//------------
		//main function that handles everything
	
	public function verifyNewAccountEntry(){
		require_once ($_SERVER['DOCUMENT_ROOT'] . "/functions.php");
		require_once ($_SERVER['DOCUMENT_ROOT'] . "/sqlconnect.php");

		//stop checking if user didn't accept terms
		if ($this -> checkIfTermsAccepted() == 0){
			echo('<p class="registrationError">Terms Must Be Accepted First</p><br>');
			} 
		else{
			if(  ($this -> blankParametersFound() == 0) && ($this -> 			 hasExistingUsername() == 0) && ($this -> checkMatchingPasswords() == 1) ){
				
					echo "ready to create user<br>";
				//if free, extract inputs and save to database
				
				$nameValue = $this -> name;
				//mysql_real_escape_string($_POST['name']);
				$usernameValue = $this -> username;
				//mysql_real_escape_string($_POST['username']);
				$passValue = $this -> password1;
				//mysql_real_escape_string($_POST['password']);
				$emailValue = $this -> emailaddress;
				
				$sql = "INSERT INTO login (name, username, pass, emailaddress) VALUES ('$nameValue','$usernameValue','$passValue', '$emailValue')";
				
				mysql_query($sql);
						
                //log user in by calling login.php
				$_POST['username'] = $this -> username;
				$_POST['password'] = $this -> password1;
				require_once($_SERVER['DOCUMENT_ROOT'] . "/login.php");
                
				
				
			}
	
		}
	
	}


	public function getUserInfoByID($uid){
		require_once($_SERVER['DOCUMENT_ROOT'] . "/sqlconnect.php");
		require_once($_SERVER['DOCUMENT_ROOT'] . "/selectdb.php");
		require_once($_SERVER['DOCUMENT_ROOT'] . "/functions.php");
		
		
		 $table = $this -> tableName;
		
		//parameters
		
		
		//fetch all parameters
//extractdata($tableName, $userArgument, $userValue, $idvalue){
		
	$this -> name = extractdata($table, "name", $uid, "id");
	$this -> username = extractdata($table, "username", $uid, "id");
	
		
		
		
		
		}





	//called to set the terms checkbox status (used for determining whether to proceed)
	public function setAcceptedTermsStatus($termsBOOL){
		$this -> didAcceptAgreements = $termsBOOL;
		}
	//------private functions
	

	//checks if terms and conditions were accepted (called after setting status flag)
	private  function checkIfTermsAccepted(){
		 $termsAccepted = $this -> didAcceptAgreements;
		if($termsAccepted == 1){
			return 1;
		}
			else{
				return 0;		
			}
		}
		
		//checks if any parameter is blank
	private function blankParametersFound(){
		$tmpName = $this -> name;
		$tmpUsername = $this ->username;
		$tmpPassword1 = $this -> password1;
		$tmpPassword2 = $this -> password2;
		$tmpEmail = $this -> emailaddress;
		
		if($tmpName == NULL){echo '<p class="registrationError">Name cannot be blank</p><br>'; 
		return 1;}
		if($tmpUsername == NULL){echo '<p class="registrationError">Username cannot be blank</p><br>';
		 return 1;}
		 	if($tmpEmail == NULL){echo '<p class="registrationError">  Email address cannot be blank</p><br>';
		return 1;}
		if($tmpPassword1 == NULL){echo '<p class="registrationError">Password cannot be blank</p><br>';
		return 1;}
		if($tmpPassword2 == NULL){echo '<p class="registrationError">Please confirm password</p><br>';
		return 1;}
	
		
		//echo "No empty fields found<br>";
		return 0;
		
		}
		
		//------PRIVATE functions-----
		
		
	private function hasExistingUsername(){
		
		//if ready, check existing user
		//mysql_select_db("bookbidder");
		require_once $_SERVER['DOCUMENT_ROOT'] . "/sqlconnect.php";
		require_once $_SERVER['DOCUMENT_ROOT'] . "/selectdb.php";
			$tableName = "login";
			$userArgument = "username";
			$userValue = $_POST['username'];
			
			//check and proceed if free to write into table
			if( checkexisting($tableName, $userArgument, $userValue) == 0){echo '<p class="registrationSuccess">Username Available'; }
			else{
				echo '<p class="registrationError">Username Taken</p>';
				}
		}
		
	
	private function checkMatchingPasswords(){
		
		$pw1 = $this -> password1;
		$pw2 = $this -> password2;
		
		if($pw1 == $pw2){
			echo '<p class="registrationSuccess">Passwords Match</p><br>';
			return 1;
			}
		else{
			echo '<p class="registrationError">Passwords must match</p><br>';
			return 0;
			}
		
		}
	
	





}


?>