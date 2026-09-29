<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_POST["Submit"]) { 
    $name=addslashes($_POST['name']);
    $email=addslashes($_POST['email']); 
    $mobile=addslashes($_POST['mobile']); 
    $password=addslashes($_POST['password']);
    
 

mysql_query("INSERT INTO  employer set

   name='$name',
   email='$email',
   mobile='$mobile',
   password='$password' 



   ") or die(mysql_error());
  
            header('location: employer.php?msg=success');
         }



           if($_POST["Update"]) {




    $id= $_POST['id'];
    $name=addslashes($_POST['name']);
    $email=addslashes($_POST['email']);
    $mobile=addslashes($_POST['mobile']); 


            mysql_query("update  employer set  


 name='$name',
   email='$email',
   mobile='$mobile',
   password='$password' 


              where id='$id'") or die(mysql_error());
             header('location: employer.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con,"delete from  employer where id='$_REQUEST[id]'");

header("location: employer.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title> employer Management</title>
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
                  <h1> employer</h1>
                  <small> employer List</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">




<? if($_GET['Action']=="View"){ $id2=$_GET['id'];
$sql="select * from   employer where id='$id2'";
$rs=mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs); ?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     

<div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 
                                 <tbody>
 
                                    <tr>
                                       
                                       <td>Name</td>
                                       <td><? echo $row['name']; ?></td>    
                                      
                                       
                                    </tr>
                                    <tr>
                                       
                                       <td>Email</td>
                                       <td><? echo $row['email']; ?></td>    
                                      
                                       
                                    </tr>
                                     <tr>
                                       
                                       <td>Mobile</td>
                                       <td><? echo $row['mobile']; ?></td>    
                                      
                                       
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
                  <a href="employer.php" class="btn btn-add btn-sm"    >List All</a>
 <a href="employer.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    >Edit Record</a>
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
                                 <h4>Add  employer</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action="">
                              <div class="form-group">
                                 <label>Name</label>
                                 <input type="text" class="form-control" name="name" placeholder="Enter name"  >
                              </div>
                           <div class="form-group">
                                 <label>Email</label>
                                 <input type="text" class="form-control" name="email" placeholder="Enter email"  >
                              </div>
                              <div class="form-group">
                                 <label>Mobile</label>
                                 <input type="text" class="form-control" name="mobile" placeholder="Enter mobile"  >
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
$sql="select * from  employer where id='$id2'";
$rs=mysql_query($sql);
$row=mysql_fetch_array($rs);
?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Update  employer</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action="">
                              <div class="form-group">
                                 <label>Name</label>
                                 <input type="text" name="name" class="form-control" placeholder="Update name" value="<? echo $row['name'];?>"   >
                              </div>
                              <div class="form-group">
                                 <label>Email</label>
                                 <input type="text" name="email" class="form-control" placeholder="Update email" value="<? echo $row['email'];?>"   >
                              </div>
                              <div class="form-group">
                                 <label>Mobile</label>
                                 <input type="text" name="mobile" class="form-control" placeholder="Update mobile" value="<? echo $row['mobile'];?>"   >
                              </div>
                              <div class="form-group">
                                 <label>Password</label>
                                 <input type="text" name="password" class="form-control" placeholder="Update password" value="<? echo $row['password'];?>"   >
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
                                 <h4> employer List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl 
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href=" employer.php?Action=Add"> <i class="fa fa-plus"></i> Add  employer
                                 </a>  
                              </div>
                            
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>Vendor</th>
                                       <th>Name</th>
                                       <th>Email</th>  
                                       <th>Mobile</th> 
                                       <th>Password</th> 
                                       <th>Date</th> 
                                      
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                    <? $sql=mysqli_query($con,"select * from  employer order by id desc");
                                    while($row=mysqli_fetch_array($sql)){ ?>
                                    <tr>
                                       
                                       <td><?    $vendor_id= $row['vendor_id']; 


if($vendor_id=="0")
   { echo "Self Created Account";
} else {

                                    
                                       $sqlv=mysqli_query($con, "select * from vendor where id ='$vendor_id'");
                                       $rowv=mysqli_fetch_array($sqlv);

                                       echo $rowv['name'];


}





                                       ?></td>
                                       <td><? echo $row['name']; ?></td>
                                       <td><? echo $row['email']; ?></td> 
                                       <td><? echo $row['mobile']; ?></td>
                                       <td><? echo $row['password']; ?></td>
                                       <td><? echo $row['date_reg']; ?></td>
                                      
                                       <td> <a href="employer.php?Action=View&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-eye"></i></a>
                                          
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
               <!-- employer Modal1 -->
              
               <!-- /.modal -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <strong>Copyright &copy; 2016-2017 <a href="#">Bollywood Product</a>.</strong> All rights reserved.
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