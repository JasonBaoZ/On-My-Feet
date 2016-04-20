<?php
include("checkCredentials.php");

if($_COOKIE['username'] != ""){
	include('db_connect.php');
	$tbl_name = "Resources2";
	$id = $_POST['id'];
	$sql = "SELECT User FROM $tbl_name WHERE ID= $id";
	$result = mysql_query($sql);
	while($row=mysql_fetch_array($result)){
		if($row['User'] === $_COOKIE['username'] || strtolower($_COOKIE['username']) === strtolower("trinityAdmin")){
			$name = $_POST['name'];
			$type = $_POST['type'];
			$url = $_POST['url'];
			$location = $_POST['location'];
			$newLocat = lookup($location);
			$lat = $newLocat['lat'];
    		$lng = $newLocat['lng'];
			$hours = $_POST['hours'];
			$details = $_POST['details'];
			$number = $_POST['number'];
			$sql2 = "UPDATE $tbl_name SET Name = '$name', Type = '$type', url = '$url', Location = '$location', Hours = '$hours', Details = '$details', Number = '$number', Lat = '$lat', Lng = '$lng' WHERE ID = $id";
			mysql_query($sql2);
			echo "Success";
		}
		else{
			echo "Access Denied. You must be the creator of the resource to edit the resource. Any questions email bao.jason.z@gmail.com";
		}
		break;
	}
}
function lookup($string){
 
   $string = str_replace (" ", "+", urlencode($string));
   $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=".$string."&sensor=false";
 
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $details_url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $response = json_decode(curl_exec($ch), true);
 
   // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
   if ($response['status'] != 'OK') {
    return $response['status'];
   }
 
   $geometry = $response['results'][0]['geometry']['location'];
   $array = array("lat"=>$geometry['lat'], "lng"=>$geometry['lng']);
   return $array;
    //return "(".$geometry['lat'].",".$geometry['lng'].")";
  
}

?>