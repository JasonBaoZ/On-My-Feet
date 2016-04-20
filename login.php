<?php
	session_start();
	
	
	if(isset($_COOKIE['username'])){
		
		header('Location:index.php');
	}
	elseif($_POST['username']!="" || $_POST['password']!=""){
		$user=$_POST['username'];
		$pass=$_POST['password'];
		
		include('db_connect.php');
		$tbl_name = "Login";
		$user = stripslashes($user);
		$pass = stripslashes($pass);
		$user = mysql_real_escape_string($user);
		$pass = mysql_real_escape_string($pass);
		$sql="SELECT * FROM $tbl_name WHERE username='$user' and password='$pass'";
		
		$result=mysql_query($sql);
		
		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);
		
		if($count==1){
			$expire = time() + 60*60*24;
			setcookie("username", $user, $expire);
			setcookie("password", $pass, $expire);
			
			header('Location:index.php');
			
		}else{
			$_SESSION['wrong'] = "false";
			
		}
		
	
	}else{
		
	}


?>

<html>
<head>
<title>Log In</title>
</head>

<body>
<form id="login" name="login" method="post" action="login.php">
Username: <input name="username" id="username" type="text" /><br>
Password: <input name="password" id = "password" type = "password" >
<input type="submit" name="submit" id="submit" value="Submit">
</form>
<p id="wrong" style="color:red"><?php 
	if(isset($_SESSION['wrong'])){
		if($_SESSION['wrong']==="false"){
			echo "Wrong Username or Password";
		}
		unset($_SESSION['wrong']);
	}
?></p>
	
	
<p id= "none">
Don't Have an account? Sign up <a href="signup.php"> here </a>
</p>

</body>

</html>