<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      } 

if($_POST["Submit"]) {

    $country_id=mysqli_real_escape_string($con,$_POST['country_id']) ;
    $state_id= mysqli_real_escape_string($con,$_POST['state_id']) ;
    $city_name= mysqli_real_escape_string($con,implode(",",$_POST['city_name'])) ;
    $pincode= mysqli_real_escape_string($con,$_POST['pincode']) ;

$check_already_pincode="select count(*)as no_pincode from pincode where pincode='$pincode'";
$exe_check_aleray_pincode=mysqli_query($con,$check_already_pincode);
$check_pincode=mysqli_fetch_array($exe_check_aleray_pincode);
if($check_pincode["no_pincode"]<1)
{

 $city_name1=explode(",",$city_name);
echo $count_city=count($city_name1);
for($i=0;$i<$count_city;$i++){
   $city_final_name=$city_name1[$i];
mysqli_query($con,"INSERT INTO `pincode` (`pincode`,`city`,`state_id`,`country_id`) VALUES ('$pincode','$city_final_name','$state_id','$country_id')") or die(mysqli_error($con));
  
           
         
}
 header('location:pincode.php?msg=success');
}
else
{
    echo '<script>alert("This Pincode Already Listed")</script>';
}
}


           if($_POST["Update"]) {




    $id= $_GET['id'];
   $country_id=mysqli_real_escape_string($con,$_POST['country_id']) ;
    $state_id= mysqli_real_escape_string($con,$_POST['state_id']) ;
    $city_name= mysqli_real_escape_string($con,$_POST['city_name']) ;
$pincode= mysqli_real_escape_string($con,$_POST['pincode']);

            mysqli_query($con,"update pincode set pincode='$pincode' ,city='$city_name',state_id='$state_id',country_id='$country_id' where id='$id'") or die(mysqli_error($con));
             header('location:pincode.php?msg=success');
 
 
}
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con, "delete from pincode where id='$_REQUEST[id]'");

header("location:pincode.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Pincode Management</title>
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
    <link href="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
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
                  <h1>Pincode Management</h1>
                  <small>Pincode List</small>
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
                                 <h4>Add Pincode</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                               <div class="form-group">
                                 <label>Select Country</label>
                                <select class="form-control" id="country_id" name="country_id" required>
                                 <option value="">-Select Country-</option>
                                 <?
                                $select_country="select * from  country1";
                                $exe_country=mysqli_query($con,$select_country);
                                while($read_country=mysqli_fetch_array($exe_country)){
                                   ?>
                                   <option value="<?echo $read_country["id"]?>"><?echo $read_country["country_name"]?></option>
                                   <? } ?>
                              
                                </select>
                              </div>  
                               <div class="form-group">
                                 <label>Select State</label>
                                 <select id="state_id" name="state_id" class="form-control">
                                 <option value="">-Select State-</option>
                                 </select>
                              <div class="form-group">
                                 <label>City Name  (Use enter ↵ to add values)</label>
                                 <input type="text" class="form-control flexdatalist" name="city_name[]" placeholder="Enter City Name" multiple="multiple">
                              </div>  
                                <div class="form-group">
                                 <label>Pincode</label>
                                 <input type="text" class="form-control" name="pincode" placeholder="Enter Pincode" />
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
$sql="select * from pincode where id='$id2'";
$rs=mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs);
$pincode_value=explode(",",$row["pincode"]);
echo $pincode_data="".implode(",",$pincode_value)."";
?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Update Pincode</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <div class="form-group">
                                 <label>Select Country</label>
                                <select class="form-control" id="country_id" name="country_id" required>
                                  <?
$country_id=$row['country_id'];
 $find_country="select * from country1 where id='$country_id'";
$exe_country=mysqli_query($con,$find_country);
$read_country=mysqli_fetch_array($exe_country);

        ?>
                                 <option value="<? echo $read_country['id'];?>"><? echo $read_country['country_name'];?></option>
                                 <?
                                $select_country="select * from  country1";
                                $exe_country=mysqli_query($con,$select_country);
                                while($read_country=mysqli_fetch_array($exe_country)){
                                   ?>
                                   <option value="<?echo $read_country["id"]?>"><?echo $read_country["country_name"]?></option>
                                   <? } ?>
                              
                                </select>
                              </div>  
                               <div class="form-group">
                                 <label>Select State</label>
                                 <select id="state_id" name="state_id" class="form-control">
                                   <?
$state_id=$row['state_id'];
 $find_state="select * from state1 where id='$state_id'";
$exe_state=mysqli_query($con,$find_state);
$read_state=mysqli_fetch_array($exe_state);

        ?>
                                 <option value="<? echo $read_state['id'];?>"><? echo $read_state['state'];?></option>
                               <?  
                               $countryid = $row['country_id'];
    $query1 = "select * from state1 where country_id='$countryid'";
    $result1 = mysqli_query($con, $query1);
    if ($result1->num_rows > 0) {
        echo '<option value="">-Select State Now-</option>';
        while ($row1 = mysqli_fetch_assoc($result1)) {
            echo '<option value="' . $row1['id'] . '">' . $row1['state'] . '</option>';
        }
    }
    else
    {
        echo '<option value="">-No State Available-</option>';
    }
    ?>
                                 </select>
                              <div class="form-group">
                                 <label>City Name</label>
                                 <input type="text" class="form-control" name="city_name" value="<? echo $row['city'];?>" placeholder="Enter City Name" >
                              </div>  
                               <div class="form-group">
                                 <label>Pincode</label>
                                 <input type="text" class="form-control"  value="<? echo $pincode_data;?>"  name="pincode" placeholder="Enter Pincode" />
                              </div>
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
                                 <h4>Pincode List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="pincode.php?Action=Add"> <i class="fa fa-plus"></i> Add Pincode
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
    url: "search_city.php",
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

<input type="text" class="search form-control" id="searchid" placeholder="Search for Pincode" style="width: 100%" />  
<div id="result"></div><br/>
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                    <th>Country Name</th>
                                    <th>State Name</th>
                                    <th>City Name</th> 
                                       <th>Pincode</th> 
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `pincode`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `pincode` order by id desc LIMIT $offset, $total_records_per_page");


 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                       <td>
                                          <?
$country_id=$row['country_id'];
 $find_country="select * from country1 where id='$country_id'";
$exe_country=mysqli_query($con,$find_country);
$read_country=mysqli_fetch_array($exe_country);

        ?>
                                       
                                       <? echo $read_country['country_name']; ?></td> 
                                       <td>
                                         <?
$state_id=$row['state_id'];
 $find_state="select * from state1 where id='$state_id'";
$exe_state=mysqli_query($con,$find_state);
$read_state=mysqli_fetch_array($exe_state);

        ?>
                                       <? echo $read_state['state']; ?></td> 
                                        <td><? echo $row['city']; ?></td>
                                        <td> <? echo $row['pincode']; ?></td>
                                       <td>
                                         
                                          <a href="pincode.php?Action=Update&id=<? echo $row['id'];?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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
<script>
$(document).ready(function() {
    $("#country_id").on('change', function() {
        var countryid = $(this).val();

        $.ajax({
            method: "POST",
            url: "ajax_country_state_response.php",
            data: {
                id: countryid
            },
            datatype: "html",
            success: function(data) {
                $("#state_id").html(data);
                //$("#pincode").html('<option value="">Select pincode</option');

            }
        });
    });
   /* $("#state").on('change', function() {
        var stateid = $(this).val();
        $.ajax({
            method: "POST",
            url: "response.php",
            data: {
                sid: stateid
            },
            datatype: "html",
            success: function(data) {
                $("#pincode").html(data);

            }

        });
    });*/
});
</script>
 <script src="assets/dist/js/dashboard.js" type="text/javascript"></script>
                 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>
 <script>
$('.flexdatalist').flexdatalist({
     minLength: 1,
     valuesSeparator:',',
     allowDuplicateValues: false,
     valueProperty: 'id',
       visibleProperties: ["id","name"],
       searchIn: 'name',
       searchContain: true
});
</script>