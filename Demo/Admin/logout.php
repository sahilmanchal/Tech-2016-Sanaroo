<?php
  @session_start();
  unset($_SESSION['card_admin_id']);
  unset($_SESSION['card_admin_name']);
  //session_destroy();
  header("location:../index.php");
  
  
 ?>
 