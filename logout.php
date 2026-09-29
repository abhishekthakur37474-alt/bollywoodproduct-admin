<?php
session_start();
	unset($_SESSION["admin"]);
	unset($_SESSION["id"]);
	unset($_SESSION["email"]);
	
	session_destroy();
	header("location:index.php");

?>
