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
      <title>Add Film Box Office Details</title>
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
<style>
    .day-wise-row {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 15px 10px;
        margin-bottom: 15px;
        background: #f8f9fa;
        position: relative;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .day-wise-row .removeDayRow {
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .day-wise-row h6 {
        font-weight: 600;
        margin-bottom: 15px;
        color: #343a40;
    }
    .day-wise-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #495057;
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
                  <h1>Film Box Office Details Management</h1>
                  <small>Add Film Box Office Details</small>
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
                                 <h4>Add Film Box Office Details Here</h4>
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
                                 <label>Currency Symbol</label>
                                 <select class="form-control" name="currency_symbol">
                                     <option value="">-Select Type-</option>
                                     <option value="&#8377;">&#8377; Rupee</option>
                                     <option value="&#36;"> Dollar</option>
                                </select>
                              </div>
                              
       <div class="form-group">
                                 <label>Box Office India Net</label>
                                 <input type="text" class="form-control" name="box_office_india_net"  placeholder="Enter Box Office India Net"  >
                              </div>
        <div class="form-group">
                                 <label>Box Office India Gross</label>
                                 <input type="text" class="form-control amount" name="box_office_india_gross" onkeyup="findTotal()" placeholder="Enter Box Office India Gross"  >
                              </div>
        <div class="form-group">
                                 <label>Box Office Oversease</label>
                                 <input type="text" class="form-control amount" name="box_office_overseases" onkeyup="findTotal()" placeholder="Enter Box Office Oversease"  >
                              </div>
        <div class="form-group">
                                 <label>Box Office Worldwide</label>
                                 <input type="text" class="form-control" id="totalordercost" name="box_office_worldwide" placeholder="Enter Box Office Worldwide"  >
                              </div>
                    
    
     <div class="form-group">
                                 <label>Re-Release Box Office</label>
                                 <input type="text" class="form-control" id="re_release_box_office" name="re_release_box_office" placeholder="Enter Re-Release Box Office"  >
   </div>
     <div class="form-group">
                                 <label>Note for Box Office Worldwide </label>
                                 <input type="text" class="form-control" id="note_for_box_office_worldwide" name="note_for_box_office_worldwide" placeholder="Enter Note For Box Office"  >
   </div>
   
   
   <hr>
<center><span style="
    color: red;
    font-size: 18px;
    margin-bottom: 20px;
    display: inline-block;
">Day Wise Collection:</span></center>
<div id="dayWiseCollectionContainer">
  <!-- First row will be here -->
</div>

<button type="button" class="btn btn-success mt-3" id="addDayWiseRow" style="float:right;">
  ➕ Add Day Wise Collection
</button>
                    
    </div>
    <div class="reset-button">

                                   <input type="submit" name="box_office_details"  class="btn btn-add"  value="Add Box Office Details">
                            
                              </div>
    </div>
    </form>
    
    <?
    if(isset($_POST["box_office_details"]))
    {
          $film_id=mysqli_real_escape_string($con,$_POST["film_id"]); 
          $film_name_q="select * from film where id='$film_id'";
           $sqlfr_film_name=mysqli_query($con,$film_name_q);
           $read_film_name=mysqli_fetch_array($sqlfr_film_name);
                          $film_name=mysqli_real_escape_string($con,$read_film_name["name"]);
          $currency_symbol=mysqli_real_escape_string($con,$_POST["currency_symbol"]);
          $box_office_india_net=mysqli_real_escape_string($con,$_POST["box_office_india_net"]);
          $box_office_india_gross=mysqli_real_escape_string($con,$_POST["box_office_india_gross"]);
          $box_office_overseases=mysqli_real_escape_string($con,$_POST["box_office_overseases"]);
          $box_office_worldwide=mysqli_real_escape_string($con,$_POST["box_office_worldwide"]);
         $re_release_box_office=mysqli_real_escape_string($con,$_POST["re_release_box_office"]);
         $note_for_worldwide=mysqli_real_escape_string($con,$_POST["note_for_box_office_worldwide"]);

$day_number=mysqli_real_escape_string($con,implode(",",$_POST["day_number"]));
$country_id=mysqli_real_escape_string($con,implode(",",$_POST["country_id"]));
$currency_code=mysqli_real_escape_string($con,implode(",",$_POST["currency_code"]));
$currency_format=mysqli_real_escape_string($con,implode(",",$_POST["currency_format"]));
$collection_language=mysqli_real_escape_string($con,implode(",",$_POST["collection_language"]));
$nett=mysqli_real_escape_string($con,implode(",",$_POST["nett"]));
$gross=mysqli_real_escape_string($con,implode(",",$_POST["gross"]));
$overseas=mysqli_real_escape_string($con,implode(",",$_POST["overseas"]));
$worldwide=mysqli_real_escape_string($con,implode(",",$_POST["worldwide"]));

          $box_office_details="insert into  film_box_office_management set re_release_box_office='$re_release_box_office',name='$film_name',film_id='$film_id',currency_symbol='$currency_symbol',box_office_india_nett='$box_office_india_net',box_office_india_gross='$box_office_india_gross',box_office_oversease='$box_office_overseases',box_office_worldwide='$box_office_worldwide',day_number='$day_number',country='$country_id',currency_code='$currency_code',currency_format='$currency_format',language='$collection_language',nett='$nett',gross='$gross',overseas='$overseas',worldwide='$worldwide',note_for_worldwide='$note_for_worldwide'";
          mysqli_query($con,$box_office_details);
                      echo "<script>alert('Box Office Details Save Successfully')</script>";
                      echo "<script>window.location.href='film_box_office_management.php'</script>";
    }
    
    ?>
               <script>
                   function findTotal(){
   var arr = document.getElementsByClassName('amount');
var tot = 0;

for (var i = 0; i < arr.length; i++) {
    var val = parseFloat(arr[i].value || arr[i].textContent || 0);
    if (!isNaN(val)) {
        tot += val;
    }
}

// Round to 2 decimals if needed
document.getElementById('totalordercost').value = tot.toFixed(2);
}
               </script>


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
// Template function for a day-wise row
const dayWiseTemplate = () => `
  <div class="day-wise-row row gx-2 gy-3 border p-3 mb-3 rounded shadow-sm bg-white">

    <!-- 🔹 Row 1 -->
    <div class="row">
    <div class="col-md-2">
      <label class="form-label">Day #</label>
      <input type="number" name="day_number[]" class="form-control" placeholder="1">
    </div>
    <div class="col-md-2">
      <label class="form-label">Country</label>
       <select class="form-control search" id="country_id" name="country_id[]">
                                 <option value="1">India</option>
                                 <?
                                $select_country="select * from  country1";
                                $exe_country=mysqli_query($con,$select_country);
                                while($read_country=mysqli_fetch_array($exe_country)){
                                   ?>
                                   <option value="<?echo $read_country["id"]?>"><?echo $read_country["country_name"]?></option>
                                   <? } ?>
                              
                                </select>
    </div>
    <div class="col-md-2">
      <label class="form-label">Currency Code</label>
       <select class="form-control search" id="courrency_code" name="currency_code[]">
                                 <option value="INR">INR</option>
      <?
                                $select_currency_code="select * from  currency_master";
                                $exe_currency_code=mysqli_query($con,$select_currency_code);
                                while($read_currency_code=mysqli_fetch_array($exe_currency_code)){
                                   ?>
                                   <option value="<?echo $read_currency_code["currency_code"]?>"><?echo $read_currency_code["currency_code"]?></option>
                                   <? } ?>
      </select>
    </div>
    <div class="col-md-2">
      <label class="form-label">Currency Format</label>
      <select name="currency_format[]" class="form-select form-control">
        <option value="Crore">Crore</option>
        <option value="Million">Million</option>
        <option value="Lakh">Lakh</option>
      </select>
    </div>
    <div class="col-md-3">
      <label class="form-label">Language</label>
      <select name="collection_language[]" class="form-select form-control search">
        <option value="">Select Language</option>
        <?
        $select_language="select * from  dubbing";
                                $exe_language_code=mysqli_query($con,$select_language);
                                while($read_language_code=mysqli_fetch_array($exe_language_code)){
                                   ?>
                                   <option value="<?echo $read_language_code["id"]?>"><?echo $read_language_code["name"]?></option>
                                   <? } ?>
      </select>
    </div>
</div>

    <!-- 🔸 Row 2 -->
    <div class="row">
    <div class="col-md-2">
      <label class="form-label">NETT</label>
      <input type="text" name="nett[]" class="form-control text-end" placeholder="0.00">
    </div>
    <div class="col-md-2">
      <label class="form-label">GROSS</label>
      <input type="text" name="gross[]" class="form-control text-end" placeholder="0.00">
    </div>
    <div class="col-md-2">
      <label class="form-label">OVERSEAS</label>
      <input type="text" name="overseas[]" class="form-control text-end" placeholder="0.00">
    </div>
    <div class="col-md-3">
      <label class="form-label">WORLDWIDE</label>
      <input type="text" name="worldwide[]" class="form-control text-end bg-light" placeholder="0.00">
    </div>

    <!-- ❌ Delete Button -->
    <div class="col-md-1 d-flex align-items-end">
      <button type="button" class="btn btn-danger btn-sm removeDayRow w-100">Remove</button>
    </div>
    </div>
  </div>
`;

// Insert first row on page load
$(document).ready(function () {
 // $('#dayWiseCollectionContainer').append(dayWiseTemplate());
});

// Add more rows
$('#addDayWiseRow').click(function () {
  $('#dayWiseCollectionContainer').append(dayWiseTemplate());
   $('.search').select2();
  
});

// Auto-sum logic
$(document).on('input', '.day-wise-row input[name="nett[]"], .day-wise-row input[name="gross[]"], .day-wise-row input[name="overseas[]"]', function () {
  const row = $(this).closest('.day-wise-row');

  const gross = parseFloat(row.find('input[name="gross[]"]').val()) || 0;
  const overseas = parseFloat(row.find('input[name="overseas[]"]').val()) || 0;

  const worldwide = gross + overseas;
  row.find('input[name="worldwide[]"]').val(worldwide.toFixed(2));
});

// Remove row
$(document).on('click', '.removeDayRow', function () {
  $(this).closest('.day-wise-row').remove();
});
  $(document).ready(function() {
    $('.search').select2();
});
</script>


<script>
$(document).on('input', '.day-wise-row input[name="nett[]"], .day-wise-row input[name="gross[]"], .day-wise-row input[name="overseas[]"]', function () {
    const row = $(this).closest('.day-wise-row');
    const gross = parseFloat(row.find('input[name="gross[]"]').val()) || 0;
    const overseas = parseFloat(row.find('input[name="overseas[]"]').val()) || 0;

    const worldwide =  gross + overseas;

    row.find('input[name="worldwide[]"]').val(worldwide.toFixed(2));
});
</script>

</body>
</html>