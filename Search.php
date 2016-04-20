<?php

	
	$name = $_POST['sname'];
	$type = $_POST['stype'];
	$location = $_POST['sLocation'];
	$start = $_POST['sstart'];
	$end = $_POST['send'];
	include('db_connect.php');
	$tbl_name = "Resources2";
		$sql = "SELECT * FROM $tbl_name WHERE Name LIKE "."\"".$name."%"."\""." AND Type LIKE"."\"".$type."%"."\""." AND Location LIKE"."\"".$location."%"."\""." AND Start LIKE"."\"".$start."%"."\""." AND End LIKE"."\"".$end."%"."\"" ;
		$result=mysql_query($sql);
		while($row=mysql_fetch_array($result)){
			echo "Name: ".$row['Name']."<br>";
			echo "Type: ".$row['Type']."<br>";
			echo "Location: ".$row['Location']."<br>";
			echo "Start Date: ".$row['Start']."<br>";
			echo "End Date: ".$row['End']."<br>";
			echo "Details: ".$row['Details']."<br><br>";
		}
	
	
?>