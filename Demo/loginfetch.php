<?php
include('config.php');
@session_start(); 
$username=$_POST['username'];
$password=$_POST['password'];

if($username!="" || !empty($username)&&$password!="" ||!empty($password)) 
{

$query = "select `id` from admin where `username`=? and password=?";
$stmt=$mysqli->prepare($query);
$stmt->bind_param( 'ss' , $username,$password); 
$stmt->execute();
$stmt->bind_result($id);
$stmt->store_result();
$stmt->fetch();

if($stmt->num_rows>0)
{
     $_SESSION['card_admin_name']=$username;
     $_SESSION['card_admin_id']=$id;         
     echo'<script>window.location="Admin/starter.php";</script>';
}

 else {
  
          $error = "Username or Password is invalid";
          $_SESSION['card_admin_error']=$error;
          echo'<script>window.location="index.php";</script>';
          
      }

}

else
{
          $error = "Username or Password is blank";
          $_SESSION['card_admin_error']=$error;
          echo'<script>window.location="index.php";</script>';
}

?>