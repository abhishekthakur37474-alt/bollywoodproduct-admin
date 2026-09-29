<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_POST["Submit"]) { 
    $name=addslashes($_POST['name']); 
    $mobile=addslashes($_POST['mobile']); 
    $email=addslashes($_POST['email']); 
    $password=addslashes($_POST['password']); 
  

mysqli_query($con,"INSERT INTO subscriber_my_package ( name,mobile, email, password, date_reg)
VALUES ( '$name','$mobile','$email','$password',now())") or die(mysqli_error($con));
  
            header('location:subscriber_my_package.php?msg=success');
         }

  

if(isset($_GET['Action']) && $_GET['Action']=="ApprovePayment"){

$id=$_GET['id'];
$payment_mode="Online";

$sql=mysqli_query($con, "update subscriber_my_package set payment_status='Paid',payment_mode='Online', expiry_date=NOW() + INTERVAL 1 MONTH where id='$id'");
$sqlfmp=mysqli_query($con, "select * from subscriber_my_package where id='$id'");
$rowfmp=mysqli_fetch_array($sqlfmp);

$subscriber_user_id= $rowfmp['subscriber_user_id'];
$subscriber_package_id= $rowfmp['subscriber_package_id'];

$sqlsu=mysqli_query($con, "select * from subscriber_user where id='$subscriber_user_id'");
$rowsu=mysqli_fetch_array($sqlsu);

$sqlsp=mysqli_query($con, "select * from subscriber_package where id='$subscriber_package_id'");
$rowsp=mysqli_fetch_array($sqlsp);

$invoice_type="Invoice";
$subscriber_name=$rowsu['name'];
$subscriber_email=$rowsu['email'];
$subscriber_mobile=$rowsu['mobile'];
$package_name=$rowsp['name'];
$price=$rowsp['price'];
$discounted_price=$rowsp['discounted_price'];
$details=$rowsp['details'];
$payment_status="Paid";
$payment_mode="Online";



$sqli=mysqli_query($con, "insert into subscriber_invoice(invoice_type,subscriber_user_id, subscriber_name, subscriber_email, subscriber_mobile, subscriber_package_id, package_name, price, discounted_price, details, payment_status, payment_mode, invoice_date, due_date, payment_date ) values('$invoice_type','$subscriber_user_id',  '$subscriber_name', '$subscriber_email', '$subscriber_mobile', '$subscriber_package_id', '$package_name', '$price','$discounted_price','$details','$payment_status','$payment_mode',now(), now(), now())    ")or die(mysqli_error($con));  


       header('location:subscriber_user_package.php?msg=success');
}

           if($_POST["Update"]) {




    $id= $_POST['id'];

    $name=addslashes($_POST['name']); 
    $mobile=addslashes($_POST['mobile']); 
    $email=addslashes($_POST['email']); 
    $password=addslashes($_POST['password']); 
  


$img=$_FILES['filstor']['name'];
$tmpName=$_FILES['filstor']['tmp_name'];
$oldimg=$_POST['oldimg'];

 if($img<>"")
   {
      $ext = strrchr($img, ".");
            $prefix=str_replace(" ","-",$name);
            $newName = $prefix ."-". substr(md5(rand() * time()), 0, 5) . $ext;
            move_uploaded_file($tmpName,"photo/".$newName);


   @unlink("photo/".$oldimg); 
   move_uploaded_file($tmpName,"photo/".$newName);

 }

else
{
$newName=$oldimg;
}

            mysqli_query($con,"update subscriber_my_package set   name='$name',photo='$newName',mobile='$mobile',email='$email',password='$password'  where id='$id'") or die(mysql_error());
             header('location:subscriber_my_package.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con, "delete from subscriber_my_package where id='$_REQUEST[id]'");

header("location:subscriber_user_package.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>subscriber_my_package Management</title>
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
                  <h1>subscriber_my_package</h1>
                  <small>subscriber_my_package List</small>
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
                                 <h4>Add subscriber_my_package</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <div class="form-group">
                                 <label>name</label>
                                 <input type="text" class="form-control" name="name" placeholder="Enter name"  >
                              </div>
                           
                               <div class="form-group">
                                 <label>Mobile</label>
                                 <input type="text" class="form-control" name="mobile" placeholder="Enter mobile"  >
                              </div>
                           
                               <div class="form-group">
                                 <label>Email</label>
                                 <input type="text" class="form-control" name="email" placeholder="Enter email"  >
                              </div>
                           
                               <div class="form-group">
                                 <label>Password</label>
                                 <input type="text" class="form-control" name="password" placeholder="Enter password"  >
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
$sql="select * from subscriber_my_package where id='$id2'";
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
                                 <h4>Update subscriber_my_package</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body"> 


                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <div class="form-group">
                                 <label>name</label>
                                 <input type="text" name="name" class="form-control" placeholder="Update name" value="<? echo $row['name'];?>"   >
                              </div>

 


                                 <div class="form-group">
                                 <label>Image</label>
                                 <img src="photo/<? echo $row['photo']; ?>" width="100"> 
                                   <input type="file"  name="filstor"  class="form-control">
                                    <input type="hidden" name="oldimg" value="<? echo $row['photo']; ?>">
                                  
                              </div>	

                             
                               <div class="form-group">
                                 <label>Mobile</label>
                                 <input type="text" class="form-control" name="mobile" placeholder="Enter mobile"  value="<? echo $row['mobile'];?>"  >
                              </div>
                           
                               <div class="form-group">
                                 <label>Email</label>
                                 <input type="text" class="form-control" name="email" placeholder="Enter email"  value="<? echo $row['email'];?>"  >
                              </div>
                           
                               <div class="form-group">
                                 <label>Password</label>
                                 <input type="text" class="form-control" name="password" placeholder="Enter password"  value="<? echo $row['password'];?>"  >
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
                                 <h4>subscriber_my_package List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="subscriber_my_package.php?Action=Add"> <i class="fa fa-plus"></i> Add subscriber_my_package
                                 </a>  
                              </div>
                            
                           </div>


 <script type="text/javascript" src="jquery-1.8.0.min.js"></script>
<script type="text/javascript">
$(function(){
$(".search").keyup(function() 
{ 
var searchid = $(this).val();
var dataString = 'search='+ searchid;
if(searchid!='')
{
    $.ajax({
    type: "POST",
    url: "search_subscriber_my_package.php",
    data: dataString,
    cache: false,
    success: function(html)
    {
    $("#result").html(html).show();
    }
    });
}return false;    
});

jQuery("#result").live("click",function(e){ 
    var $clicked = $(e.target);
    var $name = $clicked.find('.name').html();
    var decoded = $("<div/>").html($name).text();
    $('#searchid').val(decoded);
});
jQuery(document).live("click", function(e) { 
    var $clicked = $(e.target);
    if (! $clicked.hasClass("search")){
    jQuery("#result").fadeOut(); 
    }
});
$('#searchid').click(function(){
    jQuery("#result").fadeIn();
});
});
</script>

<input type="text" class="search form-control" id="searchid" placeholder="Search for Subscription User" style="width: 100%" />  
<div id="result"></div>
 

<br><br>

                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>Subscriber Details</th> 
                                       <th>Package Details</th> 
                                       <th>Activation Date</th> 
                                       <th>Expiry Date </th>  
                                       <th>Payment Status</th>  
                                       <th>Payment Mode</th>  
                                       <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                    <? 




if (isset($_GET['page_no']) && $_GET['page_no']!="") {
  $page_no = $_GET['page_no'];
  } else {
    $page_no = 1;
        }

  $total_records_per_page = 10;
    $offset = ($page_no-1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2"; 

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `subscriber_my_package`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `subscriber_my_package` order by id desc LIMIT $offset, $total_records_per_page");
                                     while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                       <td><? $subscriber_user_id= $row['subscriber_user_id'];

$sqlu=mysqli_query($con, "select * from subscriber_user where id='$subscriber_user_id'");
$rowu=mysqli_fetch_array($sqlu);?>
                                           <?php echo $rowu['name']; ?><br>
                                           <?php echo $rowu['mobile']; ?><br>
                                           <?php echo $rowu['email']; ?><br>

                                        </td>  
                                       <td><? $subscriber_package_id= $row['subscriber_package_id']; 

$sqlp=mysqli_query($con, "select * from subscriber_package where id='$subscriber_package_id'");
$rowp=mysqli_fetch_array($sqlp);?>
     <?php echo $rowp['name']; ?><br>
                                          <span style="text-decoration: line-through;">₹ <?php echo $rowp['price']; ?>/-</span>  ₹ <?php echo $rowp['discounted_price']; ?>/-<br> 
</td>  
                                       <td><? echo $row['activation_date']; ?></td>
                                        <td><? echo $row['expiry_date']; ?></td>
                                        <td><? echo $row['payment_status']; ?></td>
                                        <td><? echo $row['payment_mode']; ?></td>
                                        <td><? echo $row['status']; ?></td>
                                       <td>
                                          <?php if($row['payment_status']!="Paid"){ ?>   
                                          <a href="subscriber_user_package.php?Action=ApprovePayment&id=<? echo $row['id'];    ?>" class="btn btn-warning btn-sm"    >Approve Payment</a>
<?php } ?>
                                          <a href="subscriber_user_package.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
                                          <a  href="javascript:resume_id('<? echo $row['id']?>')" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
                                       </td>
                                    </tr>

                                     <? } ?>
                                    
                                 </tbody>
                              </table>





<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>

<ul class="pagination">
  <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
  <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
  </li>
       
    <?php 
  if ($total_no_of_pages <= 10){     
    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
      if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }
        }
  }
  elseif($total_no_of_pages > 10){
    
  if($page_no <= 4) {     
   for ($counter = 1; $counter < 8; $counter++){     
      if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }
        }
    echo "<li><a>...</a></li>";
    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
    }

   elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {     
    echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {     
           if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }                  
       }
       echo "<li><a>...</a></li>";
     echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
     echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
    
    else {
        echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }                   
                }
            }
  }
?>
    
  <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
  </li>
    <?php if($page_no < $total_no_of_pages){
    echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
    } ?>
</ul>



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