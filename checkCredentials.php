<?php
    $user = $_COOKIE['username'];
    $pass = $_COOKIE['password'];
    include('db_connect.php');
    $tbl_name = "Login";
    $user = stripslashes($user);
    $pass = stripslashes($pass);
    $user = mysql_real_escape_string($user);
    $pass = mysql_real_escape_string($pass);
    $sql="SELECT * FROM $tbl_name WHERE username='$user' and password='$pass'";
    $result=mysql_query($sql);
    $count=mysql_num_rows($result);
    if($count==1){
        
    }else{
	unset($_COOKIE['username']);
	unset($_COOKIE['password']);
	setcookie('username', "", time()-100);
	setcookie('password', "", time()-100);
	header('Location:index.php');
    }

?>