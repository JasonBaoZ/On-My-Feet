<?php
$id = $_POST['id'];
include("db_connect.php");
$tbl_name = "Resources2";
$query = "SELECT * FROM $tbl_name WHERE ID = '$id'";
$result = mysql_query($query);
$everything = array();
while($row = mysql_fetch_array($result)){

$type = preg_replace('!\s+!', '', $row['Type']);
array_push($everything, $row['Name'], $type, $row['url'], $row['Location'], $row['Hours'], $row['Details'], $row['Number']);
echo json_encode($everything); 
break;
}

?>