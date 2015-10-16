<?php
//load cookies
session_start();
//end session (destroy cookies)
session_destroy();

echo "<center>You are now logged out. <br></center>";
echo '<center>Click <a href="../" >Here</a> to return to the main page.</center>';

?>
	<script>window.location = "/";</script>
