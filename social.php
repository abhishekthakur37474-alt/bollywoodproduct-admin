<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_POST["Submit"]) { 
    $customer_id= $_POST['customer_id'] ;
    $title=addslashes($_POST['title']);
    $url=addslashes($_POST['url']); 
    $public_url=addslashes($_POST['public_url']);
    $username=addslashes($_POST['username']);
    $password=addslashes($_POST['password']);
    
 

mysqli_query($con,"INSERT INTO   social set

customer_id='$customer_id',
title='$title',
url='$url',
public_url='$public_url',
username='$username',
password='$password'

                                 ") or die(mysqli_error($con));
  
            header('location:  social.php?msg=success');
         }



           if($_POST["Update"]) {




    $id= $_POST['id']; 
 
    $title=addslashes($_POST['title']);
    $url=addslashes($_POST['url']); 
    $public_url=addslashes($_POST['public_url']);
    $username=addslashes($_POST['username']);
    $password=addslashes($_POST['password']);


            mysqli_query($con,"update   social set   
title='$title',
url='$url',
public_url='$public_url',
username='$username',
password='$password'

             where id='$id'") or die(mysql_error());
             header('location:  social.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con,"delete from   social where id='$_REQUEST[id]'");

header("location:  social.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>  social Management</title>
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
      <!-- End Global Mandatory Style
         =====================================================================-->
      <!-- Start Theme Layout Style
         =====================================================================-->
      <!-- Theme style -->
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
      <!-- Theme style rtl -->
      <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
      <!-- End Theme Layout Style
         =====================================================================-->
   </head>
   <body class="hold-transition sidebar-mini">
   <!--preloader
      <div id="preloader">
         <div id="status"></div>
      </div>-->
      <!-- Site wrapper -->
      <div class="wrapper">
         <? include "topandleft.php"; ?>
         <!-- =============================================== -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
               <div class="header-icon">
                  <i class="fa fa-users"></i>
               </div>
               <div class="header-title">
                  <h1>  social</h1>
                  <small>  social List</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">






<? if($_GET['Action']=="View"){ $id2=$_GET['id'];
$sql="select * from   social where id='$id2'";
$rs=mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs); ?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     

<div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 
                                 <tbody>
 
                                    <tr>
                                       
                                       <td>Customer</td>
                                       <td><? $customer_id= $row['customer_id'];
                                       $sqc=mysqli_query($con,"select * from customer where id='$customer_id'");
                                       $rwc=mysqli_fetch_array($sqc);
                                       echo $rwc['name'];

                                     ?></td>    
                                      
                                       
                                    </tr>
                                  
                                    <tr>
                                       
                                       <td>Title</td>
                                       <td><? echo $row['title']; ?></td>    
                                      
                                       
                                    </tr>
                                    <tr>
                                       
                                       <td>URL</td>
                                       <td><? echo $row['url']; ?></td>    
                                      
                                       
                                    </tr>
                                    <tr>
                                       
                                       <td>Public URL</td>
                                       <td><? echo $row['public_url']; ?></td>    
                                      
                                       
                                    </tr>
                                    <tr>
                                       
                                       <td>Username</td>
                                       <td><? echo $row['username']; ?></td>    
                                      
                                       
                                    </tr>
                                    <tr>
                                       
                                       <td>Password</td>
                                       <td><? echo $row['password']; ?></td>    
                                      
                                       
                                    </tr>
 
                                 </tbody>
                              </table>
                           </div>




                  </div>
               </div>
                  <a href="social.php" class="btn btn-add btn-sm"    >List All</a>
 <a href="social.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    >Edit Record</a>
 <a href="javascript:resume_id('<? echo $row['id']?>')" class="btn btn-add btn-sm"    >Delete Record</a>

<? } ?>










<? if($_GET['Action']=="Add"){ ?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Add social</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action="">
                              <div class="form-group">
                                 <label>Customer Name</label>
                                 <select name="customer_id" class="form-control">
                                       <? $sqc1=mysqli_query($con,"select * from customer ");
                                    while($rwc1=mysqli_fetch_array($sqc1)){ ?>
                                       <option value="<? echo $rwc1['id']; ?>"><? echo $rwc1['name']; ?></option>
                                <? } ?>
                                 </select>
                              
                              </div>   <div class="form-group">
                                 <label>Title</label>
                                 <input type="text" class="form-control" name="title" placeholder="Enter title"  >
                              </div>
                           <div class="form-group">
                                 <label>URL</label>
                                 <input type="text" class="form-control" name="url" placeholder="Enter url"  >
                              </div>
                              <div class="form-group">
                                 <label>Public Url</label>
                                 <input type="text" class="form-control" name="public_url" placeholder="Enter Public URl"  >
                              </div>
                              <div class="form-group">
                                 <label>Username</label>
                                 <input type="text" class="form-control" name="username" placeholder="Enter Username"  >
                              </div>
                               
                              <div class="form-group">
                                 <label>Password</label>
                                 <input type="text" class="form-control" name="password" placeholder="Enter Password"  >
                              </div>
                               
                             
                              <div class="reset-button"> 
                                   <input type="submit" name="Submit"  class="btn btn-add"  value="Add Record">
                            
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>

<? } ?>











<? if($_GET['Action']=="Update"){  $id2=$_GET['id'];
$sql="select * from   social where id='$id2'";
$rs=mysqli_query($con, $sql);
$row=mysql_fetch_array($rs);
?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Update   social</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action="">

  <div class="form-group">
                                 <label>Customer Name</label>
                                 <select name="customer_id" class="form-control">
                                    <? $sqc1=mysqli_query($con,"select * from customer ");
                                    while($rwc1=mysqi_fetch_array($sqc1)){ ?>
                                       <option value="<? echo $rwc1['id']; ?>" <? if($rwc1['id']==$row['id']){ echo "selected"; } ?>><? echo $rwc1['name']; ?></option>
                                <? } ?>
                                 </select>
                              
                              </div>  
                               <div class="form-group">
                                 <label>Title</label>
                                 <input type="text" class="form-control" name="title" placeholder="Enter title"  value="<? echo $row['title'];?>"    >
                              </div>
                           <div class="form-group">
                                 <label>URL</label>
                                 <input type="text" class="form-control" name="url" placeholder="Enter url"   value="<? echo $row['url'];?>"   >
                              </div>
                              <div class="form-group">
                                 <label>Public Url</label>
                                 <input type="text" class="form-control" name="public_url" placeholder="Enter Public URl"   value="<? echo $row['public_url'];?>"   >
                              </div>
                              <div class="form-group">
                                 <label>Username</label>
                                 <input type="text" class="form-control" name="username" placeholder="Enter Username"  value="<? echo $row['username'];?>"   >
                              </div>
                               
                              <div class="form-group">
                                 <label>Password</label>
                                 <input type="text" class="form-control" name="password" placeholder="Enter Password"  value="<? echo $row['password'];?>"   >
                              </div>
                               
                             
 
                              <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="reset-button">

                                 <input type="submit" name="Update" class="btn btn-add"   value="Update">
                                  
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>

<? } ?>
















<? if( $_GET['Action']==""){ ?>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>  social List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="  social.php?Action=Add"> <i class="fa fa-plus"></i> Add   social
                                 </a>  
                              </div>
                            
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>Customer</th>
                                       <th>Title</th>
                                       <th>URL</th>   
                                      
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                    <? $sql=mysqli_query($con, "select * from   social order by id desc");
                                    while($row=mysqli_fetch_array($sql)){ ?>
                                    <tr>
                                       
                                       <td><? $customer_id= $row['customer_id'];
                                       $sqc=mysqli_query($con,"select * from customer where id='$customer_id'");
                                       $rwc=mysqli_fetch_array($sqc);
                                       echo $rwc['name'];

                                     ?></td>
                                       <td><? echo $row['title']; ?></td>
                                       <td><? echo $row['url']; ?></td>    
                                      
                                       <td>
                                          <a href="social.php?Action=View&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-eye"></i></a>
                                          <a href="social.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
                                          <a  href="javascript:resume_id('<? echo $row['id']?>')" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
                                       </td>
                                    </tr>

                                     <? } ?>
                                    
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            <? } ?>
               <!--  social Modal1 -->
              
               <!-- /.modal -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <strong>Copyright &copy; 2016-2017 <a href="#">Blades Solution</a>.</strong> All rights reserved.
         </footer>
      </div>
      <!-- ./wrapper -->
      <!-- Start Core Plugins
         =====================================================================-->
      <!-- jQuery -->
      <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
      <!-- jquery-ui --> 
      <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <!-- Bootstrap -->
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <!-- lobipanel -->
      <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <!-- Pace js -->
      <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <!-- table-export js -->
      <script src="assets/plugins/table-export/tableExport.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/jquery.base64.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/html2canvas.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/sprintf.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/jspdf.js" type="text/javascript"></script>
      <script src="assets/plugins/table-export/base64.js" type="text/javascript"></script>
      <!-- dataTables js -->
      <script src="assets/plugins/datatables/dataTables.min.js" type="text/javascript"></script>
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


<script type="text/javascript">
function resume_id(res_id){

var agree=confirm("This will record.  Are you sure you wish to continue?");
if (agree) {
window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>?remove=yes&id='+res_id;
window.submit();
}
else {
   
}
}

</script> 