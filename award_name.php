<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
 



 if(isset($_POST["UpdateSequence"]) ) {
$id=$_POST['id'];
$sl_no=$_POST['sl_no'];
for($i = 0, $l = count($id); $i < $l; ++$i) {
  $idd= $id[$i];
  $sl= $sl_no[$i];
  $sql=mysqli_query($con, "update award_name set sl_no='$sl' where id='$idd'");
}
 header("location:award_name.php?Done");
 }

if($_POST["Submit"]) { 
    $name= $_POST['name'] ;  
    $organiser= $_POST['organiser'] ;  
    $other_name= $_POST['other_name'] ;  
    $originated_country_id= $_POST['originated_country_id'] ;  
    $language_id= $_POST['language_id'] ; 
$planguage_id="";  
foreach ($language_id as $a){
    $planguage_id= $planguage_id.",".$a;
}
$planguage_id = substr($planguage_id, 1);

    $is_name_changed= $_POST['is_name_changed'] ;  
    $old_name= $_POST['old_name'] ;  
    $first_awarded_date= $_POST['first_awarded_date'] ;  
    $first_awarded_month= $_POST['first_awarded_month'] ;  
    $first_awarded_year= $_POST['first_awarded_year'] ;  
    $website= $_POST['website'] ;  
    $details= $_POST['details'] ;  
    $status= $_POST['status'] ;   
 

 
mysqli_query($con,"INSERT INTO `award_name` ( name, organiser, other_name, originated_country_id, language_id, is_name_changed, old_name, first_awarded_date, first_awarded_month, first_awarded_year, website, details, status ) VALUES (  '$name', '$organiser' , '$other_name' , '$originated_country_id' , '$planguage_id' , '$is_name_changed' , '$old_name' , '$first_awarded_date' ,'$first_awarded_month' ,'$first_awarded_year' , '$website' , '$details' , '$status'  )") or die(mysql_error());
  
            header('location:award_name.php?msg=success');
         }



           if($_POST["Update"]) {




    $id= $_POST['id']; 
    $name= $_POST['name'] ;  
    $organiser= $_POST['organiser'] ;  
    $other_name= $_POST['other_name'] ;  
    $originated_country_id= $_POST['originated_country_id'] ;   
    $language_id= $_POST['language_id'] ; 
$planguage_id="";  
foreach ($language_id as $a){
    $planguage_id= $planguage_id.",".$a;
}
$planguage_id = substr($planguage_id, 1);
    $is_name_changed= $_POST['is_name_changed'] ;  
    $old_name= $_POST['old_name'] ;  
    $first_awarded_date= $_POST['first_awarded_date'] ;  
    $first_awarded_month= $_POST['first_awarded_month'] ;  
    $first_awarded_year= $_POST['first_awarded_year'] ;  
    $website= $_POST['website'] ;  
    $details= $_POST['details'] ;  
    $status= $_POST['status'] ;   
 
            mysqli_query($con,"update award_name set   name='$name', organiser='$organiser' , other_name='$other_name' , originated_country_id='$originated_country_id' , language_id='$planguage_id' , is_name_changed='$is_name_changed' , old_name='$old_name' , first_awarded_date='$first_awarded_date', first_awarded_month='$first_awarded_month', first_awarded_year='$first_awarded_year' , website='$website' , details='$details' , status='$status'  where id='$id'") or die(mysqli_error($con));
             header('location:award_name.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con, "delete from award_name where id='$_REQUEST[id]'");

header("location:award_name.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>award_name Management</title>
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
                  <h1>award_name</h1>
                  <small>award_name List</small>
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
                                 <h4>Add award_name</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                            <div class="form-group">
                                 <label>name</label>
                                 <input type="text" name="name" class="form-control" placeholder="Add name"   >
                              </div>

   <div class="form-group">
                                 <label>Organiser</label>
                                 <input type="text" name="organiser" class="form-control" placeholder="Add organiser" >
                              </div>

  <div class="form-group">
                                 <label>Other Name</label>
                                 <input type="text" name="other_name" class="form-control" placeholder="Add Other Name"  >
                              </div>

  <div class="form-group">
                                 <label>Originated Country</label>
                                 <select name="originated_country_id" class="form-control select2">
                                    <?php $sqlc=mysqli_query($con, "select * from country1 order by country_name");
                                    while($rowc=mysqli_fetch_array($sqlc)){ ?>
                                          <option value="<?php echo $rowc['id']; ?>"><?php echo $rowc['country_name']; ?></option>
                                       <?php } ?>
</select>
                            
                              </div>

 <div class="form-group">
                                 <label>Language</label>
 <select  class="form-control select2"   name="language_id[]" multiple >
                                 <?php $sqld=mysqli_query($con,"select * from dubbing order by name");
                                 while($rowd=mysqli_fetch_array($sqld)){?>

                                    <option value="<?php echo $rowd['id']; ?>"  <? if(strpos($row['language_id'],$rowd['id']) !== false){echo "selected";} ?>><?php echo $rowd['name']; ?></option>
                                 <?php } ?>
                                </select>
                              </div>
  <div class="form-group">
                                 <label>If Name Changed?</label>
                                 <select name="is_name_changed" class="form-control">
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                 </select>
                              </div>

  <div class="form-group">
                                 <label>Old Name</label>
                                 <input type="text" name="old_name" class="form-control" placeholder="Add Old Name"   >
                              </div>

  <div class="form-group">
                                 <label>First Awarded Date</label>
                                 <input type="text" name="first_awarded_date" class="form-control" placeholder="Update First Awarded"    >
                              </div>
  <div class="form-group">
                                 <label>First Awarded Month</label>
                                 <input type="text" name="first_awarded_month" class="form-control" placeholder="Update First Awarded"    >
                              </div>
  <div class="form-group">
                                 <label>First Awarded Year</label>
                                 <input type="text" name="first_awarded_year" class="form-control" placeholder="Update First Awarded"    >
                              </div>
 

  <div class="form-group">
                                 <label>Website</label>
                                 <input type="text" name="website" class="form-control" placeholder="Add Website"    >
                              </div>

 
  <div class="form-group">
                                 <label>Details</label>
                                 <input type="text" name="details" class="form-control" placeholder="Add Details"    >
                              </div>

 <!-- 
  <div class="form-group">
                                 <label>Status</label>
                                 <input type="text" name="status" class="form-control" placeholder="Update Status"    >
                              </div> -->

                          
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
$sql="select * from award_name where id='$id2'";
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
                                 <h4>Update award_name</h4>
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
                                 <label>Organiser</label>
                                 <input type="text" name="organiser" class="form-control" placeholder="Update organiser" value="<? echo $row['organiser'];?>"   >
                              </div>

  <div class="form-group">
                                 <label>Other Name</label>
                                 <input type="text" name="other_name" class="form-control" placeholder="Update Other Name" value="<? echo $row['other_name'];?>"   >
                              </div>

    <div class="form-group">
                                 <label>Originated Country</label>
                                 <select name="originated_country_id" class="form-control select2">
                                    <?php $sqlc=mysqli_query($con, "select * from country1 order by country_name");
                                    while($rowc=mysqli_fetch_array($sqlc)){ ?>
                                          <option value="<?php echo $rowc['id']; ?>" <?php if($rowc['id']==$row['originated_country_id']){ echo "selected"; } ?>><?php echo $rowc['country_name']; ?></option>
                                       <?php } ?>
</select>
                            
                              </div>
 <div class="form-group">
                                 <label>Language</label>
 <select  class="form-control select2"   name="language_id[]" multiple >
                                 <?php $sqld=mysqli_query($con,"select * from dubbing order by name");
                                 while($rowd=mysqli_fetch_array($sqld)){?>

                                    <option value="<?php echo $rowd['id']; ?>"  <? if(strpos($row['language_id'],$rowd['id']) !== false){echo "selected";} ?>><?php echo $rowd['name']; ?></option>
                                 <?php } ?>
                                </select>
                              </div>

  <div class="form-group">
                                 <label>If Name Changed?</label>
                                 <select name="is_name_changed" class="form-control">
                                    <option value="No" <?php if($row['is_name_changed']=="No"){echo "selected"; } ?>>No</option>
                                    <option value="Yes" <?php if($row['is_name_changed']=="Yes"){echo "selected"; } ?>>Yes</option>
                                 </select>
                              </div>
  <div class="form-group">
                                 <label>Old Name</label>
                                 <input type="text" name="old_name" class="form-control" placeholder="Update Old Name" value="<? echo $row['old_name'];?>"   >
                              </div>

  <div class="form-group">
                                 <label>First Awarded Date</label>
                                 <input type="text" name="first_awarded_date" class="form-control" placeholder="Update First Awarded" value="<? echo $row['first_awarded_date'];?>"   >
                              </div>
  <div class="form-group">
                                 <label>First Awarded Month</label>
                                 <input type="text" name="first_awarded_month" class="form-control" placeholder="Update First Awarded" value="<? echo $row['first_awarded_month'];?>"   >
                              </div>
  <div class="form-group">
                                 <label>First Awarded Year</label>
                                 <input type="text" name="first_awarded_year" class="form-control" placeholder="Update First Awarded" value="<? echo $row['first_awarded_year'];?>"   >
                              </div> 
  <div class="form-group">
                                 <label>Website</label>
                                 <input type="text" name="website" class="form-control" placeholder="Update Website" value="<? echo $row['website'];?>"   >
                              </div>

 
  <div class="form-group">
                                 <label>Details</label>
                                 <input type="text" name="details" class="form-control" placeholder="Update Details" value="<? echo $row['details'];?>"   >
                              </div>
<!-- 
 
  <div class="form-group">
                                 <label>Status</label>
                                 <input type="text" name="status" class="form-control" placeholder="Update Status" value="<? echo $row['status'];?>"   >
                              </div>
 -->
 
                             
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
                                 <h4>award_name List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="award_name.php?Action=Add"> <i class="fa fa-plus"></i> Add award_name
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
    url: "search_award_name.php",
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
<!-- 
<input type="text" class="search form-control" id="searchid" placeholder="Search for award_name Film" style="width: 100%" />  
<div id="result"></div>
 

<br><br> -->
 <select class="form-control select2"   onChange="window.document.location.href=this.options[this.selectedIndex].value;">
<option value="">Search Award Name</option>
<?php $sqlfs=mysqli_query($con, "select * from award_name");
while($rowfs=mysqli_fetch_array($sqlfs)){  
 ?>

<option value="award_name.php?Action=Update&id=<?php echo $rowfs['id']; ?>"><?php echo $rowfs['name']; ?></option>
<?php } ?>

 </select><br><br>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive"> 

                              <form name="form1" method="post" action="">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                          <th>Sl No.</th>
                                       <th>Name</th>  
                                       <th>Organiser</th>  
                                       <th>First Awarded</th>  
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `award_name`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `award_name` order by sl_no asc LIMIT $offset, $total_records_per_page");
 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                          <td> <input type="text" name="sl_no[]" value="<?php    echo $row['sl_no'];   ?>" style="width: 30px;">

<input type="hidden" name="id[]" value="<?php    echo $row['id'];   ?>"></td>
                                       <td><? echo $row['name']; ?></td> 
                                       <td><? echo $row['organiser']; ?></td> 
                                       <td><? echo $row['first_awarded_date']; ?>/<? echo $row['first_awarded_month']; ?>/<? echo $row['first_awarded_year']; ?></td> 
                                        <td>


                                          <!-- <a href="award_name.php?Action=CreateAwardYear&id=<? echo $row['id'];    ?>&year=<? echo $row['first_awarded']; ?>" class="btn btn-add btn-sm"    >Create Award Year</a> -->

                                          <a href="award_name.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
                                          <a  href="javascript:resume_id('<? echo $row['id']?>')" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
                                       </td>
                                    </tr>

                                     <? } ?>
                                    
                                 </tbody>
                              </table>
                                <input type="submit" name="UpdateSequence" value="UpdateSequence" class="btn btn-success">

 </form>
 



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
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

 

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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


$(document).ready(function() {
    $('.select2').select2();
});

</script>