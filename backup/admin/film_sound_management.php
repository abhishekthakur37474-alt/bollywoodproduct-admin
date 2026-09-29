<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      } 
	  $id=$_GET["id"];
      $record="select * from film_sound_management_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
      $film_id=$read["film_id"];

?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Film Sound Management</title>
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
                  <h1> Film Sound Management</h1>
                  <small> Film Sound List</small>
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
                                 <h4> Film Sound Management List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="add_film_sound_management.php"> <i class="fa fa-plus"></i> Add Sound
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
    url: "search_sound_management.php",
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
<?php $sqlfs=mysqli_query($con, "select * from film_sound_management_allot");
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

<option value="edit_film_sound.php?id=<?php echo $rowfs['id']; ?>"><?php echo $rowf['name']; ?> - <?php echo $rowf['year_release']; ?> - <?php echo $main_language; ?>     </option>
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `film_sound_management_allot`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `film_sound_management_allot` order by id desc LIMIT $offset, $total_records_per_page");


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
                                               <th>Sound Designer:</th>
                                               <td>
											    <?php
$film_sound_designer_name = explode(",", $row["film_sound_designer_name"]);

foreach ($film_sound_designer_name as $film_sound_designer_name_id) {
    $film_sound_designer_name_data_query = "select * from sound where id='$film_sound_designer_name_id'";
    $film_sound_designer_name_data_exe = mysqli_query($con, $film_sound_designer_name_data_query);
  
        $film_sound_designer_name_name_read = mysqli_fetch_array($film_sound_designer_name_data_exe);
        echo $film_sound_designer_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                              <tr>
                                               <th>Foley Artist:</th>
                                               <td>
											    <?php
$foley_artist = explode(",", $row["foley_artist"]);

foreach ($foley_artist as $foley_artist_id) {
    $foley_artist_data_query = "select * from sound where id='$foley_artist_id'";
    $foley_artist_data_exe = mysqli_query($con, $foley_artist_data_query);
  
        $foley_artist_name_read = mysqli_fetch_array($foley_artist_data_exe);
        echo $foley_artist_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Foley Recordist:</th>
                                               <td>
											    <?php
$foley_recordist = explode(",", $row["foley_recordist"]);

foreach ($foley_recordist as $foley_recordist_id) {
    $foley_recordist_data_query = "select * from sound where id='$foley_recordist_id'";
    $foley_recordist_data_exe = mysqli_query($con, $foley_recordist_data_query);
  
        $foley_recordist_name_read = mysqli_fetch_array($foley_recordist_data_exe);
        echo $foley_recordist_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Foley Mixer:</th>
                                               <td>
											    <?php
$foley_mixer = explode(",", $row["foley_mixer"]);

foreach ($foley_mixer as $foley_mixer_id) {
    $foley_mixer_data_query = "select * from sound where id='$foley_mixer_id'";
    $foley_mixer_data_exe = mysqli_query($con, $foley_mixer_data_query);
  
        $foley_mixer_name_read = mysqli_fetch_array($foley_mixer_data_exe);
        echo $foley_mixer_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                     <tr>
                                               <th>Foley Supervisor/Foley Editor:</th>
                                               <td>
											    <?php
$foley_supervisor = explode(",", $row["foley_supervisor"]);

foreach ($foley_supervisor as $foley_supervisor_id) {
    $foley_supervisor_data_query = "select * from sound where id='$foley_supervisor_id'";
    $foley_supervisor_data_exe = mysqli_query($con, $foley_supervisor_data_query);
  
        $foley_supervisor_name_read = mysqli_fetch_array($foley_supervisor_data_exe);
        echo $foley_supervisor_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                   <tr>
                                               <th>Sound Editor:</th>
                                               <td>
											    <?php
$sound_editor = explode(",", $row["sound_editor"]);

foreach ($sound_editor as $sound_editor_id) {
    $sound_editor_data_query = "select * from sound where id='$sound_editor_id'";
    $sound_editor_data_exe = mysqli_query($con, $sound_editor_data_query);
  
        $sound_editor_name_read = mysqli_fetch_array($sound_editor_data_exe);
        echo $sound_editor_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Sound Effect Editor:</th>
                                               <td>
											    <?php
$film_sound_effect_editor_name = explode(",", $row["film_sound_effect_editor_name"]);

foreach ($film_sound_effect_editor_name as $film_sound_effect_editor_name_id) {
    $film_sound_effect_editor_name_data_query = "select * from sound where id='$film_sound_effect_editor_name_id'";
    $film_sound_effect_editor_name_data_exe = mysqli_query($con, $film_sound_effect_editor_name_data_query);
  
        $film_sound_effect_editor_name_name_read = mysqli_fetch_array($film_sound_effect_editor_name_data_exe);
        echo $film_sound_effect_editor_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Assistant Sound Editor:</th>
                                               <td>
											    <?php
$assistant_sound_editor = explode(",", $row["assistant_sound_editor"]);

foreach ($assistant_sound_editor as $assistant_sound_editor_id) {
    $assistant_sound_editor_data_query = "select * from sound where id='$assistant_sound_editor_id'";
    $assistant_sound_editor_data_exe = mysqli_query($con, $assistant_sound_editor_data_query);
  
        $assistant_sound_editor_name_read = mysqli_fetch_array($assistant_sound_editor_data_exe);
        echo $assistant_sound_editor_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Supervising Sound Editor:</th>
                                               <td>
											    <?php
$supervising_sound_editor = explode(",", $row["supervising_sound_editor"]);

foreach ($supervising_sound_editor as $supervising_sound_editor_id) {
    $supervising_sound_editor_data_query = "select * from sound where id='$supervising_sound_editor_id'";
    $supervising_sound_editor_data_exe = mysqli_query($con, $supervising_sound_editor_data_query);
  
        $supervising_sound_editor_name_read = mysqli_fetch_array($supervising_sound_editor_data_exe);
        echo $supervising_sound_editor_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               <tr>
                                               <th>Dialogue Editor:</th>
                                               <td>
											    <?php
$film_dialogue_editor_name = explode(",", $row["film_dialogue_editor_name"]);

foreach ($film_dialogue_editor_name as $film_dialogue_editor_name_id) {
    $film_dialogue_editor_name_data_query = "select * from sound where id='$film_dialogue_editor_name_id'";
    $film_dialogue_editor_name_data_exe = mysqli_query($con, $film_dialogue_editor_name_data_query);
  
        $film_dialogue_editor_name_name_read = mysqli_fetch_array($film_dialogue_editor_name_data_exe);
        echo $film_dialogue_editor_name_name_read["name"],"<br/>";
    }

?>
											 </td>
                                               </tr>
                                               <tr>
                                               <th>Assistant Dialogue Editor:</th>
                                               <td>
											    <?php
$assistant_dialogue = explode(",", $row["assistant_dialogue"]);

foreach ($assistant_dialogue as $assistant_dialogue_id) {
    $assistant_dialogue_data_query = "select * from sound where id='$assistant_dialogue_id'";
    $assistant_dialogue_data_exe = mysqli_query($con, $assistant_dialogue_data_query);
  
        $assistant_dialogue_name_read = mysqli_fetch_array($assistant_dialogue_data_exe);
        echo $assistant_dialogue_name_read["name"],"<br/>";
    }

?>
											 </td>
                                               </tr>
                                                <tr>
                                               <th>Dialogue Cleaner:</th>
                                               <td>
											    <?php
$dialogue_cleaner = explode(",", $row["dialogue_cleaner"]);

foreach ($dialogue_cleaner as $dialogue_cleaner_id) {
    $dialogue_cleaner_data_query = "select * from sound where id='$dialogue_cleaner_id'";
    $dialogue_cleaner_data_exe = mysqli_query($con, $dialogue_cleaner_data_query);
  
        $dialogue_cleaner_name_read = mysqli_fetch_array($dialogue_cleaner_data_exe);
        echo $dialogue_cleaner_name_read["name"],"<br/>";
    }

?>
											 </td>
                                               </tr>
                                                <tr>
                                               <th>Sound Effect Librarian:</th>
                                               <td>
											    <?php
$sound_effects_librarian = explode(",", $row["sound_effects_librarian"]);

foreach ($sound_effects_librarian as $sound_effects_librarian_id) {
    $sound_effects_librarian_data_query = "select * from sound where id='$sound_effects_librarian_id'";
    $sound_effects_librarian_data_exe = mysqli_query($con, $sound_effects_librarian_data_query);
  
        $sound_effects_librarian_name_read = mysqli_fetch_array($sound_effects_librarian_data_exe);
        echo $sound_effects_librarian_name_read["name"],"<br/>";
    }

?>
											 </td>
                                               </tr>
                                                <tr>
                                               <th>Recording Engineer:</th>
                                               <td>
											    <?php
$recording_engineer = explode(",", $row["recording_engineer"]);

foreach ($recording_engineer as $recording_engineer_id) {
    $recording_engineer_data_query = "select * from sound where id='$recording_engineer_id'";
    $recording_engineer_data_exe = mysqli_query($con, $recording_engineer_data_query);
  
        $recording_engineer_name_read = mysqli_fetch_array($recording_engineer_data_exe);
        echo $recording_engineer_name_read["name"],"<br/>";
    }

?>
											 </td>
                                               </tr>
                                               <tr>
                                               <th>Sound Recordist:</th>
                                               <td>
											    <?php
$film_sound_recordist_name = explode(",", $row["film_sound_recordist_name"]);

foreach ($film_sound_recordist_name as $film_sound_recordist_name_id) {
    $film_sound_recordist_name_data_query = "select * from sound where id='$film_sound_recordist_name_id'";
    $film_sound_recordist_name_data_exe = mysqli_query($con, $film_sound_recordist_name_data_query);
  
        $film_sound_recordist_name_name_read = mysqli_fetch_array($film_sound_recordist_name_data_exe);
        echo $film_sound_recordist_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Sound Re-Recordist:</th>
                                               <td>
											    <?php
$sound_re_recordist = explode(",", $row["sound_re_recordist"]);

foreach ($sound_re_recordist as $sound_re_recordist_id) {
    $sound_re_recordist_data_query = "select * from sound where id='$sound_re_recordist_id'";
    $sound_re_recordist_data_exe = mysqli_query($con, $sound_re_recordist_data_query);
  
        $sound_re_recordist_name_read = mysqli_fetch_array($sound_re_recordist_data_exe);
        echo $sound_re_recordist_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                <tr>
                                               <th>ADR Recordist:</th>
                                               <td>
											    <?php
$adr_recordist = explode(",", $row["adr_recordist"]);

foreach ($adr_recordist as $adr_recordist_id) {
    $adr_recordist_data_query = "select * from sound where id='$adr_recordist_id'";
    $adr_recordist_data_exe = mysqli_query($con, $adr_recordist_data_query);
  
        $adr_recordist_name_read = mysqli_fetch_array($adr_recordist_data_exe);
        echo $adr_recordist_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Boom Operator:</th>
                                               <td>
											    <?php
$film_boom_operator_name = explode(",", $row["film_boom_operator_name"]);

foreach ($film_boom_operator_name as $film_boom_operator_name_id) {
    $film_boom_operator_name_data_query = "select * from sound where id='$film_boom_operator_name_id'";
    $film_boom_operator_name_data_exe = mysqli_query($con, $film_boom_operator_name_data_query);
  
        $film_boom_operator_name_name_read = mysqli_fetch_array($film_boom_operator_name_data_exe);
        echo $film_boom_operator_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Boom Operator Assistant:</th>
                                               <td>
											    <?php
$boom_operator_assistant = explode(",", $row["boom_operator_assistant"]);

foreach ($boom_operator_assistant as $boom_operator_assistant_id) {
    $boom_operator_assistant_data_query = "select * from sound where id='$boom_operator_assistant_id'";
    $boom_operator_assistant_data_exe = mysqli_query($con, $boom_operator_assistant_data_query);
  
        $boom_operator_assistant_name_read = mysqli_fetch_array($boom_operator_assistant_data_exe);
        echo $boom_operator_assistant_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                 <tr>
                                               <th>Sound Mixer:</th>
                                               <td>
											    <?php
$film_sound_mixing_name = explode(",", $row["film_sound_mixing_name"]);

foreach ($film_sound_mixing_name as $film_sound_mixing_name_id) {
    $film_sound_mixing_name_data_query = "select * from sound where id='$film_sound_mixing_name_id'";
    $film_sound_mixing_name_data_exe = mysqli_query($con, $film_sound_mixing_name_data_query);
  
        $film_sound_mixing_name_name_read = mysqli_fetch_array($film_sound_mixing_name_data_exe);
        echo $film_sound_mixing_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                <tr>
                                               <th>Re-Recordist Mixer:</th>
                                               <td>
											    <?php
$film_re_recordist_mixer_name = explode(",", $row["film_re_recordist_mixer_name"]);

foreach ($film_re_recordist_mixer_name as $film_re_recordist_mixer_name_id) {
    $film_re_recordist_mixer_name_data_query = "select * from sound where id='$film_re_recordist_mixer_name_id'";
    $film_re_recordist_mixer_name_data_exe = mysqli_query($con, $film_re_recordist_mixer_name_data_query);
  
        $film_re_recordist_mixer_name_name_read = mysqli_fetch_array($film_re_recordist_mixer_name_data_exe);
        echo $film_re_recordist_mixer_name_name_read["name"],"<br/>";
    }

?>
											  </td>
                                               </tr>
                                             <tr>
                                               <th>Re-Recording Mix Technician:</th>
                                               <td>
											    <?php
$re_recording_mix_technician = explode(",", $row["re_recording_mix_technician"]);

foreach ($re_recording_mix_technician as $re_recording_mix_technician_id) {
    $re_recording_mix_technician_data_query = "select * from sound where id='$re_recording_mix_technician_id'";
    $re_recording_mix_technician_data_exe = mysqli_query($con, $re_recording_mix_technician_data_query);
  
        $re_recording_mix_technician_name_read = mysqli_fetch_array($re_recording_mix_technician_data_exe);
        echo $re_recording_mix_technician_name_read["name"],"<br/>";
    }

?>
											  </td>
                                               </tr>
                                          
                                               <tr>
                                               <th>Audio Mastering:</th>
                                               <td>
											    <?php
$film_audio_mastering_name = explode(",", $row["film_audio_mastering_name"]);

foreach ($film_audio_mastering_name as $film_audio_mastering_name_id) {
    $film_audio_mastering_name_data_query = "select * from sound where id='$film_audio_mastering_name_id'";
    $film_audio_mastering_name_data_exe = mysqli_query($con, $film_audio_mastering_name_data_query);
  
        $film_audio_mastering_name_name_read = mysqli_fetch_array($film_audio_mastering_name_data_exe);
        echo $film_audio_mastering_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                               
                                              
                                                     <tr>
                                               <th>Production Sound Mixer:</th>
                                               <td>
											    <?php
$film_production_sound_mixer_name = explode(",", $row["film_production_sound_mixer_name"]);

foreach ($film_production_sound_mixer_name as $film_production_sound_mixer_name_id) {
    $film_production_sound_mixer_name_data_query = "select * from sound where id='$film_production_sound_mixer_name_id'";
    $film_production_sound_mixer_name_data_exe = mysqli_query($con, $film_production_sound_mixer_name_data_query);
  
        $film_production_sound_mixer_name_name_read = mysqli_fetch_array($film_production_sound_mixer_name_data_exe);
        echo $film_production_sound_mixer_name_name_read["name"],"<br/>";
    }

?>
											   </td>
                                               </tr>
                                                <tr>
                                               <th>ADR Engineer:</th>
                                               <td>
											    <?php
$adr_engineer = explode(",", $row["adr_engineer"]);

foreach ($adr_engineer as $adr_engineer_id) {
    $adr_engineer_data_query = "select * from sound where id='$adr_engineer_id'";
    $adr_engineer_data_exe = mysqli_query($con, $adr_engineer_data_query);
  
        $adr_engineer_name_read = mysqli_fetch_array($adr_engineer_data_exe);
        echo $adr_engineer_name_read["name"],"<br/>";
    }

?>
											 </td>
                                               </tr>
                                               <tr>
                                               <th>ADR Mixer:</th>
                                               <td>
											    <?php
$adr_mixer = explode(",", $row["adr_mixer"]);

foreach ($adr_mixer as $adr_mixer_id) {
    $adr_mixer_data_query = "select * from sound where id='$adr_mixer_id'";
    $adr_mixer_data_exe = mysqli_query($con, $adr_mixer_data_query);
  
        $adr_mixer_name_read = mysqli_fetch_array($adr_mixer_data_exe);
        echo $adr_mixer_name_read["name"],"<br/>";
    }

?>
											  </td>
                                               </tr>
                                               <tr>
                                               <th>ADR Supervisor:</th>
                                               <td>
											    <?php
$adr_supervisor = explode(",", $row["adr_supervisor"]);

foreach ($adr_supervisor as $adr_supervisor_id) {
    $adr_supervisor_data_query = "select * from sound where id='$adr_supervisor_id'";
    $adr_supervisor_data_exe = mysqli_query($con, $adr_supervisor_data_query);
  
        $adr_supervisor_name_read = mysqli_fetch_array($adr_supervisor_data_exe);
        echo $adr_supervisor_name_read["name"],"<br/>";
    }

?>
											  </td>
                                               </tr>
                                               <tr>
                                               <th>Dolby Mix:</th>
                                               <td>
											    <?php
$dolby_mix = explode(",", $row["dolby_mix"]);

foreach ($dolby_mix as $dolby_mix_id) {
    $dolby_mix_data_query = "select * from sound where id='$dolby_mix_id'";
    $dolby_mix_data_exe = mysqli_query($con, $dolby_mix_data_query);
  
        $dolby_mix_name_read = mysqli_fetch_array($dolby_mix_data_exe);
        echo $dolby_mix_name_read["name"],"<br/>";
    }

?>
											  </td>
                                               </tr>
                                           <tr>
                                               <th>First Assistant Sound:</th>
                                               <td>
											    <?php
$first_assistant_sound = explode(",", $row["first_assistant_sound"]);

foreach ($first_assistant_sound as $first_assistant_sound_id) {
    $first_assistant_sound_data_query = "select * from sound where id='$first_assistant_sound_id'";
    $first_assistant_sound_data_exe = mysqli_query($con, $first_assistant_sound_data_query);
  
        $first_assistant_sound_name_read = mysqli_fetch_array($first_assistant_sound_data_exe);
        echo $first_assistant_sound_name_read["name"],"<br/>";
    }

?>
											  </td>
                                               </tr>
                                             <tr>
                                               <th>Second Assistant Sound:</th>
                                               <td>
											    <?php
$second_assistant_sound = explode(",", $row["second_assistant_sound"]);

foreach ($second_assistant_sound as $second_assistant_sound_id) {
    $second_assistant_sound_data_query = "select * from sound where id='$second_assistant_sound_id'";
    $second_assistant_sound_data_exe = mysqli_query($con, $second_assistant_sound_data_query);
  
        $second_assistant_sound_name_read = mysqli_fetch_array($second_assistant_sound_data_exe);
        echo $second_assistant_sound_name_read["name"],"<br/>";
    }

?>
											  </td>
                                               </tr>
                                                 <tr>
                                               <th>Sound Trainee:</th>
                                               <td>
											    <?php
$sound_trainee = explode(",", $row["sound_trainee"]);

foreach ($sound_trainee as $sound_trainee_id) {
    $sound_trainee_data_query = "select * from sound where id='$sound_trainee_id'";
    $sound_trainee_data_exe = mysqli_query($con, $sound_trainee_data_query);
  
        $sound_trainee_name_read = mysqli_fetch_array($sound_trainee_data_exe);
        echo $sound_trainee_name_read["name"],"<br/>";
    }

?>
											  </td>
                                               </tr>
                                                <tr>
                                               <th>Audiography:</th>
                                               <td>
											    <?php
$audiography = explode(",", $row["audiography"]);

foreach ($audiography as $audiography_id) {
    $audiography_data_query = "select * from sound where id='$audiography_id'";
    $audiography_data_exe = mysqli_query($con, $audiography_data_query);
  
        $audiography_name_read = mysqli_fetch_array($audiography_data_exe);
        echo $audiography_name_read["name"],"<br/>";
    }

?>
											  </td>
                                               </tr>
                                            </table>
                                         
                                          
                                       </td>
                                       <td>
                                         
                                          <a href="edit_film_sound.php?id=<? echo $row['id'];?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
                                          <a  href="delete_film_sound.php?delete=<? echo $row['id'];?>" onclick="return del();" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
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

