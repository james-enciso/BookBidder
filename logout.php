<?php
//load cookies
session_start();
//end session (destroy cookies)
session_destroy();
?>

<center>You are now logged out.<br>
Click <a href="../" >Here</a> to return to the main page.</center>
	<script>window.location = "/";</script>
