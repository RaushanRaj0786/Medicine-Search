<?php session_start();
   unset($_SESSION['username']);
   unset($_SESSION['user_type']);

   echo "You have been logged out successfully<br>";
   echo "please wait....";
   header('refresh: 2; url=index.php');
  
?>