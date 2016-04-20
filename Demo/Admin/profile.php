<?php @session_start(); include "../config.php"; ?>
<?php if(!isset ($_SESSION['card_admin_id'])){ echo'<script>window.location="../index.php";</script>';}?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title> Admin || Profile</title>
    <link rel="icon" href="../images/fav.png" type="image"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <link href="../dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />


  </head>

  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="starter.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>P</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>Panel</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="../images/admin.png" class="user-image" alt="User Image" />
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $_SESSION['card_admin_name'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      
<?php  include "sidebar.php";  ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Profile Section
          <!--  <small>Optional description</small> -->
          </h1>
          
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class="row">
            <div class="col-xs-6">
              <div class="box">
              <div class="box-header">  
                  
<?php if (isset($_SESSION['card_admin_ok'])): ?><div style="color: green;font-size: large;"><?php echo $_SESSION['card_admin_ok'] ;?></div><?php endif; ?><?php unset($_SESSION['card_admin_ok']); ?>
<?php if (isset($_SESSION['card_admin_error'])): ?><div style="color: red;font-size: large;"><?php echo $_SESSION['card_admin_error'] ;?></div><?php endif; ?><?php unset($_SESSION['card_admin_error']); ?>
   
                </div>
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Options</th>                        
                      </tr>
                    </thead> 
                    <tbody>
<?php $sql="select * from `admin` ";
      $result=$mysqli->query($sql);
      while($row=$result->fetch_assoc())
      {
        $id=$row['id'];
        $username=$row['username'];

?>        


                 <tr> 
                      <td><?php echo $username;?></td>
                      <td>
                          
                          <button type="button" class="btn btn-success"data-toggle="modal" data-target="#changepass" >&nbsp;&nbsp;Modify&nbsp;&nbsp;</button>
                          
                      </td> 
                 </tr>
<!--------------button to change password------------>
<div class="modal fade" id="changepass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Change Old Password</h4>
      </div>
      <div class=" modal-body">
        <form action="admin_db.php?check=changepass"  method="POST" id="form">
        <div class="row">
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Enter new password:</label>
            <input type="password" class="form-control" id="password" name="pass" required >
          </div>
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Enter confirm password:</label>
            <input type="password" class="form-control" id="confirm_password" name="pass1" required >
          </div>
        </div>
<script>
  $("#form").submit(function(){
     if($("#password").val()!=$("#confirm_password").val())
     {
         alert("confirm password should be same");
         return false;
     }
 })
</script>       
        
      </div>
      <div class="modal-footer">
      <input type="submit" value="Update "  form="form" class="btn btn-primary">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
	
<!----------------add button close------------> 


         
<?php   }  ?> 
 
 
 
                 
                   </tbody>
                  
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           
            </div><!-- /.col -->
          </div>

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

     <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2016 <a href="#">Visiting Card App</a>.</strong> All rights reserved.
      </footer>


    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>

  </body>
</html>