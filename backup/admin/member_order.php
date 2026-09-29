<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_GET['Action']=="MakeWinner"){
   $customer_id=$_GET['customer_id'];
   $product_id=$_GET['product_id'];
   $winner_wallet=$_GET['winner_wallet'];

   $sqlfc=mysqli_query($con, "select * from customer where id='$customer_id'");
   $rowfc=mysqli_fetch_array($sqlfc);

   $winner_wallet_old=$rowfc['winner_wallet'];

   $winner_wallet_new=$winner_wallet_old + $winner_wallet;

   $sqluc=mysqli_query($con, "update customer set winner_wallet='$winner_wallet_new' where id='$customer_id'");

   header("location: member_order.php?product_id=$product_id");

}



if($_GET['Action']=="MakeLooser"){
   $customer_id=$_GET['customer_id'];
   $product_id=$_GET['product_id'];
   $looser_wallet=$_GET['looser_wallet'];

   $sqlfc=mysqli_query($con, "select * from customer where id='$customer_id'");
   $rowfc=mysqli_fetch_array($sqlfc);

   $looser_wallet_old=$rowfc['looser_wallet'];

   $looser_wallet_new=$looser_wallet_old + $looser_wallet;

   $sqluc=mysqli_query($con, "update customer set looser_wallet='$looser_wallet_new' where id='$customer_id'");

   header("location: member_order.php?product_id=$product_id");

}

 


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>order_details Management</title>
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
                  <h1>order_details</h1>
                  <small>order_details List</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">








<? if($_GET['Action']=="Add"){ ?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Add order_details</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action="">
                              <div class="form-group">
                                 <label>name</label>
                                 <input type="text" class="form-control" name="name" placeholder="Enter name"  >
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
$sql="select * from order_details where id='$id2'";
$rs=mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs);
?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Update order_details</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action="">
                              <div class="form-group">
                                 <label>name</label>
                                 <input type="text" name="name" class="form-control" placeholder="Update name" value="<? echo $row['name'];?>"   >
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
                                 <h4>order_details List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                          
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">   
                                       <th>Customer Name</th>  
                                       <th>Payout</th>
                                       <th>Total Price</th>  
                                       <th>Winner Wallet</th>  
                                       <th>Looser Wallet</th>  
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                    <?
$product_id=$_GET['product_id'];
                                     $sql=mysqli_query($con,"select * from order_details  where product_id='$product_id' ");
                                    while($row=mysqli_fetch_assoc($sql)){ 
                                       $member_id=$row['member_id'];
                                       $sqlm=mysqli_query($con, "select * from customer where id ='$member_id'");
                                       $rowm=mysqli_fetch_array($sqlm);
                                       ?>
                                    <tr>
                                       
                                      
                                       <td><? echo $rowm['name']; ?></td>  
                                       <td><? echo $row['mvalue']; ?></td>
                                       <td><? echo $row['price']; ?></td>  
                                       <td><? echo $rowm['winner_wallet']; ?></td>  
                                       <td><? echo $rowm['looser_wallet']; ?></td>  
                                      
                                       <td>
                                       
                                          <form method="get" action="">
<input type="hidden" name="customer_id" value="<? echo $row['member_id']; ?>">
<input type="hidden" name="product_id" value="<? echo $row['product_id']; ?>">
<input type="hidden" name="winner_wallet" value="<? echo $row['mvalue']; ?>">
<input type="hidden" name="looser_wallet" value="<? echo $row['price']; ?>">
<select name="Action"  >

<option value="MakeWinner">Make Winner</option>
<option value="MakeLooser">Make Looser</option>
</select>
<input type="submit"   class="  btn btn-danger btn-sm" name="GO">
   </select>


                                          </form>


 
                                        
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
               <!-- customer Modal1 -->
              
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