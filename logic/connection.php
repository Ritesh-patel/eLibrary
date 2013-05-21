<?php
	function getConnection(){
		return new MySQLi("localhost","root", "","ebook");
	}
	
	$con=getConnection();
	if(!$con)
	{
		die('could not connect'. mysql_error());
	}
?>
