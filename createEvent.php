<?php
include('checkCredentials.php');
if($_POST['submit']==="Create Event"){
if($_COOKIE['username']!=""){
$lat = mysql_real_escape_string ($_POST['Latitude']);
$lng = mysql_real_escape_string ($_POST['Longitude']);
$user = mysql_real_escape_string ($_COOKIE['username']);
$name = mysql_real_escape_string ($_POST['name']);
$type =  mysql_real_escape_string ($_POST['type']);
$url =  mysql_real_escape_string ($_POST['URL']);
$location = $_POST['streetnum']. " ". $_POST['streetnam']." ". $_POST['city'] . ", " . $_POST['state'];
$start =  mysql_real_escape_string ($_POST['start']);
$end =  mysql_real_escape_string ($_POST['end']);
$details = mysql_real_escape_string ( $_POST['details']);
$hours =  mysql_real_escape_string ($_POST['hours']);
$number =  mysql_real_escape_string ($_POST['number']);
include('db_connect.php');
mysql_query("INSERT INTO Resources2(User, Name, Type, url, Location, Lat, Lng, Start, End, Hours, Details, Number) VALUES('$user', '$name', '$type', '$url', '$location', '$lat', '$lng' , '$start', '$end', '$hours', '$details', '$number')") or die("cannot create");
}}
?>