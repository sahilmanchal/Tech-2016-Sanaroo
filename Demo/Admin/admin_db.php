<?php
@session_start();
include "../config.php";
@$get=$mysqli->real_escape_string($_REQUEST['check']);

if(isset($_SESSION['card_admin_id']))
{
//------------- change password ------------------
if($get=='changepass')
{
    
    $sql="UPDATE admin SET `password`=? WHERE `id`=?";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param( 'si' ,$_POST['pass'],$_SESSION['card_admin_id']);
    $stmt->execute();
    if($stmt->affected_rows>0)
    {
        $_SESSION['card_admin_ok']="Password Changed Successfully";
        echo'<script>window.location="profile.php";</script>';
    }
    else
    {
        $_SESSION['card_admin_error']="Password Not change Try Again";
        echo'<script>window.location="profile.php";</script>';
    }
     
}


//-------------------------- Add New User ----------------------------
if($get=='add-user')
{
    $user_id = bin2hex(openssl_random_pseudo_bytes(6));
    $date=date("Y-m-d");
    function rand_string( $length )
    {
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    return substr(str_shuffle($chars),0,$length);
    }
    $password= rand_string(5);
    
    $query="INSERT INTO `user` (`user_id`,`email`,`password`,`date_registered`) values(?,?,?,?) ";
    $stmt=$mysqli->prepare($query);
    $stmt->bind_param( 'ssss' ,$user_id,$_POST['email'],$password,$date);
    $stmt->execute();
    
    $query1="INSERT INTO `cards` (`user_id`,`company_name`,`name`,`address1`,`address2`,`city`,`state`,`country`,`phone`,`mobile`) values(?,?,?,?,?,?,?,?,?,?) ";
    $stmt1=$mysqli->prepare($query1);
    $stmt1->bind_param( 'ssssssssss' ,$user_id,$_POST['cname'],$_POST['name'],$_POST['ad1'],$_POST['ad2'],$_POST['city'],$_POST['state'],$_POST['country'],$_POST['phone'],$_POST['mobile']);
    $stmt1->execute();
    
    
    if($stmt->affected_rows==1)
    { 
           $_SESSION['card_admin_ok']="User Added Successfully";
           echo'<script>window.location="starter.php";</script>';
    }
 
    else
    {
           $_SESSION['card_admin_error']="User Not Added Try Again";
           echo'<script>window.location="starter.php";</script>';
    }               
   
}

//================================================ Edit User ==========================================================//
if($get=='edit-user')
{  
    $query="update `user` set `email`=? where `user_id`=? ";
    $stmt=$mysqli->prepare($query);
    $stmt->bind_param( 'ss' ,$_REQUEST['email'],$_REQUEST['id']);
    $stmt->execute();
    
    $query1="update `cards` set `company_name`=?,`name`=?,`address1`=?,`address2`=?,`city`=?,`state`=?,`country`=?,`phone`=?,`mobile`=? where `user_id`=? ";
    $stmt1=$mysqli->prepare($query1);
    $stmt1->bind_param( 'ssssssssss' ,$_POST['cname'],$_POST['name'],$_POST['ad1'],$_POST['ad2'],$_POST['city'],$_POST['state'],$_POST['country'],$_POST['phone'],$_POST['mobile'],$_REQUEST['id']);
    $stmt1->execute();
    
    if($stmt->affected_rows==1)
    { 
           $_SESSION['card_admin_ok']="updated Successfully";
           echo'<script>window.location="starter.php";</script>';
    }
 
    else
    {
           $_SESSION['card_admin_error']="Not Updated Try Again";
           echo'<script>window.location="starter.php";</script>';
    }
}



//-------------------------------------------------------- delete user ---------------------
if($get=='del-user')
{
    $sql="delete from  `user`  where `user_id`=?";
    $stmt=$mysqli->prepare($sql);
    $stmt->bind_param( 's' , $_REQUEST['id']);
    $stmt->execute();
    
    $sql1="delete from  `cards`  where `user_id`=?";
    $stmt1=$mysqli->prepare($sql1);
    $stmt1->bind_param( 's' , $_REQUEST['id']);
    $stmt1->execute();
    
     
    if($stmt->affected_rows>0)
    {
           $_SESSION['card_admin_ok']="User Deleted Successfully";
           echo'<script>window.location="starter.php";</script>';
        
    }
    else
    {
           $_SESSION['card_admin_error']="User Not Deleted Try Again";
           echo'<script>window.location="starter.php";</script>';
    }
}



}
?>