<?
session_start();
include "config.php";
  $id=$_GET["id"];
if($_SESSION['admin']==""){
     header("location:index.php");
      }
    
      $record="select * from film_music_directors_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
      ?>
<?
if($_POST["update_music_directos"]) { 
    
    
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']); 
    $music_director= mysqli_real_escape_string($con,implode(",",$_POST['music_director']));
    $music_background_scorer= mysqli_real_escape_string($con,implode(",",$_POST['music_background_scorer']));
    $music_producer= mysqli_real_escape_string($con,implode(",",$_POST['music_producer']));
    $lyricist= mysqli_real_escape_string($con,implode(",",$_POST['lyricist']));
    $additional_lyrics= mysqli_real_escape_string($con,implode(",",$_POST['additional_lyrics']));
    $rap= mysqli_real_escape_string($con,implode(",",$_POST['rap']));
    $playback_singer= mysqli_real_escape_string($con,implode(",",$_POST['playback_singer']));
    $music_label= mysqli_real_escape_string($con,implode(",",$_POST['music_label']));
     $music_supervisor= mysqli_real_escape_string($con,implode(",",$_POST['music_supervisor']));
    $music_arranger= mysqli_real_escape_string($con,implode(",",$_POST['music_arranger']));
    $music_editor= mysqli_real_escape_string($con,implode(",",$_POST['music_editor']));
    $music_coordinator= mysqli_real_escape_string($con,implode(",",$_POST['music_coordinator']));

   $film_music_directors="update film_music_directors_allot set film_id='$film_id',music_director='$music_director',music_background_scorer='$music_background_scorer',music_producer='$music_producer',lyricist='$lyricist',additional_lyrics='$additional_lyrics',rap='$rap',playback_singer='$playback_singer',music_label='$music_label',music_supervisor='$music_supervisor',music_arranger='$music_arranger',music_editor='$music_editor',music_coordinator='$music_coordinator' where id='$id'";
mysqli_query($con,$film_music_directors) or die(mysqli_error($con));
  
         echo "<script>alert('Film Music Directors Updated Succesfully')</script>";
  echo "<script>window.location.href='film_music_directors_management.php'</script>";
         }
         ?>
         
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Directors</title>
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
                  <h1>Film Music Director Management</h1>
                  <small>Edit Film Music Director</small>
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
                                 <h4>Edit Film Music Director Here</h4>
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

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (Year:<? echo $rowfr['year_release']; ?> Language:<? echo $lang_name; ?>)</option>
                                  <? } ?>
                                 </select>
                                  
                             
                              </div>
                              <div class="form-group">
                                 <label>Film Music Director</label>
                                 <select name="music_director[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                    echo $music_director=explode(",",$read["music_director"]);
                                     foreach($music_director as $music_director_name){
										$music_director_data_query="select * from music_director where id='$music_director_name'";
										 $music_director_data_exe=mysqli_query($con,$music_director_data_query);
										 $music_director_name_read=mysqli_fetch_array($music_director_data_exe);
                                     ?>
                                     <option value="<?php echo $music_director_name_read['id'] ?>" selected><?php echo $music_director_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                            
                               <div class="form-group">
                                 <label>Film Background Scorer</label>
<select name="music_background_scorer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $music_background_scorer=explode(",",$read["music_background_scorer"]);
                                     foreach($music_background_scorer as $music_background_scorer_name){
										$music_background_scorer_data_query="select * from music_director where id='$music_background_scorer_name'";
										 $music_background_scorer_data_exe=mysqli_query($con,$music_background_scorer_data_query);
										 $music_background_scorer_name_read=mysqli_fetch_array($music_background_scorer_data_exe);
                                     ?>
                                     <option value="<?php echo $music_background_scorer_name_read['id'] ?>" selected><?php echo $music_background_scorer_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                  <div class="form-group">  
                                 <label>Film Composer</label>             
  <select name="music_producer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $music_producer=explode(",",$read["music_producer"]);
                                     foreach($music_producer as $music_producer_name){
										 $music_producer_data_query="select * from music_director where id='$music_producer_name'";
										 $music_producer_data_exe=mysqli_query($con,$music_producer_data_query);
										 $music_producer_name_read=mysqli_fetch_array($music_producer_data_exe);
                                     ?>
                                     <option value="<?php echo $music_producer_name_read['id'] ?>" selected><?php echo $music_producer_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                  <div class="form-group">  
                                 <label>Music Supervisor</label> 
                                <select name="music_supervisor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $music_supervisor=explode(",",$read["music_supervisor"]);
                                     foreach($music_supervisor as $music_supervisor_name){
                                         $music_supervisor_data_query="select * from music_director where id='$music_supervisor_name'";
										 $music_supervisor_data_exe=mysqli_query($con,$music_supervisor_data_query);
										 $music_supervisor_read=mysqli_fetch_array($music_supervisor_data_exe);
                                     ?>
                                     <option value="<?php echo $music_supervisor_read['id'] ?>" selected><?php echo $music_supervisor_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from music_director order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                 <div class="form-group">  
                                 <label>Music Arranger</label> 
                                <select name="music_arranger[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $music_arranger=explode(",",$read["music_arranger"]);
                                     foreach($music_arranger as $music_arranger_name){
                                         $music_arranger_data_query="select * from singer where id='$music_arranger_name'";
										 $music_arranger_data_exe=mysqli_query($con,$music_arranger_data_query);
										 $music_arranger_read=mysqli_fetch_array($music_arranger_data_exe);
                                     ?>
                                     <option value="<?php echo $music_arranger_read['id'] ?>" selected><?php echo $music_arranger_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from singer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                 <div class="form-group">  
                                 <label>Music Editor</label> 
                                <select name="music_editor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $music_editor=explode(",",$read["music_editor"]);
                                     foreach($music_editor as $music_editor_name){
                                         $music_editor_data_query="select * from singer where id='$music_editor_name'";
										 $music_editor_data_exe=mysqli_query($con,$music_editor_data_query);
										 $music_editor_read=mysqli_fetch_array($music_editor_data_exe);
                                     ?>
                                     <option value="<?php echo $music_editor_read['id'] ?>" selected><?php echo $music_editor_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from singer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                  <div class="form-group">  
                                 <label>Film Lyricist Director</label> 
                                 <select name="lyricist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $lyricist=explode(",",$read["lyricist"]);
                                     foreach($lyricist as $lyricist_name){
										$lyricist_data_query="select * from lyricist where id='$lyricist_name'";
										 $lyricist_data_exe=mysqli_query($con,$lyricist_data_query);
										 $lyricist_name_read=mysqli_fetch_array($lyricist_data_exe);
                                     ?>
                                     <option value="<?php echo $lyricist_name_read['id'] ?>" selected><?php echo $lyricist_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from lyricist order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                 <div class="form-group">  
                                 <label>Film Playback Singer</label> 
                                <select name="playback_singer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $playback_singer=explode(",",$read["playback_singer"]);
                                     foreach($playback_singer as $playback_singer_name){
                                         $playback_singer_data_query="select * from singer where id='$playback_singer_name'";
										 $playback_singer_data_exe=mysqli_query($con,$playback_singer_data_query);
										 $playback_singer_name_read=mysqli_fetch_array($playback_singer_data_exe);
                                     ?>
                                     <option value="<?php echo $playback_singer_name_read['id'] ?>" selected><?php echo $playback_singer_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from singer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
								 
								 
								 
                                  <div class="form-group">  
                                 <label>Additional Lyrics</label> 
                                 <select name="additional_lyrics[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                     <?php 
                                     $additional_lyrics=explode(",",$read["additional_lyrics"]);
                                     foreach($additional_lyrics as $additional_lyrics_name){
										$additional_lyrics_data_query="select * from lyricist where id='$additional_lyrics_name'";
										 $additional_lyrics_data_exe=mysqli_query($con,$additional_lyrics_data_query);
										 $additional_lyrics_name_read=mysqli_fetch_array($additional_lyrics_data_exe);
                                     ?>
                                     <option value="<?php echo $additional_lyrics_name_read['id'] ?>" selected><?php echo $additional_lyrics_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from lyricist order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                  <div class="form-group">  
                                 <label>Film Rap</label> 
                                <select name="rap[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $rap=explode(",",$read["rap"]);
                                     foreach($rap as $rap_name){
										$rap_data_query="select * from lyricist where id='$rap_name'";
										 $rap_data_exe=mysqli_query($con,$rap_data_query);
										 $rap_name_read=mysqli_fetch_array($rap_data_exe);
                                     ?>
                                     <option value="<?php echo $rap_name_read['id'] ?>" selected><?php echo $rap_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from lyricist order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){
									
									  
									  ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
								 
								 
                                  
                                  <div class="form-group">  
                                 <label>Film Music Label</label> 
                                <select name="music_label[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $music_label=explode(",",$read["music_label"]);
                                     foreach($music_label as $music_label_name){
										 $music_label_data_query="select * from music_label where id='$music_label_name'";
										 $music_label_data_exe=mysqli_query($con,$music_label_data_query);
										 $music_label_name_read=mysqli_fetch_array($music_label_data_exe);
                                     ?>
                                     <option value="<?php echo $music_label_name_read['id'] ?>" selected><?php echo $music_label_name_read['music_label'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from music_label order by music_label");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['music_label']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
                                <div class="form-group">  
                                 <label>Music Coordinator</label> 
                                <select name="music_coordinator[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                    <?php 
                                     $music_coordinator=explode(",",$read["music_coordinator"]);
                                     foreach($music_coordinator as $music_coordinator_name){
                                         $music_coordinator_data_query="select * from singer where id='$music_coordinator_name'";
										 $music_coordinator_data_exe=mysqli_query($con,$music_coordinator_data_query);
										 $music_coordinator_read=mysqli_fetch_array($music_coordinator_data_exe);
                                     ?>
                                     <option value="<?php echo $music_coordinator_read['id'] ?>" selected><?php echo $music_coordinator_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from singer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                 </div>
     

              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="update_music_directos"  class="btn btn-add"  value="Update Music Directos">
                            
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

