<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      $id=$_GET["id"];
      $record="select * from film_costumes_management_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
	     $film_id=$read["film_id"];	
      ?>
      
<?
if($_POST["edit_film_costume_management"]) { 
    
    
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']); 
    $film_costume_designer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_costume_designer_name']));
    $costume_associate= mysqli_real_escape_string($con,implode(",",$_POST['costume_associate']));
    $film_assistant_costume_designer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_assistant_costume_designer_name']));
    $film_wardrobe_supervisor_name= mysqli_real_escape_string($con,implode(",",$_POST['film_wardrobe_supervisor_name']));
    $costumer= mysqli_real_escape_string($con,implode(",",$_POST['costumer']));
    $set_costumer= mysqli_real_escape_string($con,implode(",",$_POST['set_costumer']));
    $costume_maker= mysqli_real_escape_string($con,implode(",",$_POST['costume_maker']));
    $concept_costume_artist= mysqli_real_escape_string($con,implode(",",$_POST['concept_costume_artist']));
    $costume_fitter= mysqli_real_escape_string($con,implode(",",$_POST['costume_fitter']));
    $costume_buyer= mysqli_real_escape_string($con,implode(",",$_POST['costume_buyer']));
    $costume_attendant= mysqli_real_escape_string($con,implode(",",$_POST['costume_attendant']));
    $stylist= mysqli_real_escape_string($con,implode(",",$_POST['stylist']));





    $film_makeup="update film_costumes_management_allot set film_id='$film_id',costume_associate='$costume_associate',film_costume_designer_name='$film_costume_designer_name',film_assistant_costume_designer_name='$film_assistant_costume_designer_name',film_wardrobe_supervisor_name='$film_wardrobe_supervisor_name',costumer='$costumer',set_costumer='$set_costumer',costume_maker='$costume_maker',concept_costume_artist='$concept_costume_artist',costume_fitter='$costume_fitter',costume_buyer='$costume_buyer',costume_attendant='$costume_attendant',stylist='$stylist' where id='$id'";
mysqli_query($con,$film_makeup) or die(mysqli_error($con));
  
         echo "<script>alert('Film Sound Management Updated Succesfully')</script>";
   echo "<script>window.location.href='film_costumes_management.php'</script>";
         }
         ?>
         
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Costume Management</title>
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
                  <h1>Film Costume Management</h1>
                  <small>Edit Film Costume</small>
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
                                 <h4>Edit Film Costume Management Here</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                             <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                  
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
                                 <label>Costume Designer</label>
                             <select name="film_costume_designer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_costume_designer_name=explode(",",$read["film_costume_designer_name"]);
                                     foreach($film_costume_designer_name as $costume_designer_name){
									 $costume_designer_name_data_query="select * from costumes where id='$costume_designer_name'";
										 $costume_designer_name_data_exe=mysqli_query($con,$costume_designer_name_data_query);
										 $costume_designer_name_name_read=mysqli_fetch_array($costume_designer_name_data_exe);
                                     ?>
                                     <option value="<?php echo $costume_designer_name_name_read['id'] ?>" selected><?php echo $costume_designer_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from costumes order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                <div class="form-group">
                                 <label>Associate Costume Designer</label>
                             <select name="costume_associate[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $costume_associate=explode(",",$read["costume_associate"]);
                                     foreach($costume_associate as $costume_associate1){
									 $costume_associate1_data_query="select * from costumes where id='$costume_associate1'";
										 $costume_associate1_data_exe=mysqli_query($con,$costume_associate1_data_query);
										 $costume_associate1_name_read=mysqli_fetch_array($costume_associate1_data_exe);
                                     ?>
                                     <option value="<?php echo $costume_associate1_name_read['id'] ?>" selected><?php echo $costume_associate1_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from costumes order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                            
                               <div class="form-group">
                                 <label>Assistant Costume Designer</label>
                             <select name="film_assistant_costume_designer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_assistant_costume_designer_name=explode(",",$read["film_assistant_costume_designer_name"]);
                                     foreach($film_assistant_costume_designer_name as $assistant_costume_designer_name){
									  $assistant_costume_designer_name_data_query="select * from costumes where id='$assistant_costume_designer_name'";
										 $assistant_costume_designer_name_data_exe=mysqli_query($con,$assistant_costume_designer_name_data_query);
										 $assistant_costume_designer_name_name_read=mysqli_fetch_array($assistant_costume_designer_name_data_exe);
                                     ?>
                                     <option value="<?php echo $assistant_costume_designer_name_name_read['id'] ?>" selected><?php echo $assistant_costume_designer_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from costumes order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   
                                    <div class="form-group">
                                 <label>Wardrobe Supervisor/Costume Supervisor </label>
                             <select name="film_wardrobe_supervisor_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_wardrobe_supervisor_name=explode(",",$read["film_wardrobe_supervisor_name"]);
                                     foreach($film_wardrobe_supervisor_name as $wardrobe_supervisor_name){
									   $wardrobe_supervisor_name_data_query="select * from costumes where id='$wardrobe_supervisor_name'";
										 $wardrobe_supervisor_name_data_exe=mysqli_query($con,$wardrobe_supervisor_name_data_query);
										 $wardrobe_supervisor_name_name_read=mysqli_fetch_array($wardrobe_supervisor_name_data_exe);
                                     ?>
                                     <option value="<?php echo $wardrobe_supervisor_name_name_read['id'] ?>" selected><?php echo $wardrobe_supervisor_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from costumes order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Stylist</label>
                             <select name="stylist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $stylist=explode(",",$read["stylist"]);
                                     foreach($stylist as $stylist){
									   $stylist_data_query="select * from costumes where id='$stylist'";
										 $stylist_data_exe=mysqli_query($con,$stylist_data_query);
										 $stylist_name_read=mysqli_fetch_array($stylist_data_exe);
                                     ?>
                                     <option value="<?php echo $stylist_name_read['id'] ?>" selected><?php echo $stylist_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from costumes order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Costumer</label>
                             <select name="costumer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $costumer=explode(",",$read["costumer"]);
                                     foreach($costumer as $costumer){
									   $costumer_data_query="select * from costumes where id='$costumer'";
										 $costumer_data_exe=mysqli_query($con,$costumer_data_query);
										 $costumer_name_read=mysqli_fetch_array($costumer_data_exe);
                                     ?>
                                     <option value="<?php echo $costumer_name_read['id'] ?>" selected><?php echo $costumer_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from costumes order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                  <div class="form-group">
                                 <label>Set Costumer</label>
                             <select name="set_costumer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $set_costumer=explode(",",$read["set_costumer"]);
                                     foreach($set_costumer as $set_costumer){
									   $set_costumer_data_query="select * from costumes where id='$set_costumer'";
										 $set_costumer_data_exe=mysqli_query($con,$set_costumer_data_query);
										 $set_costumer_name_read=mysqli_fetch_array($set_costumer_data_exe);
                                     ?>
                                     <option value="<?php echo $set_costumer_name_read['id'] ?>" selected><?php echo $set_costumer_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from costumes order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Costume Maker</label>
                             <select name="costume_maker[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $costume_maker=explode(",",$read["costume_maker"]);
                                     foreach($costume_maker as $costume_maker){
									   $costume_maker_data_query="select * from costumes where id='$costume_maker'";
										 $costume_maker_data_exe=mysqli_query($con,$costume_maker_data_query);
										 $costume_maker_name_read=mysqli_fetch_array($costume_maker_data_exe);
                                     ?>
                                     <option value="<?php echo $costume_maker_name_read['id'] ?>" selected><?php echo $costume_maker_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from costumes order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>                            
                                    <div class="form-group">
                                 <label>Concept Costume Artist</label>
                             <select name="concept_costume_artist[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $concept_costume_artist=explode(",",$read["concept_costume_artist"]);
                                     foreach($concept_costume_artist as $concept_costume_artist){
									   $concept_costume_artist_data_query="select * from costumes where id='$concept_costume_artist'";
										 $concept_costume_artist_data_exe=mysqli_query($con,$concept_costume_artist_data_query);
										 $concept_costume_artist_name_read=mysqli_fetch_array($concept_costume_artist_data_exe);
                                     ?>
                                     <option value="<?php echo $concept_costume_artist_name_read['id'] ?>" selected><?php echo $concept_costume_artist_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from costumes order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Costume Fitter</label>
                             <select name="costume_fitter[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $costume_fitter=explode(",",$read["costume_fitter"]);
                                     foreach($costume_fitter as $costume_fitter){
									   $costume_fitter_data_query="select * from costumes where id='$costume_fitter'";
										 $costume_fitter_data_exe=mysqli_query($con,$costume_fitter_data_query);
										 $costume_fitter_name_read=mysqli_fetch_array($costume_fitter_data_exe);
                                     ?>
                                     <option value="<?php echo $costume_fitter_name_read['id'] ?>" selected><?php echo $costume_fitter_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from costumes order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Costume Buyer</label>
                             <select name="costume_buyer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $costume_buyer=explode(",",$read["costume_buyer"]);
                                     foreach($costume_buyer as $costume_buyer){
									   $costume_buyer_data_query="select * from costumes where id='$costume_buyer'";
										 $costume_buyer_data_exe=mysqli_query($con,$costume_buyer_data_query);
										 $costume_buyer_name_read=mysqli_fetch_array($costume_buyer_data_exe);
                                     ?>
                                     <option value="<?php echo $costume_buyer_name_read['id'] ?>" selected><?php echo $costume_buyer_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from costumes order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                 <div class="form-group">
                                 <label>Costume Attendant</label>
                             <select name="costume_attendant[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $costume_attendant=explode(",",$read["costume_attendant"]);
                                     foreach($costume_attendant as $costume_attendant){
									   $costume_attendant_data_query="select * from costumes where id='$costume_attendant'";
										 $costume_attendant_data_exe=mysqli_query($con,$costume_attendant_data_query);
										 $costume_attendant_name_read=mysqli_fetch_array($costume_attendant_data_exe);
                                     ?>
                                     <option value="<?php echo $costume_attendant_name_read['id'] ?>" selected><?php echo $costume_attendant_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from costumes order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                 
     

              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="edit_film_costume_management"  class="btn btn-add"  value="Update Film Costume Manegement">
                            
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

