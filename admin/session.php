<?php
$login_session=$_SESSION['username'];

if(!isset($login_session)){
  
header("Location: login.php");// Redirecting To Home Page
}
?>