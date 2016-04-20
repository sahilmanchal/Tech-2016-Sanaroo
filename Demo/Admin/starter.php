<?php @session_start(); include "../config.php"; ?>
<?php if(!isset ($_SESSION['card_admin_id'])){ echo'<script>window.location="../index.php";</script>';} ?>
<!DOCTYPE html>
<html>
  <head >
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Card ||  App</title>
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
    <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="../dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
<style>
::-webkit-scrollbar {
    height: 12px;
    width: 8px;
    background: lightgrey;
}

::-webkit-scrollbar-thumb {
    background: grey;
    -webkit-border-radius: 1ex;
}
</style>    
    
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
          <h1>User's Visiting Cards</h1>
          <ol class="breadcrumb">
           <li><button type="buton" data-toggle="modal" data-target="#add-card" class="btn btn-primary">Add New User</button></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         <div class="row" id="main-div">
            <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
              <div class="box">
                <div class="box-header">
  <?php if(isset($_SESSION['card_admin_ok'])): ?><div style="color: green;font-size: large;"><?php echo $_SESSION['card_admin_ok'] ;?></div><?php endif; ?><?php unset($_SESSION['card_admin_ok']); ?>
  <?php if(isset($_SESSION['card_admin_error'])): ?><div style="color: red;font-size: large;"><?php echo $_SESSION['card_admin_error'] ;?></div><?php endif; ?><?php unset($_SESSION['card_admin_error']); ?>
   
                </div><!-- /.box-header -->
                <div class="box-body">
                <div class="col-xs-12 table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                       <tr>
                        <th>Name</th>
                        <th>Company Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>UserId</th>
                        <th>Options</th>
                       </tr>
                    </thead>
                    <tbody>
                  
<?php   
        $sql="select `cards`.*,`user`.`email`,`user`.`date_registered` from user left join `cards` on `user`.`user_id`=`cards`.`user_id` ";
        $result=$mysqli->query($sql);
        while($row=$result->fetch_assoc())
        {
            $id=$row['id'];
            $name=$row['name'];
            $user_id=$row['user_id'];
            $mobile=$row['mobile'];
            $c_name=$row['company_name'];
            $email=$row['email'];
            $phone=$row['phone'];
            $city=$row['city'];
            $state=$row['state'];
            $country=$row['country']; 
            $address1=$row['address1'];
            $address2=$row['address2'];             
?> 
      
                     <tr style="cursor: pointer;" >
                          <td><?php echo $name;?></td>
                          <td><?php echo $c_name;?></td>
                          <td><?php echo $email;?></td>
                          <td><?php echo $mobile;?></td>
                          <td><?php echo $user_id;?></td>
                          <td>
                                <button class="btn btn-primary"  data-toggle="modal" data-target="#edit-card<?=$id?>" ><i class="fa fa-edit"></i></button>
                                <a href="admin_db.php?check=del-user&id=<?=$user_id?>"><button  class="btn btn-danger"><i class="fa fa-trash-o" ></i></button></a>
                          </td> 
                     </tr>
<!--------------button to Edit User------------>
<div class="modal fade" id="edit-card<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Add User</h4>
      </div>
      <div class=" modal-body">
        <form action="admin_db.php?check=edit-user&id=<?=$user_id?>"  method="POST" id="form4<?=$id?>" >
        <div class="row">       
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Name:</label>
            <input type="text" class="form-control" name="name" value="<?=$name;?>" required >
          </div>
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Company Name:</label>
            <input type="text" class="form-control" name="cname" value="<?=$c_name;?>" required >
          </div>
        </div>
        
        <div class="row">
          <div class="form-group col-md-12">
            <label for="recipient-name" class="control-label">Email:</label>
            <input type="email" class="form-control" name="email" value="<?=$email;?>" required >
          </div>
        </div>
        
        <div class="row">
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Phone:</label>
            <input type="text" class="form-control" name="phone" value="<?=$phone;?>" required >
          </div>
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Mobile:</label>
            <input type="text" class="form-control" name="mobile" value="<?=$mobile;?>" required>
          </div>
        </div>
        

        
        <div class="row">
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Address 1:</label>
            <textarea class="form-control" rows="2" name="ad1"  required><?=$address1;?></textarea>
          </div>
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Address 2:</label>
            <textarea class="form-control" rows="2" name="ad2"><?=$name;?></textarea>
          </div>
        </div>
        
        <div class="row">
          <div class="form-group col-md-4">
            <label for="recipient-name" class="control-label">City:</label>
            <input type="text" class="form-control" name="city" value="<?=$city;?>" required >
          </div>
          <div class="form-group col-md-4">
            <label for="recipient-name" class="control-label">State:</label>
            <input type="text" class="form-control" name="state" value="<?=$state;?>" required >
          </div>
          <div class="form-group col-md-4">
            <label for="recipient-name" class="control-label">Country:</label>
            <input type="text" class="form-control" name="country" value="<?=$country;?>" required >
          </div>
        </div>
       
      </div>
      <div class="modal-footer">
         <input type="submit" value="Update"  form="form4<?=$id?>" class="btn btn-primary"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
	
<!----------------Efit button close------------>  
                     
<?php   } ?>
                 </tbody>
                   </table></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
           </div><!-- /.col -->
          
            
      </div>

<!--------------button to Add User------------>
<div class="modal fade" id="add-card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Add User</h4>
      </div>
      <div class=" modal-body">
        <form action="admin_db.php?check=add-user"  method="POST" id="form4" >
        <div class="row">       
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Name:</label>
            <input type="text" class="form-control" name="name" required >
          </div>
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Company Name:</label>
            <input type="text" class="form-control" name="cname" required >
          </div>
        </div>
        
        <div class="row">
          <div class="form-group col-md-12">
            <label for="recipient-name" class="control-label">Email:</label>
            <input type="email" class="form-control" name="email" required >
          </div>
        </div>
        
        <div class="row">
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Phone:</label>
            <input type="text" class="form-control" name="phone" required >
          </div>
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Mobile:</label>
            <input type="text" class="form-control" name="mobile" required >
          </div>
        </div>
        

        
        <div class="row">
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Address 1:</label>
            <textarea class="form-control" rows="2" name="ad1" required></textarea>
          </div>
          <div class="form-group col-md-6">
            <label for="recipient-name" class="control-label">Address 2:</label>
            <textarea class="form-control" rows="2" name="ad2"></textarea>
          </div>
        </div>
        
        <div class="row">
          <div class="form-group col-md-4">
            <label for="recipient-name" class="control-label">City:</label>
            <input type="text" class="form-control" name="city" required >
          </div>
          <div class="form-group col-md-4">
            <label for="recipient-name" class="control-label">State:</label>
            <input type="text" class="form-control" name="state" required >
          </div>
          <div class="form-group col-md-4">
            <label for="recipient-name" class="control-label">Country:</label>
            <input type="text" class="form-control" name="country" required >
          </div>
        </div>
       
      </div>
      <div class="modal-footer">
         <input type="submit" value="Add"  form="form4" class="btn btn-primary"/>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
	
<!----------------add button close------------>  







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
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="../plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>   
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>