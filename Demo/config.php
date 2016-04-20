<?php

$mysqli = new mysqli("localhost","root","","visiting_card");

if(mysqli_connect_errno()){
    
  trigger_error('Connection failed: '.$mysqli->error);
}
else
{
    date_default_timezone_set("Asia/Kolkata"); 
    //$mysqli->query("SET NAMES 'utf8'");
    //$mysqli->query("SET CHARACTER SET utf8");
}


?>