<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      } 
	  
	  $id=$_GET["id"];
      $record="select * from film_production_management_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
      $film_id=$read["film_id"];	  

?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Film Production Management</title>
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
   
   <script>
     function del()
     {
         var c=confirm('Are you sure delete this...?');
         if(c==true)
         {
             return true;
         }
         else{
             return false;
         }
     }
     
     </script>

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
                  <h1> Film Production Management</h1>
                  <small> Film Production List</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4> Film Production Management List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="add_film_production_management.php"> <i class="fa fa-plus"></i> Add Production
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
    url: "search_production_management2.php",
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

<input type="text" class="search form-control" id="searchid" placeholder="Search for Film" style="width: 100%" />  
<div id="result"></div>
 
              

   <br/>

 <select class="form-control select2"   onChange="window.document.location.href=this.options[this.selectedIndex].value;">
<option value="">Search Film  </option>
<?php $sqlfs=mysqli_query($con, "select * from film_production_management_allot");
while($rowfs=mysqli_fetch_array($sqlfs)){ 

$film_id=$rowfs['film_id'];

$sqlf=mysqli_query($con,"select * from film where id='$film_id'");
$rowf=mysqli_fetch_array($sqlf);
   
$main_lang=explode(",",$rowf['main_lang']);
$main_language="";
foreach ($main_lang as $x) {
  $sqlld=mysqli_query($con, "select * from dubbing where id='$x'");
  $rowld=mysqli_fetch_array($sqlld);
  $main_language=$main_language.", ".$rowld['name'];

}
 
$main_language=   substr($main_language, 2);
 ?>

<option value="edit_film_production_management.php?id=<?php echo $rowfs['id']; ?>"><?php echo $rowf['name']; ?> - <?php echo $rowf['year_release']; ?> - <?php echo $main_language; ?>     </option>
<?php } ?>

 </select><br>             
                           <br/>
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                    <th>S.N</th>
                                    <th>Film Name</th>
                                    <th>Production</th>
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `film_production_management_allot`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `film_production_management_allot` order by id desc LIMIT $offset, $total_records_per_page");


                                       $sn=1;
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           <td><?php echo $sn;?></td>
                                           <td><?php 
                                    
                                    $film_id=$row["film_id"];
										 $film_data_query="select * from film where id='$film_id'";
										 $film_data_exe=mysqli_query($con,$film_data_query);
										 $film_name_read=mysqli_fetch_array($film_data_exe);
                                     ?>
                                     <?php echo $film_name_read["name"];?></td>
                                      
                                       <td>
                                           <table class="table table-bordered table-striped table-hover">
                                               <tr>
                                                <th>Project Director:</th>
                                               <td>
											    <?php
$film_project_director_name = explode(",", $row["film_project_director_name"]);

foreach ($film_project_director_name as $film_project_director_name_id) {
    $film_project_director_name_data_query = "select * from productionandmanagement where id='$film_project_director_name_id'";
    $film_project_director_name_data_data_exe = mysqli_query($con, $film_project_director_name_data_query);
  
        $film_project_director_name_name_read = mysqli_fetch_array($film_project_director_name_data_data_exe);
        echo $film_project_director_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               
                                                <tr>
                                                <th>Project Designer:</th>
                                               <td>
											    <?php
$project_designer = explode(",", $row["project_designer"]);

foreach ($project_designer as $project_designer_id) {
    $project_designer_data_query = "select * from productionandmanagement where id='$project_designer_id'";
    $project_designer_data_exe = mysqli_query($con, $project_designer_data_query);
  
        $project_designer_data_read = mysqli_fetch_array($project_designer_data_exe);
        echo $project_designer_data_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>


                                                   <tr>
                                                <th>Project Executive:</th>
                                               <td>
											    <?php
$film_project_executive_name = explode(",", $row["film_project_executive_name"]);

foreach ($film_project_executive_name as $film_project_executive_name_id) {
    $film_project_executive_name_data_query = "select * from productionandmanagement where id='$film_project_executive_name_id'";
    $film_project_executive_name_data_exe = mysqli_query($con, $film_project_executive_name_data_query);
  
        $film_project_executive_name_data_read = mysqli_fetch_array($film_project_executive_name_data_exe);
        echo $film_project_executive_name_data_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                     <tr>
                                                <th>Project Controller:</th>
                                               <td>
											    <?php
$film_project_controller_name = explode(",", $row["film_project_controller_name"]);

foreach ($film_project_controller_name as $film_project_controller_name_id) {
    $film_project_controller_name_data_query = "select * from productionandmanagement where id='$film_project_controller_name_id'";
    $film_project_controller_name_data_exe = mysqli_query($con, $film_project_controller_name_data_query);
  
        $film_project_controller_name_data_read = mysqli_fetch_array($film_project_controller_name_data_exe);
        echo $film_project_controller_name_data_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                 <tr>
                                               <th>Production Head:</th>
                                               <td>
											    <?php
$prodution_head = explode(",", $row["prodution_head"]);

foreach ($prodution_head as $prodution_head_id) {
    $prodution_head_data_query = "select * from productionandmanagement where id='$prodution_head_id'";
    $prodution_head_data_exe = mysqli_query($con, $prodution_head_data_query);
  
        $prodution_head_name_read = mysqli_fetch_array($prodution_head_data_exe);
        echo $prodution_head_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Production Controller:</th>
                                               <td>
											    <?php
$film_production_controller_name = explode(",", $row["film_production_controller_name"]);

foreach ($film_production_controller_name as $film_production_controller_name_id) {
    $film_production_controller_name_data_query = "select * from productionandmanagement where id='$film_production_controller_name_id'";
    $film_production_controller_name_data_exe = mysqli_query($con, $film_production_controller_name_data_query);
  
        $film_production_controller_name_name_read = mysqli_fetch_array($film_production_controller_name_data_exe);
        echo $film_production_controller_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Production Supervisor:</th>
                                               <td>
											    <?php
$film_production_supervisor_name = explode(",", $row["film_production_supervisor_name"]);

foreach ($film_production_supervisor_name as $film_production_supervisor_name_id) {
    $film_production_supervisor_name_data_query = "select * from productionandmanagement where id='$film_production_supervisor_name_id'";
    $film_production_supervisor_name_data_exe = mysqli_query($con, $film_production_supervisor_name_data_query);
  
        $film_production_supervisor_name_name_read = mysqli_fetch_array($film_production_supervisor_name_data_exe);
        echo $film_production_supervisor_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Production Manager:</th>
                                               <td>
											    <?php
$film_production_manager_name = explode(",", $row["film_production_manager_name"]);

foreach ($film_production_manager_name as $film_production_manager_name_id) {
    $film_production_manager_name_data_query = "select * from productionandmanagement where id='$film_production_manager_name_id'";
    $film_production_manager_name_data_exe = mysqli_query($con, $film_production_manager_name_data_query);
  
        $film_production_manager_name_name_read = mysqli_fetch_array($film_production_manager_name_data_exe);
        echo $film_production_manager_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Assistant Production Manager:</th>
                                               <td>
											    <?php
$assistant_production_manager = explode(",", $row["assistant_production_manager"]);

foreach ($assistant_production_manager as $assistant_production_manager_id) {
    $assistant_production_manager_data_query = "select * from productionandmanagement where id='$assistant_production_manager_id'";
    $assistant_production_manager_data_exe = mysqli_query($con, $assistant_production_manager_data_query);
  
        $assistant_production_manager_name_read = mysqli_fetch_array($assistant_production_manager_data_exe);
        echo $assistant_production_manager_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Unit Production Manager:</th>
                                               <td>
											    <?php
$unit_production_manager = explode(",", $row["unit_production_manager"]);

foreach ($unit_production_manager as $unit_production_manager_id) {
    $unit_production_manager_data_query = "select * from productionandmanagement where id='$unit_production_manager_id'";
    $unit_production_manager_data_exe = mysqli_query($con, $unit_production_manager_data_query);
  
        $unit_production_manager_name_read = mysqli_fetch_array($unit_production_manager_data_exe);
        echo $unit_production_manager_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Production Stage Manager:</th>
                                               <td>
											    <?php
$production_stage_manager = explode(",", $row["production_stage_manager"]);

foreach ($production_stage_manager as $production_stage_manager_id) {
    $production_stage_manager_data_query = "select * from productionandmanagement where id='$production_stage_manager_id'";
    $production_stage_manager_data_exe = mysqli_query($con, $production_stage_manager_data_query);
  
        $production_stage_manager_name_read = mysqli_fetch_array($production_stage_manager_data_exe);
        echo $production_stage_manager_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Production Coordinator:</th>
                                               <td>
											   
											    <?php
$film_production_coordinator_name = explode(",", $row["film_production_coordinator_name"]);

foreach ($film_production_coordinator_name as $film_production_coordinator_name_id) {
    $film_production_coordinator_name_data_query = "select * from productionandmanagement where id='$film_production_coordinator_name_id'";
    $film_production_coordinator_name_data_exe = mysqli_query($con, $film_production_coordinator_name_data_query);
  
        $film_production_coordinator_name_name_read = mysqli_fetch_array($film_production_coordinator_name_data_exe);
        echo $film_production_coordinator_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Production Assistant:</th>
                                               <td>
											    <?php
$film_production_assistant_name = explode(",", $row["film_production_assistant_name"]);

foreach ($film_production_assistant_name as $film_production_assistant_name_id) {
    $film_production_assistant_name_data_query = "select * from productionandmanagement where id='$film_production_assistant_name_id'";
    $film_production_assistant_name_data_exe = mysqli_query($con, $film_production_assistant_name_data_query);
  
        $film_production_assistant_name_name_read = mysqli_fetch_array($film_production_assistant_name_data_exe);
        echo $film_production_assistant_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Post Production Head:</th>
                                               <td>
											    <?php
$post_production_head = explode(",", $row["post_production_head"]);

foreach ($post_production_head as $post_production_head_id) {
    $post_production_head_data_query = "select * from productionandmanagement where id='$post_production_head_id'";
    $post_production_head_data_exe = mysqli_query($con, $post_production_head_data_query);
  
        $post_production_head_name_read = mysqli_fetch_array($post_production_head_data_exe);
        echo $post_production_head_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Post Production Supervisor:</th>
                                               <td>
											    <?php
$film_post_production_supervisor_name = explode(",", $row["film_post_production_supervisor_name"]);

foreach ($film_post_production_supervisor_name as $film_post_production_supervisor_name_id) {
    $film_post_production_supervisor_name_data_query = "select * from productionandmanagement where id='$film_post_production_supervisor_name_id'";
    $film_post_production_supervisor_name_data_exe = mysqli_query($con, $film_post_production_supervisor_name_data_query);
  
        $film_post_production_supervisor_name_name_read = mysqli_fetch_array($film_post_production_supervisor_name_data_exe);
        echo $film_post_production_supervisor_name_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Post Production Coordinator:</th>
                                               <td>
											    <?php
$post_production_coordinator = explode(",", $row["post_production_coordinator"]);

foreach ($post_production_coordinator as $post_production_coordinator_id) {
    $post_production_coordinator_data_query = "select * from productionandmanagement where id='$post_production_coordinator_id'";
    $post_production_coordinator_data_exe = mysqli_query($con, $post_production_coordinator_data_query);
  
        $post_production_coordinator_name_read = mysqli_fetch_array($post_production_coordinator_data_exe);
        echo $post_production_coordinator_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                 <tr>
                                               <th>Project Manager:</th>
                                               <td>
											    <?php
$project_manager = explode(",", $row["project_manager"]);

foreach ($project_manager as $project_manager_id) {
    $project_manager_data_query = "select * from productionandmanagement where id='$project_manager_id'";
    $project_manager_data_exe = mysqli_query($con, $project_manager_data_query);
  
        $project_manager_name_read = mysqli_fetch_array($project_manager_data_exe);
        echo $project_manager_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Production Executive:</th>
                                               <td>
											    <?php
$production_executive = explode(",", $row["production_executive"]);

foreach ($production_executive as $production_executive_id) {
    $production_executive_data_query = "select * from productionandmanagement where id='$production_executive_id'";
    $production_executive_data_exe = mysqli_query($con, $production_executive_data_query);
  
        $production_executive_name_read = mysqli_fetch_array($production_executive_data_exe);
        echo $production_executive_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Production Secretary:</th>
                                               <td>
											    <?php
$production_secretary = explode(",", $row["production_secretary"]);

foreach ($production_secretary as $production_secretary_id) {
    $production_secretary_data_query = "select * from productionandmanagement where id='$production_secretary_id'";
    $production_secretary_data_exe = mysqli_query($con, $production_secretary_data_query);
  
        $production_secretary_name_read = mysqli_fetch_array($production_secretary_data_exe);
        echo $production_secretary_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Digital Production Manager:</th>
                                               <td>
											    <?php
$digital_production_manager = explode(",", $row["digital_production_manager"]);

foreach ($digital_production_manager as $digital_production_manager_id) {
    $digital_production_manager_data_query = "select * from productionandmanagement where id='$digital_production_manager_id'";
    $digital_production_manager_data_exe = mysqli_query($con, $digital_production_manager_data_query);
  
        $digital_production_manager_name_read = mysqli_fetch_array($digital_production_manager_data_exe);
        echo $digital_production_manager_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Digital Production Coordinator:</th>
                                               <td>
											    <?php
$digital_production_coordinator = explode(",", $row["digital_production_coordinator"]);

foreach ($digital_production_coordinator as $digital_production_coordinator_id) {
    $digital_production_coordinator_data_query = "select * from productionandmanagement where id='$digital_production_coordinator_id'";
    $digital_production_coordinator_data_exe = mysqli_query($con, $digital_production_coordinator_data_query);
  
        $digital_production_coordinator_name_read = mysqli_fetch_array($digital_production_coordinator_data_exe);
        echo $digital_production_coordinator_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                            </table>
                                         
                                          
                                       </td>
                                       <td>
                                         
                                          <a href="edit_film_production_management.php?id=<? echo $row['id'];?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
                                          <a  href="delete_film_production_management.php?delete=<? echo $row['id'];?>" onclick="return del();" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
                                       </td>
                                    </tr>

                                     <? $sn++;} ?>
                                    
                                 </tbody>
                              </table>



<div style='padding: 10px 20px 0px; border-top: ded 1px #CCC;'>
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

</script>

   



<script type="text/javascript"> 

$(document).ready(function() {
    $('.select2').select2();
});
</script>
