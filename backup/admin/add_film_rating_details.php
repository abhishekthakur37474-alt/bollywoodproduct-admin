<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      ?>
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Add Film Rating Details</title>
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
                  <h1>Film Rating Details Management</h1>
                  <small>Add Film Rating Details</small>
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
                                 <h4>Add Film Rating Details Here</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                  <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                                   <div class="form-group">
<label>Select Film:</label>

<select class="main_language form-control" name="film_id" style="width:100%;" required>
<option value="">-Select Film-</option>

<?php
$sqlfr = mysqli_query($con, "
SELECT 
    f.id,
    f.name,
    f.year_release,
    f.type,
    f.season,
    d.name AS lang_name
FROM film f
LEFT JOIN dubbing d 
ON d.id = COALESCE(NULLIF(f.main_lang,''), f.dubbing)
ORDER BY f.id DESC
");

while($rowfr = mysqli_fetch_assoc($sqlfr)){

$display = $rowfr['name'];

if($rowfr['type'] == "Web Series" && !empty($rowfr['season'])){
    $display .= " (Season ".$rowfr['season']." - ".$rowfr['year_release']." - ".$rowfr['lang_name'].")";
}else{
    $display .= " (".$rowfr['year_release']." - ".$rowfr['lang_name'].")";
}
?>

<option value="<?php echo $rowfr['id']; ?>">
<?php echo $display; ?>
</option>

<?php } ?>

</select>
</div>
                  
                              <div class="form-group">
                                 <label>IMDB Rating</label>
                                 <input type="text" class="form-control" name="imdb_rating" placeholder="Enter IMDB Rating"  >
                              </div>
                              <div class="form-group">
                                 <label>Bollywood Product Rating</label>
                                 <input type="text" class="form-control" name="rating" placeholder="Enter Rating"  >
                              </div>
                               <div class="panel-body">
                                <div class="form-group">
                                 <label>CBFC Rating</label>
                              
 <select name="cbfc_rating[]" class="form-control"> 
                                 

<option value="">-Please Select-</option>
<option value="A" <? if($row['cbfc_rating']=="A"){echo "selected"; } ?> >A</option>
<option value="UA" <? if($row['cbfc_rating']=="UA"){echo "selected"; } ?> >UA</option>
<option value="U" <? if($row['cbfc_rating']=="U"){echo "selected"; } ?> >U</option>
<option value="UA 7" <? if($row['cbfc_rating']=="UA 7"){echo "selected"; } ?> >UA 7+</option>
<option value="UA 13" <? if($row['cbfc_rating']=="UA 13"){echo "selected"; } ?> >UA 13+</option>
<option value="UA 16" <? if($row['cbfc_rating']=="UA 16"){echo "selected"; } ?> >UA 16+</option>
<option value="S" <? if($row['cbfc_rating']=="S"){echo "selected"; } ?> >S</option>
                                 
                                 </select>
                              </div>
                                <div class="form-group">
                                <label>Certificate issue for Lanaguage</label>
                                 
   <select class="main_language"  class="form-control" name="main_language[]" >
       <option value="">-Please Select Lanaguage-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                               <div class="form-group">
                                 <label>-Certificate issue Country-</label>
                                <select class="form-control main_language" id="country_id" name="country_id[]" >
                                 <option value="">-Select Country-</option>
                                 <?
                                $select_country="select * from  country1";
                                $exe_country=mysqli_query($con,$select_country);
                                while($read_country=mysqli_fetch_array($exe_country)){
                                   ?>
                                   <option value="<?echo $read_country["country_name"]?>"><?echo $read_country["country_name"]?></option>
                                   <? } ?>
                              
                                </select>
                              </div>
                              <div class="form-group">
                                 <label>-Certificate State/City-</label>
                                <select class="form-control main_language" id="country_id" name="state_city[]" >
                                 <option value="">-Select State/City-</option>
                                 <?
                                $select_city_state="SELECT city FROM city1 UNION SELECT state FROM state1";
                                $exe_city_state=mysqli_query($con,$select_city_state);
                                while($read_city_state=mysqli_fetch_array($exe_city_state)){
                                   ?>
                                   <option value="<?echo $read_city_state["city"]?>"><?echo $read_city_state["city"]?></option>
                                   <? } ?>
                              
                                </select>
                              </div>
                                <div class="form-group">
                                 <label>CBFC Certificate No</label>
                                 <input type="text" class="form-control" name="cbfc_certificate_no[]" placeholder="Enter cbfc_certificate_no"  >
                              </div>

    
                              
      <div class="form-group">
                                 <label>CBFC Certificate Date</label>
                                 <input type="text" class="form-control" name="cbfc_certificate_date[]" placeholder="Enter cbfc_certificate_date"  >
                              </div>
                        
      <div class="form-group">
                                 <label>CBFC Certificate Month</label>
                                 <input type="text" class="form-control" name="cbfc_certificate_month[]" placeholder="Enter cbfc_certificate_month" >
                              </div>
                        
      <div class="form-group">
                                 <label>CBFC Certificate Year</label>
                                 <input type="text" class="form-control" name="cbfc_certificate_year[]" placeholder="Enter cbfc_certificate_year" >
                              </div>

                          
      <div class="form-group">
                                 <label>CBFC Running Time Minutes</label>
                                 <input type="text" class="form-control" name="cbfc_running_time_minutes[]" placeholder="Enter cbfc_running_time_minutes" >
                              </div>

                              
      <div class="form-group">
                                 <label>CBFC Running Time Seconds</label>
                                 <input type="text" class="form-control" name="cbfc_running_time_seconds[]" placeholder="Enter cbfc_running_time_seconds" >
                              </div>
                               <a href="javascript:void(0);" class="add_button2 btn btn-success pull-right" title="Add More">Add More</a><br/>
                               <div class="field_wrapper2"></div>
                            </div> 

                              
    
                               <div class="reset-button">
                               <input type="submit" name="UpdateRating" class="btn btn-add"   value="Add Rating">
                               </div>
              </div>
              
              </div>
             
              </form>
              <?php
               if(isset($_POST["UpdateRating"]))
                  {
                      $film_id=mysqli_real_escape_string($con,$_POST["film_id"]); 
                       $film_name_q="select * from film where id='$film_id'";
           $sqlfr_film_name=mysqli_query($con,$film_name_q);
           $read_film_name=mysqli_fetch_array($sqlfr_film_name);
                          $film_name=mysqli_real_escape_string($con,$read_film_name["name"]);
                      $imdb_rating=mysqli_real_escape_string($con,$_POST["imdb_rating"]);
                      $rating=mysqli_real_escape_string($con,$_POST["rating"]);
                      $cbfc_rating=mysqli_real_escape_string($con,implode(",",$_POST["cbfc_rating"]));
                      $main_language=mysqli_real_escape_string($con,implode(",",$_POST['main_language']));
                      $country_id=mysqli_real_escape_string($con,implode(",",$_POST['country_id']));
                      $state_city=mysqli_real_escape_string($con,implode(",",$_POST['state_city']));
                      $cbfc_certificate_no=mysqli_real_escape_string($con,implode(",",$_POST["cbfc_certificate_no"]));
                      $cbfc_certificate_date=mysqli_real_escape_string($con,implode(",",$_POST["cbfc_certificate_date"]));
                      $cbfc_certificate_month=mysqli_real_escape_string($con,implode(",",$_POST["cbfc_certificate_month"]));
                      $cbfc_certificate_year=mysqli_real_escape_string($con,implode(",",$_POST["cbfc_certificate_year"]));
                      $cbfc_running_time_minutes=mysqli_real_escape_string($con,implode(",",$_POST["cbfc_running_time_minutes"]));
                      $cbfc_running_time_seconds=mysqli_real_escape_string($con,implode(",",$_POST["cbfc_running_time_seconds"]));
                    
                     
                      $rating_value="insert into film_rating_management set name='$film_name',film_id='$film_id',imdb_rating='$imdb_rating',rating='$rating',cbfc_rating='$cbfc_rating',language='$main_language',country='$country_id',state='$state_city',certificate_no='$cbfc_certificate_no',certificate_date='$cbfc_certificate_date',certificate_month='$cbfc_certificate_month',certificate_year='$cbfc_certificate_year',running_time_minutes='$cbfc_running_time_minutes',running_time_seconds='$cbfc_running_time_seconds'";
                      mysqli_query($con,$rating_value);
                      echo "<script>alert('Rating Details Save Successfully')</script>";
                      echo "<script>window.location.href='film_rating_management.php'</script>";
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
$(document).ready(function(){
    var maxField2 = 10; //Input fields increment limitation
    var addButton2 = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper2'); //Input field wrapper
    var fieldHTML2 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+


'<div class="form-group">'+
'<label>CBFC Rating</label>'+
'<select name="cbfc_rating[]" class="form-control">'+
'<option value="">-Please Select-</option>'+
'<option value="A" <? if($row['cbfc_rating']=="A"){echo "selected"; } ?> >A</option>'+
'<option value="UA" <? if($row['cbfc_rating']=="UA"){echo "selected"; } ?> >UA</option>'+
'<option value="U" <? if($row['cbfc_rating']=="U"){echo "selected"; } ?> >U</option>'+
'<option value="UA 7" <? if($row['cbfc_rating']=="UA 7"){echo "selected"; } ?> >UA 7+</option>'+
'<option value="UA 13" <? if($row['cbfc_rating']=="UA 13"){echo "selected"; } ?> >UA 13+</option>'+
'<option value="UA 16" <? if($row['cbfc_rating']=="UA 16"){echo "selected"; } ?> >UA 16+</option>'+
'<option value="S" <? if($row['cbfc_rating']=="S"){echo "selected"; } ?> >S</option>'+
'</select>'+
'</div>'+

 '<div class="form-group">'+
 '<label>Certificate issue for Lanaguage</label>'+
                                 
   '<select class="main_language"  class="form-control" name="main_language[]" >'+
       '<option value="">-Please Select Lanaguage-</option>'+
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                '</select>'+
                                 
                              '</div>'+
 '<div class="form-group">'+
                                 '<label>-Certificate issue Country-</label>'+
                                '<select class="form-control main_language" id="country_id" name="country_id[]" >'+
                                 '<option value="">-Select Country-</option>'+
                                 <?
                                $select_country="select * from  country1";
                                $exe_country=mysqli_query($con,$select_country);
                                while($read_country=mysqli_fetch_array($exe_country)){
                                   ?>
                                   '<option value="<?echo $read_country["id"]?>"><?echo $read_country["country_name"]?></option>'+
                                   <? } ?>
                              
                                '</select>'+
                              '</div>'+
                              '<div class="form-group">'+
                                 '<label>-Certificate State/City-</label>'+
                                '<select class="form-control main_language" id="state_city" name="state_city[]">'+
                                 '<option value="">-Select State/City-</option>'+
                                 <?
                                $select_city_state="SELECT city FROM city1 UNION SELECT state FROM state1";
                                $exe_city_state=mysqli_query($con,$select_city_state);
                                while($read_city_state=mysqli_fetch_array($exe_city_state)){
                                   ?>
                                   '<option value="<?echo $read_city_state["city"]?>"><?echo $read_city_state["city"]?></option>'+
                                   <? } ?>
                              
                               '</select>'+
                              '</div>'+

      '<div class="form-group">'+
                                 '<label>CBFC Certificate No</label>'+
                                 '<input type="text" class="form-control" name="cbfc_certificate_no[]" placeholder="Enter cbfc_certificate_no"  >'+
                              '</div>'+

    
                              
      '<div class="form-group">'+
                                 '<label>CBFC Certificate Date</label>'+
                                 '<input type="text" class="form-control" name="cbfc_certificate_date[]" placeholder="Enter cbfc_certificate_date"  >'+
                              '</div>'+
                        
      '<div class="form-group">'+
                                 '<label>CBFC Certificate Month</label>'+
                                 '<input type="text" class="form-control" name="cbfc_certificate_month[]" placeholder="Enter cbfc_certificate_month" >'+
                              '</div>'+
                        
      '<div class="form-group">'+
                                 '<label>CBFC Certificate Year</label>'+
                                 '<input type="text" class="form-control" name="cbfc_certificate_year[]" placeholder="Enter cbfc_certificate_year"  >'+
                              '</div>'+

                          
      '<div class="form-group">'+
                                 '<label>CBFC Running Time Minutes</label>'+
                                 '<input type="text" class="form-control" name="cbfc_running_time_minutes[]" placeholder="Enter cbfc_running_time_minutes">'+
                              '</div>'+

                              
      '<div class="form-group">'+
                                 '<label>CBFC Running Time Seconds</label>'+
                                 '<input type="text" class="form-control" name="cbfc_running_time_seconds[]" placeholder="Enter cbfc_running_time_seconds" >'+
                              '</div>'
 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton2).click(function(){
        //Check maximum number of input fields
        if(x < maxField2){ 
            x++; //Increase field counter
            $(wrapper2).append(fieldHTML2); //Add field html
            $('.main_language').select2();
			$('.flexdatalist1').flexdatalist({
     minLength: 1
});
           
        }else{
            alert('A maximum of '+maxField2+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper2).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>

</body>
</html>