<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      } 
	    $id=$_GET["id"];
      $record="select * from film_visual_effects_management_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
        $film_id=$read["film_id"];

?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Film Visual Effects Management</title>
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
                  <h1> Film Visual Effects Management</h1>
                  <small> Film Visual Effects List</small>
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
                                 <h4> Film Visual Effects Management List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="add_film_visual_effects_management.php"> <i class="fa fa-plus"></i> Add Film Visual Effects
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
    url: "search_visual_effects.php",
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
<?php $sqlfs=mysqli_query($con, "select * from film_visual_effects_management_allot");
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

<option value="edit_film_visual_effects.php?id=<?php echo $rowfs['id']; ?>"><?php echo $rowf['name']; ?> - <?php echo $rowf['year_release']; ?> - <?php echo $main_language; ?>     </option>
<?php } ?>

 </select><br>
 
                           
                           <br/>
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                    <th>S.N</th>
                                    <th>Film Name</th>
                                    <th>Directos</th>
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `film_visual_effects_management_allot`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `film_visual_effects_management_allot` order by id desc LIMIT $offset, $total_records_per_page");


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
                                               <th>Visual Effects:</th>
                                               <td>
											   <?php
$film_visual_effects_name = explode(",", $row["film_visual_effects_name"]);

foreach ($film_visual_effects_name as $film_visual_effects_name_id) {
    $film_visual_effects_name_data_query = "select * from visualeffects where id='$film_visual_effects_name_id'";
    $film_visual_effects_name_data_exe = mysqli_query($con, $film_visual_effects_name_data_query);
  
        $film_visual_effects_name_name_read = mysqli_fetch_array($film_visual_effects_name_data_exe);
        echo $film_visual_effects_name_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Visual Effects Artist:</th>
                                               <td>
											   <?php
$film_visual_effects_artist_name = explode(",", $row["film_visual_effects_artist"]);

foreach ($film_visual_effects_artist_name as $film_visual_effects_artist_id) {
    $film_visual_effects_artist_data_query = "select * from visualeffects where id='$film_visual_effects_artist_id'";
    $film_visual_effects_artist_data_exe = mysqli_query($con, $film_visual_effects_artist_data_query);
  
        $film_visual_effects_artist_name_read = mysqli_fetch_array($film_visual_effects_artist_data_exe);
        echo $film_visual_effects_artist_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Visual Effects Director:</th>
                                               <td>
											   <?php
$visual_effects_director = explode(",", $row["visual_effects_director"]);

foreach ($visual_effects_director as $visual_effects_director_id) {
    $visual_effects_director_data_query = "select * from visualeffects where id='$visual_effects_director_id'";
    $visual_effects_director_data_exe = mysqli_query($con, $visual_effects_director_data_query);
  
        $visual_effects_director_name_read = mysqli_fetch_array($visual_effects_director_data_exe);
        echo $visual_effects_director_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               
                                               <tr>
                                               <th>Visual Effects Supervisor:</th>
                                               <td>
											     <?php
$film_visual_effects_supervisor_name = explode(",", $row["film_visual_effects_supervisor_name"]);

foreach ($film_visual_effects_supervisor_name as $film_visual_effects_supervisor_name_id) {
    $film_visual_effects_supervisor_name_data_query = "select * from visualeffects where id='$film_visual_effects_supervisor_name_id'";
    $film_visual_effects_supervisor_name_data_exe = mysqli_query($con, $film_visual_effects_supervisor_name_data_query);
  
        $film_visual_effects_supervisor_name_name_read = mysqli_fetch_array($film_visual_effects_supervisor_name_data_exe);
        echo $film_visual_effects_supervisor_name_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Senior VFX Supervisor:</th>
                                               <td>
											   <?php
$senior_vfx_supervisor = explode(",", $row["senior_vfx_supervisor"]);

foreach ($senior_vfx_supervisor as $senior_vfx_supervisor_id) {
    $senior_vfx_supervisor_data_query = "select * from visualeffects where id='$senior_vfx_supervisor_id'";
    $senior_vfx_supervisor_data_exe = mysqli_query($con, $senior_vfx_supervisor_data_query);
  
        $senior_vfx_supervisor_name_read = mysqli_fetch_array($senior_vfx_supervisor_data_exe);
        echo $senior_vfx_supervisor_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                                <tr>
                                               <th>On-Set VFX Supervisor:</th>
                                               <td>
											   <?php
$on_set_vfx_supervisor = explode(",", $row["on_set_vfx_supervisor"]);

foreach ($on_set_vfx_supervisor as $on_set_vfx_supervisor_id) {
    $on_set_vfx_supervisor_data_query = "select * from visualeffects where id='$on_set_vfx_supervisor_id'";
    $on_set_vfx_supervisor_data_exe = mysqli_query($con, $on_set_vfx_supervisor_data_query);
  
        $on_set_vfx_supervisor_name_read = mysqli_fetch_array($on_set_vfx_supervisor_data_exe);
        echo $on_set_vfx_supervisor_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                                 
                                                <tr>
                                               <th>VFX Producer:</th>
                                               <td>
											   <?php
$vfx_producer = explode(",", $row["vfx_producer"]);

foreach ($vfx_producer as $vfx_producer_id) {
    $vfx_producer_data_query = "select * from visualeffects where id='$vfx_producer_id'";
    $vfx_producer_data_exe = mysqli_query($con, $vfx_producer_data_query);
  
        $vfx_producer_name_read = mysqli_fetch_array($vfx_producer_data_exe);
        echo $vfx_producer_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>VFX Executive Producer:</th>
                                               <td>
											   <?php
$vfx_executive_producer = explode(",", $row["vfx_executive_producer"]);

foreach ($vfx_executive_producer as $vfx_executive_producer_id) {
    $vfx_executive_producer_data_query = "select * from visualeffects where id='$vfx_executive_producer_id'";
    $vfx_executive_producer_data_exe = mysqli_query($con, $vfx_executive_producer_data_query);
  
        $vfx_executive_producer_name_read = mysqli_fetch_array($vfx_executive_producer_data_exe);
        echo $vfx_executive_producer_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                                <tr>
                                               <th>VFX Editor:</th>
                                               <td>
											   <?php
$vfx_editor = explode(",", $row["vfx_editor"]);

foreach ($vfx_editor as $vfx_editor_id) {
    $vfx_editor_data_query = "select * from visualeffects where id='$vfx_editor_id'";
    $vfx_editor_data_exe = mysqli_query($con, $vfx_editor_data_query);
  
        $vfx_editor_name_read = mysqli_fetch_array($vfx_editor_data_exe);
        echo $vfx_editor_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>VFX Coordinator:</th>
                                               <td>
											   <?php
$vfx_coordinator = explode(",", $row["vfx_coordinator"]);

foreach ($vfx_coordinator as $vfx_coordinator_id) {
    $vfx_coordinator_data_query = "select * from visualeffects where id='$vfx_coordinator_id'";
    $vfx_coordinator_data_exe = mysqli_query($con, $vfx_coordinator_data_query);
  
        $vfx_coordinator_name_read = mysqli_fetch_array($vfx_coordinator_data_exe);
        echo $vfx_coordinator_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Lead Compositor:</th>
                                               <td>
											   <?php
$lead_compositor = explode(",", $row["lead_compositor"]);

foreach ($lead_compositor as $lead_compositor_id) {
    $lead_compositor_data_query = "select * from visualeffects where id='$lead_compositor_id'";
    $lead_compositor_data_exe = mysqli_query($con, $lead_compositor_data_query);
  
        $lead_compositor_name_read = mysqli_fetch_array($lead_compositor_data_exe);
        echo $lead_compositor_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Compositor:</th>
                                               <td>
											     <?php
$film_compositor_name = explode(",", $row["film_compositor_name"]);

foreach ($film_compositor_name as $film_compositor_name_id) {
    $film_compositor_name_data_query = "select * from visualeffects where id='$film_compositor_name_id'";
    $film_compositor_name_data_exe = mysqli_query($con, $film_compositor_name_data_query);
  
        $film_compositor_name_name_read = mysqli_fetch_array($film_compositor_name_data_exe);
        echo $film_compositor_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Digital Compositor:</th>
                                               <td>
											     <?php
$film_digital_compositor_name = explode(",", $row["film_digital_compositor_name"]);

foreach ($film_digital_compositor_name as $film_digital_compositor_name_id) {
    $film_digital_compositor_name_data_query = "select * from visualeffects where id='$film_digital_compositor_name_id'";
    $film_digital_compositor_name_data_exe = mysqli_query($con, $film_digital_compositor_name_data_query);
  
        $film_digital_compositor_name_name_read = mysqli_fetch_array($film_digital_compositor_name_data_exe);
        echo $film_digital_compositor_name_name_read["name"],"<br/>";
    }

?>
											   
											 </td>
                                               </tr>
                                                <tr>
                                               <th>Senior Compositor:</th>
                                               <td>
											     <?php
$film_senior_compositor_name = explode(",", $row["film_senior_compositor_name"]);

foreach ($film_senior_compositor_name as $film_senior_compositor_name_id) {
    $film_senior_compositor_name_data_query = "select * from visualeffects where id='$film_senior_compositor_name_id'";
    $film_senior_compositor_name_data_exe = mysqli_query($con, $film_senior_compositor_name_data_query);
  
        $film_senior_compositor_name_name_read = mysqli_fetch_array($film_senior_compositor_name_data_exe);
        echo $film_senior_compositor_name_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Compositing Supervisor:</th>
                                               <td>
											   <?php
$compositing_supervisor = explode(",", $row["compositing_supervisor"]);

foreach ($compositing_supervisor as $compositing_supervisor_id) {
    $compositing_supervisor_data_query = "select * from visualeffects where id='$compositing_supervisor_id'";
    $compositing_supervisor_data_exe = mysqli_query($con, $compositing_supervisor_data_query);
  
        $compositing_supervisor_name_read = mysqli_fetch_array($compositing_supervisor_data_exe);
        echo $compositing_supervisor_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Rotoscope Artist:</th>
                                               <td>
											   <?php
$rotoscope_artist = explode(",", $row["rotoscope_artist"]);

foreach ($rotoscope_artist as $rotoscope_artist_id) {
    $rotoscope_artist_data_query = "select * from visualeffects where id='$rotoscope_artist_id'";
    $rotoscope_artist_data_exe = mysqli_query($con, $rotoscope_artist_data_query);
  
        $rotoscope_artist_name_read = mysqli_fetch_array($rotoscope_artist_data_exe);
        echo $rotoscope_artist_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Junior Compositor:</th>
                                               <td>
											   <?php
$junior_compositor = explode(",", $row["junior_compositor"]);

foreach ($junior_compositor as $junior_compositor_id) {
    $junior_compositor_data_query = "select * from visualeffects where id='$junior_compositor_id'";
    $junior_compositor_data_exe = mysqli_query($con, $junior_compositor_data_query);
  
        $junior_compositor_name_read = mysqli_fetch_array($junior_compositor_data_exe);
        echo $junior_compositor_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Matchmove Artist:</th>
                                               <td>
											   <?php
$matchmove_artist = explode(",", $row["matchmove_artist"]);

foreach ($matchmove_artist as $matchmove_artist_id) {
    $matchmove_artist_data_query = "select * from visualeffects where id='$matchmove_artist_id'";
    $matchmove_artist_data_exe = mysqli_query($con, $matchmove_artist_data_query);
  
        $matchmove_artist_name_read = mysqli_fetch_array($matchmove_artist_data_exe);
        echo $matchmove_artist_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>CG Supervisor Modeling:</th>
                                               <td>
											   <?php
$cs_supervisor_modeling = explode(",", $row["cs_supervisor_modeling"]);

foreach ($cs_supervisor_modeling as $cs_supervisor_modeling_id) {
    $cs_supervisor_modeling_data_query = "select * from visualeffects where id='$cs_supervisor_modeling_id'";
    $cs_supervisor_modeling_data_exe = mysqli_query($con, $cs_supervisor_modeling_data_query);
  
        $cs_supervisor_modeling_name_read = mysqli_fetch_array($cs_supervisor_modeling_data_exe);
        echo $cs_supervisor_modeling_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>CG Supervisor Animation:</th>
                                               <td>
											   <?php
$cs_supervisor_animation = explode(",", $row["cs_supervisor_animation"]);

foreach ($cs_supervisor_animation as $cs_supervisor_animation_id) {
    $cs_supervisor_animation_data_query = "select * from visualeffects where id='$cs_supervisor_animation_id'";
    $cs_supervisor_animation_data_exe = mysqli_query($con, $cs_supervisor_animation_data_query);
  
        $cs_supervisor_animation_name_read = mysqli_fetch_array($cs_supervisor_animation_data_exe);
        echo $cs_supervisor_animation_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                              <tr>
                                               <th>Render Wrangler:</th>
                                               <td>
											   <?php
$render_wrangler = explode(",", $row["render_wrangler"]);

foreach ($render_wrangler as $render_wrangler_id) {
    $render_wrangler_data_query = "select * from visualeffects where id='$render_wrangler_id'";
    $render_wrangler_data_exe = mysqli_query($con, $render_wrangler_data_query);
  
        $render_wrangler_name_read = mysqli_fetch_array($render_wrangler_data_exe);
        echo $render_wrangler_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Pipeline Technical Director(TD):</th>
                                               <td>
											   <?php
$pipeline_technical_director = explode(",", $row["pipeline_technical_director"]);

foreach ($pipeline_technical_director as $pipeline_technical_director_id) {
    $pipeline_technical_director_data_query = "select * from visualeffects where id='$pipeline_technical_director_id'";
    $pipeline_technical_director_data_exe = mysqli_query($con, $pipeline_technical_director_data_query);
  
        $pipeline_technical_director_name_read = mysqli_fetch_array($pipeline_technical_director_data_exe);
        echo $pipeline_technical_director_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Concept Artist:</th>
                                               <td>
											   <?php
$concept_artist = explode(",", $row["concept_artist"]);

foreach ($concept_artist as $concept_artist_id) {
    $concept_artist_data_query = "select * from visualeffects where id='$concept_artist_id'";
    $concept_artist_data_exe = mysqli_query($con, $concept_artist_data_query);
  
        $concept_artist_name_read = mysqli_fetch_array($concept_artist_data_exe);
        echo $concept_artist_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Previsualization Artist:</th>
                                               <td>
											   <?php
$previsualization_artist = explode(",", $row["previsualization_artist"]);

foreach ($previsualization_artist as $previsualization_artist_id) {
    $previsualization_artist_data_query = "select * from visualeffects where id='$previsualization_artist_id'";
    $previsualization_artist_data_exe = mysqli_query($con, $previsualization_artist_data_query);
  
        $previsualization_artist_name_read = mysqli_fetch_array($previsualization_artist_data_exe);
        echo $previsualization_artist_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Animator:</th>
                                               <td>
											   <?php
$animator = explode(",", $row["animator"]);

foreach ($animator as $animator_id) {
    $animator_data_query = "select * from visualeffects where id='$animator_id'";
    $animator_data_exe = mysqli_query($con, $animator_data_query);
  
        $animator_name_read = mysqli_fetch_array($animator_data_exe);
        echo $animator_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Character Animator:</th>
                                               <td>
											   <?php
$character_animator = explode(",", $row["character_animator"]);

foreach ($character_animator as $character_animator_id) {
    $character_animator_data_query = "select * from visualeffects where id='$character_animator_id'";
    $character_animator_data_exe = mysqli_query($con, $character_animator_data_query);
  
        $character_animator_name_read = mysqli_fetch_array($character_animator_data_exe);
        echo $character_animator_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Rigger:</th>
                                               <td>
											   <?php
$rigger = explode(",", $row["rigger"]);

foreach ($rigger as $rigger_id) {
    $rigger_data_query = "select * from visualeffects where id='$rigger_id'";
    $rigger_data_exe = mysqli_query($con, $rigger_data_query);
  
        $rigger_name_read = mysqli_fetch_array($rigger_data_exe);
        echo $rigger_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Motion Graphics Artist:</th>
                                               <td>
											   <?php
$motion_graphics = explode(",", $row["motion_graphics"]);

foreach ($motion_graphics as $motion_graphics_id) {
    $motion_graphics_data_query = "select * from visualeffects where id='$motion_graphics_id'";
    $motion_graphics_data_exe = mysqli_query($con, $motion_graphics_data_query);
  
        $motion_graphics_name_read = mysqli_fetch_array($motion_graphics_data_exe);
        echo $motion_graphics_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Modeler:</th>
                                               <td>
											   <?php
$modeler = explode(",", $row["modeler"]);

foreach ($modeler as $modeler_id) {
    $modeler_data_query = "select * from visualeffects where id='$modeler_id'";
    $modeler_data_exe = mysqli_query($con, $modeler_data_query);
  
        $modeler_name_read = mysqli_fetch_array($modeler_data_exe);
        echo $modeler_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Texture Artist:</th>
                                               <td>
											   <?php
$texture_artist = explode(",", $row["texture_artist"]);

foreach ($texture_artist as $texture_artist_id) {
    $texture_artist_data_query = "select * from visualeffects where id='$texture_artist_id'";
    $texture_artist_data_exe = mysqli_query($con, $texture_artist_data_query);
  
        $texture_artist_name_read = mysqli_fetch_array($texture_artist_data_exe);
        echo $texture_artist_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Look Devlopment Artist:</th>
                                               <td>
											   <?php
$look_devlopment_artist = explode(",", $row["look_devlopment_artist"]);

foreach ($look_devlopment_artist as $look_devlopment_artist_id) {
    $look_devlopment_artist_data_query = "select * from visualeffects where id='$look_devlopment_artist_id'";
    $look_devlopment_artist_data_exe = mysqli_query($con, $look_devlopment_artist_data_query);
  
        $look_devlopment_artist_name_read = mysqli_fetch_array($look_devlopment_artist_data_exe);
        echo $look_devlopment_artist_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Simulation Artist:</th>
                                               <td>
											   <?php
$simulation_artist = explode(",", $row["simulation_artist"]);

foreach ($simulation_artist as $simulation_artist_id) {
    $simulation_artist_data_query = "select * from visualeffects where id='$simulation_artist_id'";
    $simulation_artist_data_exe = mysqli_query($con, $simulation_artist_data_query);
  
        $simulation_artist_name_read = mysqli_fetch_array($simulation_artist_data_exe);
        echo $simulation_artist_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Dynamics Artist:</th>
                                               <td>
											   <?php
$dynamics = explode(",", $row["dynamics"]);

foreach ($dynamics as $dynamics_id) {
    $dynamics_data_query = "select * from visualeffects where id='$dynamics_id'";
    $dynamics_data_exe = mysqli_query($con, $dynamics_data_query);
  
        $dynamics_name_read = mysqli_fetch_array($dynamics_data_exe);
        echo $dynamics_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Fluid Simulation Artist:</th>
                                               <td>
											   <?php
$fluid_simulation_artist = explode(",", $row["fluid_simulation_artist"]);

foreach ($fluid_simulation_artist as $fluid_simulation_artist_id) {
    $fluid_simulation_artist_data_query = "select * from visualeffects where id='$fluid_simulation_artist_id'";
    $fluid_simulation_artist_data_exe = mysqli_query($con, $fluid_simulation_artist_data_query);
  
        $fluid_simulation_artist_name_read = mysqli_fetch_array($fluid_simulation_artist_data_exe);
        echo $fluid_simulation_artist_name_read["name"],"<br/>";
    }

?>
											   
											   </td>
                                               </tr>
                                            </table>
                                         
                                          
                                       </td>
                                       <td>
                                         
                                          <a href="edit_film_visual_effects.php?id=<? echo $row['id'];?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
                                          <a  href="delete_film_visual_effects.php?delete=<? echo $row['id'];?>" onclick="return del();" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
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


