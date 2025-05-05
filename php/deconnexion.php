<?php
session_start(); 
session_destroy();
$_SESSION['user'] = NULL;
header("Location: loginpage.php");
exit();
?>