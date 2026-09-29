<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      $id=$_GET["id"];
      $record="select * from film_marketing_and_publicity_management_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
	  $film_id=$read["film_id"];
      ?>
<?
if($_POST["edit_marketing_and_publicity_management"]) { 
    
    
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']); 
    $social_media_manager= mysqli_real_escape_string($con,implode(",",$_POST['social_media_manager'])); 
    $press_agent= mysqli_real_escape_string($con,implode(",",$_POST['press_agent'])); 
    $marketing_and_promotion= mysqli_real_escape_string($con,implode(",",$_POST['marketing_and_promotion'])); 
    $marketing_consultant= mysqli_real_escape_string($con,implode(",",$_POST['marketing_consultant'])); 
    $strategy_consultant= mysqli_real_escape_string($con,implode(",",$_POST['strategy_consultant'])); 
    $publicity_manager= mysqli_real_escape_string($con,implode(",",$_POST['publicity_manager']));
    $digital_marketing= mysqli_real_escape_string($con,implode(",",$_POST['digital_marketing'])); 
    $digital_marketing_manager= mysqli_real_escape_string($con,implode(",",$_POST['digital_marketing_manager'])); 
    $promo= mysqli_real_escape_string($con,implode(",",$_POST['promo']));
    $promo_cut= mysqli_real_escape_string($con,implode(",",$_POST['promo_cut'])); 
    $teaser= mysqli_real_escape_string($con,implode(",",$_POST['teaser'])); 
    $trailer= mysqli_real_escape_string($con,implode(",",$_POST['trailer']));


     $film_marketing_and_publicity="update film_marketing_and_publicity_management_allot set film_id='$film_id',social_media_manager='$social_media_manager',press_agent='$press_agent',marketing_and_promotion='$marketing_and_promotion',marketing_consultant='$marketing_consultant',strategy_consultant='$strategy_consultant',publicity_manager='$publicity_manager',digital_marketing='$digital_marketing',digital_marketing_manager='$digital_marketing_manager',promo='$promo',promo_cut='$promo_cut',teaser='$teaser',trailer='$trailer' where id='$id'";
mysqli_query($con,$film_marketing_and_publicity) or die(mysqli_error($con));
  
         echo "<script>alert('Film Marketing And Publicit Management Update Succesfully')</script>";
  echo "<script>window.location.href='film_marketing_and_publicity_management.php'</script>";
         }
         ?>
         
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Marketing And Publicity Management</title>
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
                  <h1>Film Marketing And Publicity Management</h1>
                  <small>Edit Film Marketing And Publicity</small>
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
                                 <h4>Edit Film Marketing And Publicity Management Here</h4>
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
                                 <label>Social Media Manager</label>
                             <select name="social_media_manager[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $social_media_manager=explode(",",$read["social_media_manager"]);
                                     foreach($social_media_manager as $social_media_manager){
									  $social_media_manager_data_query="select * from casting where id='$social_media_manager'";
										 $social_media_manager_data_exe=mysqli_query($con,$social_media_manager_data_query);
										 $social_media_manager_name_read=mysqli_fetch_array($social_media_manager_data_exe);
                                     ?>
                                     <option value="<?php echo $social_media_manager_name_read['id'] ?>" selected><?php echo $social_media_manager_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from marketing_publicity order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                            
                               <div class="form-group">
                                 <label>Press Agent</label>
                             <select name="press_agent[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $press_agent=explode(",",$read["press_agent"]);
                                     foreach($press_agent as $press_agent){
									  $press_agent_data_query="select * from marketing_publicity where id='$press_agent'";
										 $press_agent_data_exe=mysqli_query($con,$press_agent_data_query);
										 $press_agent_name_read=mysqli_fetch_array($press_agent_data_exe);
                                     ?>
                                     <option value="<?php echo $press_agent_name_read['id'] ?>" selected><?php echo $press_agent_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	marketing_publicity order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                  <div class="form-group">  
                                 <label>Marketing and Promotion</label>             
                             <select name="marketing_and_promotion[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $marketing_and_promotion=explode(",",$read["marketing_and_promotion"]);
                                     foreach($marketing_and_promotion as $marketing_and_promotion){
									  $marketing_and_promotion_data_query="select * from casting where id='$marketing_and_promotion'";
										 $marketing_and_promotion_data_exe=mysqli_query($con,$marketing_and_promotion_data_query);
										 $marketing_and_promotion_name_read=mysqli_fetch_array($marketing_and_promotion_data_exe);
                                     ?>
                                     <option value="<?php echo $marketing_and_promotion_name_read['id'] ?>" selected><?php echo $marketing_and_promotion_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	marketing_publicity order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                  <div class="form-group">  
                                 <label>Marketing Consultant</label>             
                             <select name="marketing_consultant[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $marketing_consultant=explode(",",$read["marketing_consultant"]);
                                     foreach($marketing_consultant as $marketing_consultant){
									  $marketing_consultant_data_query="select * from marketing_publicity where id='$marketing_consultant'";
										 $marketing_consultant_data_exe=mysqli_query($con,$marketing_consultant_data_query);
										 $marketing_consultant_name_read=mysqli_fetch_array($marketing_consultant_data_exe);
                                     ?>
                                     <option value="<?php echo $marketing_consultant_name_read['id'] ?>" selected><?php echo $marketing_consultant_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	marketing_publicity order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                  <div class="form-group">  
                                 <label>Strategy Consultant</label>             
                             <select name="strategy_consultant[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $strategy_consultant=explode(",",$read["strategy_consultant"]);
                                     foreach($strategy_consultant as $strategy_consultant){
									  $strategy_consultant_data_query="select * from marketing_publicity where id='$strategy_consultant'";
										 $strategy_consultant_data_exe=mysqli_query($con,$strategy_consultant_data_query);
										 $strategy_consultant_name_read=mysqli_fetch_array($strategy_consultant_data_exe);
                                     ?>
                                     <option value="<?php echo $strategy_consultant_name_read['id'] ?>" selected><?php echo $strategy_consultant_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	marketing_publicity order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                   <div class="form-group">  
                                 <label>Publicity Manager</label>             
                             <select name="publicity_manager[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $publicity_manager=explode(",",$read["publicity_manager"]);
                                     foreach($publicity_manager as $publicity_manager){
									  $publicity_manager_data_query="select * from marketing_publicity where id='$publicity_manager'";
										 $publicity_manager_data_exe=mysqli_query($con,$publicity_manager_data_query);
										 $publicity_manager_name_read=mysqli_fetch_array($publicity_manager_data_exe);
                                     ?>
                                     <option value="<?php echo $publicity_manager_name_read['id'] ?>" selected><?php echo $publicity_manager_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	marketing_publicity order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                  <div class="form-group">  
                                 <label>Digital Marketing</label>             
                             <select name="digital_marketing[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $digital_marketing=explode(",",$read["digital_marketing"]);
                                     foreach($digital_marketing as $digital_marketing){
									  $digital_marketing_data_query="select * from marketing_publicity where id='$digital_marketing'";
										 $digital_marketing_data_exe=mysqli_query($con,$digital_marketing_data_query);
										 $digital_marketing_name_read=mysqli_fetch_array($digital_marketing_data_exe);
                                     ?>
                                     <option value="<?php echo $digital_marketing_name_read['id'] ?>" selected><?php echo $digital_marketing_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	marketing_publicity order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                  <div class="form-group">  
                                 <label>Digital Marketing Manager</label>             
                             <select name="digital_marketing_manager[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $digital_marketing_manager=explode(",",$read["digital_marketing_manager"]);
                                     foreach($digital_marketing_manager as $digital_marketing_manager){
									  $digital_marketing_manager_data_query="select * from marketing_publicity where id='$digital_marketing_manager'";
										 $digital_marketing_manager_data_exe=mysqli_query($con,$digital_marketing_manager_data_query);
										 $digital_marketing_manager_name_read=mysqli_fetch_array($digital_marketing_manager_data_exe);
                                     ?>
                                     <option value="<?php echo $digital_marketing_manager_name_read['id'] ?>" selected><?php echo $digital_marketing_manager_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	marketing_publicity order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                  <div class="form-group">  
                                 <label>Promo</label>             
                             <select name="promo[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $promo=explode(",",$read["promo"]);
                                     foreach($promo as $promo){
									  $promo_data_query="select * from marketing_publicity where id='$promo'";
										 $promo_data_exe=mysqli_query($con,$promo_data_query);
										 $promo_name_read=mysqli_fetch_array($promo_data_exe);
                                     ?>
                                     <option value="<?php echo $promo_name_read['id'] ?>" selected><?php echo $promo_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	marketing_publicity order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                  <div class="form-group">  
                                 <label>Promo Cut</label>             
                             <select name="promo_cut[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $promo_cut=explode(",",$read["promo_cut"]);
                                     foreach($promo_cut as $promo_cut){
									  $promo_cut_data_query="select * from marketing_publicity where id='$promo_cut'";
										 $promo_cut_data_exe=mysqli_query($con,$promo_cut_data_query);
										 $promo_cut_name_read=mysqli_fetch_array($promo_cut_data_exe);
                                     ?>
                                     <option value="<?php echo $promo_cut_name_read['id'] ?>" selected><?php echo $promo_cut_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	marketing_publicity order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                   <div class="form-group">  
                                 <label>Teaser</label>             
                             <select name="teaser[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $teaser=explode(",",$read["teaser"]);
                                     foreach($teaser as $teaser){
									  $teaser_data_query="select * from marketing_publicity where id='$teaser'";
										 $teaser_data_exe=mysqli_query($con,$teaser_data_query);
										 $teaser_name_read=mysqli_fetch_array($teaser_data_exe);
                                     ?>
                                     <option value="<?php echo $teaser_name_read['id'] ?>" selected><?php echo $teaser_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	marketing_publicity order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                                  <div class="form-group">  
                                 <label>Trailer</label>             
                             <select name="trailer[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $trailer=explode(",",$read["trailer"]);
                                     foreach($trailer as $trailer){
									  $trailer_data_query="select * from marketing_publicity where id='$trailer'";
										 $trailer_data_exe=mysqli_query($con,$trailer_data_query);
										 $trailer_name_read=mysqli_fetch_array($trailer_data_exe);
                                     ?>
                                     <option value="<?php echo $trailer_name_read['id'] ?>" selected><?php echo $trailer_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from 	marketing_publicity order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                  </div>
                  

                                 
     

              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="edit_marketing_and_publicity_management"  class="btn btn-add"  value="Update Marketing And Publicity Manegement">
                            
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

