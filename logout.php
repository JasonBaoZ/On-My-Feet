<?php
unset($_COOKIE['username']);
unset($_COOKIE['password']);
setcookie('username', "", time()-100);
setcookie('password', "", time()-100);
header('Location:index.php');

?>