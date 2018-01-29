<?php
   session_start();

   if(session_destroy()) {
      header("Location: dummy_login.php");
   }
?>
