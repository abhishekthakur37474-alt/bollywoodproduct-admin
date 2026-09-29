<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
       $edit_id=$_GET["id"];
$record="select * from ott_film where id='$edit_id'";
$exe=mysqli_query($con,$record);
$read=mysqli_fetch_array($exe);
      ?>
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit OTT Film Details</title>
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
                  <h1>OTT Film Details Management</h1>
                  <small>Edit OTT Film Details</small>
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
                                 <h4>Edit OTT Film Details Here</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                    <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                      <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="main_language"  class="form-control" name="film_id"  style="width:100%:"  required>
                                   <?php 
           $film_id=$read["film_id"];
           $film_name="select * from film where id='$film_id'";
           $sqlfr_film_name=mysqli_query($con,$film_name);
           $read_film_name=mysqli_fetch_array($sqlfr_film_name);
       ?>
                                    <option value="<? echo $film_id?>"><?php echo $read_film_name["name"];?></option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ 
 $lang_code=$rowfr["main_lang"];
                                    $lang_q="select * from dubbing where id='$lang_code'";
                                    $exe_lang=mysqli_query($con,$lang_q);
                                    $read_lang=mysqli_fetch_array($exe_lang);
                                    
                                    ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?> (<? echo $rowfr['year_release']; ?>-<? echo $read_lang['name']; ?>)</option>
                               
                                  <? } ?>
                                 </select>
                                  
                              </div>   
                            <div class="form-group">
                                 <label>FILM AVAILABLE ON OTT:</label>
                                 <select class="form-control" id="isott" name="film_available_ott" required>
                                     
                                     <option value="Yes">Yes</option>
                                     <option value="No">No</option>
                                     
                                </select>
                              </div>
                               <div id="isottdetails" style="display: block;border: 1px solid black;padding: 14px;">
                                  <fieldset>
                                      <legend>Please Fillout These Details Also:</legend>
                                      
                                    <div class="field_wrapper4">
                                    	<!--<a href="javascript:void(0);" class="add_button4 btn btn-success " title="Add More">Add More</a>-->
                                    
                                    <br>
                                    <?php
                                    $ott_Platform=explode(",",$read["ott_Platform"]);
                                    $ott_link=explode(",",$read["ott_link"]);
                                    $ott_date_release=explode(",",$read["date_release"]);
                                    $ott_month_release=explode(",",$read["month_release"]);
                                    $ott_year_release=explode(",",$read["year_release"]);
                                    $ott_remarks=explode(",",$read["ott_remarks"]);
                                    $count=count($ott_Platform);
                                    $incr=0;
                                    for($i=1;$i<=$count;$i++){
                                        $platform_id=$ott_Platform[$incr];
                                        $ott_platform_name_q="select id,name from ott_platform where id='$platform_id'";
                                        $platofrm_exe=mysqli_query($con,$ott_platform_name_q);
                                        $read_platform_name=mysqli_fetch_array($platofrm_exe);
                                    ?>
                                   <div class="form-group">
                                 <label>OTT Platform</label>
                                 <select class="form-control" name="type[]">
                                     <option value="<?php echo $ott_Platform[$incr];?>"><?php echo $read_platform_name["name"];?></option>
                                       <? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                </select>
                              </div>
                              
                              <div class="form-group">
                                 <label>Link</label>
                                 <input type="text" class="form-control" value="<?php echo $ott_link[$incr];?>" name="link[]" placeholder=""  >
                              </div>
                              
                                  <div class="form-group">
                                <label>Lanaguage</label>
                                 
   <select class="form-control orignal_language" name="main_language[]" multiple="multiple" style="width:100%;">
        <?php 
       $ott_lang=explode(",",$read["ott_lanaguage"]);
       foreach($ott_lang as $ott_lan){
          $language_name="select * from dubbing where id='$ott_lan'";
           $sqlfr_lang=mysqli_query($con,$language_name);
           $read_name_lang=mysqli_fetch_array($sqlfr_lang);
       ?>
       <option value="<? echo $read_name_lang['id']; ?>" selected><? echo $read_name_lang['name']; ?></option>
                     <? } ?>             
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div> 
                               <div class="form-group">
                                 <label>Date Release</label>
                                 <input type="text" class="form-control" value="<?php echo $ott_date_release[$incr];?>" name="date_release[]" placeholder=""  >
                              </div>
                               <div class="form-group">
                                 <label>Month Release</label>
                                 <input type="text" class="form-control" value="<?php echo $ott_month_release[$incr];?>" name="month_release[]" placeholder=""  >
                              </div> 
                              <div class="form-group">
                                 <label>Year Release</label>
                                 <input type="text" class="form-control" value="<?php echo $ott_year_release[$incr];?>" name="year_release[]" placeholder=""  >
                              </div> 
                          <div class="form-group">
                                 <label>Remarks</label>
                                 <input type="text" class="form-control" value="<?php echo $ott_remarks[$incr];?>" name="remarks[]" placeholder=""  >
                              </div>
                              
                        </div>   
                        <?php $incr++;} ?>
                          </fieldset>
                               
                             
          
                    
                    
                              
           </div>                    
                                                        
        </div>
        <div class="reset-button">
                   <input type="submit" name="Updateott_two_w" class="btn btn-add"   value="Update OTT" style="margin-top:10px;">       
        </div>
        </div>

        </form>
          <?php
               if(isset($_POST["Updateott_two_w"]))
                  {
                      $film_id=mysqli_real_escape_string($con,$_POST["film_id"]);
                       $film_name_q="select * from film where id='$film_id'";
           $sqlfr_film_name=mysqli_query($con,$film_name_q);
           $read_film_name=mysqli_fetch_array($sqlfr_film_name);
                          $film_name=$read_film_name["name"]; 
                      $film_available_ott=mysqli_real_escape_string($con,$_POST["film_available_ott"]); 
                      $type=mysqli_real_escape_string($con,implode(",",$_POST["type"]));
                      $link=mysqli_real_escape_string($con,implode(",",$_POST["link"]));
                      $main_language=mysqli_real_escape_string($con,implode(",",$_POST["main_language"]));
                      $remarks=mysqli_real_escape_string($con,implode(",",$_POST["remarks"]));
                      $date_release=mysqli_real_escape_string($con,implode(",",$_POST["date_release"]));
                      $month_release=mysqli_real_escape_string($con,implode(",",$_POST["month_release"]));
                      $year_release=mysqli_real_escape_string($con,implode(",",$_POST["year_release"]));
                      $ott_film_add="update ott_film set name='$film_name',film_id='$film_id',film_available_ott='$film_available_ott',ott_Platform='$type',ott_link='$link',ott_lanaguage='$main_language',ott_remarks='$remarks',date_release='$date_release',month_release='$month_release',year_release='$year_release', updated_date=now() where id='$edit_id'";
                      mysqli_query($con,$ott_film_add);
                      echo "<script>alert('OTT Film  Details Updated Successfully')</script>";
                      echo "<script>window.location.href='film_ott_management.php'</script>";
                      }
                      ?>
       
  

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
    $('.main_language').select2();
});
</script>
  <script>
$(function() {
   $("#cbfc_releasing_platform").change(function(){
        if($('#cbfc_releasing_platform').val() == 'OTT') {
            $('#ott_platform').show(); 
        } else {
            $('#ott_platform').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#cbfc_releasing_platform').val() == 'OTT') {
            $('#ott_platform').show(); 
        } else {
            $('#ott_platform').hide(); 
        } 
    });
});
 </script>

<script>
$(function() {
    jQuery(document).ready(function($){
        if($('#OTT').val() == 'Yes') {
            $('#OTTdetails').show(); 
        } else {
            $('#OTTdetails').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#OTT").change(function(){
        if($('#OTT').val() == 'Yes') {
            $('#OTTdetails').show(); 
        } else {
            $('#OTTdetails').hide(); 
        } 
    });
});
 </script> 
 
 <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#isott').val() == 'Yes') {
            $('#isottdetails').show(); 
        } else {
            $('#isottdetails').hide(); 
        } 
    });
});
 </script>
 <script>
  $(document).ready(function() {
    $('.orignal_language').select2();
});
</script>
 <script>
$(function() {
   $("#isott").change(function(){
        if($('#isott').val() == 'Yes') {
            $('#isottdetails').show(); 
        } else {
            $('#isottdetails').hide(); 
        } 
    });
});
 </script>
 
<script>
$(document).ready(function(){

    var maxField4 = 10; //Input fields increment limitation
    var addButton4 = $('.add_button4'); //Add button selector
    var wrapper4 = $('.field_wrapper4'); //Input field wrapper
    var fieldHTML4 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                               
                                   '<div class="form-group">'+
                                 '<label>OTT Platform</label>'+
                                 '<select class="form-control" name="type[]">'+
                                     '<option value="">-Select OTT Platform Name-</option>'+
                                       <? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                
                                '</select>'+
                              '</div>'+
                              
                              '<div class="form-group">'+
                                 '<label>Link</label>'+
                                 '<input type="text" class="form-control" name="link[]" placeholder=""  >'+
                              '</div>'+
                              
                                  '<div class="form-group">'+
                                '<label>Lanaguage</label>'+
                                 
   '<select class="form-control dubbing_lang" name="main_language[]" multiple="multiple" style="width:100%;">'+
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                                 
                              '</div>'+
                                '<div class="form-group">'+
                                 '<label>Date Release</label>'+
                                 '<input type="text" class="form-control" value="<?php echo $ott_date_release[$incr];?>" name="date_release[]" placeholder=""  >'+
                              '</div>'+
                               '<div class="form-group">'+
                                '<label>Month Release</label>'+
                                 '<input type="text" class="form-control" value="<?php echo $ott_month_release[$incr];?>" name="month_release[]" placeholder=""  >'+
                              '</div>'+ 
                              '<div class="form-group">'+
                                 '<label>Year Release</label>'+
                                 '<input type="text" class="form-control" value="<?php echo $ott_year_release[$incr];?>" name="year_release[]" placeholder=""  >'+
                              '</div>'+ 
                          '<div class="form-group">'+
                                 '<label>Remarks</label>'+
                                 '<input type="text" class="form-control" name="remarks[]" placeholder=""  >'+
                              '</div>'+
                                
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton4).click(function(){
        //Check maximum number of input fields
        if(x < maxField4){ 
            x++; //Increase field counter
            $(wrapper4).append(fieldHTML4); //Add field html
            $('.dubbing_lang').select2();
           
        }else{
            alert('A maximum of '+maxField2+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper4).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>
</body>
</html>