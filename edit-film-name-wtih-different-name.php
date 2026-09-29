<?
session_start();
include "config.php";
date_default_timezone_set('Asia/Kolkata');
$last_update=date('d-m-Y h:i:s A');
if($_SESSION['admin']==""){
     header("location:index.php");
      }
        $edit_id=$_GET["id"];
$film_details_details="select * from film_diffrent_name_language where id='$edit_id'";
$exe_edit=mysqli_query($con,$film_details_details) or die(mysqli_error($con));
$read=mysqli_fetch_array($exe_edit);
      ?>
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film  Details</title>
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
                  <h1>Film Details Management</h1>
                  <small>Edit Film Details</small>
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
                                 <h4>Edit Film Details Here</h4>
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
       <option value="<? echo $read_film_name['id']; ?>" selected><? echo $read_film_name['name']; ?></option>
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
                            
                               <div id="isdubbedsection" style="display: block;border: 1px solid black;padding: 14px;">
                                  <fieldset>
                                      <legend>Please Fillout These Details Also:</legend>
                                      <?php
                                     
                                      $dubbing_film_name=explode(",",$read['diffrent_film_name']);
                                      
                                      $release_date=explode(",",$read['release_date']);
                                      $release_month=explode(",",$read['release_month']);
                                      $release_year=explode(",",$read['release_year']);
                                      $dubbed_youtube_link=explode(",",$read['youtube_movie_link']);
                                      $dubbed_date_release_youtube=explode(",",$read['upload_date']);
                                      $dubbed_month_release_youtube=explode(",",$read['upload_month']);
                                      $dubbed_year_release_youtube=explode(",",$read['upload_year']);
                                      $ott_platform_name=explode(",",$read['ott_platform_name']);
                                      $ott_link=explode(",",$read['ott_link']);
                                      $more_than_dubbed_versions=$read['more_than_dubbed_versions'];
                                      $count_movie=count($dubbing_film_name);
                                      $count=0;
                                      for($i=1;$i<=$count_movie;$i++){
                                      ?>
                                 
                                 
                              
                              <div class="form-group">
                                <label>Others Lanaguage(s)</label>
                                 <?php 
       $dubbing_lanaguage=explode(",",$read["lanaguage_change"]);
       $dubbing_lanaguage_count=$dubbing_lanaguage[$count];
          $language_name_dubbing="select * from dubbing where id='$dubbing_lanaguage_count'";
           $sqlfr_lang_dubb=mysqli_query($con,$language_name_dubbing);
           $read_name_lang_dubb=mysqli_fetch_array($sqlfr_lang_dubb);
       ?>
   <select class="dubbing_lang"  class="form-control" name="dubbing_movie_language[]" multiple="multiple" style="width:100%;">
        <option value="<? echo $dubbing_lanaguage_count; ?>" selected><? echo $dubbing_lanaguage_count; ?></option>
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
            <label>New Film Name</label>
            <input list="dubb_film_name_list" name="dubb_film_name[]"  id="dubb_film_name"  value="<?php echo $dubbing_film_name[$count];?>" class="form-control">

<datalist id="dubb_film_name_list">
   <option value="<?php echo $dubbing_film_name[$count];?>" checked />
    <? $sqlfrm=mysqli_query($con, "select * from film order by name");
    
    while($rowfrm=mysqli_fetch_array($sqlfrm)){ ?>
 <option value="<? echo $rowfrm['name']; ?>"/>(ID:<? echo $rowfrm['id']; ?> Year:<? echo $rowfrm['year_release']; ?>)
     <? } ?>
</datalist>
                          
                              </div>
                              <div class="form-group">
                                 <label>YouTube Movie Link</label>
                                 <input type="text" class="form-control" name="dubbed_youtube_link[]" value="<?php echo $dubbed_youtube_link[$count];?>" placeholder="Enter You Tube Movie Link"  >
                              </div>
                                 <div class="form-group">
                                <label>Is Release Date is Different?</label>
                              <select class="form-control" name="release_date_change" id="release_date_details">
                   <option value="no">No</option>
                   <option value="yes">Yes</otption>
                              </select>
                              </div>
                              <div id="release_date_section">
                               <div class="form-group">
                                 <label>Release Date</label>
                                 <input type="text" class="form-control" name="dubbed_date_release[]" value="<?php echo $release_date[$count];?>" placeholder="Enter Release Date"  >
                              </div>
                          <div class="form-group">
                                 <label>Release Month</label>
                                 <input type="text" class="form-control" name="dubbed_month_release[]" value="<?php echo $release_month[$count];?>" placeholder="Enter Release Month"  >
                              </div>
                          <div class="form-group">
                                 <label>Release Year</label>
                                 <input type="text" class="form-control" name="dubbed_year_release[]" value="<?php echo $release_year[$count];?>" placeholder="Enter Release Year"  >
                              </div>
                              </div>
                                
                              <div class="form-group">
                                 <label>Upload Full Date:</label>
                             
                              </div>
                               <div class="form-group">
                                 <label>Upload Date</label>
                                 <input type="text" class="form-control" name="dubbed_date_release_youtube[]" value="<?php echo $dubbed_date_release_youtube[$count];?>" placeholder="Enter Release Date"  >
                              </div>
                          <div class="form-group">
                                 <label>Upload Month</label>
                                 <input type="text" class="form-control" name="dubbed_month_release_youtube[]" value="<?php echo $dubbed_month_release_youtube[$count];?>" placeholder="Enter Release Month"  >
                              </div>
                          <div class="form-group">
                                 <label>Upload Year</label>
                                 <input type="text" class="form-control" name="dubbed_year_release_youtube[]" value="<?php echo $dubbed_year_release_youtube[$count];?>" placeholder="Enter Release Year"  >
                              </div>
                              </fieldset>
                               
                                           <hr/>
                       <div class="form-group">
                                 <label>CBFC Rating</label>
                              
 <select name="cbfc_rating" class="form-control"> 
                                 

<option value="">-Please Select-</option>
<option value="A" <? if($read['cbfc_rating']=="A"){echo "selected"; } ?> >A</option>
<option value="UA" <? if($read['cbfc_rating']=="UA"){echo "selected"; } ?> >UA</option>
<option value="U" <? if($read['cbfc_rating']=="U"){echo "selected"; } ?> >U</option>
<option value="UA 7" <? if($read['cbfc_rating']=="UA 7"){echo "selected"; } ?> >UA 7+</option>
<option value="UA 13" <? if($read['cbfc_rating']=="UA 13"){echo "selected"; } ?> >UA 13+</option>
<option value="UA 16" <? if($read['cbfc_rating']=="UA 16"){echo "selected"; } ?> >UA 16+</option>
<option value="S" <? if($read['cbfc_rating']=="S"){echo "selected"; } ?> >S</option>
                                 
                                 </select>
                              </div>
                                <div class="form-group">
                                 <label>CBFC Certificate No</label>
                                 <input type="text" class="form-control" name="cbfc_certificate_no" placeholder="Enter cbfc_certificate_no" value="<? echo $read['cbfc_certificate_no'];?>" >
                              </div>

    
                              
      <div class="form-group">
                                 <label>CBFC Certificate Date</label>
                                 <input type="text" class="form-control" name="cbfc_certificate_date" placeholder="Enter cbfc_certificate_date" value="<? echo $read['cbfc_certificate_date'];?>" >
                              </div>
                        
      <div class="form-group">
                                 <label>CBFC Certificate Month</label>
                                 <input type="text" class="form-control" name="cbfc_certificate_month" placeholder="Enter cbfc_certificate_month" value="<? echo $read['cbfc_certificate_month'];?>" >
                              </div>
                        
      <div class="form-group">
                                 <label>CBFC Certificate Year</label>
                                 <input type="text" class="form-control" name="cbfc_certificate_year" placeholder="Enter cbfc_certificate_year" value="<? echo $read['cbfc_certificate_year'];?>" >
                              </div>

                          
      <div class="form-group">
                                 <label>CBFC Running Time Minutes</label>
                                 <input type="text" class="form-control" name="cbfc_running_time_minutes" placeholder="Enter cbfc_running_time_minutes" value="<? echo $read['cbfc_running_time_minutes'];?>" >
                              </div>

                              
      <div class="form-group">
                                 <label>CBFC Running Time Seconds</label>
                                 <input type="text" class="form-control" name="cbfc_running_time_seconds" placeholder="Enter cbfc_running_time_seconds" value="<? echo $read['cbfc_running_time_seconds'];?>" >
                              </div>
                                           <hr/>
                                            <div class="form-group">
                                 <label>IS CBFC Rating Revised?</label>
                              
 <select name="cbfc_rating_revised" id="cbfc_rating_revised" class="form-control"> 
                                 

<option value="<?php echo $read["cbfc_rating_revised"];?>"><?php echo $read["cbfc_rating_revised"];?></option>
<option value="Yes">Yes</option>
<option value="No">No</option>

                                 
                                 </select>
                              </div>
							  <div style="border:1px solid black;" id="new_cbfc_rating_panel">
							  
							   <div class="form-group">
                                 <label>New CBFC Rating</label>
                              
 <select name="new_cbfc_rating"  class="form-control"> 
                                 

<option value="<?php echo $read["new_certificate_rating"];?>"><?php echo $read["new_certificate_rating"];?></option>
<option value="A">A</option>
<option value="UA">UA</option>
<option value="UA 7+">UA 7+</option>
<option value="UA 13+">UA 13+</option>
<option value="UA 16+">UA 16+</option>
<option value="U">U</option>
<option value="S">S</option>
<option value="">No Change In Rating</option>

                                 
                                 </select>
                              </div>
                               <div class="form-group">
                                 <label>New CBFC Certificate Date</label>
                                 <input type="text" class="form-control" name="new_cbfc_certificate_date" placeholder="Enter cbfc_certificate_date" value="<? echo $read['new_certificate_date'];?>" >
                              </div>
                        
      <div class="form-group">
                                 <label>New CBFC Certificate Month</label>
                                 <input type="text" class="form-control" name="new_cbfc_certificate_month" placeholder="Enter cbfc_certificate_month" value="<? echo $read['new_certificate_month'];?>" >
                              </div>
                        
      <div class="form-group">
                                 <label>New CBFC Certificate Year</label>
                                 <input type="text" class="form-control" name="new_cbfc_certificate_year" placeholder="Enter cbfc_certificate_year" value="<? echo $read['new_certificate_year'];?>" >
                              </div>

                          
      <div class="form-group">
                                 <label>New CBFC Running Time Minutes</label>
                                 <input type="text" class="form-control" name="new_cbfc_running_time_minutes" placeholder="Enter cbfc_running_time_minutes" value="<? echo $read['new_certificate_min'];?>" >
                              </div>

                              
                   <div class="form-group">
                                 <label>New CBFC Running Time Seconds</label>
                                 <input type="text" class="form-control" name="new_cbfc_running_time_seconds" placeholder="Enter cbfc_running_time_seconds" value="<? echo $read['new_certificate_sec'];?>" >
                              </div>

                              </div>
        <div class="field_wrapper1">
    <label>OTT Platform Details</label>
          <a href="javascript:void(0);" class="add_button1 btn btn-success" title="Add More">Add More</a>
          
                           <div class="form-group">
                                <label>OTT Platform Name:</label>
                                 
   <select  class="form-control" name="dubbed_ott_name[]"  style="width:100%;">
       <option value="<?php echo $ott_platform_name[$count];?>"><?php echo $ott_platform_name[$count];?></option>
                                  <? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                              </div>
                               <div class="form-group">
            <label>Link</label>
            <input type="text" name="dubbed_ott_link[]" value="<?php echo $ott_link[$count];?>" id="ott_link" class="form-control">
   </div>
                              
   
</div>
 <?php $count++;} ?>
                             
                           
                              
  </div> 
</div>
    
   
</div>
    </div>
    
            
                    
                    
                              
           </div>                    
                    <div class="reset-button">

                                   <input type="submit" name="dubbed_details"  class="btn btn-add"  value="Updated Details">
                            
                              </div>          
        </div>
                        
        </div>
        </form>
        <?
        if(isset($_POST["dubbed_details"]))
        {
                      $film_id=mysqli_real_escape_string($con,$_POST["film_id"]); 
                       $q1="select * from film where id='$film_id'";
                                         $exe1=mysqli_query($con,$q1);
                                         $read1=mysqli_fetch_array($exe1);
                     $film_name=$read1["name"];
                      $isdubbed=mysqli_real_escape_string($con,$_POST["isdubbed"]);
                      $ismoredubbed=mysqli_real_escape_string($con,$_POST["ismoredubbed"]); 
                     $release_date_change=mysqli_real_escape_string($con,$_POST["release_date_change"]); 
                      $original_movie_language=mysqli_real_escape_string($con,implode(",",$_POST["original_movie_language"]));
                      $dubbing_movie_language=mysqli_real_escape_string($con,implode(",",$_POST["dubbing_movie_language"]));
                      $dubb_film_name=mysqli_real_escape_string($con,implode(",",$_POST["dubb_film_name"]));
                      $dubbed_date_release=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_date_release"]));
                      $dubbed_month_release=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_month_release"]));
                      $dubbed_year_release=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_year_release"]));
                      
                      $dubbed_youtube_link=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_youtube_link"]));
                      $dubbed_date_release_youtube=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_date_release_youtube"]));
                      $dubbed_month_release_youtube=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_month_release_youtube"]));
                      $dubbed_year_release_youtube=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_year_release_youtube"]));
                      $dubbed_ott_name=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_ott_name"]));
                      $dubbed_ott_link=mysqli_real_escape_string($con,implode(",",$_POST["dubbed_ott_link"]));
                       $cbfc_rating=mysqli_real_escape_string($con,$_POST["cbfc_rating"]);
                      $cbfc_certificate_no=mysqli_real_escape_string($con,$_POST["cbfc_certificate_no"]);
                      $cbfc_certificate_date=mysqli_real_escape_string($con,$_POST["cbfc_certificate_date"]);
                      $cbfc_certificate_month=mysqli_real_escape_string($con,$_POST["cbfc_certificate_month"]);
                      $cbfc_certificate_year=mysqli_real_escape_string($con,$_POST["cbfc_certificate_year"]);
                      $cbfc_running_time_minutes=mysqli_real_escape_string($con,$_POST["cbfc_running_time_minutes"]);
                      $cbfc_running_time_seconds=mysqli_real_escape_string($con,$_POST["cbfc_running_time_seconds"]);

                       $cbfc_rating_revised=mysqli_real_escape_string($con,$_POST["cbfc_rating_revised"]);
					    $new_cbfc_rating=mysqli_real_escape_string($con,$_POST["new_cbfc_rating"]);
						 $new_cbfc_certificate_date=mysqli_real_escape_string($con,$_POST["new_cbfc_certificate_date"]);
						  $new_cbfc_certificate_month=mysqli_real_escape_string($con,$_POST["new_cbfc_certificate_month"]);
						   $new_cbfc_certificate_year=mysqli_real_escape_string($con,$_POST["new_cbfc_certificate_year"]);
						    $new_cbfc_running_time_minutes=mysqli_real_escape_string($con,$_POST["new_cbfc_running_time_minutes"]);
							 $new_cbfc_running_time_seconds=mysqli_real_escape_string($con,$_POST["new_cbfc_running_time_seconds"]);
                      $dubbed_details_q="update film_diffrent_name_language set release_date_change='$release_date_change',updated_at='$last_update',name='$film_name',film_id='$film_id',lanaguage_change='$dubbing_movie_language',diffrent_film_name='$dubb_film_name',release_date='$dubbed_date_release',release_month='$dubbed_month_release',release_year='$dubbed_year_release',youtube_movie_link='$dubbed_youtube_link',upload_date='$dubbed_date_release_youtube',upload_month='$dubbed_month_release_youtube',upload_year='$dubbed_year_release_youtube',ott_platform_name='$dubbed_ott_name',ott_link='$dubbed_ott_link',cbfc_rating='$cbfc_rating',cbfc_certificate_no='$cbfc_certificate_no',cbfc_certificate_date='$cbfc_certificate_date',cbfc_certificate_month='$cbfc_certificate_month',cbfc_certificate_year='$cbfc_certificate_year',cbfc_running_time_minutes='$cbfc_running_time_minutes',cbfc_running_time_seconds='$cbfc_running_time_seconds',cbfc_rating_revised='$cbfc_rating_revised',new_certificate_date='$new_cbfc_certificate_date',new_certificate_month='$new_cbfc_certificate_month',new_certificate_year='$new_cbfc_certificate_year',new_certificate_min='$new_cbfc_running_time_minutes',new_certificate_sec='$new_cbfc_running_time_seconds',new_certificate_rating='$new_cbfc_rating' where id='$edit_id'";
                       mysqli_query($con,$dubbed_details_q) or die(mysqli_error($con));
  echo "<script>alert('Details Updated Succesfully')</script>";
  echo "<script>window.location.href='film_diffrent_name_list.php'</script>";
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
  $(document).ready(function() {
    $('.orignal_language').select2();
});
</script>
<script>
  $(document).ready(function() {
    $('.dubbing_lang').select2();
});
</script>
 <script>
$(document).ready(function(){

    var maxField1 = 10; //Input fields increment limitation
    var addButton1 = $('.add_button1'); //Add button selector
    var wrapper1 = $('.field_wrapper1'); //Input field wrapper
    var fieldHTML1 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a> <div class="form-group">'+
                                '<label>OTT Platform Name:</label>'+
                                 
   '<select  class="form-control" name="dubbed_ott_name[]"  style="width:100%;">'+
       '<option value="">-Please Select OTT Platform-</option>'+
                                  <? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                              '</div>'+
                               '<div class="form-group">'+
            '<label>Link</label>'+
            '<input type="text" name="dubbed_ott_link[]" id="ott_link" class="form-control">'+
   '</div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton1).click(function(){
        //Check maximum number of input fields
        if(x < maxField1){ 
            x++; //Increase field counter
            $(wrapper1).append(fieldHTML1); //Add field html
           
        }else{
            alert('A maximum of '+maxField1+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper1).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>
<script>
$(document).ready(function(){

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
   
                              '<div class="form-group">'+
                                '<label>Original Lanaguage(s)</label>'+
   '<select class="form-control dubbing_lang" name="original_movie_language[]" multiple="multiple" style="width:100%;">'+
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>
'<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                                 
                              '</div>'+
    '<div class="form-group"><label>Dubbing Lanaguage(s)</label><select  class="form-control dubbing_lang" name="dubbing_movie_language[]" multiple="multiple" style="width:100%;">'+
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                '</select>'+
                              '</div>'+
                               '<div class="form-group">'+
            '<label>Dubbing Film Name</label>'+
            '<input list="dubb_film_name_list" id="dubb_film_name" name="dubb_film_name[]" class="form-control">'+
'<datalist id="dubb_film_name_list">'+
    <? $sqlfrm=mysqli_query($con, "select * from film1 order by name");
    while($rowfrm=mysqli_fetch_array($sqlfrm)){ ?>
 '<option value="<? echo $rowfrm['name']; ?>"/>'+
     <? } ?>
'</datalist>'+
                              '</div>'+
                              '<div class="form-group">'+
                                 '<label>Release Date</label>'+
                                 '<input type="text" class="form-control" name="dubbed_date_release[]" placeholder="Enter Release Date"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label>Release Month</label>'+
                                 '<input type="text" class="form-control" name="dubbed_month_release[]" placeholder="Enter Release Month"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label>Release Year</label>'+
                                 '<input type="text" class="form-control" name="dubbed_year_release[]" placeholder="Enter Release Year"  >'+
                              '</div>'+
                              
                              '<div class="form-group">'+
                                 '<label>YouTube Movie Link</label>'+
                                 '<input type="text" class="form-control" name="dubbed_youtube_link[]" placeholder="Enter You Tube Movie Link"  >'+
                              '</div>'+
                              '<div class="form-group">'+
                                 '<label>Upload Full Date:</label>'+
                             
                              '</div>'+
                               '<div class="form-group">'+
                                 '<label>Upload Date</label>'+
                                 '<input type="text" class="form-control" name="dubbed_date_release_youtube[]" placeholder="Enter Release Date"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label>Upload Month</label>'+
                                 '<input type="text" class="form-control" name="dubbed_month_release_youtube[]" placeholder="Enter Release Month"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label>Upload Year</label>'+
                                 '<input type="text" class="form-control" name="dubbed_year_release_youtube[]" placeholder="Enter Release Year"  >'+
                              '</div>'+
                              '<br/>'+
        '<div class="field_wrapper1">'+
    '<label>OTT Platform Details</label>'+
          '<a href="javascript:void(0);" class="add_button1 btn btn-success" title="Add More">Add More</a>'+
                           '<div class="form-group">'+
                                '<label>OTT Platform Name:</label>'+                        
   '<select  class="form-control" name="dubbed_ott_name[]"  style="width:100%;">'+
       '<option value="">-Please Select OTT Platform-</option>'+
                                  <? $sqlfr=mysqli_query($con, "select * from ott_platform order by name");
                                 
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                              '</div>'+
                               '<div class="form-group">'+
            '<label>Link</label>'+
            '<input type="text" name="dubbed_ott_link[]" id="ott_link" class="form-control">'+
   '</div>'+
'</div>'+
                              '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increase field counter
            $(wrapper).append(fieldHTML); //Add field html
             $('.dubbing_lang').select2();
        }else{
            alert('A maximum of '+maxField+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>
<script>
$(function() {
    jQuery(document).ready(function($){
        if($('#ismoredubbed').val() == 'Yes') {
            $('#ismoredubbedsection').show(); 
        } else {
            $('#ismoredubbedsection').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#ismoredubbed").change(function(){
        if($('#ismoredubbed').val() == 'Yes') {
            $('#ismoredubbedsection').show(); 
        } else {
            $('#ismoredubbedsection').hide(); 
        } 
    });
});
 </script>
 
 <script>
$(function() {
   $("#isdubbed").change(function(){
        if($('#isdubbed').val() == 'Yes') {
            $('#isdubbedsection').show(); 
        } else {
            $('#isdubbedsection').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#cbfc_rating_revised").change(function(){
        if($('#cbfc_rating_revised').val() == 'Yes') {
            $('#new_cbfc_rating_panel').show(); 
        } else {
            $('#new_cbfc_rating_panel').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#cbfc_rating_revised').val() == 'Yes') {
            $('#new_cbfc_rating_panel').show(); 
        } else {
            $('#new_cbfc_rating_panel').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#release_date_details').val() == 'yes') {
            $('#release_date_section').show(); 
        } else {
            $('#release_date_section').hide(); 
        } 
    });
});
 </script>
   <script>
$(function() {
   $("#release_date_details").change(function(){
        if($('#release_date_details').val() == 'yes') {
            $('#release_date_section').show(); 
        } else {
            $('#release_date_section').hide(); 
        } 
    });
});
 </script>

</body>
</html>