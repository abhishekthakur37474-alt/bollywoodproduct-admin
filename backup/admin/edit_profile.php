<?
session_start();
$admin_id=$_SESSION['id'];
include "config.php";

  if($_SESSION['admin']==""){
     header("location:index.php");
      }
   
           ?>
      

<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>edit profile</title>
      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <!-- Start Global Mandatory Style
         =====================================================================-->
      <!-- jquery-ui css -->
      <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
      <!-- Bootstrap -->
      <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
      <!-- Bootstrap rtl -->
      <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
      <!-- Lobipanel css -->
      <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
      <!-- Pace css -->
      <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
      <!-- Font Awesome -->
      <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <!-- Pe-icon -->
      <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
      <!-- Themify icons -->
      <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
      <!-- dataTables css -->
      <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
            <!--textaera------css-->
            <link href="/admin/richtext.min.css" rel="stylesheet" type="text/css"/>
            <link href="/admin/site.css" rel="stylesheet" type="text/css"/>
      <!-- End Global Mandatory Style
         =====================================================================-->
      <!-- Start Theme Layout Style
         =====================================================================-->
      <!-- Theme style -->
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>

     
  <!-- select2 -->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

 <style>
     select
     {
         width:100%;
     }
     fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
 </style>

   </head>
   <body class="hold-transition sidebar-mini">
   <!--preloader
      <div id="preloader">
         <div id="status"></div>
      </div>-->
      <!-- Site wrapper -->
       <div class="wrapper">
         <? include "topandleft.php"; 
          
      
         
         ?>
         <!-- =============================================== -->
        
      
         <!-- =============================================== -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-users"></i>
               </div>
               <div class="header-title">
                  <h1>User Profile</h1>
                  <small>Edit user profile Details</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">

                  <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Edit user profile Here</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                  <form method="post" enctype="multipart/form-data">
          <div class="row">
              <div class="col-lg-12">
			  

                    
                   <div class="form-group">
                                 <label>Username</label>
                                 <input type="text" class="form-control" name="username"   value="<?php echo $read_profile["username"];?>"  required>
                              </div>
                              <div class="form-group">
                                 <label>Password</label>
                                 <input type="text" class="form-control" name="password" value="<?php echo $read_profile["password"];?>" required> 
                              </div>
                              <div class="form-group">
                                 <label>Role</label>
                                 <input type="text" class="form-control" name="role" value="<?php echo $read_profile["role"];?>" > 
                              </div>
                               <div class="form-group">
                                 <label>Email ID</label>
                                 <input type="email" class="form-control" name="email" value="<?php echo $read_profile["email"];?>" required> 
                              </div>
                              <div class="form-group">
                                 <label>Previous profile</label>
                                 <img src="photo/<?php echo $read_profile["image"];?>" height=50 width=50/> 
                              </div>
                              
                               <div class="form-group">
                                 <label>New User Profile</label>
                                 <input type="file" class="form-control" name="image" > 
                              </div>
                                
                               <div class="reset-button">
                               <input type="submit" name="Updateuser" class="btn btn-add"   value="Update Profile">
                               </div>
              </div>
              
              </div>
            
      
              </form>
              <?php
               if(isset($_POST["Updateuser"]))
                  {
                      
                      $username=$_POST["username"]; 
                      $password=$_POST["password"];
                      $role=$_POST["role"];
                       $email=$_POST["email"];
                     $image=$_FILES["image"]["name"];
                                        $filetemplocation=$_FILES["image"]["tmp_name"];
                                        move_uploaded_file($filetemplocation,"photo/$image");
                                        if($image=="")
                                        {
                                            $new_img=$read_profile["image"];
                                        }
                                        else
                                        {
                                            $new_img=$image;
                                        }
                      $q="update admin set username='$username',password='$password',role='$role',email='$email',image='$new_img' where id='$admin_id'";
                      mysqli_query($con,$q);
                      echo "<script>alert('Profile Details Update Successfully')</script>";
                      echo "<script>window.location.href='logout.php'</script>";
                      }
                      ?>
                
               


                           
            <!-- /.content -->
         </div>
          </div>
         <!-- /.content-wrapper -->
     
      </div>
    
  </div>
 
  </section>
  </div>
    <?php include('footer.php');?>
       <!-- jQuery -->
      <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
      <!-- jquery-ui --> 
      <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <!-- Bootstrap -->
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <!-- lobipanel -->
      <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <!-- Pace js -->
      <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <!-- SlimScroll -->
      <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
      <!-- FastClick -->
      <script src="assets/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
      <!-- CRMadmin frame -->
      <script src="assets/dist/js/custom.js" type="text/javascript"></script>
      <!-- End Core Plugins
         =====================================================================-->
      <!-- Start Theme label Script
         =====================================================================-->
      <!-- Dashboard js -->
      <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
      <!-- End Theme label Script
         =====================================================================-->
     </body>
     </html>
      
        
     