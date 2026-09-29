<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      $id=$_GET["id"];
      $record="select * from film_makeup_management_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
	   $film_id=$read["film_id"];
      ?>

<?
if($_POST["edit_makeup_management"]) { 
    
    
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']); 
    $film_makeup_artist_name= mysqli_real_escape_string($con,implode(",",$_POST['film_makeup_artist_name']));
    $film_assistant_makeup_artist_name= mysqli_real_escape_string($con,implode(",",$_POST['film_assistant_makeup_artist_name']));
    $film_prosthetic_makeup_artist_name= mysqli_real_escape_string($con,implode(",",$_POST['film_prosthetic_makeup_artist_name']));
    $film_assistant_prosthetic_makeup_artist_name= mysqli_real_escape_string($con,implode(",",$_POST['film_assistant_prosthetic_makeup_artist_name']));
    $film_hair_stylist_name= mysqli_real_escape_string($con,implode(",",$_POST['film_hair_stylist_name']));
    $film_assistant_hair_name= mysqli_real_escape_string($con,implode(",",$_POST['film_assistant_hair_name']));
    $makeup_designer= mysqli_real_escape_string($con,implode(",",$_POST['makeup_designer']));
    $special_effects_makeup_artist= mysqli_real_escape_string($con,implode(",",$_POST['special_effects_makeup_artist']));
    $additional_makeup_artist= mysqli_real_escape_string($con,implode(",",$_POST['additional_makeup_artist']));
    $key_makeup_artist= mysqli_real_escape_string($con,implode(",",$_POST['key_makeup_artist']));
    $makeup_assistant_general= mysqli_real_escape_string($con,implode(",",$_POST['makeup_assistant_general']));
    $background_makeup_artist= mysqli_real_escape_string($con,implode(",",$_POST['background_makeup_artist']));
    $age_makeup_artist= mysqli_real_escape_string($con,implode(",",$_POST['age_makeup_artist']));
    $character_makeup_artist= mysqli_real_escape_string($con,implode(",",$_POST['character_makeup_artist']));
    $makeup_set_medic= mysqli_real_escape_string($con,implode(",",$_POST['makeup_set_medic']));
    $makeup_assistant= mysqli_real_escape_string($con,implode(",",$_POST['makeup_assistant']));
    $wig_maker= mysqli_real_escape_string($con,implode(",",$_POST['wig_maker']));
    $special_effects_makeup_designer= mysqli_real_escape_string($con,implode(",",$_POST['special_effects_makeup_designer'])); 
    $hair_department_head= mysqli_real_escape_string($con,implode(",",$_POST['hair_department_head'])); 

   $film_makeup="update film_makeup_management_allot set hair_department_head='$hair_department_head',film_id='$film_id',film_makeup_artist_name='$film_makeup_artist_name',film_assistant_makeup_artist_name='$film_assistant_makeup_artist_name',film_prosthetic_makeup_artist_name='$film_prosthetic_makeup_artist_name',film_assistant_prosthetic_makeup_artist_name='$film_assistant_prosthetic_makeup_artist_name',film_hair_stylist_name='$film_hair_stylist_name',film_assistant_hair_name='$film_assistant_hair_name',makeup_designer='$makeup_designer',special_effects_makeup_artist='$special_effects_makeup_artist',additional_makeup_artist='$additional_makeup_artist',key_makeup_artist='$key_makeup_artist',makeup_assistant_general='$makeup_assistant_general',background_makeup_artist='$background_makeup_artist',age_makeup_artist='$age_makeup_artist',character_makeup_artist='$character_makeup_artist',makeup_set_medic='$makeup_set_medic',makeup_assistant='$makeup_assistant',wig_maker='$wig_maker',special_effects_makeup_designer='$special_effects_makeup_designer' where id='$id'";
mysqli_query($con,$film_makeup) or die(mysqli_error($con));
  
         echo "<script>alert('Film Makeup Management Updated Succesfully')</script>";
  echo "<script>window.location.href='film_makeup_management.php'</script>";
         }
         ?>
         
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Makeup Management</title>
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
                  <h1>Film Makeup Management</h1>
                  <small>Edit Film Make3up</small>
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
                                 <h4>Edit Film Makeup Management Here</h4>
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

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Year:<? echo $rowfr['year_release']; ?> Language:<? echo $lang_name; ?>)</option>
                                  <? } ?>
                                 </select>
                                  
                             
                              </div>
                               <div class="form-group">
                                 <label>Makeup Designer</label>
                             <select name="makeup_designer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $makeup_designer=explode(",",$read["makeup_designer"]);
                                     foreach($makeup_designer as $makeup_designer){
									$makeup_designer_data_query="select * from makeup where id='$makeup_designer'";
										 $makeup_designer_data_exe=mysqli_query($con,$makeup_designer_data_query);
										 $makeup_designer_name_read=mysqli_fetch_array($makeup_designer_data_exe);
                                     ?>
                                     <option value="<?php echo $makeup_designer_name_read["id"] ?>" selected><?php echo $makeup_designer_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>

                               <div class="form-group">
                                 <label>Hair Department Head</label>
                             <select name="hair_department_head[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $hair_department_head=explode(",",$read["hair_department_head"]);
                                     foreach($hair_department_head as $hair_department_head_id){
									$hair_department_head_data_query="select * from makeup where id='$hair_department_head_id'";
										 $hair_department_head_data_exe=mysqli_query($con,$hair_department_head_data_query);
										 $hair_department_name_read=mysqli_fetch_array($hair_department_head_data_exe);
                                     ?>
                                     <option value="<?php echo $hair_department_name_read["id"] ?>" selected><?php echo $hair_department_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>

                              <div class="form-group">
                                 <label>Makeup Artist</label>
                             <select name="film_makeup_artist_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_makeup_artist_name=explode(",",$read["film_makeup_artist_name"]);
                                     foreach($film_makeup_artist_name as $makeup_artist_name){
									$film_makeup_artist_name_data_query="select * from makeup where id='$makeup_artist_name'";
										 $film_makeup_artist_name_data_exe=mysqli_query($con,$film_makeup_artist_name_data_query);
										 $film_makeup_artist_name_name_read=mysqli_fetch_array($film_makeup_artist_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_makeup_artist_name_name_read["id"] ?>" selected><?php echo $film_makeup_artist_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Special Effects Makeup Designer</label>
                             <select name="special_effects_makeup_designer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $special_effects_makeup_designer=explode(",",$read["special_effects_makeup_designer"]);
                                     foreach($special_effects_makeup_designer as $special_effects_makeup_designer){
									$special_effects_makeup_designer_data_query="select * from makeup where id='$special_effects_makeup_designer'";
										 $special_effects_makeup_designer_data_exe=mysqli_query($con,$special_effects_makeup_designer_data_query);
										 $special_effects_makeup_designer_name_read=mysqli_fetch_array($special_effects_makeup_designer_data_exe);
                                     ?>
                                     <option value="<?php echo $special_effects_makeup_designer_name_read["id"] ?>" selected><?php echo $special_effects_makeup_designer_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                            <div class="form-group">
                                 <label>Special Effects Makeup Artist</label>
                             <select name="special_effects_makeup_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $special_effects_makeup_artist=explode(",",$read["special_effects_makeup_artist"]);
                                     foreach($special_effects_makeup_artist as $special_effects_makeup_artist){
									$special_effects_makeup_artist_data_query="select * from makeup where id='$special_effects_makeup_artist'";
										 $special_effects_makeup_artist_data_exe=mysqli_query($con,$special_effects_makeup_artist_data_query);
										 $special_effects_makeup_artist_name_read=mysqli_fetch_array($special_effects_makeup_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $special_effects_makeup_artist_name_read["id"] ?>" selected><?php echo $special_effects_makeup_artist_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Additional Makeup Artist</label>
                             <select name="additional_makeup_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $additional_makeup_artist=explode(",",$read["additional_makeup_artist"]);
                                     foreach($additional_makeup_artist as $additional_makeup_artist){
									$additional_makeup_artist_data_query="select * from makeup where id='$additional_makeup_artist'";
										 $additional_makeup_artist_data_exe=mysqli_query($con,$additional_makeup_artist_data_query);
										 $additional_makeup_artist_name_read=mysqli_fetch_array($additional_makeup_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $additional_makeup_artist_name_read["id"] ?>" selected><?php echo $additional_makeup_artist_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Key Makeup Artist / Makeup Department Head</label>
                             <select name="key_makeup_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $key_makeup_artist=explode(",",$read["key_makeup_artist"]);
                                     foreach($key_makeup_artist as $key_makeup_artist){
									$key_makeup_artist_data_query="select * from makeup where id='$key_makeup_artist'";
										 $key_makeup_artist_data_exe=mysqli_query($con,$key_makeup_artist_data_query);
										 $key_makeup_artist_name_read=mysqli_fetch_array($key_makeup_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $key_makeup_artist_name_read["id"] ?>" selected><?php echo $key_makeup_artist_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Assistant Makeup Artist</label>
                             <select name="film_assistant_makeup_artist_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_assistant_makeup_artist_name=explode(",",$read["film_assistant_makeup_artist_name"]);
                                     foreach($film_assistant_makeup_artist_name as $assistant_makeup_artist_name){
									$film_assistant_makeup_artist_name_data_query="select * from makeup where id='$assistant_makeup_artist_name'";
										 $film_assistant_makeup_artist_name_data_exe=mysqli_query($con,$film_assistant_makeup_artist_name_data_query);
										 $film_assistant_makeup_artist_name_name_read=mysqli_fetch_array($film_assistant_makeup_artist_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_assistant_makeup_artist_name_name_read["id"] ?>" selected><?php echo $film_assistant_makeup_artist_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Makeup Assistant (General)</label>
                             <select name="makeup_assistant_general[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $makeup_assistant_general=explode(",",$read["makeup_assistant_general"]);
                                     foreach($makeup_assistant_general as $makeup_assistant_general){
									$makeup_assistant_general_data_query="select * from makeup where id='$makeup_assistant_general'";
										 $makeup_assistant_general_data_exe=mysqli_query($con,$makeup_assistant_general_data_query);
										 $makeup_assistant_general_name_read=mysqli_fetch_array($makeup_assistant_general_data_exe);
                                     ?>
                                     <option value="<?php echo $makeup_assistant_general_name_read["id"] ?>" selected><?php echo $makeup_assistant_general_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                  <div class="form-group">  
                                 <label>Prosthetic Makeup Artist</label>             
                             <select name="film_prosthetic_makeup_artist_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_prosthetic_makeup_artist_name=explode(",",$read["film_prosthetic_makeup_artist_name"]);
                                     foreach($film_prosthetic_makeup_artist_name as $prosthetic_makeup_artist_name){
									$film_prosthetic_makeup_artist_name_data_query="select * from makeup where id='$prosthetic_makeup_artist_name'";
										 $film_prosthetic_makeup_artist_name_data_exe=mysqli_query($con,$film_prosthetic_makeup_artist_name_data_query);
										 $film_prosthetic_makeup_artist_name_data_exe=mysqli_fetch_array($film_prosthetic_makeup_artist_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_prosthetic_makeup_artist_name_data_exe["id"] ?>" selected><?php echo $film_prosthetic_makeup_artist_name_data_exe['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                    <div class="form-group">  
                                 <label>Assistant Prosthetic Makeup Artist</label>    
                                   <select name="film_assistant_prosthetic_makeup_artist_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                       <?php 
                                     $film_assistant_prosthetic_makeup_artist_name=explode(",",$read["film_prosthetic_makeup_artist_name"]);
                                     foreach($film_assistant_prosthetic_makeup_artist_name as $assistant_prosthetic_makeup_artist_name){
									$film_assistant_prosthetic_makeup_artist_name_data_query="select * from makeup where id='$assistant_prosthetic_makeup_artist_name'";
										 $film_assistant_prosthetic_makeup_artist_name_data_exe=mysqli_query($con,$film_assistant_prosthetic_makeup_artist_name_data_query);
										 $film_assistant_prosthetic_makeup_artist_name_name_read=mysqli_fetch_array($film_assistant_prosthetic_makeup_artist_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_assistant_prosthetic_makeup_artist_name_name_read["id"] ?>" selected><?php echo $film_assistant_prosthetic_makeup_artist_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                 <div class="form-group"> 
                                  <label>Background Makeup Artist</label>             
                             <select name="background_makeup_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $background_makeup_artist=explode(",",$read["background_makeup_artist"]);
                                     foreach($background_makeup_artist as $background_makeup_artist){
									$background_makeup_artist_data_query="select * from makeup where id='$background_makeup_artist'";
										 $background_makeup_artist_data_exe=mysqli_query($con,$background_makeup_artist_data_query);
										 $background_makeup_artist_name_data_exe=mysqli_fetch_array($background_makeup_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $background_makeup_artist_name_data_exe["id"] ?>" selected><?php echo $background_makeup_artist_name_data_exe['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                  <div class="form-group">  
                                 <label>Age Makeup Artist</label> 
                                 <select name="age_makeup_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $age_makeup_artist=explode(",",$read["age_makeup_artist"]);
                                     foreach($age_makeup_artist as $age_makeup_artist){
									$age_makeup_artist_data_query="select * from makeup where id='$age_makeup_artist'";
										 $age_makeup_artist_data_exe=mysqli_query($con,$age_makeup_artist_data_query);
										 $age_makeup_artist_name_read=mysqli_fetch_array($age_makeup_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $age_makeup_artist_name_read["id"] ?>" selected><?php echo $age_makeup_artist_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                  <div class="form-group">  
                                 <label>Character Makeup Artist</label> 
                                 <select name="character_makeup_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $character_makeup_artist=explode(",",$read["character_makeup_artist"]);
                                     foreach($character_makeup_artist as $character_makeup_artist){
									$character_makeup_artist_data_query="select * from makeup where id='$character_makeup_artist'";
										 $character_makeup_artist_data_exe=mysqli_query($con,$character_makeup_artist_data_query);
										 $character_makeup_artist_name_read=mysqli_fetch_array($character_makeup_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $character_makeup_artist_name_read["id"] ?>" selected><?php echo $character_makeup_artist_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                  <div class="form-group">  
                                 <label>Makeup Set Medic</label> 
                                 <select name="makeup_set_medic[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $makeup_set_medic=explode(",",$read["makeup_set_medic"]);
                                     foreach($makeup_set_medic as $makeup_set_medic){
									$makeup_set_medic_data_query="select * from makeup where id='$makeup_set_medic'";
										 $makeup_set_medic_data_exe=mysqli_query($con,$makeup_set_medic_data_query);
										 $makeup_set_medic_name_read=mysqli_fetch_array($makeup_set_medic_data_exe);
                                     ?>
                                     <option value="<?php echo $makeup_set_medic_name_read["id"] ?>" selected><?php echo $makeup_set_medic_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                 <div class="form-group">  
                                 <label>Makeup Assistant</label> 
                                 <select name="makeup_assistant[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $makeup_assistant=explode(",",$read["makeup_assistant"]);
                                     foreach($makeup_assistant as $makeup_assistant){
									$makeup_assistant_data_query="select * from makeup where id='$makeup_assistant'";
										 $makeup_assistant_data_exe=mysqli_query($con,$makeup_assistant_data_query);
										 $makeup_assistant_name_read=mysqli_fetch_array($makeup_assistant_data_exe);
                                     ?>
                                     <option value="<?php echo $makeup_assistant_name_read["id"] ?>" selected><?php echo $makeup_assistant_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>

                                  <div class="form-group">  
                                 <label>Hair Stylist</label> 
                                 <select name="film_hair_stylist_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $film_hair_stylist_name=explode(",",$read["film_hair_stylist_name"]);
                                     foreach($film_hair_stylist_name as $hair_stylist_name){
									$film_hair_stylist_name_data_query="select * from makeup where id='$hair_stylist_name'";
										 $film_hair_stylist_name_data_exe=mysqli_query($con,$film_hair_stylist_name_data_query);
										 $film_hair_stylist_name_name_read=mysqli_fetch_array($film_hair_stylist_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_hair_stylist_name_name_read["id"] ?>" selected><?php echo $film_hair_stylist_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                 <div class="form-group">  
                                 <label>Wig Maker/Hair Postiche</label> 
                                 <select name="wig_maker[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $wig_maker=explode(",",$read["wig_maker"]);
                                     foreach($wig_maker as $wig_maker){
									$wig_maker_data_query="select * from makeup where id='$wig_maker'";
										 $wig_maker_data_exe=mysqli_query($con,$wig_maker_data_query);
										 $wig_maker_name_read=mysqli_fetch_array($wig_maker_data_exe);
                                     ?>
                                     <option value="<?php echo $wig_maker_name_read["id"] ?>" selected><?php echo $wig_maker_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                  <div class="form-group">  
                                 <label>Assistant Hair Stylist</label> 
                                 <select name="film_assistant_hair_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $film_assistant_hair_name=explode(",",$read["film_assistant_hair_name"]);
                                     foreach($film_assistant_hair_name as $assistant_hair_name){
									$film_assistant_hair_name_data_query="select * from makeup where id='$assistant_hair_name'";
										 $film_assistant_hair_name_data_exe=mysqli_query($con,$film_assistant_hair_name_data_query);
										 $film_assistant_hair_name_name_read=mysqli_fetch_array($film_assistant_hair_name_data_exe);
                                     ?>
                                     <option value="<?php echo $film_assistant_hair_name_name_read["id"] ?>" selected><?php echo $film_assistant_hair_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from makeup order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                 
                                 
     

              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="edit_makeup_management"  class="btn btn-add"  value="Edit Makeup Manegement">
                            
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

