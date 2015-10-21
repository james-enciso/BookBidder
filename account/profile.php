<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] .  "/header.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/classes/newUserClass.php");


$userobject = new newUser;
$userobject -> getUserInfoByID($_GET['id']);

echo $userobject -> name . "<br>";
echo $userobject -> username . "<br>";


?>