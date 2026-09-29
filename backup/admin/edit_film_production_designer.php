<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      $id=$_GET["id"];
      $record="select * from film_production_designer_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
      ?>
<?
if($_POST["update_production_designer"]) { 
    
    
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']); 
    $film_production_designer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_production_designer_name']));
    $film_chief_assistant_art_director_name= mysqli_real_escape_string($con,implode(",",$_POST['film_chief_assistant_art_director_name']));
    $film_assistant_art_director_name= mysqli_real_escape_string($con,implode(",",$_POST['film_assistant_art_director_name']));
    $film_assistant_production_designer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_assistant_production_designer_name']));
    $film_graphic_designer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_graphic_designer_name']));
    $film_set_decorator_name= mysqli_real_escape_string($con,implode(",",$_POST['film_set_decorator_name']));
    $film_set_dresser_name= mysqli_real_escape_string($con,implode(",",$_POST['film_set_dresser_name']));
    $film_3d_set_visualizer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_3d_set_visualizer_name']));
    $film_art_director_name= mysqli_real_escape_string($con,implode(",",$_POST['film_art_director_name']));
    $film_associate_production_designer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_associate_production_designer_name']));
    $art_director= mysqli_real_escape_string($con,implode(",",$_POST['art_director']));
    $associate_art_director= mysqli_real_escape_string($con,implode(",",$_POST['associate_art_director']));
    $props= mysqli_real_escape_string($con,implode(",",$_POST['props']));
   $set_decorator= mysqli_real_escape_string($con,implode(",",$_POST['set_decorator']));
    $assistant_set_decorator= mysqli_real_escape_string($con,implode(",",$_POST['assistant_set_decorator']));
   $supervising_art_director= mysqli_real_escape_string($con,implode(",",$_POST['supervising_art_director']));
    $set_decoration_buyer= mysqli_real_escape_string($con,implode(",",$_POST['set_decoration_buyer']));


   $film_directors="update film_production_designer_allot set film_id='$film_id',set_decorator='$set_decorator',film_production_designer_name='$film_production_designer_name',film_chief_assistant_art_director_name='$film_chief_assistant_art_director_name',film_assistant_art_director_name='$film_assistant_art_director_name',film_assistant_production_designer_name='$film_assistant_production_designer_name',film_graphic_designer_name='$film_graphic_designer_name',film_set_decorator_name='$film_set_decorator_name',film_set_dresser_name='$film_set_dresser_name',film_3d_set_visualizer_name='$film_3d_set_visualizer_name',film_art_director_name='$film_art_director_name',film_associate_production_designer_name='$film_associate_production_designer_name',associate_art_director='$associate_art_director',props='$props',assistant_set_decorator='$assistant_set_decorator',supervising_art_director='$supervising_art_director',set_decoration_buyer='$set_decoration_buyer' where id='$id'";
mysqli_query($con,$film_directors) or die(mysqli_error($con));
  
         echo "<script>alert('Film Production Designer Save Succesfully')</script>";
  echo "<script>window.location.href='film_production_designer.php'</script>";
         }
         ?>
         
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Producers</title>
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
                  <h1>Film Production Designer</h1>
                  <small>Edit Film Production Designer</small>
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
                                 <h4>Edit Film Production Designer</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                             <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                  
                               <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="form-control main_language" id="film_id" name="film_id"  style="width:100%:"  required>
   <?php 
                                    
                                     $film_id=$read["film_id"];
	  
										  $film_data_query="select * from film where id='$film_id'";
										 $film_data_exe=mysqli_query($con,$film_data_query);
										 $film_name_read=mysqli_fetch_array($film_data_exe);
                                     ?>
                                     <option value="<?php echo $film_name_read["id"]; ?>" selected><?php echo $film_name_read["name"];?></option>
                                    
                                 <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ 
                                    $main_lang=$rowfr['main_lang'];
                                    $lang_q="select * from dubbing where id='$main_lang'";
                                    $exe_main_lang=mysqli_query($con,$lang_q);
                                    $read_lang=mysqli_fetch_array($exe_main_lang);
                                    $lang_name=$read_lang['name'];
                                    ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Year:<? echo $rowfr['year_release']; ?> Language:<? echo $lang_name; ?>)</option>
                                  <? } ?>
                                 </select>
                                  
                             
                              </div>
                              <div class="form-group">
                                 <label>Production Designer</label>
                                <select name="film_production_designer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $film_production_designer_name=explode(",",$read["film_production_designer_name"]);
                                     foreach($film_production_designer_name as $production_designer_name){
									 $film_production_designer_name_data_query="select * from production_designer where id='$production_designer_name'";
										 $film_production_designer_name_data_exe=mysqli_query($con,$film_production_designer_name_data_query);
										 $film_production_designer_name_name_read=mysqli_fetch_array($film_production_designer_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_production_designer_name_name_read['id'] ?>" selected><?php echo $film_production_designer_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                            <div class="form-group">  
                                 <label>Associate Production Designer</label> 
                                 <select name="film_associate_production_designer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $film_associate_production_designer_name=explode(",",$read["film_associate_production_designer_name"]);
                                     foreach($film_associate_production_designer_name as $associate_production_designer_name){
									 $film_associate_production_designer_name_data_query="select * from production_designer where id='$associate_production_designer_name'";
										 $film_associate_production_designer_name_data_exe=mysqli_query($con,$film_associate_production_designer_name_data_query);
										 $film_associate_production_designer_name_name_read=mysqli_fetch_array($film_associate_production_designer_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_associate_production_designer_name_name_read['id'] ?>" selected><?php echo $film_associate_production_designer_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                <div class="form-group">  
                                 <label>Assistant Production Designer</label>    
                                   <select name="film_assistant_production_designer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                       <?php 
                                     $film_assistant_production_designer_name=explode(",",$read["film_assistant_production_designer_name"]);
                                     foreach($film_assistant_production_designer_name as $assistant_production_designer_name){
									 $film_assistant_production_designer_name_data_query="select * from production_designer where id='$assistant_production_designer_name'";
										 $film_assistant_production_designer_name_data_exe=mysqli_query($con,$film_assistant_production_designer_name_data_query);
										 $film_assistant_production_designer_name_name_read=mysqli_fetch_array($film_assistant_production_designer_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_assistant_production_designer_name_name_read['id'] ?>" selected><?php echo $film_assistant_production_designer_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                 <div class="form-group">  
                                 <label>Art Director</label> 
                                 <select name="film_art_director_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $film_art_director_name=explode(",",$read["film_art_director_name"]);
                                     foreach($film_art_director_name as $art_director_name){
									 $film_art_director_name_data_query="select * from production_designer where id='$art_director_name'";
										 $film_art_director_name_data_exe=mysqli_query($con,$film_art_director_name_data_query);
										 $film_art_director_name_name_read=mysqli_fetch_array($film_art_director_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_art_director_name_name_read['id'] ?>" selected><?php echo $film_art_director_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
<div class="form-group">  
                                 <label>Associate Art Director</label> 
                                 <select name="associate_art_director[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $associate_art_director=explode(",",$read["associate_art_director"]);
                                     foreach($associate_art_director as $associate_art_director){
									 $associate_art_director_data_query="select * from production_designer where id='$associate_art_director'";
										 $associate_art_director_data_exe=mysqli_query($con,$associate_art_director_data_query);
										 $associate_art_director_name_read=mysqli_fetch_array($associate_art_director_data_exe);
                                     ?>
                                     <option value="<?php echo $associate_art_director_name_read['id'] ?>" selected><?php echo $associate_art_director_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                  <div class="form-group">  
                                 <label>Assistant Art Director</label>             
                                <select name="film_assistant_art_director_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $film_assistant_art_director_name=explode(",",$read["film_assistant_art_director_name"]);
                                     foreach($film_assistant_art_director_name as $assistant_art_director_name){
									 $film_assistant_art_director_name_data_query="select * from production_designer where id='$assistant_art_director_name'";
										 $film_assistant_art_director_name_data_exe=mysqli_query($con,$film_assistant_art_director_name_data_query);
										 $film_assistant_art_director_name_name_read=mysqli_fetch_array($film_assistant_art_director_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_assistant_art_director_name_name_read['id'] ?>" selected><?php echo $film_assistant_art_director_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                               <div class="form-group">
                                 <label>Chief Assistant Art Director</label>
                                <select name="film_chief_assistant_art_director_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $film_chief_assistant_art_director_name=explode(",",$read["film_chief_assistant_art_director_name"]);
                                     foreach($film_chief_assistant_art_director_name as $chief_assistant_art_director_name){
									  $film_chief_assistant_art_director_name_data_query="select * from production_designer where id='$chief_assistant_art_director_name'";
										 $film_chief_assistant_art_director_name_data_exe=mysqli_query($con,$film_chief_assistant_art_director_name_data_query);
										 $film_chief_assistant_art_director_name_name_read=mysqli_fetch_array($film_chief_assistant_art_director_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_chief_assistant_art_director_name_name_read['id'] ?>" selected><?php echo $film_chief_assistant_art_director_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                  
                                    
                                  <div class="form-group">  
                                 <label>Graphic Designer</label> 
                                <select name="film_graphic_designer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $film_graphic_designer_name=explode(",",$read["film_graphic_designer_name"]);
                                     foreach($film_graphic_designer_name as $graphic_designer_name){
									 $film_graphic_designer_name_data_query="select * from production_designer where id='$graphic_designer_name'";
										 $film_graphic_designer_name_data_exe=mysqli_query($con,$film_graphic_designer_name_data_query);
										 $film_graphic_designer_name_name_read=mysqli_fetch_array($film_graphic_designer_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_graphic_designer_name_name_read['id'] ?>" selected><?php echo $film_graphic_designer_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                  <div class="form-group">  
                                 <label>Set Decorator</label> 
                                 <select name="film_set_decorator_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $film_set_decorator_name=explode(",",$read["film_set_decorator_name"]);
                                     foreach($film_set_decorator_name as $set_decorator_name){
									 $film_set_decorator_name_data_query="select * from production_designer where id='$set_decorator_name'";
										 $film_set_decorator_name_data_exe=mysqli_query($con,$film_set_decorator_name_data_query);
										 $film_set_decorator_name_name_read=mysqli_fetch_array($film_set_decorator_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_set_decorator_name_name_read['id'] ?>" selected><?php echo $film_set_decorator_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                 
                                  <div class="form-group">  
                                 <label>Set Dresser</label> 
                                 <select name="film_set_dresser_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $film_set_dresser_name=explode(",",$read["film_set_dresser_name"]);
                                     foreach($film_set_dresser_name as $set_dresser_name){
									  $film_set_dresser_name_data_query="select * from production_designer where id='$set_dresser_name'";
										 $film_set_dresser_name_data_exe=mysqli_query($con,$film_set_dresser_name_data_query);
										 $film_set_dresser_name_name_read=mysqli_fetch_array($film_set_dresser_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_set_dresser_name_name_read['id'] ?>" selected><?php echo $film_set_dresser_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                  <div class="form-group">  
                                 <label>3D Set Visualizer</label> 
                                 <select name="film_3d_set_visualizer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $film_3d_set_visualizer_name=explode(",",$read["film_3d_set_visualizer_name"]);
                                     foreach($film_3d_set_visualizer_name as $three_d_set_visualizer_name){
									 $film_3d_set_visualizer_name_data_query="select * from production_designer where id='$three_d_set_visualizer_name'";
										 $film_3d_set_visualizer_name_data_exe=mysqli_query($con,$film_3d_set_visualizer_name_data_query);
										 $film_3d_set_visualizer_name_name_read=mysqli_fetch_array($film_3d_set_visualizer_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_3d_set_visualizer_name_name_read['id'] ?>" selected><?php echo $film_3d_set_visualizer_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                    <div class="form-group">  
                                 <label>Props</label>             
                                <select name="props[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $props=explode(",",$read["props"]);
                                     foreach($props as $props){
									 $props_data_query="select * from production_designer where id='$props'";
										 $props_data_exe=mysqli_query($con,$props_data_query);
										 $props_name_read=mysqli_fetch_array($props_data_exe);
                                     ?>
                                     <option value="<?php echo $props_name_read['id'] ?>" selected><?php echo $props_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div> 
                                   <div class="form-group">  
                                 <label>Set Decorator</label>             
                                <select name="set_decorator[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $set_decorator=explode(",",$read["set_decorator"]);
                                     foreach($set_decorator as $set_decorator_id){
									 $set_decorator_data_query="select * from production_designer where id='$set_decorator_id'";
										 $set_decorator_data_exe=mysqli_query($con,$set_decorator_data_query);
										 $set_decorator_name_read=mysqli_fetch_array($set_decorator_data_exe);
                                     ?>
                                     <option value="<?php echo $set_decorator_name_read['id'] ?>" selected><?php echo $set_decorator_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>                                   
                                                               
                                   <div class="form-group">  
                                 <label>Assistant Set Decorator</label>             
                                <select name="assistant_set_decorator[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $assistant_set_decorator=explode(",",$read["assistant_set_decorator"]);
                                     foreach($assistant_set_decorator as $assistant_set_decorator){
									 $assistant_set_decorator_data_query="select * from production_designer where id='$assistant_set_decorator'";
										 $assistant_set_decorator_data_exe=mysqli_query($con,$assistant_set_decorator_data_query);
										 $assistant_set_decorator_name_read=mysqli_fetch_array($assistant_set_decorator_data_exe);
                                     ?>
                                     <option value="<?php echo $assistant_set_decorator_name_read['id'] ?>" selected><?php echo $assistant_set_decorator_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>                                   
                                 
                                  <div class="form-group">  
                                 <label>Supervising Art Decorator</label>             
                                <select name="supervising_art_director[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $supervising_art_director=explode(",",$read["supervising_art_director"]);
                                     foreach($supervising_art_director as $supervising_art_director){
									 $supervising_art_director_data_query="select * from production_designer where id='$supervising_art_director'";
										 $supervising_art_director_data_exe=mysqli_query($con,$supervising_art_director_data_query);
										 $supervising_art_director_name_read=mysqli_fetch_array($supervising_art_director_data_exe);
                                     ?>
                                     <option value="<?php echo $supervising_art_director_name_read['id'] ?>" selected><?php echo $supervising_art_director_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                  <div class="form-group">  
                                 <label>Set Decoration Buyer</label>             
                                <select name="set_decoration_buyer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $set_decoration_buyer=explode(",",$read["set_decoration_buyer"]);
                                     foreach($set_decoration_buyer as $set_decoration_buyer){
									 $set_decoration_buyer_data_query="select * from production_designer where id='$set_decoration_buyer'";
										 $set_decoration_buyer_data_exe=mysqli_query($con,$set_decoration_buyer_data_query);
										 $set_decoration_buyer_name_read=mysqli_fetch_array($set_decoration_buyer_data_exe);
                                     ?>
                                     <option value="<?php echo $set_decoration_buyer_name_read['id'] ?>" selected><?php echo $set_decoration_buyer_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from production_designer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>

              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="update_production_designer"  class="btn btn-add"  value="Update Production Designer">
                            
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

