<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      $id=$_GET["id"];
      $record="select * from film_cinematographer_management_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
	   $film_id=$read["film_id"];
      ?>
      
<?
if($_POST["edit_film_cinematographer_management"]) { 
    
    
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']); 
    $film_cinematographer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_cinematographer_name']));
    $film_director_of_photography_name= mysqli_real_escape_string($con,implode(",",$_POST['film_director_of_photography_name']));
    $film_associate_cinematographer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_associate_cinematographer_name']));
    $film_assistant_cinematographer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_assistant_cinematographer_name']));
    $aerial_cinematography= mysqli_real_escape_string($con,implode(",",$_POST['aerial_cinematography']));
    $drone_operator= mysqli_real_escape_string($con,implode(",",$_POST['drone_operator']));
    $focus_puller= mysqli_real_escape_string($con,implode(",",$_POST['focus_puller']));
    $camera_operator= mysqli_real_escape_string($con,implode(",",$_POST['camera_operator']));
    $steadicam_operator= mysqli_real_escape_string($con,implode(",",$_POST['steadicam_operator']));
    $digital_imaging_technician= mysqli_real_escape_string($con,implode(",",$_POST['digital_imaging_technician']));
    $gaffer= mysqli_real_escape_string($con,implode(",",$_POST['gaffer']));
    $grip= mysqli_real_escape_string($con,implode(",",$_POST['grip']));
    $assistant_camera= mysqli_real_escape_string($con,implode(",",$_POST['assistant_camera']));




    $film_makeup="update film_cinematographer_management_allot set film_id='$film_id',film_cinematographer_name='$film_cinematographer_name',film_director_of_photography_name='$film_director_of_photography_name',film_associate_cinematographer_name='$film_associate_cinematographer_name',film_assistant_cinematographer_name='$film_assistant_cinematographer_name',aerial_cinematography='$aerial_cinematography',drone_operator='$drone_operator',focus_puller='$focus_puller',camera_operator='$camera_operator',steadicam_operator='$steadicam_operator',digital_imaging_technician='$digital_imaging_technician',gaffer='$gaffer',grip='$grip',assistant_camera='$assistant_camera' where id='$id'";
mysqli_query($con,$film_makeup) or die(mysqli_error($con));
  
         echo "<script>alert('Film Cinematographer Management Updated Succesfully')</script>";
   echo "<script>window.location.href='film_cinematographer_management.php'</script>";
         }
         ?>
         
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Cinematographer Management</title>
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
                  <h1>Film Cinematographer Management</h1>
                  <small>Edit Film Cinematographer</small>
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
                                 <h4>Edit Film Cinematographer Here</h4>
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
                                 <label>Cinematographer</label>
                             <select name="film_cinematographer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_cinematographer_name=explode(",",$read["film_cinematographer_name"]);
                                     foreach($film_cinematographer_name as $cinematographer_name){
									 $cinematographer_name_data_query="select * from cinematographer where id='$cinematographer_name'";
										 $cinematographer_name_data_exe=mysqli_query($con,$cinematographer_name_data_query);
										 $cinematographer_name_name_read=mysqli_fetch_array($cinematographer_name_data_exe);
                                     ?>
                                     <option value="<?php echo $cinematographer_name_name_read['id'] ?>" selected><?php echo $cinematographer_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                            
                               <div class="form-group">
                                 <label>Director of Photography</label>
                             <select name="film_director_of_photography_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_director_of_photography_name=explode(",",$read["film_director_of_photography_name"]);
                                     foreach($film_director_of_photography_name as $director_of_photography_name){
									 $director_of_photography_name_data_query="select * from cinematographer where id='$director_of_photography_name'";
										 $director_of_photography_name_data_exe=mysqli_query($con,$director_of_photography_name_data_query);
										 $director_of_photography_name_name_read=mysqli_fetch_array($director_of_photography_name_data_exe);
                                     ?>
                                     <option value="<?php echo $director_of_photography_name_name_read['id'] ?>" selected><?php echo $director_of_photography_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   
                                    <div class="form-group">
                                 <label>Associate Cinematographer</label>
                             <select name="film_associate_cinematographer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_associate_cinematographer_name=explode(",",$read["film_associate_cinematographer_name"]);
                                     foreach($film_associate_cinematographer_name as $associate_cinematographer_name){
									 $associate_cinematographer_name_data_query="select * from cinematographer where id='$associate_cinematographer_name'";
										 $associate_cinematographer_name_data_exe=mysqli_query($con,$associate_cinematographer_name_data_query);
										 $associate_cinematographer_name_name_read=mysqli_fetch_array($associate_cinematographer_name_data_exe);
                                     ?>
                                     <option value="<?php echo $associate_cinematographer_name_name_read['id'] ?>" selected><?php echo $associate_cinematographer_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   
                                   <div class="form-group">
                                 <label>Assistant Cinematographer</label>
                             <select name="film_assistant_cinematographer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_assistant_cinematographer_name=explode(",",$read["film_assistant_cinematographer_name"]);
                                     foreach($film_assistant_cinematographer_name as $assistant_cinematographer_name){
									 $assistant_cinematographer_name_data_query="select * from cinematographer where id='$assistant_cinematographer_name'";
										 $assistant_cinematographer_name_data_exe=mysqli_query($con,$assistant_cinematographer_name_data_query);
										 $assistant_cinematographer_name_name_read=mysqli_fetch_array($assistant_cinematographer_name_data_exe);
                                     ?>
                                     <option value="<?php echo $assistant_cinematographer_name_name_read['id'] ?>" selected><?php echo $assistant_cinematographer_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Aerial Cinematography</label>
                             <select name="aerial_cinematography[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $aerial_cinematography=explode(",",$read["aerial_cinematography"]);
                                     foreach($aerial_cinematography as $aerial_cinematography){
									 $aerial_cinematography_data_query="select * from cinematographer where id='$aerial_cinematography'";
										 $aerial_cinematography_data_exe=mysqli_query($con,$aerial_cinematography_data_query);
										 $aerial_cinematography_name_read=mysqli_fetch_array($aerial_cinematography_data_exe);
                                     ?>
                                     <option value="<?php echo $aerial_cinematography_name_read['id'] ?>" selected><?php echo $aerial_cinematography_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                  <div class="form-group">
                                 <label>Drone Operator</label>
                             <select name="drone_operator[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $drone_operator=explode(",",$read["drone_operator"]);
                                     foreach($drone_operator as $drone_operator){
									 $drone_operator_data_query="select * from cinematographer where id='$drone_operator'";
										 $drone_operator_data_exe=mysqli_query($con,$drone_operator_data_query);
										 $drone_operator_name_read=mysqli_fetch_array($drone_operator_data_exe);
                                     ?>
                                     <option value="<?php echo $drone_operator_name_read['id'] ?>" selected><?php echo $drone_operator_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>   
                                  <div class="form-group">
                                 <label>Focus Operator</label>
                             <select name="focus_puller[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $focus_puller=explode(",",$read["focus_puller"]);
                                     foreach($focus_puller as $focus_puller){
									 $focus_puller_data_query="select * from cinematographer where id='$focus_puller'";
										 $focus_puller_data_exe=mysqli_query($con,$focus_puller_data_query);
										 $focus_puller_name_read=mysqli_fetch_array($focus_puller_data_exe);
                                     ?>
                                     <option value="<?php echo $focus_puller_name_read['id'] ?>" selected><?php echo $focus_puller_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>  
                                 <div class="form-group">
                                 <label>Camera Operator</label>
                             <select name="camera_operator[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $camera_operator=explode(",",$read["camera_operator"]);
                                     foreach($camera_operator as $camera_operator){
									 $camera_operator_data_query="select * from cinematographer where id='$camera_operator'";
										 $camera_operator_data_exe=mysqli_query($con,$camera_operator_data_query);
										 $camera_operator_name_read=mysqli_fetch_array($camera_operator_data_exe);
                                     ?>
                                     <option value="<?php echo $camera_operator_name_read['id'] ?>" selected><?php echo $camera_operator_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Assistant Camera</label>
                             <select name="assistant_camera[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $assistant_camera=explode(",",$read["assistant_camera"]);
                                     foreach($assistant_camera as $assistant_camera){
									 $assistant_camera_data_query="select * from cinematographer where id='$assistant_camera'";
										 $assistant_camera_data_exe=mysqli_query($con,$assistant_camera_data_query);
										 $assistant_camera_name_read=mysqli_fetch_array($assistant_camera_data_exe);
                                     ?>
                                     <option value="<?php echo $assistant_camera_name_read['id'] ?>" selected><?php echo $assistant_camera_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                  <div class="form-group">
                                 <label>Steadicam Operator</label>
                             <select name="steadicam_operator[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $steadicam_operator=explode(",",$read["steadicam_operator"]);
                                     foreach($steadicam_operator as $steadicam_operator){
									 $steadicam_operator_data_query="select * from cinematographer where id='$steadicam_operator'";
										 $steadicam_operator_data_exe=mysqli_query($con,$steadicam_operator_data_query);
										 $steadicam_operator_name_read=mysqli_fetch_array($steadicam_operator_data_exe);
                                     ?>
                                     <option value="<?php echo $steadicam_operator_name_read['id'] ?>" selected><?php echo $steadicam_operator_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                 <div class="form-group">
                                 <label>Digital Imaging Technician</label>
                             <select name="digital_imaging_technician[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $digital_imaging_technician=explode(",",$read["digital_imaging_technician"]);
                                     foreach($digital_imaging_technician as $digital_imaging_technician){
									 $digital_imaging_technician_data_query="select * from cinematographer where id='$digital_imaging_technician'";
										 $digital_imaging_technician_data_exe=mysqli_query($con,$digital_imaging_technician_data_query);
										 $digital_imaging_technician_name_read=mysqli_fetch_array($digital_imaging_technician_data_exe);
                                     ?>
                                     <option value="<?php echo $digital_imaging_technician_name_read['id'] ?>" selected><?php echo $digital_imaging_technician_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Gaffer</label>
                             <select name="gaffer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $gaffer=explode(",",$read["gaffer"]);
                                     foreach($gaffer as $gaffer){
									 $gaffer_data_query="select * from cinematographer where id='$gaffer'";
										 $gaffer_data_exe=mysqli_query($con,$gaffer_data_query);
										 $gaffer_name_read=mysqli_fetch_array($gaffer_data_exe);
                                     ?>
                                     <option value="<?php echo $gaffer_name_read['id'] ?>" selected><?php echo $gaffer_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Grip</label>
                             <select name="grip[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $grip=explode(",",$read["grip"]);
                                     foreach($grip as $grip){
									 $grip_data_query="select * from cinematographer where id='$grip'";
										 $grip_data_exe=mysqli_query($con,$grip_data_query);
										 $grip_name_read=mysqli_fetch_array($grip_data_exe);
                                     ?>
                                     <option value="<?php echo $grip_name_read['id'] ?>" selected><?php echo $grip_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from cinematographer order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="edit_film_cinematographer_management"  class="btn btn-add"  value="Update Film Cinematographer ">
                            
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

