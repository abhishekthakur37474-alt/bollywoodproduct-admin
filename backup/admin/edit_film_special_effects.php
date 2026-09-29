<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      $id=$_GET["id"];
      $record="select * from film_special_effects_management_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
	     $film_id=$read["film_id"];	
      ?>
      
<?
if($_POST["edit_film_special_effects_management"]) { 
    
    
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']); 
    $special_effects= mysqli_real_escape_string($con,implode(",",$_POST['special_effects'])); 
    $special_effects_supervisor= mysqli_real_escape_string($con,implode(",",$_POST['special_effects_supervisor'])); 
    $pyrotechnics= mysqli_real_escape_string($con,implode(",",$_POST['pyrotechnics']));
    $machanical_effects= mysqli_real_escape_string($con,implode(",",$_POST['machanical_effects']));
    $creature_effects= mysqli_real_escape_string($con,implode(",",$_POST['creature_effects']));
    $special_effects_coordinator= mysqli_real_escape_string($con,implode(",",$_POST['special_effects_coordinator']));
    $prop_master= mysqli_real_escape_string($con,implode(",",$_POST['prop_master']));
    $special_effects_technicianre= mysqli_real_escape_string($con,implode(",",$_POST['special_effects_technicianre'])); 
    $special_effects_buyer= mysqli_real_escape_string($con,implode(",",$_POST['special_effects_buyer']));
    $special_effects_assistant= mysqli_real_escape_string($con,implode(",",$_POST['special_effects_assistant']));


    $film_special="update film_special_effects_management_allot set film_id='$film_id',special_effects='$special_effects',special_effects_supervisor='$special_effects_supervisor',pyrotechnics='$pyrotechnics',machanical_effects='$machanical_effects',creature_effects='$creature_effects',special_effects_coordinator='$special_effects_coordinator',prop_master='$prop_master',special_effects_technicianre='$special_effects_technicianre',special_effects_buyer='$special_effects_buyer',special_effects_assistant='$special_effects_assistant' where id='$id'";
mysqli_query($con,$film_special) or die(mysqli_error($con));
  
         echo "<script>alert('Film Special Effects Management Updated Succesfully')</script>";
   echo "<script>window.location.href='film_special_effects_management.php'</script>";
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
                  <h1>Film Special Effects Management</h1>
                  <small>Edit Film Special Effects</small>
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
                                 <h4>Edit Film Special Effects Management Here</h4>
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
                                 <label>Special Effects</label>
                             <select name="special_effects[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $special_effects=explode(",",$read["special_effects"]);
                                     foreach($special_effects as $special_effects){
									 $special_effects_data_query="select * from  special_effect_manager where id='$special_effects'";
										 $special_effects_data_exe=mysqli_query($con,$special_effects_data_query);
										 $special_effects_name_read=mysqli_fetch_array($special_effects_data_exe);
                                     ?>
                                     <option value="<?php echo $special_effects_name_read['id'] ?>" selected><?php echo $special_effects_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from  special_effect_manager order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                <div class="form-group">
                                 <label>Special Effects Supervisor</label>
                             <select name="special_effects_supervisor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $special_effects_supervisor=explode(",",$read["special_effects_supervisor"]);
                                     foreach($special_effects_supervisor as $special_effects_supervisor){
									 $special_effects_supervisor_data_query="select * from cas special_effect_managerting where id='$special_effects_supervisor'";
										 $special_effects_supervisor_data_exe=mysqli_query($con,$special_effects_supervisor_data_query);
										 $special_effects_supervisor_name_read=mysqli_fetch_array($special_effects_supervisor_data_exe);
                                     ?>
                                     <option value="<?php echo $special_effects_supervisor_name_read['id'] ?>" selected><?php echo $special_effects_supervisor_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from  special_effect_manager order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                            
                               <div class="form-group">
                                 <label>Pyrotechnics</label>
                             <select name="pyrotechnics[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $pyrotechnics=explode(",",$read["pyrotechnics"]);
                                     foreach($pyrotechnics as $pyrotechnics){
									  $pyrotechnics_data_query="select * from  special_effect_manager where id='$pyrotechnics'";
										 $pyrotechnics_data_exe=mysqli_query($con,$pyrotechnics_data_query);
										 $pyrotechnics_name_read=mysqli_fetch_array($pyrotechnics_data_exe);
                                     ?>
                                     <option value="<?php echo $pyrotechnics_name_read['id'] ?>" selected><?php echo $pyrotechnics_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from  special_effect_manager order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   
                                    <div class="form-group">
                                 <label>Machanical Effects</label>
                             <select name="machanical_effects[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $machanical_effects=explode(",",$read["machanical_effects"]);
                                     foreach($machanical_effects as $machanical_effects){
									   $machanical_effects_data_query="select * from  special_effect_manager where id='$machanical_effects'";
										 $machanical_effects_data_exe=mysqli_query($con,$machanical_effects_data_query);
										 $machanical_effects_name_read=mysqli_fetch_array($machanical_effects_data_exe);
                                     ?>
                                     <option value="<?php echo $machanical_effects_name_read['id'] ?>" selected><?php echo $machanical_effects_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from  special_effect_manager order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Creature Effects</label>
                             <select name="creature_effects[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $creature_effects=explode(",",$read["creature_effects"]);
                                     foreach($creature_effects as $creature_effects){
									   $creature_effects_data_query="select * from  special_effect_manager where id='$creature_effects'";
										 $creature_effects_data_exe=mysqli_query($con,$creature_effects_data_query);
										 $creature_effects_name_read=mysqli_fetch_array($creature_effects_data_exe);
                                     ?>
                                     <option value="<?php echo $creature_effects_name_read['id'] ?>" selected><?php echo $creature_effects_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from  special_effect_manager order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                  <div class="form-group">
                                 <label>Special Effects Coordinator</label>
                             <select name="special_effects_coordinator[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $special_effects_coordinator=explode(",",$read["special_effects_coordinator"]);
                                     foreach($special_effects_coordinator as $special_effects_coordinator){
									   $special_effects_coordinator_data_query="select * from  special_effect_manager where id='$special_effects_coordinator'";
										 $special_effects_coordinator_data_exe=mysqli_query($con,$special_effects_coordinator_data_query);
										 $special_effects_coordinator_name_read=mysqli_fetch_array($special_effects_coordinator_data_exe);
                                     ?>
                                     <option value="<?php echo $special_effects_coordinator_name_read['id'] ?>" selected><?php echo $special_effects_coordinator_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from  special_effect_manager order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                    <div class="form-group">
                                 <label>Prop Masterr</label>
                             <select name="prop_master[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $prop_master=explode(",",$read["prop_master"]);
                                     foreach($prop_master as $prop_master){
									   $prop_master_data_query="select * from  special_effect_manager where id='$prop_master'";
										 $prop_master_data_exe=mysqli_query($con,$prop_master_data_query);
										 $prop_master_name_read=mysqli_fetch_array($prop_master_data_exe);
                                     ?>
                                     <option value="<?php echo $prop_master_name_read['id'] ?>" selected><?php echo $prop_master_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from  special_effect_manager order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>                            
                                    <div class="form-group">
                                 <label>Special Effects Technicianre</label>
                             <select name="special_effects_technicianre[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $special_effects_technicianre=explode(",",$read["special_effects_technicianre"]);
                                     foreach($special_effects_technicianre as $special_effects_technicianre){
									   $special_effects_technicianre_data_query="select * from  special_effect_manager where id='$special_effects_technicianre'";
										 $special_effects_technicianre_data_exe=mysqli_query($con,$special_effects_technicianre_data_query);
										 $special_effects_technicianre_name_read=mysqli_fetch_array($special_effects_technicianre_data_exe);
                                     ?>
                                     <option value="<?php echo $special_effects_technicianre_name_read['id'] ?>" selected><?php echo $special_effects_technicianre_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from  special_effect_manager order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Special Effects Buyer</label>
                             <select name="special_effects_buyer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $special_effects_buyer=explode(",",$read["special_effects_buyer"]);
                                     foreach($special_effects_buyer as $special_effects_buyer){
									   $special_effects_buyer_data_query="select * from  special_effect_manager where id='$special_effects_buyer'";
										 $special_effects_buyer_data_exe=mysqli_query($con,$special_effects_buyer_data_query);
										 $special_effects_buyer_name_read=mysqli_fetch_array($special_effects_buyer_data_exe);
                                     ?>
                                     <option value="<?php echo $special_effects_buyer_name_read['id'] ?>" selected><?php echo $special_effects_buyer_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from  special_effect_manager order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                   <div class="form-group">
                                 <label>Special Effects Assistant</label>
                             <select name="special_effects_assistant[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $special_effects_assistant=explode(",",$read["special_effects_assistant"]);
                                     foreach($special_effects_assistant as $special_effects_assistant){
									   $special_effects_assistant_data_query="select * from  special_effect_manager where id='$special_effects_assistant'";
										 $special_effects_assistant_data_exe=mysqli_query($con,$special_effects_assistant_data_query);
										 $special_effects_assistant_name_read=mysqli_fetch_array($special_effects_assistant_data_exe);
                                     ?>
                                     <option value="<?php echo $special_effects_assistant_name_read['id'] ?>" selected><?php echo $special_effects_assistant_name_read['name'];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from  special_effect_manager order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                 
                                 
     

              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="edit_film_special_effects_management"  class="btn btn-add"  value="Update Film Special Effects Manegement">
                            
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

