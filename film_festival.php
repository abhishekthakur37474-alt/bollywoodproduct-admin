<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
 

if($_POST["Submit"]) { 
    $name= $_POST['name'] ;  
    $formar_name= $_POST['formar_name'] ;  
    $initial_name= $_POST['initial_name'] ;  
    $alias_name= $_POST['alias_name'] ;  
    $establishment_year= $_POST['establishment_year'] ;  
    $theme= $_POST['theme'] ;   
    $held= $_POST['held'] ;   
    $held_month= $_POST['held_month'] ;   
    $organised_by= $_POST['organised_by'] ;    
 
 $insert_q="INSERT INTO `film_festival` ( name, formar_name, initial_name, alias_name, establishment_year, theme, held, held_month, organised_by) VALUES (  '$name', '$formar_name' , '$initial_name' ,'$alias_name' ,'$establishment_year' , '$theme'  ,'$held', '$held_month' , '$organised_by')";
 
mysqli_query($con,$insert_q) or die(mysqli_error($con));
  
            header('location:film_festival.php?msg=success');
         }



           if($_POST["Update"]) {




    $id= $_POST['id']; 
    $name= $_POST['name'] ;  
    $formar_name= $_POST['formar_name'] ;  
    $initial_name= $_POST['initial_name'] ;  
    $alias_name= $_POST['alias_name'] ;  
    $establishment_year= $_POST['establishment_year'] ;  
    $theme= $_POST['theme'] ;   
    $held= $_POST['held'] ;   
    $held_month= $_POST['held_month'] ;   
    $organised_by= $_POST['organised_by'] ;       
 
            mysqli_query($con,"update film_festival set   name='$name', formar_name='$formar_name' , initial_name='$initial_name' ,alias_name='$alias_name' ,establishment_year='$establishment_year' , theme='$theme', held='$held', held_month='$held_month', organised_by='$organised_by'    where id='$id'") or die(mysqli_error($con));
             header('location:film_festival.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){  
mysqli_query($con, "delete from film_festival where id='$_REQUEST[id]'");

header("location:film_festival.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Film Festival Management</title>
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
                  <h1>Film Festival</h1>
                  <small>Film Festival List</small>
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
                                 <h4>Add Film Festival</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                             <div class="form-group">
                                 <label>Name</label>
                                 <input type="text" name="name" class="form-control" placeholder="Add Name" value="<? echo $row['name'];?>"   >
                              </div>


   <div class="form-group">
                                 <label>Formar Name</label>
                                 <input type="text" name="formar_name" class="form-control" placeholder="Add Formar Name" value="<? echo $row['formar_name'];?>"   >
                              </div>
   <div class="form-group">
                                 <label>Initial Name</label>
                                 <input type="text" name="initial_name" class="form-control" placeholder="Add Initial Name" value="<? echo $row['initial_name'];?>"   >
                              </div>

   <div class="form-group">
                                 <label>Alias Name</label>
                                 <input type="text" name="alias_name" class="form-control" placeholder="Add Alias Name" value="<? echo $row['alias_name'];?>"   >
                              </div>


   <div class="form-group">
                                 <label>Establishment Year</label>
                                 <input type="text" name="establishment_year" class="form-control" placeholder="Add Establishment Year" value="<? echo $row['establishment_year'];?>"   >
                              </div>


   <div class="form-group">
                                 <label>Theme</label>
                                 <input type="text" name="theme" class="form-control" placeholder="Add Theme" value="<? echo $row['theme'];?>"   >
                              </div>


   <div class="form-group">
                                 <label>Held</label>
                                 <input type="text" name="held" class="form-control" placeholder="Add Held" value="<? echo $row['held'];?>"   >
                              </div>
   <div class="form-group">
                                 <label>Held Month</label>
                                 <input type="text" name="held_month" class="form-control" placeholder="Add Held Month" value="<? echo $row['held_month'];?>"   >
                              </div>

   <div class="form-group">
                                 <label>Organised By</label>
                                 <input type="text" name="organised_by" class="form-control" placeholder="Add Organised By" value="<? echo $row['organised_by'];?>"   >
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
$sql="select * from film_festival where id='$id2'";
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
                                 <h4>Update film_festival</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                               <div class="form-group">
                                 <label>Name</label>
                                 <input type="text" name="name" class="form-control" placeholder="Add Name" value="<? echo $row['name'];?>"   >
                              </div>


   <div class="form-group">
                                 <label>Formar Name</label>
                                 <input type="text" name="formar_name" class="form-control" placeholder="Add Formar Name" value="<? echo $row['formar_name'];?>"   >
                              </div>
   <div class="form-group">
                                 <label>Initial Name</label>
                                 <input type="text" name="initial_name" class="form-control" placeholder="Add Initial Name" value="<? echo $row['initial_name'];?>"   >
                              </div>

   <div class="form-group">
                                 <label>Alias Name</label>
                                 <input type="text" name="alias_name" class="form-control" placeholder="Add Alias Name" value="<? echo $row['alias_name'];?>"   >
                              </div>


   <div class="form-group">
                                 <label>Establishment Year</label>
                                 <input type="text" name="establishment_year" class="form-control" placeholder="Add Establishment Year" value="<? echo $row['establishment_year'];?>"   >
                              </div>


   <div class="form-group">
                                 <label>Theme</label>
                                 <input type="text" name="theme" class="form-control" placeholder="Add Theme" value="<? echo $row['theme'];?>"   >
                              </div>


   <div class="form-group">
                                 <label>Held</label>
                                 <input type="text" name="held" class="form-control" placeholder="Add Held" value="<? echo $row['held'];?>"   >
                              </div>
   <div class="form-group">
                                 <label>Held Month</label>
                                 <input type="text" name="held_month" class="form-control" placeholder="Add Held Month" value="<? echo $row['held_month'];?>"   >
                              </div>

   <div class="form-group">
                                 <label>Organised By</label>
                                 <input type="text" name="organised_by" class="form-control" placeholder="Add Organised By" value="<? echo $row['organised_by'];?>"   >
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
                                 <h4>Film Festival List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="film_festival.php?Action=Add"> <i class="fa fa-plus"></i> Add Film Festival
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
    url: "search_film_festival.php",
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

<input type="text" class="search form-control" id="searchid" placeholder="Search for Film Festival Film" style="width: 100%" />  
<div id="result"></div>
 

<br><br>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                        <td>Name</td>
                                        <td>Organised By</td>
                                        <td>Establishment Year</td>
                                        <td>Theme</td>
                                        <td>Held</td>
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `film_festival`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `film_festival` order by id desc LIMIT $offset, $total_records_per_page");
 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                       <td><? echo $row['name']; ?></td> 
                                       <td><? echo $row['organised_by']; ?></td> 
                                      

                                       <td><? echo $row['establishment_year']; ?></td> 
                                       <td><? echo $row['theme']; ?></td> 
                                       <td><? echo $row['held']; ?></td> 
                                         <td>


                                  
                                          <a href="film_festival.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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