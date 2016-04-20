<?php
include('db_connect.php');
session_start();
$_SESSION['badreg']="";
if($_POST['submit'] ==="Sign Up"){
	$user = $_POST['username'];
	$userE = stripslashes($user);
	$userE = mysql_real_escape_string($userE);
	$organization = $_POST['organization'];
	$organizationE= stripslashes($organization);
	$organizationE= mysql_real_escape_string($organizationE);
	$email = $_POST['myemail'];
	$emailE= stripslashes($email);
	$emailE= mysql_real_escape_string($emailE);
	$password1 = $_POST['mypassword1'];
	$password1E= stripslashes($password1);
	$password1E= mysql_real_escape_string($password1E);
	$password2 = $_POST['mypassword2'];
	$password2E= stripslashes($password2);
	$password2E= mysql_real_escape_string($password2E);
	
		if(($user != $userE) || ($organization != $organizationE) || ($password1E != $password1) || ($email != $emailE) || ($password2!=$password2E)){
			$_SESSION['badreg'] = "Make sure you don't have any slashes in any field";
			echo "hi";
		}elseif(($password1 != $password2) || ($user == "") || ($organization == "") || ($email == "") || ($password1 =="")){
			$_SESSION['badreg'] = "Make sure you have all fields completed and that your passwords match.";
			
		}else{
			
			mysql_query("INSERT INTO Login VALUES('','$user', '$password1', '$email', '$organization')") or die("cannot create");
			$expire = time() + 60*60*24;
			
			setcookie("username", $user, $expire);
			setcookie("password", $password1, $expire); 
			header('Location:index.php');
		}
}
else{
}

?>
<html>
<head>
<title>Sign Up</title>
</head>
<body>
	<div>
		<form name="signup" method="post" action="signup.php">
			<table>
				<tr>
					<td colspan="2" class="heading">Sign Up </td>
				</tr>
				<tr>
					<td>Username:</td>
					<td><input name="username" type="text" maxlength="65" /></td>
				</tr>
				<tr>
					<td>Organization Name:</td>
					<td><input name="organization" type = "text" /></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input name="myemail" type="text"/></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input name="mypassword1" type="password" maxlength="65" /></td>
				</tr>
				<tr>
					<td>Confirm password:</td>
					<td><input name="mypassword2" type="password" maxlength="65" /></td>
				
				</tr>
				<tr>
				
				</tr>
				<tr>
					<td colspan="2" class="right"><input name="submit" type="submit" value="Sign Up" /></td>
				</tr>
			</table>
		</form>
		<p style = "color:red"> <?php echo $_SESSION['badreg']; ?> </p>
		
	</div>
</body>
			
</html>