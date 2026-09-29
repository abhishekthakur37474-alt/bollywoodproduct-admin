<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      $id=$_GET["id"];
      $record="select * from film_screenplay_management_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
	   $film_id=$read["film_id"];
      ?>

<?
if($_POST["edit_film_screenplay_management"]) { 
    
    
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']); 
    $film_screenplay_name= mysqli_real_escape_string($con,implode(",",$_POST['film_screenplay_name']));
    $film_writer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_writer_name']));
    $script_supervisor= mysqli_real_escape_string($con,implode(",",$_POST['script_supervisor']));
    $film_additional_screenplay_name= mysqli_real_escape_string($con,implode(",",$_POST['film_additional_screenplay_name']));
    $film_additional_dialogue_name= mysqli_real_escape_string($con,implode(",",$_POST['film_additional_dialogue_name']));
    $film_story_name= mysqli_real_escape_string($con,implode(",",$_POST['film_story_name']));
    $film_screenplay_adapted_name= mysqli_real_escape_string($con,implode(",",$_POST['film_screenplay_adapted_name']));
    $film_dialogue_name= mysqli_real_escape_string($con,implode(",",$_POST['film_dialogue_name']));
    $film_additional_screenplay_name= mysqli_real_escape_string($con,implode(",",$_POST['film_additional_screenplay_name']));
    $film_adapted_story_name= mysqli_real_escape_string($con,implode(",",$_POST['film_adapted_story_name']));
    $original_story= mysqli_real_escape_string($con,implode(",",$_POST['original_story']));
    $original_idea= mysqli_real_escape_string($con,implode(",",$_POST['original_idea']));
    $story_editor= mysqli_real_escape_string($con,implode(",",$_POST['story_editor']));
    $script_coordinator= mysqli_real_escape_string($con,implode(",",$_POST['script_coordinator']));
    $script_consultant= mysqli_real_escape_string($con,implode(",",$_POST['script_consultant']));
     $Concept= mysqli_real_escape_string($con,implode(",",$_POST['Concept']));
     $Based_on= mysqli_real_escape_string($con,implode(",",$_POST['Based_on']));


    $film_makeup="update film_screenplay_management_allot set film_id='$film_id',writer='$film_writer_name',Concept='$Concept',Based_on='$Based_on',script_supervisor='$script_supervisor',film_screenplay_name='$film_screenplay_name',film_additional_screenplay_name='$film_additional_screenplay_name',film_additional_dialogue_name='$film_additional_dialogue_name',film_story_name='$film_story_name',film_screenplay_adapted_name='$film_screenplay_adapted_name',film_dialogue_name='$film_dialogue_name',film_adapted_story_name='$film_adapted_story_name',original_story='$original_story',original_idea='$original_idea',story_editor='$story_editor',script_coordinator='$script_coordinator',script_consultant='$script_consultant' where id='$id'";
mysqli_query($con,$film_makeup) or die(mysqli_error($con));
  
         echo "<script>alert('Film Screenplay Management Updated Succesfully')</script>";
   echo "<script>window.location.href='film_screenplay_management.php'</script>";
         }
         ?>
         
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Screenplay Management</title>
      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
      <!-- Start Global Mandatory Style
         =====================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
  <!-- select2 -->
  
  <style>
   .flexdatalist-alias
    {
       width:100%;
       height: 35px;
    }
  </style>

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
                  <h1>Film Screenplay Management</h1>
                  <small>Edit Film Screenplay</small>
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
                                 <h4>Edit Film Screenplay Management Here</h4>
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
                                 <label>Screenplay</label>
                                  <? 
														$tmp = '';
                                       
                                   
                                     $film_screenplay_name=explode(",",$read["film_screenplay_name"]);
                                     foreach($film_screenplay_name as $screenplay_name){
									  $screenplay_name_data_query="select * from screenplay where id='$screenplay_name'";
										 $screenplay_name_data_exe=mysqli_query($con,$screenplay_name_data_query);
										 $screenplay_name_name_read=mysqli_fetch_array($screenplay_name_data_exe);
										 $screenplay_name_name_read_id=$screenplay_name_name_read["id"];
										 $tmp .=$screenplay_name_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Screenplay'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_screenplay_name',
       data-value-property='value',
	   name='film_screenplay_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_screenplay_name">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                           
                              </div>
                               <div class="form-group">
                                 <label>Writer</label>
                                  <? 
														$tmp = '';
                                       
                                   
                                     $film_writer_name=explode(",",$read["writer"]);
                                     foreach($film_writer_name as $film_writername){
									  $writer_name_data_query="select * from screenplay where id='$film_writername'";
										 $writer_name_data_exe=mysqli_query($con,$writer_name_data_query);
										 $writer_name_name_read=mysqli_fetch_array($writer_name_data_exe);
										 $writer_name_name_read_id=$writer_name_name_read["id"];
										 $tmp .=$writer_name_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Writer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_writer_name',
       data-value-property='value',
	   name='film_writer_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_writer_name">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                             
                              </div>
                              <div class="form-group">
                                 <label>Additional Screenplay</label>
                                  <? 
														$tmp = '';
                                       
                                   
                                     $film_additional_screenplay_name=explode(",",$read["film_additional_screenplay_name"]);
                                     foreach($film_additional_screenplay_name as $additional_screenplay_name){
									 $additional_screenplay_name_data_query="select * from screenplay where id='$additional_screenplay_name'";
										 $additional_screenplay_name_data_exe=mysqli_query($con,$additional_screenplay_name_data_query);
										 $additional_screenplay_name_name_read=mysqli_fetch_array($additional_screenplay_name_data_exe);
										 $additional_screenplay_name_name_read_id=$additional_screenplay_name_name_read["id"];
										 $tmp .=$additional_screenplay_name_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Additional Screenplay'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_additional_screenplay_name',
       data-value-property='value',
	   name='film_additional_screenplay_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_additional_screenplay_name">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                            
                                   </div>
                                     <div class="form-group">
                                 <label>Adapted Screenplay</label>
                                   <? 
														$tmp = '';
                                       
                                   
                                     $film_screenplay_adapted_name=explode(",",$read["film_screenplay_adapted_name"]);
                                     foreach($film_screenplay_adapted_name as $screenplay_adapted_name){
									  $screenplay_adapted_name_data_query="select * from screenplay where id='$screenplay_adapted_name'";
										 $screenplay_adapted_name_data_exe=mysqli_query($con,$screenplay_adapted_name_data_query);
										 $screenplay_adapted_name_name_read=mysqli_fetch_array($screenplay_adapted_name_data_exe);
										 $screenplay_adapted_name_name_read_id=$screenplay_adapted_name_name_read["id"];
										 $tmp .=$screenplay_adapted_name_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Adapted Screenplay'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_screenplay_adapted_name',
       data-value-property='value',
	   name='film_screenplay_adapted_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_screenplay_adapted_name">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                          
                                   </div>
                                    <div class="form-group">
                                 <label>Story</label>
                                 <? 
														$tmp = '';
                                       
                                   
                                      $film_story_name=explode(",",$read["film_story_name"]);
                                     foreach($film_story_name as $story_name){
									 $story_name_data_query="select * from screenplay where id='$story_name'";
										 $story_name_data_exe=mysqli_query($con,$story_name_data_query);
										 $story_name_name_read=mysqli_fetch_array($story_name_data_exe);
										 $story_name_name_read_id=$story_name_name_read["id"];
										 $tmp .=$story_name_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Story'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_story_name',
       data-value-property='value',
	   name='film_story_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_story_name">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                           
                                   </div>
                                    <div class="form-group">
                                 <label>Original Story</label>
                                 <? 
														$tmp = '';
                                       
                                   
                                       $original_story=explode(",",$read["original_story"]);
                                     foreach($original_story as $original_story){
									 $original_story_data_query="select * from screenplay where id='$original_story'";
										 $original_story_data_exe=mysqli_query($con,$original_story_data_query);
										 $original_story_name_read=mysqli_fetch_array($original_story_data_exe);
										 $original_story_name_read_id=$original_story_name_read["id"];
										 $tmp .=$original_story_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Original Story'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='original_story',
       data-value-property='value',
	   name='original_story[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="original_story">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                           
                                   </div>
                                    <div class="form-group">
                                 <label>Original Idea</label>
                                  <? 
														$tmp = '';
                                       
                                   
                                        $original_idea=explode(",",$read["original_idea"]);
                                     foreach($original_idea as $original_idea){
									 $original_idea_data_query="select * from screenplay where id='$original_idea'";
										 $original_idea_data_exe=mysqli_query($con,$original_idea_data_query);
										 $original_idea_name_read=mysqli_fetch_array($original_idea_data_exe);
										 $original_idea_name_read_id=$original_idea_name_read["id"];
										 $tmp .=$original_idea_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Original Idea'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='original_idea',
       data-value-property='value',
	   name='original_idea[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="original_idea">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                            
                                   </div>
                                    <div class="form-group">
                                 <label>Adapted Story</label>
                                 <? 
														$tmp = '';
                                       
                                   
                                       $film_adapted_story_name=explode(",",$read["film_adapted_story_name"]);
                                     foreach($film_adapted_story_name as $adapted_story_name){
									 $adapted_story_name_data_query="select * from screenplay where id='$adapted_story_name'";
										 $adapted_story_name_data_exe=mysqli_query($con,$adapted_story_name_data_query);
										 $adapted_story_name_name_read=mysqli_fetch_array($adapted_story_name_data_exe);
										 $adapted_story_name_name_read_id=$adapted_story_name_name_read["id"];
										 $tmp .=$adapted_story_name_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Adapted Story'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_adapted_story_name',
       data-value-property='value',
	   name='film_adapted_story_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_adapted_story_name">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                           
                                   </div>
                                   <div class="form-group">
                                 <label>Story Editor</label>
                                  <? 
														$tmp = '';
                                       
                                   
                                       $story_editor=explode(",",$read["story_editor"]);
                                     foreach($story_editor as $story_editor){
									 $story_editor_data_query="select * from screenplay where id='$story_editor'";
										 $story_editor_data_exe=mysqli_query($con,$story_editor_data_query);
										 $story_editor_name_read=mysqli_fetch_array($story_editor_data_exe);
										 $story_editor_name_read_id=$story_editor_name_read["id"];
										 $tmp .=$story_editor_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Story Editor'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='story_editor',
       data-value-property='value',
	   name='story_editor[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="story_editor">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                            
                                   </div>
                                   <div class="form-group">
                                 <label>Dialogue</label>
                                  <? 
														$tmp = '';
                                       
                                   
                                       $film_dialogue_name=explode(",",$read["film_dialogue_name"]);
                                     foreach($film_dialogue_name as $dialogue_name){
									   $dialogue_name_data_query="select * from screenplay where id='$dialogue_name'";
										 $dialogue_name_data_exe=mysqli_query($con,$dialogue_name_data_query);
										 $dialogue_name_name_read=mysqli_fetch_array($dialogue_name_data_exe);
										 $dialogue_name_name_read_id=$dialogue_name_name_read["id"];
										 $tmp .=$dialogue_name_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Dialogue'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_dialogue_name',
       data-value-property='value',
	   name='film_dialogue_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_dialogue_name">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                            
                                   </div>
                                    <div class="form-group">
                                 <label>Additional Dialogue</label>
                                 <? 
														$tmp = '';
                                       
                                   
                                      $film_additional_dialogue_name=explode(",",$read["film_additional_dialogue_name"]);
                                     foreach($film_additional_dialogue_name as $additional_dialogue_name){
								 $additional_dialogue_name_data_query="select * from screenplay where id='$additional_dialogue_name'";
										 $additional_dialogue_name_data_exe=mysqli_query($con,$additional_dialogue_name_data_query);
										 $additional_dialogue_name_name_read=mysqli_fetch_array($additional_dialogue_name_data_exe);
										 $additional_dialogue_name_name_read_id=$additional_dialogue_name_name_read["id"];
										 $tmp .=$additional_dialogue_name_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Additional Dialogue'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_additional_dialogue_name',
       data-value-property='value',
	   name='film_additional_dialogue_name[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="film_additional_dialogue_name">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                          
                                   </div>
                                   
                             <div class="form-group">
                                 <label>Script Supervisor</label>
                                 <? 
														$tmp = '';
                                       
                                   
                                       $script_supervisor=explode(",",$read["script_supervisor"]);
                                     foreach($script_supervisor as $script_supervisor1){
									 $script_supervisor1_data_query="select * from screenplay where id='$script_supervisor1'";
										 $script_supervisor1_data_exe=mysqli_query($con,$script_supervisor1_data_query);
										 $script_supervisor1_name_read=mysqli_fetch_array($script_supervisor1_data_exe);
										 $script_supervisor1_name_read_id=$script_supervisor1_name_read["id"];
										 $tmp .=$script_supervisor1_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Script Supervisor'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='script_supervisor',
       data-value-property='value',
	   name='script_supervisor[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="script_supervisor">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                             
                              </div>
                             <div class="form-group">
                                 <label>Script Coordinator</label>
                                  <? 
														$tmp = '';
                                       
                                   
                                       $script_coordinator=explode(",",$read["script_coordinator"]);
                                     foreach($script_coordinator as $script_coordinator){
								 $script_coordinator_data_query="select * from screenplay where id='$script_coordinator'";
										 $script_coordinator_data_exe=mysqli_query($con,$script_coordinator_data_query);
										 $script_coordinator_name_read=mysqli_fetch_array($script_coordinator_data_exe);
										 $script_coordinator_name_read_id=$script_coordinator_name_read["id"];
										 $tmp .=$script_coordinator_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Script Coordinator'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='script_coordinator',
       data-value-property='value',
	   name='script_coordinator[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="script_coordinator">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                          
                                   </div>
                                   <div class="form-group">
                                 <label>Script Consultant</label>
                                  <? 
														$tmp = '';
                                       
                                   
                                      $script_consultant=explode(",",$read["script_consultant"]);
                                     foreach($script_consultant as $script_consultant){
								 $script_consultant_data_query="select * from screenplay where id='$script_consultant'";
										 $script_consultant_data_exe=mysqli_query($con,$script_consultant_data_query);
										 $script_consultant_name_read=mysqli_fetch_array($script_consultant_data_exe);
										 $script_consultant_name_read_id=$script_consultant_name_read["id"];
										 $tmp .=$script_consultant_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Script Consultant'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='script_consultant',
       data-value-property='value',
	   name='script_consultant[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="script_consultant">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
</datalist>
                            
                                   </div>
                                    <div class="form-group">
                                 <label>Concept</label>
                                  <? 
														$tmp = '';
                                       
                                   
                                      $Concept1=explode(",",$read["Concept"]);
                                     foreach($Concept1 as $Concept1_id){
								 $Concept_data_query="select * from screenplay where id='$Concept1_id'";
										 $Concept_data_exe=mysqli_query($con,$Concept_data_query);
										 $Concept_name_read=mysqli_fetch_array($Concept_data_exe);
										 $Concept_name_read_id=$Concept_name_read["id"];
										 $tmp .=$Concept_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Concept'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='Concept',
       data-value-property='value',
	   name='Concept[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="Concept">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
</datalist>
                          
                                   </div>
                                   <div class="form-group">
                                 <label>Based On</label>
                                  <? 
														$tmp = '';
                                       
                                   
                                       $Based_on1=explode(",",$read["Based_on"]);
                                     foreach($Based_on1 as $Based_on1_id){
								 $Based_on_data_query="select * from screenplay where id='$Based_on1_id'";
										 $Based_on_data_exe=mysqli_query($con,$Based_on_data_query);
										 $Based_on_name_read=mysqli_fetch_array($Based_on_data_exe);
										 $Based_on_name_read_id=$Based_on_name_read["id"];
										 $tmp .=$Based_on_name_read_id. ','; 
                                     }
                                     	 $tmp = trim($tmp, ',');    // remove trailing comma
                                     ?>
                                       
                                       
                                   
 
<input type='text'
       placeholder='Enter Based On'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='Based_on',
       data-value-property='value',
	   name='Based_on[]',
	    value='<? echo $tmp?>',
       multiple='multiple'
       >
	   <datalist id="Based_on">
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
</datalist>
                           
                                   </div>


              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="edit_film_screenplay_management"  class="btn btn-add"  value="Update Film Screenplay Manegement">
                            
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>
      <!-- jquery-ui --> 
      <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <!-- Bootstrap -->
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <!-- lobipanel -->
      <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <!-- Pace js -->
      <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <!-- table-export js -->

   
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
         
       
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script>
  $(document).ready(function() {
    $('.searchwithselect2').select2();
});
</script>
  
    <script>
$('.flexdatalist').flexdatalist({
     minLength: 1,
	 selectionRequired: true,
	  valueProperty: 'value'
});
</script>

 
   </body>
  
</html>

