<?php
   session_start();

   if(session_destroy()) {
      header("Location: final_login.php");
   }
?>
