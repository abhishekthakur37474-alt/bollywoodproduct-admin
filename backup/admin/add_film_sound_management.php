<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_POST["add_film_sound_management"]) { 
    
    
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']); 
    $film_dialogue_editor_name= mysqli_real_escape_string($con,implode(",",$_POST['film_dialogue_editor_name']));
    $film_sound_designer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_sound_designer_name']));
    $film_sound_mixing_name= mysqli_real_escape_string($con,implode(",",$_POST['film_sound_mixing_name']));
    $film_audio_mastering_name= mysqli_real_escape_string($con,implode(",",$_POST['film_audio_mastering_name']));
    $film_sound_effect_editor_name= mysqli_real_escape_string($con,implode(",",$_POST['film_sound_effect_editor_name']));
    $film_sound_recordist_name= mysqli_real_escape_string($con,implode(",",$_POST['film_sound_recordist_name']));
    $film_re_recordist_mixer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_re_recordist_mixer_name']));
    $film_production_sound_mixer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_production_sound_mixer_name']));
    $film_boom_operator_name= mysqli_real_escape_string($con,implode(",",$_POST['film_boom_operator_name']));
    $foley_artist= mysqli_real_escape_string($con,implode(",",$_POST['foley_artist']));
    $foley_mixer= mysqli_real_escape_string($con,implode(",",$_POST['foley_mixer']));
    $foley_supervisor= mysqli_real_escape_string($con,implode(",",$_POST['foley_supervisor']));
    $sound_editor= mysqli_real_escape_string($con,implode(",",$_POST['sound_editor']));
    $assistant_sound_editor= mysqli_real_escape_string($con,implode(",",$_POST['assistant_sound_editor']));
    $supervising_sound_editor= mysqli_real_escape_string($con,implode(",",$_POST['supervising_sound_editor']));
    $assistant_dialogue= mysqli_real_escape_string($con,implode(",",$_POST['assistant_dialogue']));
    $dialogue_cleaner= mysqli_real_escape_string($con,implode(",",$_POST['dialogue_cleaner']));
    $sound_effects_librarian= mysqli_real_escape_string($con,implode(",",$_POST['sound_effects_librarian']));
    $recording_engineer= mysqli_real_escape_string($con,implode(",",$_POST['recording_engineer']));
    $sound_re_recordist= mysqli_real_escape_string($con,implode(",",$_POST['sound_re_recordist']));
    $adr_recordist= mysqli_real_escape_string($con,implode(",",$_POST['adr_recordist']));
    $boom_operator_assistant= mysqli_real_escape_string($con,implode(",",$_POST['boom_operator_assistant']));
    $re_recording_mix_technician= mysqli_real_escape_string($con,implode(",",$_POST['re_recording_mix_technician']));
    $adr_mixer= mysqli_real_escape_string($con,implode(",",$_POST['adr_mixer']));
    $adr_supervisor= mysqli_real_escape_string($con,implode(",",$_POST['adr_supervisor']));
    $dolby_mix= mysqli_real_escape_string($con,implode(",",$_POST['dolby_mix']));
    $first_assistant_sound= mysqli_real_escape_string($con,implode(",",$_POST['first_assistant_sound']));
    $second_assistant_sound= mysqli_real_escape_string($con,implode(",",$_POST['second_assistant_sound']));
    $sound_trainee= mysqli_real_escape_string($con,implode(",",$_POST['sound_trainee']));
    $adr_engineer= mysqli_real_escape_string($con,implode(",",$_POST['adr_engineer']));
    $audiography= mysqli_real_escape_string($con,implode(",",$_POST['audiography']));
    $foley_recordist= mysqli_real_escape_string($con,implode(",",$_POST['foley_recordist']));

    $film_makeup="insert into film_sound_management_allot set film_id='$film_id',foley_recordist='$foley_recordist',film_dialogue_editor_name='$film_dialogue_editor_name',film_sound_designer_name='$film_sound_designer_name',film_sound_mixing_name='$film_sound_mixing_name',film_audio_mastering_name='$film_audio_mastering_name',film_sound_effect_editor_name='$film_sound_effect_editor_name',film_sound_recordist_name='$film_sound_recordist_name',film_re_recordist_mixer_name='$film_re_recordist_mixer_name',film_production_sound_mixer_name='$film_production_sound_mixer_name',film_boom_operator_name='$film_boom_operator_name',foley_artist='$foley_artist',foley_mixer='$foley_mixer',foley_supervisor='$foley_supervisor',sound_editor='$sound_editor',assistant_sound_editor='$assistant_sound_editor',supervising_sound_editor='$supervising_sound_editor',assistant_dialogue='$assistant_dialogue',dialogue_cleaner='$dialogue_cleaner',sound_effects_librarian='$sound_effects_librarian',recording_engineer='$recording_engineer',sound_re_recordist='$sound_re_recordist',adr_recordist='$adr_recordist',boom_operator_assistant='$boom_operator_assistant',re_recording_mix_technician='$re_recording_mix_technician',adr_mixer='$adr_mixer',adr_supervisor='$adr_supervisor',dolby_mix='$dolby_mix',first_assistant_sound='$first_assistant_sound',second_assistant_sound='$second_assistant_sound',sound_trainee='$sound_trainee',adr_engineer='$adr_engineer',audiography='$audiography'";
mysqli_query($con,$film_makeup) or die(mysqli_error($con));
  
         echo "<script>alert('Film Sound Management Save Succesfully')</script>";
   echo "<script>window.location.href='film_sound_management.php'</script>";
         }
         ?>
         
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Add Film Sound Management</title>
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
                  <h1>Film Sound Management</h1>
                  <small>Add Film Sound</small>
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
                                 <h4>Add Film Sound Management Here</h4>
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
                                 <label>Sound Designer</label>
                             <select name="film_sound_designer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Foley Artist</label>
                             <select name="foley_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Foley Recordist</label>
                             <select name="foley_recordist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Foley Mixer</label>
                             <select name="foley_mixer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Foley Supervisor/Foley Editor</label>
                             <select name="foley_supervisor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Sound Editor</label>
                             <select name="sound_editor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Sound Effect Editor</label>
                             <select name="film_sound_effect_editor_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Assistant Sound Editor</label>
                             <select name="assistant_sound_editor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Supervising Effect Editor</label>
                             <select name="supervising_sound_editor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                              <div class="form-group">
                                 <label>Dialogue Editor</label>
                             <select name="film_dialogue_editor_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                             <div class="form-group">
                                 <label>Assistant Dialogue Editor</label>
                             <select name="assistant_dialogue[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                <div class="form-group">
                                 <label>Dialogue Cleaner</label>
                             <select name="dialogue_cleaner[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Sound Effects Librarian</label>
                             <select name="sound_effects_librarian[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Recording Engineer</label>
                             <select name="recording_engineer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Sound Recordist</label>
                             <select name="film_sound_recordist_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Sound Re-Recordist</label>
                             <select name="sound_re_recordist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>ADR Recordist</label>
                             <select name="adr_recordist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Boom Operator</label>
                             <select name="film_boom_operator_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Boom Operator Assistant</label>
                             <select name="boom_operator_assistant[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Sound Mixer</label>
                             <select name="film_sound_mixing_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   
                                    <div class="form-group">
                                 <label>Audio Mastering</label>
                             <select name="film_audio_mastering_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   
                                  
                                   
                                   
                                   
                                   <div class="form-group">
                                 <label>Re-Recordist Mixer</label>
                             <select name="film_re_recordist_mixer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Re-Recordist Mix Technician</label>
                             <select name="re_recording_mix_technician[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Production Sound Mixer</label>
                             <select name="film_production_sound_mixer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>First Assistant Sound</label>
                             <select name="first_assistant_sound[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>ADR Engineer</label>
                             <select name="adr_engineer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>ADR Mixer</label>
                             <select name="adr_mixer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>ADR Supervisor</label>
                             <select name="adr_supervisor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Dolby Mix</label>
                             <select name="dolby_mix[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>First Assistant Sound</label>
                             <select name="first_assistant_sound[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Second Assistant Sound</label>
                             <select name="second_assistant_sound[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Sound Trainee</label>
                             <select name="sound_trainee[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                
                                  <div class="form-group">
                                 <label>Audiography</label>
                             <select name="audiography[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <? $sqlfr=mysqli_query($con, "select * from sound order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                

     

              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="add_film_sound_management"  class="btn btn-add"  value="Add Film Sound Manegement">
                            
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

