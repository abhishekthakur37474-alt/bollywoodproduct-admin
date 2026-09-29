<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_POST["add_visual_effects_management"]) { 
    
    
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



    $film_makeup="insert into film_visual_effects_management_allot set film_visual_effects_artist='$film_visual_effects_artist_name',film_id='$film_id',film_visual_effects_name='$film_visual_effects_name',film_visual_effects_supervisor_name='$film_visual_effects_supervisor_name',film_compositor_name='$film_compositor_name',film_digital_compositor_name='$film_digital_compositor_name',film_senior_compositor_name='$film_senior_compositor_name',visual_effects_director='$visual_effects_director',senior_vfx_supervisor='$senior_vfx_supervisor',on_set_vfx_supervisor='$on_set_vfx_supervisor',vfx_executive_producer='$vfx_executive_producer',vfx_producer='$vfx_producer',vfx_editor='$vfx_editor',vfx_coordinator='$vfx_coordinator',lead_compositor='$lead_compositor',compositing_supervisor='$compositing_supervisor',junior_compositor='$junior_compositor',matchmove_artist='$matchmove_artist',cs_supervisor_modeling='$cs_supervisor_modeling',cs_supervisor_animation='$cs_supervisor_animation',render_wrangler='$render_wrangler',pipeline_technical_director='$pipeline_technical_director',concept_artist='$concept_artist',previsualization_artist='$previsualization_artist',animator='$animator',character_animator='$character_animator',rigger='$rigger',motion_graphics='$motion_graphics',modeler='$modeler',texture_artist='$texture_artist',look_devlopment_artist='$look_devlopment_artist',simulation_artist='$simulation_artist',dynamics='$dynamics',fluid_simulation_artist='$fluid_simulation_artist',rotoscope_artist='$rotoscope_artist'";
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
      <title>Add Film Viusual Effects Management</title>
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
                  <small>Add Film Visual Effects</small>
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
                                 <h4>Add Film Visual Effects Management Here</h4>
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
                                    <option value="">-Select Film-</option>
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
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                <div class="form-group">
                                 <label>Visual Effects Artist</label>
                             <select name="film_visual_effects_artist_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                             <div class="form-group">
                                 <label>Visual Effects Director</label>
                             <select name="visual_effects_director[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Visual Effects Supervisor</label>
                             <select name="film_visual_effects_supervisor_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Senior VFX Supervisor</label>
                             <select name="senior_vfx_supervisor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>On-Set VFX Supervisor</label>
                             <select name="on_set_vfx_supervisor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>VFX Producer</label>
                             <select name="vfx_producer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>VFX Executive Producer</label>
                             <select name="vfx_executive_producer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               
                               <div class="form-group">
                                 <label>VFX Editor</label>
                             <select name="vfx_editor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>VFX Coordinator</label>
                             <select name="vfx_coordinator[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Lead Compositor</label>
                             <select name="lead_compositor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                  <div class="form-group">  
                                 <label>Compositor</label>             
                             <select name="film_compositor_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                    <div class="form-group">  
                                 <label>Digital Compositor</label>    
                                   <select name="film_digital_compositor_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                  <div class="form-group">  
                                 <label>Senior Compositor</label> 
                                 <select name="film_senior_compositor_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                   <div class="form-group">
                                 <label>Compositing Supervisor</label>
                             <select name="compositing_supervisor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Rotoscope Artist</label>
                             <select name="rotoscope_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                  <div class="form-group">
                                 <label>Junior Compositor</label>
                             <select name="junior_compositor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Matchmove Artist</label>
                             <select name="matchmove_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>CG Supervisor(Modeling)</label>
                             <select name="cs_supervisor_modeling[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>CG Supervisor (Animation)</label>
                             <select name="cs_supervisor_animation[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                 <div class="form-group">
                                 <label>Render Wrangler</label>
                             <select name="render_wrangler[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Pipeline Technical Director</label>
                             <select name="pipeline_technical_director[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Concept Artist</label>
                             <select name="concept_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Previsualization Artist</label>
                             <select name="previsualization_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Animator</label>
                             <select name="animator[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Character Animator</label>
                             <select name="character_animator[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                <div class="form-group">
                                 <label>Rigger</label>
                             <select name="rigger[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Motion Graphics Artist</label>
                             <select name="motion_graphics[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Modeler</label>
                             <select name="modeler[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Texture Artist</label>
                             <select name="texture_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Look Development Artist</label>
                             <select name="look_devlopment_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                 <div class="form-group">
                                 <label>Simulation Artist</label>
                             <select name="simulation_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Dynamics Artist</label>
                             <select name="dynamics[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Fluid Simulation Artist</label>
                             <select name="fluid_simulation_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from 	visualeffects order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>

              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="add_visual_effects_management"  class="btn btn-add"  value="Add Visual Effects Manegement">
                            
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

