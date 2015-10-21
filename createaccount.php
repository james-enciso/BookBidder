<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/header.php";
 require_once $_SERVER['DOCUMENT_ROOT'] . "/classes/newUserClass.php"; ?>
<div class="searchBlock">

Create an Account!<br>
Please fill in the information below to get started<br><br>


<?php
//preliminary check
//check if var set
if(isset($_POST['name'])){
	
		
		//set flag for terms and conditions checking
		$termsStatus = 0;
				if(isset($_POST['accepted'])){ $termsStatus = 1;}
		
		$incomingUser =	new NewUser;
		//set parameters
		$incomingUser -> name = $_POST['name'];
		$incomingUser -> username = $_POST['username'];
		$incomingUser -> password1 = $_POST['password'];
		$incomingUser -> password2 = $_POST['password2'];
		$incomingUser -> emailaddress = $_POST['emailaddress'];

		
		$incomingUser -> setAcceptedTermsStatus($termsStatus);
		$incomingUser -> verifyNewAccountEntry();
		
		/*
		
			//check and proceed if free to write into table
			if( checkexisting($tableName, $userArgument, $userValue) == 0){
				//if free, extract inputs and save to database
				
				$nameValue = mysql_real_escape_string($_POST['name']);
				$usernameValue = mysql_real_escape_string($_POST['username']);
				$passValue = mysql_real_escape_string($_POST['password']);
				
				$sql = "INSERT INTO login (name, username, pass) VALUES ('$nameValue','$usernameValue','$passValue')";
				
				mysql_query($sql);
				
				//redirect to main page after successful creation
				header("Location:/");
				

				}

		*/
		
		}	
		
		
	//}


?>





<center>
<form action="createaccount.php" method="POST">
<table>
<tr><td>Name</td><td><input name="name" type="text" placeholder="Name" value="<?php 
	if(isset($_POST['name'])){
		echo $_POST['name']; } ?>"></td></tr>
<tr><td>Username</td>
<td> <input name="username" type="text" placeholder="Username" value="<?php 
	if(isset($_POST['username'])){
		echo $_POST['username']; } ?>" ></td></tr>
        
<tr><td>Email Address</td>
<td><input name="emailaddress" type="text" placeholder="Email Address" value="<?php 
	if(isset($_POST['emailaddress'])){
		echo $_POST['emailaddress']; } ?>"></td></tr>
        
<tr><td>Password</td> 
<td><input name="password" type="password" placeholder="Password" value="<?php 
	if(isset($_POST['password'])){
		echo $_POST['password']; } ?>"></td></tr>

<tr><td>Confirm Password</td>
<td><input name="password2" type="password" placeholder="Confirm Password" value="<?php 
	if(isset($_POST['password2'])){
		echo $_POST['password2']; } ?>"></td></tr>

</table>
<hr>
<input name="accepted" type="checkbox" <?php if(isset($_POST['accepted'])){echo 'checked="checked"';} ?>  value="" > I have read and accept the privacy policy for BookBidder
<br>
<input class="buttonStyle" name="" type="submit" value="Create my Account!" >
</form>
</center>

</div>

<div id="aboutbox"><?php  require nl2br("./img/about.txt") ?></div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/footer.php"; ?>

