<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      $id=$_GET["id"];
      $record="select * from film_additional_contributors_management_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
	  $film_id=$read["film_id"];
      ?>
      
<?
if($_POST["edit_film_additional_contributors"]) { 
    
    
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']);
    $digial_intermediate= mysqli_real_escape_string($con,implode(",",$_POST['digial_intermediate']));
    $film_publicity_designer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_publicity_designer_name']));
    $film_public_relation_officer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_public_relation_officer_name']));
    $film_colourist_name= mysqli_real_escape_string($con,implode(",",$_POST['film_colourist_name']));
    $film_still_photographer_name= mysqli_real_escape_string($con,implode(",",$_POST['film_still_photographer_name']));
    $di_supervisor= mysqli_real_escape_string($con,implode(",",$_POST['di_supervisor']));
     $colorist_assistant= mysqli_real_escape_string($con,implode(",",$_POST['colorist_assistant']));
    $conformer= mysqli_real_escape_string($con,implode(",",$_POST['conformer']));






    $film_makeup="update film_additional_contributors_management_allot set film_id='$film_id',digial_intermediate='$digial_intermediate',film_publicity_designer_name='$film_publicity_designer_name',film_public_relation_officer_name='$film_public_relation_officer_name',film_colourist_name='$film_colourist_name',film_still_photographer_name='$film_still_photographer_name',di_supervisor='$di_supervisor',colorist_assistant='$colorist_assistant',conformer='$conformer' where id='$id'";
mysqli_query($con,$film_makeup) or die(mysqli_error($con));
  
         echo "<script>alert('Film Additional Contributors Management Updated Succesfully')</script>";
   echo "<script>window.location.href='film_additional_contributors_management.php'</script>";
         }
         ?>
         
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Additional Contributors Management</title>
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
                  <h1>Film Additional Contributors Management</h1>
                  <small>Edit Film Additional Contributors</small>
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
                                 <h4>Edit Film Additional Contributors Here</h4>
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
                                 <label>Digital Intermediate</label>
                             <select name="digial_intermediate[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $digial_intermediate=explode(",",$read["digial_intermediate"]);
                                     foreach($digial_intermediate as $digial_intermediate1){
									 $digial_intermediate1_data_query="select * from additionalcontributors where id='$digial_intermediate1'";
										 $digial_intermediate1_data_exe=mysqli_query($con,$digial_intermediate1_data_query);
										 $digial_intermediate1_name_read=mysqli_fetch_array($digial_intermediate1_data_exe);
                                     ?>
                                     <option value="<?php echo $digial_intermediate1_name_read['id'] ?>" selected><?php echo $digial_intermediate1_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from additionalcontributors order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>

                              <div class="form-group">
                                 <label>Publicity Designer</label>
                             <select name="film_publicity_designer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_publicity_designer_name=explode(",",$read["film_publicity_designer_name"]);
                                     foreach($film_publicity_designer_name as $publicity_designer_name){
										 $publicity_designer_name_data_query="select * from additionalcontributors where id='$publicity_designer_name'";
										 $publicity_designer_name_data_exe=mysqli_query($con,$publicity_designer_name_data_query);
										 $publicity_designer_name_name_read=mysqli_fetch_array($publicity_designer_name_data_exe);
                                     ?>
                                     <option value="<?php echo $publicity_designer_name_name_read['id'] ?>" selected><?php echo $publicity_designer_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from additionalcontributors order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                             <div class="form-group">
                                 <label>Colourist</label>
                             <select name="film_colourist_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_colourist_name=explode(",",$read["film_colourist_name"]);
                                     foreach($film_colourist_name as $colourist_name){
									 $colourist_name_data_query="select * from additionalcontributors where id='$colourist_name'";
										 $colourist_name_data_exe=mysqli_query($con,$colourist_name_data_query);
										 $colourist_name_name_read=mysqli_fetch_array($colourist_name_data_exe);
                                     ?>
                                     <option value="<?php echo $colourist_name_name_read['id'] ?>" selected><?php echo $colourist_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from additionalcontributors order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                  <div class="form-group">
                                 <label>DI Supervisor</label>
                             <select name="di_supervisor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $di_supervisor=explode(",",$read["di_supervisor"]);
                                     foreach($di_supervisor as $di_supervisor){
									 $di_supervisor_data_query="select * from additionalcontributors where id='$di_supervisor'";
										 $di_supervisor_data_exe=mysqli_query($con,$di_supervisor_data_query);
										 $di_supervisor_name_read=mysqli_fetch_array($di_supervisor_data_exe);
                                     ?>
                                     <option value="<?php echo $di_supervisor_name_read['id'] ?>" selected><?php echo $di_supervisor_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from additionalcontributors order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>

                               <div class="form-group">
                                 <label>Public Relation Officer</label>
                             <select name="film_public_relation_officer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_public_relation_officer_name=explode(",",$read["film_public_relation_officer_name"]);
                                     foreach($film_public_relation_officer_name as $public_relation_officer_name){
										 $public_relation_officer_name_data_query="select * from additionalcontributors where id='$public_relation_officer_name'";
										 $public_relation_officer_name_data_exe=mysqli_query($con,$public_relation_officer_name_data_query);
										 $public_relation_officer_name_name_read=mysqli_fetch_array($public_relation_officer_name_data_exe);
                                     ?>
                                     <option value="<?php echo $public_relation_officer_name_name_read['id'] ?>" selected><?php echo $public_relation_officer_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from additionalcontributors order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   
                                                                      
                                   <div class="form-group">
                                 <label>Still Photographer</label>
                             <select name="film_still_photographer_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_still_photographer_name=explode(",",$read["film_still_photographer_name"]);
                                     foreach($film_still_photographer_name as $still_photographer_name){
										 $still_photographer_name_data_query="select * from additionalcontributors where id='$still_photographer_name'";
										 $still_photographer_name_data_exe=mysqli_query($con,$still_photographer_name_data_query);
										 $still_photographer_name_name_read=mysqli_fetch_array($still_photographer_name_data_exe);
                                     ?>
                                     <option value="<?php echo $still_photographer_name_name_read['id'] ?>" selected><?php echo $still_photographer_name_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from additionalcontributors order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Colorist Assistant</label>
                             <select name="colorist_assistant[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $colorist_assistant=explode(",",$read["colorist_assistant"]);
                                     foreach($colorist_assistant as $colorist_assistant){
									 $colorist_assistant_data_query="select * from additionalcontributors where id='$colorist_assistant'";
										 $colorist_assistant_data_exe=mysqli_query($con,$colorist_assistant_data_query);
										 $colorist_assistant_name_read=mysqli_fetch_array($colorist_assistant_data_exe);
                                     ?>
                                     <option value="<?php echo $colorist_assistant_name_read['id'] ?>" selected><?php echo $colorist_assistant_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from additionalcontributors order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Conformer</label>
                             <select name="conformer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $conformer=explode(",",$read["conformer"]);
                                     foreach($conformer as $conformer){
									 $conformer_data_query="select * from additionalcontributors where id='$conformer'";
										 $conformer_data_exe=mysqli_query($con,$conformer_data_query);
										 $conformer_name_read=mysqli_fetch_array($conformer_data_exe);
                                     ?>
                                     <option value="<?php echo $conformer_name_read['id'] ?>" selected><?php echo $conformer_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from additionalcontributors order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    
                                   
                                
                                 
     

              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="edit_film_additional_contributors"  class="btn btn-add"  value="Updated Film Additional Contributors">
                            
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

