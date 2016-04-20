<?php	
	$host="localhost"; // Host name 
	$username="jasonbao"; // Mysql username 
	$password="UUwylTCglVt8"; // Mysql password 
	$db_name = "Resources";
	mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
	mysql_select_db("$db_name")or die("cannot select DB");
?>