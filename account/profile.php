<?php
require_once ($_SERVER['DOCUMENT_ROOT'] .  "/header.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/classes/newUserClass.php");


$userobject = new newUser;
$userobject -> getUserInfoByID($_GET['user']);

echo $userobject -> name . "<br>";
echo $userobject -> username . "<br>";


?>