<?
session_start();
include "config.php";
include "generalfunction.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_POST["Submit"]) { 
    $name=addslashes($_POST['name']);  
    $cat_id=addslashes($_POST['cat_id']); 
    $price=addslashes($_POST['price']); 
    $mvalue=addslashes($_POST['mvalue']); 
    $details=addslashes($_POST['details']); 
 

    $img=$_FILES['filstor']['name'];
    $tmpName=$_FILES['filstor']['tmp_name']; 
    if($img<>"")
         {
            $ext = strrchr($img, ".");
            $prefix=str_replace(" ","-",$name);
            $newName = $prefix ."-". substr(md5(rand() * time()), 0, 5) . $ext;
            move_uploaded_file($tmpName,"photo/".$newName);
         } 


mysqli_query($con,"INSERT INTO product ( name,  cat_id, price,photos, mvalue, details)
VALUES ( '$name','$cat_id','$price','$mvalue','$newName','$details' )") or die(mysqli_error($con));
  
            header('location:product.php?msg=success');
         }



           if($_POST["Update"]) {




    $id= $_POST['id'];
    $name=addslashes($_POST['name']);  
    $cat_id=addslashes($_POST['cat_id']); 
    $price=addslashes($_POST['price']); 
    $mvalue=addslashes($_POST['mvalue']); 
    $details=addslashes($_POST['details']); 

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

            mysqli_query($con,"update product set  name='$name',photos='$newName',cat_id='$cat_id',price='$price',mvalue='$mvalue',details='$details'  where id='$id'") or die(mysql_error());
             header('location:product.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con, "delete from product where id='$_REQUEST[id]'");

header("location:product.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>product Management</title>
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

         
         <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({
  selector: 'textarea',
  height: 300,
  theme: 'modern',
  plugins: 'print preview fullpage   searchreplace autolink directionality   visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc   advlist lists textcolor wordcount     imagetools      contextmenu colorpicker textpattern help',
  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });</script>



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
                  <h1>product</h1>
                  <small>product List</small>
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
                                 <h4>Add product</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data" >
                                <div class="form-group">
                                 <label>Category</label>
                                 <select class="form-control" name="cat_id">

                                    <? $sqlp=mysqli_query($con,"select * from category");
                                    while($rowp=mysqli_fetch_array($sqlp)){ ?>

                                       <option value="<? echo $rowp['id']; ?>"><? echo $rowp['name']; ?></option>
                                    <? } ?>  
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Name</label>
                                 <input type="text" class="form-control" name="name" placeholder="Enter Product Name" required>
                              </div>
                                   <div class="form-group">
                                 <label>Image</label>
                                   <input type="file"  name="filstor"  class="form-control">
                                  
                              </div>

                             <div class="form-group">
                                 <label>Price</label>
                                 <input type="text" name="price" class="form-control" placeholder="Enter Price"     >
                              </div>
                               <div class="form-group">
                                 <label>M Value</label>
                                 <input type="text" name="mvalue" class="form-control" placeholder="Enter Market Value"    >
                              </div>
                             
                             
                             <div class="form-group">
                                 <label>Details</label>
                                 <textarea name="details"  class="form-control"></textarea>
                                 
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
$sql="select * from product where id='$id2'";
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
                                 <h4>Update product</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12"  method="post" action=""     enctype="multipart/form-data" >


                                   <div class="form-group">
                                 <label>Category</label>
                                 <select class="form-control" name="cat_id">

                                    <? $sqlp=mysqli_query($con,"select * from category");
                                    while($rowp=mysqli_fetch_array($sqlp)){ ?>

                                       <option value="<? echo $rowp['id']; ?>" <? if($rowp['id']==$row['category']){echo "selected";} ?>><? echo $rowp['name']; ?></option>
                                    <? } ?>  
                                 </select>
                              </div>
                             
                        

                           <div class="form-group">
                                 <label>Name</label>
                                 <input type="text" class="form-control" name="name" placeholder="Enter Product Name"  value="<? echo $row['name'];?>"   required>
                              </div>

                             

                                  <div class="form-group">
                                 <label>Image</label>
                                 <img src="photo/<? echo $row['photos']; ?>" width="100"> 
                                   <input type="file"  name="filstor"  class="form-control">
                                    <input type="hidden" name="oldimg" value="<? echo $row['photos']; ?>">
                                  
                              </div>  
                             <div class="form-group">
                                 <label>Price</label>
                                 <input type="text" name="price" class="form-control" placeholder="Enter Price"  value="<? echo $row['price'];?>"       >
                              </div>
                               <div class="form-group">
                                 <label>M Value</label>
                                 <input type="text" name="mvalue" class="form-control" placeholder="Enter Market Value" value="<? echo $row['mvalue'];?>"      >
                              </div>
                             
                             
                             <div class="form-group">
                                 <label>Details</label>

                                   <textarea name="details"  class="form-control"><? echo $row['details'];?></textarea>
                                 
                              
                              </div>
                             
                              
                              <div class="reset-button">

                              <input type="hidden" name="id" value="<? echo $row['id'];?>">
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
                                 <h4>product List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="product.php?Action=Add"> <i class="fa fa-plus"></i> Add product
                                 </a>  
                              </div>
                            
                           </div>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>Category</th>
                                       <th>Product</th>  
                                       <th>Photo</th>  
                                       <th>Value</th>  
                                       <th>Price</th>  
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                    <? $sql=mysqli_query($con,"select * from product order by id desc");
                                    while($row=mysqli_fetch_array($sql)){ ?>
                                    <tr>
                                       
                                       <td><? $cat_id= $row['cat_id'];
$sql2=mysqli_query($con,"select * from category where id='$cat_id'");
$row2=mysqli_fetch_array($sql2);
echo $row2['name'];
                                        ?></td>
                                       <td><? echo $row['name']; ?></td> 
                                             <td> <img src="photo/<? echo $row['photos']; ?>" width="50"></td>
                                
                                      <td><? echo $row['mvalue']; ?></td> 
                                      <td><? echo $row['price']; ?></td> 
                                      
                                       <td>
                                          <a href="product.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
                                          <a  href="javascript:resume_id('<?=$row['id']?>')" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
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