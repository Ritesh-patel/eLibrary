<?php
	session_start();	
	unset($_SESSION['eid']);
 unset($_SESSION['name']);
	header('location:index.php');
?>