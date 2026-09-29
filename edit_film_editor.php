<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      $id=$_GET["id"];
      $record="select * from film_editor_management_allot where id='$id'";
      $exe=mysqli_query($con,$record);
      $read=mysqli_fetch_array($exe);
	    $film_id=$read["film_id"];
      ?>

<?
if($_POST["edit_film_editor_management"]) { 
    
    
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']); 
    $film_editor_name= mysqli_real_escape_string($con,implode(",",$_POST['film_editor_name']));
    $film_associate_editor_name= mysqli_real_escape_string($con,implode(",",$_POST['film_associate_editor_name']));
     $assistant_editor= mysqli_real_escape_string($con,implode(",",$_POST['assistant_editor']));
      $online_editor= mysqli_real_escape_string($con,implode(",",$_POST['online_editor']));
       $offline_editor= mysqli_real_escape_string($con,implode(",",$_POST['offline_editor']));
    $co_editor= mysqli_real_escape_string($con,implode(",",$_POST['co_editor']));
    $sub_editor= mysqli_real_escape_string($con,implode(",",$_POST['sub_editor']));


    $film_makeup="update film_editor_management_allot set film_id='$film_id',film_editor_name='$film_editor_name',film_associate_editor_name='$film_associate_editor_name',assistant_editor='$assistant_editor',online_editor='$online_editor',offline_editor='$offline_editor',co_editor='$co_editor',sub_editor='$sub_editor' where id='$id'";
mysqli_query($con,$film_makeup) or die(mysqli_error($con));
  
         echo "<script>alert('Film Editor Management Update Succesfully')</script>";
   echo "<script>window.location.href='film_editor_management.php'</script>";
         }
         ?>
         
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Editor Management</title>
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
                  <h1>Edit Editor Management</h1>
                  <small>Edit Film Editor</small>
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
                                 <h4>Edit Film Editor Management Here</h4>
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
                                    $lang_name=$read_lang['name']
                                    ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (Year:<? echo $rowfr['year_release']; ?> Language:<? echo $lang_name; ?>)</option>
                                  <? } ?>
                                 </select>
                                  
                             
                             
                             
                              </div>
                              <div class="form-group">
                                 <label>Film Editor</label>
                             <select name="film_editor_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $film_editor_name=explode(",",$read["film_editor_name"]);
                                     foreach($film_editor_name as $editor_name){
										  $editor_name_data_query="select * from film_editor where id='$editor_name'";
										 $editor_name_data_exe=mysqli_query($con,$editor_name_data_query);
										 $editor_name_name_read=mysqli_fetch_array($editor_name_data_exe);
                                     ?>
                                     <option value="<?php echo $editor_name_name_read['id'] ?>" selected><?php echo $editor_name_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from film_editor order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                             <div class="form-group">
                                 <label>Co-Editor</label>
                             <select name="co_editor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $co_editor=explode(",",$read["co_editor"]);
                                     foreach($co_editor as $co_editor){
										  $co_editor_data_query="select * from film_editor where id='$co_editor'";
										 $co_editor_data_exe=mysqli_query($con,$co_editor_data_query);
										 $co_editor_name_read=mysqli_fetch_array($co_editor_data_exe);
                                     ?>
                                     <option value="<?php echo $co_editor_name_read['id'] ?>" selected><?php echo $co_editor_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from film_editor order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Sub-Editor</label>
                             <select name="sub_editor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $sub_editor=explode(",",$read["sub_editor"]);
                                     foreach($sub_editor as $sub_editor){
										  $sub_editor_data_query="select * from film_editor where id='$sub_editor'";
										 $sub_editor_data_exe=mysqli_query($con,$sub_editor_data_query);
										 $sub_editor_name_read=mysqli_fetch_array($sub_editor_data_exe);
                                     ?>
                                     <option value="<?php echo $sub_editor_name_read['id'] ?>" selected><?php echo $sub_editor_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from film_editor order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>Associate Editor</label>
                             <select name="film_associate_editor_name[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                  <?php 
                                     $film_associate_editor_name=explode(",",$read["film_associate_editor_name"]);
                                     foreach($film_associate_editor_name as $associate_editor_name){
										  $associate_editor_name_data_query="select * from film_editor where id='$associate_editor_name'";
										 $associate_editor_name_data_exe=mysqli_query($con,$associate_editor_name_data_query);
										 $associate_editor_name_name_read=mysqli_fetch_array($associate_editor_name_data_exe);
                                     ?>
                                     <option value="<?php echo $associate_editor_name_name_read['id'] ?>" selected><?php echo $associate_editor_name_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from film_editor order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                                   </div>
                                  <div class="form-group">
                                 <label>Assistant Editor</label>
                             <select name="assistant_editor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $assistant_editor=explode(",",$read["assistant_editor"]);
                                     foreach($assistant_editor as $assistant_editor){
										  $assistant_editor_data_query="select * from film_editor where id='$assistant_editor'";
										 $assistant_editor_data_exe=mysqli_query($con,$assistant_editor_data_query);
										 $assistant_editor_name_read=mysqli_fetch_array($assistant_editor_data_exe);
                                     ?>
                                     <option value="<?php echo $assistant_editor_name_read['id'] ?>" selected><?php echo $assistant_editor_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from film_editor order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                 <div class="form-group">
                                 <label>Online Editor</label>
                             <select name="online_editor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $online_editor=explode(",",$read["online_editor"]);
                                     foreach($online_editor as $online_editor){
										  $online_editor_data_query="select * from film_editor where id='$online_editor'";
										 $online_editor_data_exe=mysqli_query($con,$online_editor_data_query);
										 $online_editor_name_read=mysqli_fetch_array($online_editor_data_exe);
                                     ?>
                                     <option value="<?php echo $online_editor_name_read['id'] ?>" selected><?php echo $online_editor_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from film_editor order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div> 
                                 <div class="form-group">
                                 <label>Offline Editor</label>
                             <select name="offline_editor[]" class="form-control searchwithselect2" style="width:100%;" multiple>
                                 <?php 
                                     $offline_editor=explode(",",$read["offline_editor"]);
                                     foreach($offline_editor as $offline_editor){
										  $offline_editor_data_query="select * from film_editor where id='$offline_editor'";
										 $offline_editor_data_exe=mysqli_query($con,$offline_editor_data_query);
										 $offline_editor_name_read=mysqli_fetch_array($offline_editor_data_exe);
                                     ?>
                                     <option value="<?php echo $offline_editor_name_read['id'] ?>" selected><?php echo $offline_editor_name_read["name"];?></option>
                                     <?php } ?>
                                  <? $sqlfr=mysqli_query($con, "select * from film_editor order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (ID:<? echo $rowfr['id']; ?> Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
                                 </select>
                              </div>
                                 
     

              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="edit_film_editor_management"  class="btn btn-add"  value="Update Film Editor Manegement">
                            
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

