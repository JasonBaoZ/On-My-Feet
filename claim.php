<?php
include("checkCredentials.php");
if($_COOKIE['username'] != ""){
mail("jason2monster@gmail.com", "Resource Claim " . $_COOKIE['username'], "Resource was claimed with above user. Resource in question is id ".$_POST['id']. ". Email is ". $_POST['email']);
echo "An Email has been sent to the website administrator and he/she will follow up with you through email ASAP";
}else{
	echo "Please Login to use this service";
}

?>