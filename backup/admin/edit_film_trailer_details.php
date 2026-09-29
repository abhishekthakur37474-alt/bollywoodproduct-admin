<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      $edit_id=$_GET["id"];
$trailer_details="select * from film_trailer_management where id='$edit_id'";
$exe_edit=mysqli_query($con,$trailer_details) or die(mysqli_error($con));
$read=mysqli_fetch_array($exe_edit);
      ?>
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Trailer Details</title>
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
                  <h1>Film Trailer Details Management</h1>
                  <small>Edit New Film Trailer Details</small>
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
                                 <h4>Edit Film Trailer/Teaser Details Here</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                              <form method="post" enctype="multipart/form-data"  >
      <div class="field_wrapper2">
              <!--  <a href="javascript:void(0);" class="add_button2 btn btn-success pull-right" title="Add More">Add More</a>-->
                  <div class="form-group">
                                 <label>Select Film:</label>
                              <select class="main_language form-control" name="film_id" style="width:100%;" required>

<?php

$film_id = $read["film_id"];

/*
|--------------------------------------------------------------------------
| Get all films + dubbed names + different language names
|--------------------------------------------------------------------------
*/

$sqlfr = mysqli_query($con, "

    /* ORIGINAL FILM NAME */
    SELECT 
        f.id,
        NULL AS original_name,
        f.name AS display_name,
        f.year_release,
        f.type,
        f.season,
        d.name AS lang_name,
        'film' AS name_type
    FROM film f
    LEFT JOIN dubbing d 
        ON d.id = COALESCE(NULLIF(f.main_lang,''), f.dubbing)


    UNION ALL


    /* DUBBED FILM NAME */
    SELECT 
        f.id,
        fd.name AS original_name,
        fd.dubbing_film_name AS display_name,
        fd.upload_year AS year_release,
        f.type,
        f.season,
        fd.dubbing_lanaguage AS lang_name,
        'dubbed' AS name_type
    FROM film f

    INNER JOIN film_dubbed_management fd
        ON fd.film_id = f.id


    UNION ALL


    /* DIFFERENT LANGUAGE FILM NAME */
    SELECT 
        f.id,
        fn.name AS original_name,
        fn.diffrent_film_name AS display_name,
        f.year_release,
        f.type,
        f.season,
        fn.lanaguage_change AS lang_name,
        'different_name' AS name_type
    FROM film f

    INNER JOIN film_diffrent_name_language fn
        ON fn.film_id = f.id


    ORDER BY id DESC

");


while($rowfr = mysqli_fetch_assoc($sqlfr)){

 $store_name=$rowfr['display_name'];
    /*
    |--------------------------------------------------------------------------
    | Display Name
    |--------------------------------------------------------------------------
    */

    $display = $rowfr['display_name'];


    /*
    |--------------------------------------------------------------------------
    | Year + Language
    |--------------------------------------------------------------------------
    */

    if($rowfr['type'] == "Web Series" && !empty($rowfr['season'])){

        $display .= " (Season "
                  . $rowfr['season']
                  . " - "
                  . $rowfr['year_release']
                  . " - "
                  . $rowfr['lang_name']
                  . ")";

    }else{

        $display .= " ("
                  . $rowfr['year_release']
                  . " - "
                  . $rowfr['lang_name']
                  . ")";
    }


    /*
    |--------------------------------------------------------------------------
    | Original Name
    |--------------------------------------------------------------------------
    */

    if($rowfr['name_type'] != 'film'){

        $display .= " [ Original-"
                  . $rowfr['original_name']
                  . " ]";
    }


    /*
    |--------------------------------------------------------------------------
    | Selected Film
    |--------------------------------------------------------------------------
    */

    // Match both film ID and stored display name
    $selected = (
        $rowfr['id'] == $film_id &&
        $store_name 
    ) ? 'selected' : '';

?>

<option 
    value="<?php echo $rowfr['id'].'||'.base64_encode($store_name); ?>"
    <?php echo $selected; ?>
>
    <?php echo htmlspecialchars($display); ?>
</option>

<?php } ?>

</select>
                                  
                              </div>       
 <?php
 $trailer_category=$read["trailer_category"];
 $teaser=$read["teaser"];
 $trailer_release_date=$read["trailer_release_date"];
 $trailer_release_month=$read["trailer_release_month"];
 $trailer_release_year=$read["trailer_release_year"];

 $views=$read["views"];
 
 ?>
           
          <div class="row">
              <div class="col-lg-12">
                  <div class="form-group">
                                 <label>Trailer/Teaser Category</label>
                                 <select class="form-control" name="trailer_catgories">
                                     <option value="<?php echo $trailer_category;?>"><?php echo $trailer_category;?></option>
                                      <? $sqlfr=mysqli_query($con, "select * from film_trailer_categories order by film_trailer_name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['film_trailer_name']; ?>"><? echo $rowfr['film_trailer_name']; ?></option>
                                  <? } ?>
                                </select>
                              </div>
            
            <div class="form-group">
                                <label>Trailer/Teaser Lanaguage</label>
                                 
   <select class="main_language"  class="form-control" name="trailer_language" style="width:100%:" >
 <?php 
       $trailer_lang=$read["trailer_lanaguage"];
      
       ?>
       <option value="<? echo $trailer_lang; ?>" selected><? echo $trailer_lang; ?></option>
     
      
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                              
            <div class="form-group">
                                 <label>Trailer/Teaser Link</label>
                                 <input type="text" class="form-control" name="teaser" value="<?php echo $teaser;?>">
                                  
                              </div>
                              
                         
           
                              
           
                  <div class="form-group">
                                 <label> Trailer/Teaser Release Date</label>
                                 <input type="text" class="form-control" name="trailer_date_release" placeholder="Enter  Date Release" value="<?php echo $trailer_release_date;?>"   >
                              </div>
                          <div class="form-group">
                                 <label> Trailer/Teaser Release Month</label>
                                 <input type="text" class="form-control" name="trailer_month_release" placeholder="Enter  Month Release" value="<?php echo $trailer_release_month;?>"  >
                              </div>
                          <div class="form-group">
                                 <label> Trailer/Teaser Release Year</label>
                                 <input type="text" class="form-control" name="trailer_year_release" placeholder="Enter  Year Release"  value="<?php echo $trailer_release_year;?>" >
                              </div>
                              
                            
                        
                         
                            <div class="form-group">
                                 <label> Views (Million/Billion)</label>
                                 <input type="text" class="form-control" name="trailer_youtube_views"  value="<?php echo $views;?>">
                              </div>      
                          
                  </div>
                  </div>
                  <hr/>
              
                
                   </div>
   
                               <div class="reset-button">

                                   <input type="submit" name="trailer_details"  class="btn btn-add"  value="Update Trailer Details">
                            
                              </div>
                             
                  </form>
                  
                    <?
                  
                  if(isset($_POST["trailer_details"]))
                  {
                         $selectedFilm = $_POST['film_id'];

$parts = explode('||', $selectedFilm, 2);

$film_id = mysqli_real_escape_string($con, $parts[0]);

$film_name = '';

if(isset($parts[1])){
    $film_name = mysqli_real_escape_string(
        $con,
        base64_decode($parts[1])
    );
}
                      $trailer_catgories=mysqli_real_escape_string($con,$_POST["trailer_catgories"]); 
                      $trailer_language=mysqli_real_escape_string($con,$_POST["trailer_language"]);
                      $teaser=mysqli_real_escape_string($con,$_POST["teaser"]);
                      $trailer_date_release=mysqli_real_escape_string($con,$_POST["trailer_date_release"]);
                      $trailer_month_release=mysqli_real_escape_string($con,$_POST["trailer_month_release"]);
                      $trailer_year_release=mysqli_real_escape_string($con,$_POST["trailer_year_release"]);
                    
                      $trailer_youtube_views=mysqli_real_escape_string($con,$_POST["trailer_youtube_views"]);
                    
         
             $trailer_management_query="update film_trailer_management set name='$film_name',film_id='$film_id',trailer_category='$trailer_catgories',trailer_lanaguage='$trailer_language',teaser='$teaser',trailer_release_date='$trailer_date_release',trailer_release_month='$trailer_month_release',trailer_release_year='$trailer_year_release',views='$trailer_youtube_views',updated_date=now() where id='$edit_id'"; 
                  mysqli_query($con,$trailer_management_query) or die(mysqli_error($con));
  echo "<script>alert('Trailer Details Updated Succesfully')</script>";
  echo "<script>window.location.href='film_trailer_details.php'</script>";
            //header('location:film.php?msg=success');
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

</body>
</html>