<?php
include("db_connect.php");
$tbl_name = "Resources2";
if($_GET['alphabet']==1){
	$query = mysql_query("SELECT * FROM $tbl_name ORDER BY Name");
}else{
	$query = mysql_query("SELECT * FROM $tbl_name");
}
while($row = mysql_fetch_array($query)){
	echo "<h3 style='display:inline'>Name: </h3>".$row['Name']."<br>";
	echo "<h3 style='display:inline'>Type: </h3>".$row['Type']."<br>";
	echo "<h3 style='display:inline'>URL: </h3>".$row['url']."<br>";
	echo "<h3 style='display:inline'>Location: </h3>".$row['Location']."<br>";
	echo "<h3 style='display:inline'>Details: </h3>".$row['Details']."<br>";
	echo "<h3 style='display:inline'>Number: </h3>".$row['Number']."<br><br>";
}
?>