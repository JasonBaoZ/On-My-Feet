<?php
	$keyword=$_POST['Keyword'];
	$myaddress = $_POST['myAddress'];
	$myLat = $_POST['Lat'];
	$myLng = $_POST['Lng'];
	echo "<p id='postedKeyword' style='display:none'>".$keyword."</p>";
	echo "<p id='postedAddress' style='display:none'>".$myaddress."</p>";
	echo "<p id='postedLng' style='display:none'>".$myLat."</p>";
	echo "<p id='postedLat' style='display:none'>".$myLng."</p>";
	$tbl_name = "Resources2";
	$bDelete = $_POST['Delete'];
	$bEdit = $_POST['Edit'];
	include('db_connect.php');
	//$sql = "SELECT * FROM $tbl_name WHERE Name LIKE "."\""."%".$keyword."%"."\""." OR Type LIKE"."\""."%".$keyword."%"."\""." OR Location LIKE"."\""."%".$keyword."%"."\""." OR Start LIKE"."\""."%".$keyword."%"."\""." OR End LIKE"."\""."%".$keyword."%"."\"" ;
	$query = "SELECT COUNT(*) as num FROM $tbl_name WHERE Name LIKE '%$keyword%' OR Type LIKE '%$keyword%' OR Location LIKE '%$keyword%' OR Start LIKE '%$keyword%' OR End LIKE '%$keyword%' OR Details LIKE '%$keyword%'";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['num'];
	$limit = 10;
	$page = $_POST['page'];
	if($page){$start = ($page-1)*$limit;}
	else{$start = 0;}
	//$sql = "SELECT * FROM $tbl_name WHERE Name LIKE '%$keyword%' OR Type LIKE '%$keyword%' OR Location LIKE '%$keyword%' OR Start LIKE '%$keyword%' OR End LIKE '%$keyword%' OR Details LIKE '%keyword%' LIMIT $start, $limit" ;
	$sql = "SELECT *, ( 3959 * ACOS( COS( RADIANS( '$myLat' ) ) * COS( RADIANS( Lat ) ) * COS( RADIANS( Lng ) - RADIANS( '$myLng' ) ) + SIN( RADIANS('$myLat') ) * SIN( RADIANS( Lat ) ) ) ) AS distance\n"
    . "FROM $tbl_name\n"
    . "WHERE Name LIKE '%$keyword%' OR Type LIKE '%$keyword%' OR Location LIKE '%$keyword%' OR Start LIKE '%$keyword%' OR End LIKE '%$keyword%' OR Details LIKE '%$keyword%'\n"
    . "ORDER BY `distance` ASC \n"
    . "LIMIT $start , $limit\n"
    . "";	
    //echo $sql;
		$result=mysql_query($sql);
		$string = "";
		$counter =0;
		
		while($row=mysql_fetch_array($result)){
/*
		        $distance = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=".urlencode($myaddress)."&destinations=".$row['Lat'].",".$row['Lng']);
		        $obj = json_decode($distance);
		        $obj = objectToArray($obj);
		        $distance = $obj['rows'][0]['elements'][0]['distance']['value'];
		        */   
		    $string .= "<div class=contentDivs>";
		    $string .="<div class = cr-dwn-arw data-dropdown = '#dropdown-".$counter."'></div>";
		    $string .= "<div id='dropdown-".$counter."' class = 'dropdown dropdown-tip dropdown-anchor-right'>";
		    $string .= "<ul class= dropdown-menu>";
		    $string .= "<li><a href='?resourceID=".$row['ID']."'>Get Link</a></li><li><a onClick='showDirections(".$counter.")'>Show Directions</a></li></ul></div>";
		    /*if($row['User']!="Administrator"){
		    		$string .="</ul></div>";
		    }else{
		    	if($_COOKIE['username']!=""){
		    		$string .= "<li><a onClick='claimResource(".$row['ID'].");'> Claim Resource</a></li></ul></div>";
		    	}else{
		    		$string.="</ul></div>";
		    	}
		    }*/
			$counter +=1;
			if($bEdit){
				$string.= "<a href='index.php' onclick='editResource(".$row['ID'].");return false;'>";
			}elseif($bDelete){
				$string .= "<a href= 'deleteRes.php?ID=".$row['ID']."'>";
			}elseif($row['url'] != ""){ 
				$string = $string . "<a href='".$row['url']."'>";
			}
			$string = $string."<b><span id='resourceTitle".$counter."'>".$row['Name']."</span></b><br>";
			if($bDelete || $bEdit){
			}elseif($row['url'] != ""){ 
				$string .= "</a>";
			}
			$string = $string . "<b>Type:</b> ".$row['Type']."<br>";
			$string = $string . "<b>Location:</b> "."<span id='Location".$counter."'>".$row['Location']."</span>"."<br>";
			/*$string .= "Distance: ".$distance. " Meters <br>";*/
			$string = $string . "<b>Hours:</b> ".$row['Hours']."<br>";
			$string .= "<b>Phone Number:</b> ". $row['Number']."<br>";
			/*$string = $string . "Start Date: ".$row['Start']."<br>";
			$string = $string . "End Date: ".$row['End']."<br>";*/
			$string = $string . "<b>Details:</b> ".$row['Details']."<br><br>";
			$string = $string . "<p id='latlong".$counter."'"."style='display:none'>"."(".$row['Lat'].",".$row['Lng'].")"."</p>";
			if($bDelete){
				$string .="</a>";
			}
			if($bEdit){
				$string .= "</a>";
			}
			
			$string .="</div>";
		}
		$string = $string."<p id='counter' style='display:none'>".$counter."</p>";
		echo $string;
		echo "<p id='pageMarkers'>";
		for($i = 1; $i <= ceil($total_pages/$limit);$i++){
			echo '<a href="?page='.$i.'" onclick="changePage('.$i.');return false;">'.$i.' </a>';
		}
		echo "</p>";
function objectToArray($d) 
{
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    } else {
        // Return array
        return $d;
    }
}
/*function lookup($string){
 
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
  
}*/

?>