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
      ?>
<?
if($_POST["edit_visual_effects_management"]) { 
    
    
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']); 
    $film_visual_effects_name= mysqli_real_escape_string($con,implode(",",$_POST['film_visual_effects_name']));
    $film_visual_effects_supervisor_name= mysqli_real_escape_string($con,implode(",",$_POST['film_visual_effects_supervisor_name']));
    $film_compositor_name= mysqli_real_escape_string($con,implode(",",$_POST['film_compositor_name']));
    $film_digital_compositor_name= mysqli_real_escape_string($con,implode(",",$_POST['film_digital_compositor_name']));
    $film_senior_compositor_name= mysqli_real_escape_string($con,implode(",",$_POST['film_senior_compositor_name']));
    $visual_effects_director= mysqli_real_escape_string($con,implode(",",$_POST['visual_effects_director']));
    $senior_vfx_supervisor= mysqli_real_escape_string($con,implode(",",$_POST['senior_vfx_supervisor']));
    $on_set_vfx_supervisor= mysqli_real_escape_string($con,implode(",",$_POST['on_set_vfx_supervisor']));
    $vfx_executive_producer= mysqli_real_escape_string($con,implode(",",$_POST['vfx_executive_producer']));
    $vfx_producer= mysqli_real_escape_string($con,implode(",",$_POST['vfx_producer']));
    $vfx_editor= mysqli_real_escape_string($con,implode(",",$_POST['vfx_editor']));
    $vfx_coordinator= mysqli_real_escape_string($con,implode(",",$_POST['vfx_coordinator']));
    $lead_compositor= mysqli_real_escape_string($con,implode(",",$_POST['lead_compositor']));
    $compositing_supervisor= mysqli_real_escape_string($con,implode(",",$_POST['compositing_supervisor']));
    $junior_compositor= mysqli_real_escape_string($con,implode(",",$_POST['junior_compositor']));
    $matchmove_artist= mysqli_real_escape_string($con,implode(",",$_POST['matchmove_artist']));
    $cs_supervisor_modeling= mysqli_real_escape_string($con,implode(",",$_POST['cs_supervisor_modeling']));
    $cs_supervisor_animation= mysqli_real_escape_string($con,implode(",",$_POST['cs_supervisor_animation']));
    $render_wrangler= mysqli_real_escape_string($con,implode(",",$_POST['render_wrangler']));
    $pipeline_technical_director= mysqli_real_escape_string($con,implode(",",$_POST['pipeline_technical_director']));
    $concept_artist= mysqli_real_escape_string($con,implode(",",$_POST['concept_artist']));
    $previsualization_artist= mysqli_real_escape_string($con,implode(",",$_POST['previsualization_artist']));
    $animator= mysqli_real_escape_string($con,implode(",",$_POST['animator']));
    $character_animator= mysqli_real_escape_string($con,implode(",",$_POST['character_animator']));
    $rigger= mysqli_real_escape_string($con,implode(",",$_POST['rigger']));
    $motion_graphics= mysqli_real_escape_string($con,implode(",",$_POST['motion_graphics']));
    $modeler= mysqli_real_escape_string($con,implode(",",$_POST['modeler']));
    $texture_artist= mysqli_real_escape_string($con,implode(",",$_POST['texture_artist']));
    $look_devlopment_artist= mysqli_real_escape_string($con,implode(",",$_POST['look_devlopment_artist']));
    $simulation_artist= mysqli_real_escape_string($con,implode(",",$_POST['simulation_artist']));
    $dynamics= mysqli_real_escape_string($con,implode(",",$_POST['dynamics']));
    $fluid_simulation_artist= mysqli_real_escape_string($con,implode(",",$_POST['fluid_simulation_artist']));
    $rotoscope_artist= mysqli_real_escape_string($con,implode(",",$_POST['rotoscope_artist']));
$film_visual_effects_artist_name=mysqli_real_escape_string($con,implode(",",$_POST['film_visual_effects_artist_name']));


    $film_makeup="update film_visual_effects_management_allot set film_visual_effects_artist='$film_visual_effects_artist_name',film_id='$film_id',film_visual_effects_name='$film_visual_effects_name',film_visual_effects_supervisor_name='$film_visual_effects_supervisor_name',film_compositor_name='$film_compositor_name',film_digital_compositor_name='$film_digital_compositor_name',film_senior_compositor_name='$film_senior_compositor_name',visual_effects_director='$visual_effects_director',senior_vfx_supervisor='$senior_vfx_supervisor',on_set_vfx_supervisor='$on_set_vfx_supervisor',vfx_executive_producer='$vfx_executive_producer',vfx_producer='$vfx_producer',vfx_editor='$vfx_editor',vfx_coordinator='$vfx_coordinator',lead_compositor='$lead_compositor',compositing_supervisor='$compositing_supervisor',junior_compositor='$junior_compositor',matchmove_artist='$matchmove_artist',cs_supervisor_modeling='$cs_supervisor_modeling',cs_supervisor_animation='$cs_supervisor_animation',render_wrangler='$render_wrangler',pipeline_technical_director='$pipeline_technical_director',concept_artist='$concept_artist',previsualization_artist='$previsualization_artist',animator='$animator',character_animator='$character_animator',rigger='$rigger',motion_graphics='$motion_graphics',modeler='$modeler',texture_artist='$texture_artist',look_devlopment_artist='$look_devlopment_artist',simulation_artist='$simulation_artist',dynamics='$dynamics',fluid_simulation_artist='$fluid_simulation_artist',rotoscope_artist='$rotoscope_artist' where id='$id'";
mysqli_query($con,$film_makeup) or die(mysqli_error($con));
  
         echo "<script>alert('Film Visual Effects Management Save Succesfully')</script>";
  echo "<script>window.location.href='film_visual_effects_management.php'</script>";
         }
         ?>
         
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Viusual Effects Management</title>
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
            <!--textaera------css-->
            <link href="/admin/richtext.min.css" rel="stylesheet" type="text/css"/>
            <link href="/admin/site.css" rel="stylesheet" type="text/css"/>
      <!-- End Global Mandatory Style
         =====================================================================-->
      <!-- Start Theme Layout Style
         =====================================================================-->
      <!-- Theme style -->
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>

     
  <!-- select2 -->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

 <style>
     select
     {
         width:100%;
     }
     fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
 </style>

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
                  <h1>Film Visual Effects Management</h1>
                  <small>Edit Film Visual Effects</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">

 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Edit Film Visual Effects Management Here</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                             <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                  
                                 <div class="form-group">
                                 <label>Select Film:</label>
                               <select class="form-control searchwithselect2" id="film_id" name="film_id"  style="width:100%:"  required>
                                     <?php 
                                    
                                    
										 $film_data_query="select * from film where id='$film_id'";
										 $film_data_exe=mysqli_query($con,$film_data_query);
										 $film_name_read=mysqli_fetch_array($film_data_exe);
                                     ?>
								   <option value="<?php echo $film_name_read["id"];?>"><?php echo $film_name_read["name"];?></option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ 
                                       $main_lang=$rowfr['main_lang'];
                                    $lang_q="select * from dubbing where id='$main_lang'";
                                    $exe_main_lang=mysqli_query($con,$lang_q);
                                    $read_lang=mysqli_fetch_array($exe_main_lang);
                                    $lang_name=$read_lang['name'];
                                    ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (Year:<? echo $rowfr['year_release']; ?> Language:<? echo $lang_name; ?>)</option>
                                  <? } ?>
                                 </select>
                                  
                             
                             
                             
                              </div>
                              <div class="form-group">
                                 <label>Visual Effects</label>
                             <select name="film_visual_effects_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_visual_effects_name=explode(",",$read["film_visual_effects_name"]);
                                     foreach($film_visual_effects_name as $visual_effects_name){
										   $visual_effects_name_data_query="select * from visualeffects where id='$visual_effects_name'";
										 $visual_effects_name_data_exe=mysqli_query($con,$visual_effects_name_data_query);
										 $visual_effects_name_name_read=mysqli_fetch_array($visual_effects_name_data_exe);
                                     ?>
                                     <option value="<?php echo $visual_effects_name_name_read['id'] ?>" selected><?php echo $visual_effects_name_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Visual Effects Artist</label>
                             <select name="film_visual_effects_artist_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_visual_effects_artist=explode(",",$read["film_visual_effects_artist"]);
                                     foreach($film_visual_effects_artist as $film_visual_effects_artist_id){
										   $visual_effects_name_data_query="select * from visualeffects where id='$film_visual_effects_artist_id'";
										 $visual_effects_name_data_exe=mysqli_query($con,$visual_effects_name_data_query);
										 $visual_effects_name_name_read=mysqli_fetch_array($visual_effects_name_data_exe);
                                     ?>
                                     <option value="<?php echo $visual_effects_name_name_read['id'] ?>" selected><?php echo $visual_effects_name_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Visual Effects Director</label>
                             <select name="visual_effects_director[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $visual_effects_director=explode(",",$read["visual_effects_director"]);
                                     foreach($visual_effects_director as $visual_effects_director){
										   $visual_effects_director_data_query="select * from visualeffects where id='$visual_effects_director'";
										 $visual_effects_director_data_exe=mysqli_query($con,$visual_effects_director_data_query);
										 $visual_effects_director_name_read=mysqli_fetch_array($visual_effects_director_data_exe);
                                     ?>
                                     <option value="<?php echo $visual_effects_director_name_read['id'] ?>" selected><?php echo $visual_effects_director_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>

                            
                               <div class="form-group">
                                 <label>Visual Effects Supervisor</label>
                             <select name="film_visual_effects_supervisor_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_visual_effects_supervisor_name=explode(",",$read["film_visual_effects_supervisor_name"]);
                                     foreach($film_visual_effects_supervisor_name as $visual_effects_supervisor_name){
										     $visual_effects_supervisor_name_data_query="select * from visualeffects where id='$visual_effects_supervisor_name'";
										 $visual_effects_supervisor_name_data_exe=mysqli_query($con,$visual_effects_supervisor_name_data_query);
										 $visual_effects_supervisor_name_name_read=mysqli_fetch_array($visual_effects_supervisor_name_data_exe);
                                     ?>
                                     <option value="<?php echo $visual_effects_supervisor_name_name_read['id'] ?>" selected><?php echo $visual_effects_supervisor_name_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Senior VFX Supervisor</label>
                             <select name="senior_vfx_supervisor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $senior_vfx_supervisor=explode(",",$read["senior_vfx_supervisor"]);
                                     foreach($senior_vfx_supervisor as $senior_vfx_supervisor){
										   $senior_vfx_supervisor_data_query="select * from visualeffects where id='$senior_vfx_supervisor'";
										 $senior_vfx_supervisor_data_exe=mysqli_query($con,$senior_vfx_supervisor_data_query);
										 $senior_vfx_supervisor_name_read=mysqli_fetch_array($senior_vfx_supervisor_data_exe);
                                     ?>
                                     <option value="<?php echo $senior_vfx_supervisor_name_read['id'] ?>" selected><?php echo $senior_vfx_supervisor_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>On-Set VFX Supervisor</label>
                             <select name="on_set_vfx_supervisor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $on_set_vfx_supervisor=explode(",",$read["on_set_vfx_supervisor"]);
                                     foreach($on_set_vfx_supervisor as $on_set_vfx_supervisor){
										   $on_set_vfx_supervisor_data_query="select * from visualeffects where id='$on_set_vfx_supervisor'";
										 $on_set_vfx_supervisor_data_exe=mysqli_query($con,$on_set_vfx_supervisor_data_query);
										 $on_set_vfx_supervisor_name_read=mysqli_fetch_array($on_set_vfx_supervisor_data_exe);
                                     ?>
                                     <option value="<?php echo $on_set_vfx_supervisor_name_read['id'] ?>" selected><?php echo $on_set_vfx_supervisor_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              
                               <div class="form-group">
                                 <label>VFX Producer</label>
                             <select name="vfx_producer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $vfx_producer=explode(",",$read["vfx_producer"]);
                                     foreach($vfx_producer as $vfx_producer){
										   $vfx_producer_data_query="select * from visualeffects where id='$vfx_producer'";
										 $vfx_producer_data_exe=mysqli_query($con,$vfx_producer_data_query);
										 $vfx_producer_name_read=mysqli_fetch_array($vfx_producer_data_exe);
                                     ?>
                                     <option value="<?php echo $vfx_producer_name_read['id'] ?>" selected><?php echo $vfx_producer_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>VFX Executive Producer</label>
                             <select name="vfx_executive_producer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $vfx_executive_producer=explode(",",$read["vfx_executive_producer"]);
                                     foreach($vfx_executive_producer as $vfx_executive_producer){
										   $vfx_executive_producer_data_query="select * from visualeffects where id='$vfx_executive_producer'";
										 $vfx_executive_producer_data_exe=mysqli_query($con,$vfx_executive_producer_data_query);
										 $vfx_executive_producer_name_read=mysqli_fetch_array($vfx_executive_producer_data_exe);
                                     ?>
                                     <option value="<?php echo $vfx_executive_producer_name_read['id'] ?>" selected><?php echo $vfx_executive_producer_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>VFX Editor</label>
                             <select name="vfx_editor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $vfx_editor=explode(",",$read["vfx_editor"]);
                                     foreach($vfx_editor as $vfx_editor){
										   $vfx_editor_data_query="select * from visualeffects where id='$vfx_editor'";
										 $vfx_editor_data_exe=mysqli_query($con,$vfx_editor_data_query);
										 $vfx_editor_name_read=mysqli_fetch_array($vfx_editor_data_exe);
                                     ?>
                                     <option value="<?php echo $vfx_editor_name_read['id'] ?>" selected><?php echo $vfx_editor_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>VFX Coordinator</label>
                             <select name="vfx_coordinator[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $vfx_coordinator=explode(",",$read["vfx_coordinator"]);
                                     foreach($vfx_coordinator as $vfx_coordinator){
										   $vfx_coordinator_data_query="select * from visualeffects where id='$vfx_coordinator'";
										 $vfx_coordinator_data_exe=mysqli_query($con,$vfx_coordinator_data_query);
										 $vfx_coordinator_name_read=mysqli_fetch_array($vfx_coordinator_data_exe);
                                     ?>
                                     <option value="<?php echo $vfx_coordinator_name_read['id'] ?>" selected><?php echo $vfx_coordinator_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Lead Compositor</label>
                             <select name="lead_compositor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $lead_compositor=explode(",",$read["lead_compositor"]);
                                     foreach($lead_compositor as $lead_compositor){
										   $lead_compositor_data_query="select * from visualeffects where id='$lead_compositor'";
										 $lead_compositor_data_exe=mysqli_query($con,$lead_compositor_data_query);
										 $lead_compositor_name_read=mysqli_fetch_array($lead_compositor_data_exe);
                                     ?>
                                     <option value="<?php echo $lead_compositor_name_read['id'] ?>" selected><?php echo $lead_compositor_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                  <div class="form-group">  
                                 <label>Compositor</label>             
                             <select name="film_compositor_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_compositor_name=explode(",",$read["film_compositor_name"]);
                                     foreach($film_compositor_name as $compositor_name){
										    $compositor_name_data_query="select * from visualeffects where id='$compositor_name'";
										 $compositor_name_data_exe=mysqli_query($con,$compositor_name_data_query);
										 $compositor_name_name_read=mysqli_fetch_array($compositor_name_data_exe);
                                     ?>
                                     <option value="<?php echo $compositor_name_name_read['id'] ?>" selected><?php echo $compositor_name_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                    <div class="form-group">  
                                 <label>Digital Compositor</label>    
                                   <select name="film_digital_compositor_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                       <?php 
                                     $film_digital_compositor_name=explode(",",$read["film_digital_compositor_name"]);
                                     foreach($film_digital_compositor_name as $digital_compositor_name){
									   $digital_compositor_name_data_query="select * from visualeffects where id='$digital_compositor_name'";
										 $digital_compositor_name_data_exe=mysqli_query($con,$digital_compositor_name_data_query);
										 $digital_compositor_name_name_read=mysqli_fetch_array($digital_compositor_name_data_exe);
                                     ?>
                                     <option value="<?php echo $digital_compositor_name_name_read['id'] ?>" selected><?php echo $digital_compositor_name_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                  <div class="form-group">  
                                 <label>Senior Compositor</label> 
                                 <select name="film_senior_compositor_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $film_senior_compositor_name=explode(",",$read["film_senior_compositor_name"]);
                                     foreach($film_senior_compositor_name as $senior_compositor_name){
									   $senior_compositor_name_data_query="select * from visualeffects where id='$senior_compositor_name'";
										 $senior_compositor_name_data_exe=mysqli_query($con,$senior_compositor_name_data_query);
										 $senior_compositor_name_name_read=mysqli_fetch_array($senior_compositor_name_data_exe);
                                     ?>
                                     <option value="<?php echo $senior_compositor_name_name_read['id'] ?>" selected><?php echo $senior_compositor_name_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                   <div class="form-group">
                                 <label>Compositing Supervisor</label>
                             <select name="compositing_supervisor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $compositing_supervisor=explode(",",$read["compositing_supervisor"]);
                                     foreach($compositing_supervisor as $compositing_supervisor){
										   $compositing_supervisor_data_query="select * from visualeffects where id='$compositing_supervisor'";
										 $compositing_supervisor_data_exe=mysqli_query($con,$compositing_supervisor_data_query);
										 $compositing_supervisor_name_read=mysqli_fetch_array($compositing_supervisor_data_exe);
                                     ?>
                                     <option value="<?php echo $compositing_supervisor_name_read['id'] ?>" selected><?php echo $compositing_supervisor_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Rotoscope Artist</label>
                             <select name="rotoscope_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $rotoscope_artist=explode(",",$read["rotoscope_artist"]);
                                     foreach($rotoscope_artist as $rotoscope_artist){
										   $rotoscope_artist_data_query="select * from visualeffects where id='$rotoscope_artist'";
										 $rotoscope_artist_data_exe=mysqli_query($con,$rotoscope_artist_data_query);
										 $rotoscope_artist_name_read=mysqli_fetch_array($rotoscope_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $rotoscope_artist_name_read['id'] ?>" selected><?php echo $rotoscope_artist_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Junior Compositor</label>
                             <select name="junior_compositor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $junior_compositor=explode(",",$read["junior_compositor"]);
                                     foreach($junior_compositor as $junior_compositor){
										   $junior_compositor_data_query="select * from visualeffects where id='$junior_compositor'";
										 $junior_compositor_data_exe=mysqli_query($con,$junior_compositor_data_query);
										 $junior_compositor_name_read=mysqli_fetch_array($junior_compositor_data_exe);
                                     ?>
                                     <option value="<?php echo $junior_compositor_name_read['id'] ?>" selected><?php echo $junior_compositor_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Matchmove Artist</label>
                             <select name="matchmove_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $matchmove_artist=explode(",",$read["matchmove_artist"]);
                                     foreach($matchmove_artist as $matchmove_artist){
										   $matchmove_artist_data_query="select * from visualeffects where id='$matchmove_artist'";
										 $matchmove_artist_data_exe=mysqli_query($con,$matchmove_artist_data_query);
										 $matchmove_artist_name_read=mysqli_fetch_array($matchmove_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $matchmove_artist_name_read['id'] ?>" selected><?php echo $matchmove_artist_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>CG Supervisor (Modeling)</label>
                             <select name="cs_supervisor_modeling[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $cs_supervisor_modeling=explode(",",$read["cs_supervisor_modeling"]);
                                     foreach($cs_supervisor_modeling as $cs_supervisor_modeling){
										   $cs_supervisor_modeling_data_query="select * from visualeffects where id='$cs_supervisor_modeling'";
										 $cs_supervisor_modeling_data_exe=mysqli_query($con,$cs_supervisor_modeling_data_query);
										 $cs_supervisor_modeling_name_read=mysqli_fetch_array($cs_supervisor_modeling_data_exe);
                                     ?>
                                     <option value="<?php echo $cs_supervisor_modeling_name_read['id'] ?>" selected><?php echo $cs_supervisor_modeling_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>CG Supervisor (Animation)</label>
                             <select name="cs_supervisor_animation[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $cs_supervisor_animation=explode(",",$read["cs_supervisor_animation"]);
                                     foreach($cs_supervisor_animation as $cs_supervisor_animation){
										   $cs_supervisor_animation_data_query="select * from visualeffects where id='$cs_supervisor_animation'";
										 $cs_supervisor_animation_data_exe=mysqli_query($con,$cs_supervisor_animation_data_query);
										 $cs_supervisor_animation_name_read=mysqli_fetch_array($cs_supervisor_animation_data_exe);
                                     ?>
                                     <option value="<?php echo $cs_supervisor_animation_name_read['id'] ?>" selected><?php echo $cs_supervisor_animation_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                 <div class="form-group">
                                 <label>Render Wrangler</label>
                             <select name="render_wrangler[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $render_wrangler=explode(",",$read["render_wrangler"]);
                                     foreach($render_wrangler as $render_wrangler){
										   $render_wrangler_data_query="select * from visualeffects where id='$render_wrangler'";
										 $render_wrangler_data_exe=mysqli_query($con,$render_wrangler_data_query);
										 $render_wrangler_name_read=mysqli_fetch_array($render_wrangler_data_exe);
                                     ?>
                                     <option value="<?php echo $render_wrangler_name_read['id'] ?>" selected><?php echo $render_wrangler_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Pipeline Technical Director</label>
                             <select name="pipeline_technical_director[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $pipeline_technical_director=explode(",",$read["pipeline_technical_director"]);
                                     foreach($pipeline_technical_director as $pipeline_technical_director){
										   $pipeline_technical_director_data_query="select * from visualeffects where id='$pipeline_technical_director'";
										 $pipeline_technical_director_data_exe=mysqli_query($con,$pipeline_technical_director_data_query);
										 $pipeline_technical_director_name_read=mysqli_fetch_array($pipeline_technical_director_data_exe);
                                     ?>
                                     <option value="<?php echo $pipeline_technical_director_name_read['id'] ?>" selected><?php echo $pipeline_technical_director_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                 <div class="form-group">
                                 <label>Concept Artist</label>
                             <select name="concept_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $concept_artist=explode(",",$read["concept_artist"]);
                                     foreach($concept_artist as $concept_artist){
										   $concept_artist_data_query="select * from visualeffects where id='$concept_artist'";
										 $concept_artist_data_exe=mysqli_query($con,$concept_artist_data_query);
										 $concept_artist_name_read=mysqli_fetch_array($concept_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $concept_artist_name_read['id'] ?>" selected><?php echo $concept_artist_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                  <div class="form-group">
                                 <label>Previsualization Artist</label>
                             <select name="previsualization_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $previsualization_artist=explode(",",$read["previsualization_artist"]);
                                     foreach($previsualization_artist as $previsualization_artist){
										   $previsualization_artist_data_query="select * from visualeffects where id='$previsualization_artist'";
										 $previsualization_artist_data_exe=mysqli_query($con,$previsualization_artist_data_query);
										 $previsualization_artist_name_read=mysqli_fetch_array($previsualization_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $previsualization_artist_name_read['id'] ?>" selected><?php echo $previsualization_artist_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Animator</label>
                             <select name="animator[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $animator=explode(",",$read["animator"]);
                                     foreach($animator as $animator){
										   $animator_data_query="select * from visualeffects where id='$animator'";
										 $animator_data_exe=mysqli_query($con,$animator_data_query);
										 $animator_name_read=mysqli_fetch_array($animator_data_exe);
                                     ?>
                                     <option value="<?php echo $animator_name_read['id'] ?>" selected><?php echo $animator_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Character Animator</label>
                             <select name="character_animator[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $character_animator=explode(",",$read["character_animator"]);
                                     foreach($character_animator as $character_animator){
										   $character_animator_data_query="select * from visualeffects where id='$animator'";
										 $character_animator_data_exe=mysqli_query($con,$character_animator_data_query);
										 $character_animator_name_read=mysqli_fetch_array($character_animator_data_exe);
                                     ?>
                                     <option value="<?php echo $character_animator_name_read['id'] ?>" selected><?php echo $character_animator_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Rigger</label>
                             <select name="rigger[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $rigger=explode(",",$read["rigger"]);
                                     foreach($rigger as $rigger){
										   $rigger_data_query="select * from visualeffects where id='$rigger'";
										 $rigger_data_exe=mysqli_query($con,$rigger_data_query);
										 $rigger_name_read=mysqli_fetch_array($rigger_data_exe);
                                     ?>
                                     <option value="<?php echo $rigger_name_read['id'] ?>" selected><?php echo $rigger_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Motion Graphics Artist</label>
                             <select name="motion_graphics[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $motion_graphics=explode(",",$read["motion_graphics_graphics"]);
                                     foreach($motion_graphics as $motion_graphics_graphics){
										   $motion_graphics_data_query="select * from visualeffects where id='$rigger'";
										 $motion_graphics_data_exe=mysqli_query($con,$motion_graphics_data_query);
										 $motion_graphics_name_read=mysqli_fetch_array($motion_graphics_data_exe);
                                     ?>
                                     <option value="<?php echo $motion_graphics_name_read['id'] ?>" selected><?php echo $motion_graphics_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Modeler</label>
                             <select name="modeler[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $modeler=explode(",",$read["modeler"]);
                                     foreach($modeler as $modeler){
										   $modeler_data_query="select * from visualeffects where id='$modeler'";
										 $modeler_data_exe=mysqli_query($con,$modeler_data_query);
										 $modeler_name_read=mysqli_fetch_array($modeler_data_exe);
                                     ?>
                                     <option value="<?php echo $modeler_name_read['id'] ?>" selected><?php echo $modeler_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Texture Artist</label>
                             <select name="texture_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $texture_artist=explode(",",$read["texture_artist"]);
                                     foreach($texture_artist as $texture_artist){
										   $texture_artist_data_query="select * from visualeffects where id='$texture_artist'";
										 $texture_artist_data_exe=mysqli_query($con,$texture_artist_data_query);
										 $texture_artist_name_read=mysqli_fetch_array($texture_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $texture_artist_name_read['id'] ?>" selected><?php echo $texture_artist_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Look Devlopment Artist</label>
                             <select name="look_devlopment_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $look_devlopment_artist=explode(",",$read["look_devlopment_artist"]);
                                     foreach($look_devlopment_artist as $look_devlopment_artist){
										   $look_devlopment_artist_data_query="select * from visualeffects where id='$look_devlopment_artist'";
										 $look_devlopment_artist_data_exe=mysqli_query($con,$look_devlopment_artist_data_query);
										 $look_devlopment_artist_name_read=mysqli_fetch_array($look_devlopment_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $look_devlopment_artist_name_read['id'] ?>" selected><?php echo $look_devlopment_artist_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Simulation Artist</label>
                             <select name="simulation_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $simulation_artist=explode(",",$read["simulation_artist"]);
                                     foreach($simulation_artist as $simulation_artist){
										   $simulation_artist_data_query="select * from visualeffects where id='$simulation_artist'";
										 $simulation_artist_data_exe=mysqli_query($con,$simulation_artist_data_query);
										 $simulation_artist_name_read=mysqli_fetch_array($simulation_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $simulation_artist_name_read['id'] ?>" selected><?php echo $simulation_artist_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                <div class="form-group">
                                 <label>Dynamics Artist</label>
                             <select name="dynamics[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $dynamics=explode(",",$read["dynamics"]);
                                     foreach($dynamics as $dynamics){
										   $dynamics_data_query="select * from visualeffects where id='$dynamics'";
										 $dynamics_data_exe=mysqli_query($con,$dynamics_data_query);
										 $dynamics_name_read=mysqli_fetch_array($dynamics_data_exe);
                                     ?>
                                     <option value="<?php echo $dynamics_name_read['id'] ?>" selected><?php echo $dynamics_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                <div class="form-group">
                                 <label>Fluid Simulation Artist</label>
                             <select name="fluid_simulation_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $fluid_simulation_artist=explode(",",$read["fluid_simulation_artist"]);
                                     foreach($fluid_simulation_artist as $fluid_simulation_artist){
										   $fluid_simulation_artist_data_query="select * from visualeffects where id='$fluid_simulation_artist'";
										 $fluid_simulation_artist_data_exe=mysqli_query($con,$fluid_simulation_artist_data_query);
										 $fluid_simulation_artist_name_read=mysqli_fetch_array($fluid_simulation_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $fluid_simulation_artist_name_read['id'] ?>" selected><?php echo $fluid_simulation_artist_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="edit_visual_effects_management"  class="btn btn-add"  value="Update Visual Effects Manegement">
                            
                              </div>
        </form>  
                </section>  
            <!-- /.content -->
         </div>
          
         <!-- /.content-wrapper -->
       <?php include('footer.php');?>
      </div>
    
  </div>
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
   <script src="/admin/assets/bootstrap/js/jquery.richtext.js"></script>
<script src="/admin/assets/bootstrap/js/jquery.richtext.min.js"></script>
<script>
  $(document).ready(function() {
    $('.searchwithselect2').select2();
});
</script>



 
   </body>
  
</html>

