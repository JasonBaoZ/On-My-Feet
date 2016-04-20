<?php
	error_reporting(-1);
    $id = $_POST['ID'];
    
    $tbl_name = "Resources2";
    include('db_connect.php');
    $id = stripslashes($id);
    $id = mysql_real_escape_string($id);
    $query = "SELECT * FROM $tbl_name WHERE ID = '$id'";
    $result = mysql_query($query);
    $string = "";
    $counter = 1;
    while($row = mysql_fetch_array($result)){
    	$string .= "<div class=contentDivs>";
		$string .="<div class = cr-dwn-arw data-dropdown = '#dropdown-1'></div>";
		$string .= "<div id='dropdown-1' class = 'dropdown dropdown-tip dropdown-anchor-right'>";
		$string .= "<ul class= dropdown-menu>";
		$string .= "<li><a href='?resourceID=".$row['ID']."'>Get Link</a></li><li><a onClick='showDirections(0)'>Show Directions</a></li></ul></div>";
		$string .= "<a href='".$row['url']."'>";
		$string .= "<b><span id='resourceTitle".$counter."'>".$row['Name']."</span></b><br>";
		$string .= "</a>";
		$string .= "<b>Type:</b> ".$row['Type']."<br>";
		$string .= "<b>Location:</b> "."<span id='Location".$counter."'>".$row['Location']."</span>"."<br>";
			$string = $string . "<b>Hours:</b> ".$row['Hours']."<br>";
			/*$string = $string . "Start Date: ".$row['Start']."<br>";
			$string = $string . "End Date: ".$row['End']."<br>";*/
			$string = $string . "<b>Details:</b> ".$row['Details']."<br><br>";
			$string = $string . "<p id='latlong".$counter."'"."style='display:none'>"."(".$row['Lat'].",".$row['Lng'].")"."</p>";
			$string .="</div>";
			break;
		}
		$string = $string."<p id='counter' style='display:none'>".$counter."</p>";
		echo $string;
    
?>