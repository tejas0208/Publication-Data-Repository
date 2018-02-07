<?php
   //include('config.php');
   session_start();
   
   $user = $_SESSION['mis'];
   $level = $_SESSION['level'];
   
   //$ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");
   
   //$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   //$login_session = $row['username'];
   
   //TODO
   //change this after adding correct login
   if(!isset($_SESSION['level'])){
      header("location:dummy_login.php");
   }
?>