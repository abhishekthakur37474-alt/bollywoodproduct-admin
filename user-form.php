<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
      ?>
<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_POST["basic_details"]) { 
    
    $meaningfilm= mysqli_real_escape_string($con,$_POST['film_meaning']); 
    $type= mysqli_real_escape_string($con,$_POST['type']); 
    $country= mysqli_real_escape_string($con,implode(",",$_POST['country']));
    $name= mysqli_real_escape_string($con,$_POST['name']); 
    $main_language= mysqli_real_escape_string($con,implode(",",$_POST['main_language']));
    $film_slug=mysqli_real_escape_string($con,$_POST['film_slug_permalink']);
    $panindia=mysqli_real_escape_string($con,$_POST['panindia']);
    $pan_language=mysqli_real_escape_string($con,implode(",",$_POST['pan_language']));
    $Real=mysqli_real_escape_string($con,$_POST['Real']);
    $Sequel=mysqli_real_escape_string($con,$_POST['Sequel']);
    $sequel_type=mysqli_real_escape_string($con,implode(",",$_POST['sequel_type']));
    $sequel_film_name=mysqli_real_escape_string($con,implode(",",$_POST['sequel_film_name']));
    $Installment=mysqli_real_escape_string($con,implode(",",$_POST['Installment']));
    $genre_id=mysqli_real_escape_string($con,implode(",",$_POST['genre_id']));
    $Multiple_Roles=mysqli_real_escape_string($con,$_POST['Multiple_Roles']);
    $multiple_actor_name=mysqli_real_escape_string($con,implode(",",$_POST['multiple_actor_name']));
    $multiple_character_name=mysqli_real_escape_string($con,implode(",",$_POST['multiple_character_name']));
    $multiple_remarks=mysqli_real_escape_string($con,implode(",",$_POST['multiple_remarks']));
    $budget=mysqli_real_escape_string($con,$_POST['budget']);
    $date_release= mysqli_real_escape_string($con,$_POST['date_release']);
    $month_release= mysqli_real_escape_string($con,$_POST['month_release']);
    $year_release= mysqli_real_escape_string($con,$_POST['year_release']);
    $shelved_unreleased=mysqli_real_escape_string($con,$_POST['shelved_unreleased']);
    $showonfront=mysqli_real_escape_string($con,$_POST['showonfront']);
    $releasing_platform=mysqli_real_escape_string($con,$_POST['releasing_platform']);
	$ott_platform_name=mysqli_real_escape_string($con,$_POST['ott_platform_name']);
    $posterbyurl=mysqli_real_escape_string($con,$_POST['posterbyurl']);
   

$fname1=strtolower(str_replace(" ", "-", $name)); 

$alias=preg_replace("/[^a-zA-Z0-9-]/", "",$fname1 );

  $film_basic_details="insert into film set type='$type',name='$name',alias='$alias',country='$country',budget='$budget',cbfc_releasing_platform='$releasing_platform',cbfc_releasing_platform_details='$ott_platform_name',main_lang='$main_language',youtube='$posterbyurl',date_release='$date_release',month_release='$month_release',year_release='$year_release',film_meaning='$meaningfilm',film_slug_permalink='$film_slug',panindia='$panindia',pan_language='$pan_language',real_name='$Real',sequel='$Sequel',sequel_type='$sequel_type',sequel_film_name='$sequel_film_name',installment='$Installment',multiple_roles='$Multiple_Roles',multiple_actor_name='$multiple_actor_name',multiple_character_name='$multiple_character_name',multiple_remarks='$multiple_remarks',shelved_unreleased='$shelved_unreleased',show_on_front='$showonfront',film_genre='$genre_id'";
mysqli_query($con,$film_basic_details) or die(mysqli_error($con));
  
         echo "<script>alert('Basic Details Save Succesfully')</script>";
  echo "<script>window.location.href='film_basic_details.php'</script>";
         }
         ?>
         
<!DOCTYPE html>
<html lang="en">
   
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Add Film Basic Details</title>
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

   
   
     ul {
      list-style:none;
    
    }

    .btn-add {
    background: #009688;
    color: #fbfbfb !important;
    border: 1px solid #009688;
    
}

.chek{
    display:inline-block;
    padding:10px;
}
 </style>

   </head>
   <body class="hold-transition sidebar-mini">
   <script type="text/javascript">
        function ShowHideDiv() {
            var ddlPassport = document.getElementById("ddlPassport");
            var dvPassport = document.getElementById("dvPassport");
            dvPassport.style.display = ddlPassport.value == "Staff Admin" ? "block" : "none";
        }
    </script>
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
                  <h1>User Management</h1>
                  <small>Add User Management list</small>
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
                                 <h4>Add Film Basic Details Here</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                             <form method="post" enctype="multipart/form-data">
          <div class="row">
              <div class="col-lg-12">
               <div class="form-group">
                                 <label>Role:</label>
                                 <select name="x" class="form-control" id="ddlPassport" onchange="ShowHideDiv()" name="Sequel" required>
                                      <option   name="x" value="Super Admin">Super Admin</option>
                                      <option name="x" value="Staff Admin">Staff Admin</option>
                                   
                                </select>
                              </div>
                              <div class="form-group">
                                 <label>User Name</label>
                                 <input type="text" class="form-control" name="name" placeholder="Enter name" required >
                              </div>
                              <div class="form-group">
                                 <label>Email</label>
                                 <input type="gmail" class="form-control" name="email" placeholder="Enter Email"  >
                              </div>
                                <div class="form-group">
                                 <label>Enter Password</label>
                                <input type="password" name="password" class="form-control"   placeholder="Enter password"/><br>
                               
                               <div class="form-group">
                                 <label>Enter Phone Number</label>
                                <input type="Number" name="number" class="form-control"   placeholder="Ennter Number"/> <div id="ispan" style="display: block;border: 1px solid black;padding: 14px;">
                                    </div><br>
                               <div class="form-group">
                                 <label>Image</label>
                                <input type="file" name="image" class="form-control"   placeholder="Ennter Image"/>
                               <br> 
                              <div id="dvPassport" style="display:none" class="form-group chek  form-check-inline">
                              <label>Permission</label><br><br>
                              <div class="form-check form-check-inline form-group chek">
    <label class="form-check-label" for="flexCheckDefault">
    News & FAQ Management
  </label>
   <ul>
      <li><label><input type="checkbox" name="news_faq[]" value="Edit" data-checkem-parent="nest"> Edit  </label></li>
      <li><label><input type="checkbox"  name="news_faq[]" value="Delete" data-checkem-parent="nest"> Delete</label></li>
        <ul>
</div>
 <div class="form-check  form-group chek">
    <label class="form-check-label" for="flexCheckDefaulta">
   Genre and Category
  </label>
  <ul>
      <li><label><input type="checkbox" name="news_tr[]" value="Edit" data-checkem-parent="nest"> Edit  </label></li>
      <li><label><input type="checkbox" name="news_tr[]" value="Delete" data-checkem-parent="nest"> Delete</label></li>
        <ul>
</div>
 

<div class="form-check  form-group chek">
    <label class="form-check-label" for="flexCheckCheckedv">
   Theater & Location 
  </label>
   <ul>
      <li><label><input type="checkbox" name="news_aa[]" value="Edit" data-checkem-parent="nest"> Edit  </label></li>
      <li><label><input type="checkbox" name="news_aa[]" value="Delete" data-checkem-parent="nest"> Delete</label></li>
        <ul>
</div>
<div class="form-check  form-group chek">
    <label class="form-check-label" for="flexCheckDefaultl">
  Blog Manegement 
  </label>
   <ul>
      <li><label><input type="checkbox" name="news_fass[]" value="Edit" data-checkem-parent="nest"> Edit  </label></li>
      <li><label><input type="checkbox" name="news_fass[]" value="Delete" data-checkem-parent="nest"> Delete</label></li>
        <ul>
</div>
<div class="form-check form-group chek">
    <label class="form-check-label" for="flexCheckDefaultm">
  Artists Management 
  </label>
   <ul>
      <li><label><input type="checkbox" name="news_faqgg[]" value="Edit" data-checkem-parent="nest"> Edit  </label></li>
      <li><label><input type="checkbox" name="news_faqgg[]" value="Delete" data-checkem-parent="nest"> Delete</label></li>
        <ul>
</div>

<div class="form-check form-group chek">
    <label class="form-check-label" for="flexCheckDefaultr">
  New Film Management 
  </label>
   <ul>
      <li><label><input type="checkbox" name="news_faqrr[]" value="Edit" data-checkem-parent="nest"> Edit  </label></li>
      <li><label><input type="checkbox" name="news_faqrr[]" value="Delete" data-checkem-parent="nest"> Delete</label></li>
        <ul>
</div>
<div class="form-check form-group chek">
    <label class="form-check-label" for="flexCheckDefaulte">
  Old Film Management 
  </label>
   <ul>
      <li><label><input type="checkbox" name="news_faqas[]" value="Edit" data-checkem-parent="nest"> Edit  </label></li>
      <li><label><input type="checkbox" name="news_faqas[]" value="Delete" data-checkem-parent="nest"> Delete</label></li>
        <ul>
</div>
<div class="form-check form-group chek">
    <label class="form-check-label" for="flexCheckDefaultj">
  Film Song Management 
  </label>
   <ul>
      <li><label><input type="checkbox" name="news_faqi[]" value="Edit" data-checkem-parent="nest"> Edit  </label></li>
      <li><label><input type="checkbox" name="news_faqi[]" value="Delete" data-checkem-parent="nest"> Delete</label></li>
        <ul>
</div>
<div class="form-check form-group chek">
    <label class="form-check-label" for="flexCheckDefaultq">
  Master Entries 
  </label>
   <ul>
      <li><label><input type="checkbox" name="news_faqasd[]" value="Edit" data-checkem-parent="nest"> Edit  </label></li>
      <li><label><input type="checkbox" name="news_faqasd[]" value="Delete" data-checkem-parent="nest"> Delete</label></li>
        <ul>
</div>
<div class="form-check form-group chek">
  <label class="form-check-label" for="flexCheckDefaultc">
  Slider Management 
  </label>
   <ul>
      <li><label><input type="checkbox" name="news_faqqw[]" value="Edit" data-checkem-parent="nest"> Edit  </label></li>
      <li><label><input type="checkbox" name="news_faqqw[]" value="Delete" data-checkem-parent="nest"> Delete</label></li>
        <ul>
</div>

                              </div>      
                               
                         <div class="reset-button">

                        <input type="submit" name="save"   class="btn btn-add"  value="Add Basic Record">
                           </div> 
                        
                        
        </form>  
        <?php
       if(isset($_POST['save']))
       {
        $role=$_POST["x"];
        $name=$_POST["name"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $number=$_POST["number"];
        $image=$_FILES["image"]['name'];
        $filetemplocation = $_FILES['image']['tmp_name'];
        move_uploaded_file ($filetemplocation,"user_img/".$image);
        $news_faq=implode(",",$_POST["news_faq"]);
         $news_tr=implode(",",$_POST["news_tr"]);
          $news_aa=implode(",",$_POST["news_aa"]);
           $news_fass=implode(",",$_POST["news_fass"]);
           $news_faqgg=implode(",",$_POST["news_faqgg"]);
           $news_faqrr=implode(",",$_POST["news_faqrr"]);
           $news_faqas=implode(",",$_POST["news_faqas"]);
           $news_faqi=implode(",",$_POST["news_faqi"]);
           $news_faqasd=implode(",",$_POST["news_faqasd"]);
           $news_faqqw=implode(",",$_POST["news_faqqw"]);
        $q="insert into userform set ROLE='$role',username='$name',email='$email',password='$password',number='$number',image='$image',news_and_faq_Management='$news_faq',genre_and_category='$news_tr',theater_and_location='$news_aa',blog_manegement='$news_fass',artists_management='$news_faqgg',new_film_management='$news_faqrr',old_film_management='$news_faqas',film_song_management='$news_faqi',master_entries='$news_faqasd',newss_and_faq_Management	='$news_faqqw'";
        $exe=mysqli_query($con,$q);
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
  
	/* Encode string to slug */
function convertToSlug(str) {
    
  //replace all special characters | symbols with a space
  str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
           .toLowerCase();
    
  // trim spaces at start and end of string
  str = str.replace(/^\s+|\s+$/gm,'');
    
  // replace space with dash/hyphen
  str = str.replace(/\s+/g, '-');  
 $("#film_slug_permalink").val(str); 
  //document.getElementById("slug1").innerHTML = str;
  //return str;
}
	</script>
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
$(document).ready(function(){
    var maxField_multiple_role = 10; //Input fields increment limitation
    var addButton_multiple_role = $('.add_button_multiple_role'); //Add button selector
    var wrapper_multiple_role = $('.field_wrapper_multiple_role'); //Input field wrapper
    var fieldHTML_multiple_role = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                              
                            '<div class="form-group">'+
                                '<label>Actors Name:</label>'+
                               '<select name="multiple_actor_name[]" class="form-control leadactor" style="width:100%;">'+
                                  <? $sqlfr=mysqli_query($con, "select * from cast order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['name']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                                '</div>'+
                                '<div class="form-group">'+
                                '<label>Character  Name:</label>'+
                                '<input type="text" name="multiple_character_name[]" class="form-control"/>'+
                                '</div>'+
                                '<div class="form-group">'+
                                '<label>Remarks:</label>'+
                                '<input type="text" name="multiple_remarks[]" class="form-control"/>'+
                                '</div>'+
                          
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    // Once add button is clicked
    $(addButton_multiple_role).click(function(){
        //Check maximum number of input fields
        if(x < maxField_multiple_role){ 
            x++; //Increase field counter
            $(wrapper_multiple_role).append(fieldHTML_multiple_role); //Add field html
           
        }else{
            alert('A maximum of '+maxField_multiple_role+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper_multiple_role).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
   
});

</script>

 <script>
$(document).ready(function(){

    var maxField3 = 10; //Input fields increment limitation
    var addButton3 = $('.add_button3'); //Add button selector
    var wrapper3 = $('.field_wrapper3'); //Input field wrapper
    var fieldHTML3 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                        '<label>Fill Following Franchise  Details of This Film:</label>'+
                                '<br/>'+
                                '<br/>'+
                        '<div class="form-group  ">'+
                                '<label>Select Sequel Type</label>'+
   '<select class="form-control" name="sequel_type[]" >'+
                                  '<option value="">-Please Select-</option>'+
                                     '<option value="Sequel">Sequel</option>'+
                                     '<option value="Prequel">Prequel</option>'+
                                     '<option value="Quasi Sequel">Quasi Sequel</option>'+
                                 '</select>'+
                              '</div>'+
                              
                              '<div class="form-group  ">'+
                             
                                 '<label>Film Title(s)</label>'+
                                 
 '<select class="main_language"  class="form-control" name="sequel_film_name[]" multiple="multiple">'+
                                  <? $sqlfr=mysqli_query($con, "select * from film order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){  $FilmName=$rowfr['name'];?>

'<option value="<? echo $rowfr['id']; ?>"><?  $FilmName1= str_replace("'", "", $FilmName);echo $FilmName1; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                                 
                              '</div>'+
                              
                              '<div class="form-group  ">'+
                                '<label>Installment:</label>'+
                                '<input type="text" name="Installment[]" class="form-control"/>'+
                                '</div>'+
                                
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton3).click(function(){
        //Check maximum number of input fields
        if(x < maxField3){ 
            x++; //Increase field counter
            $(wrapper3).append(fieldHTML3); //Add field html
            $('.main_language').select2();
           
        }else{
            alert('A maximum of '+maxField2+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper3).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>

   <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#Multiple_Roles').val() == 'Yes') {
            $('#is_Multiple_Roles').show(); 
        } else {
            $('#is_Multiple_Roles').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#Multiple_Roles").change(function(){
        if($('#Multiple_Roles').val() == 'Yes') {
            $('#is_Multiple_Roles').show(); 
        } else {
            $('#is_Multiple_Roles').hide(); 
        } 
    });
});
 </script>
 

 
 <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#panindia').val() == 'Yes') {
            $('#ispan').show(); 
        } else {
            $('#ispan').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#panindia").change(function(){
        if($('#panindia').val() == 'Yes') {
            $('#ispan').show(); 
        } else {
            $('#ispan').hide(); 
        } 
    });
});
 </script>
 
  <script>
$(function() {
    jQuery(document).ready(function($){
        if($('#Sequel').val() == 'Yes') {
            $('#isSequel').show(); 
        } else {
            $('#isSequel').hide(); 
        } 
    });
});
 </script>
 <script>
$(function() {
   $("#Sequel").change(function(){
        if($('#Sequel').val() == 'Yes') {
            $('#isSequel').show(); 
        } else {
            $('#isSequel').hide(); 
        } 
    });
});
 </script>
 
 
   <script>
$(function() {
    jQuery(document).ready(function($){
      
            $('#ott_platform_name').hide(); 
        
    });
});
 </script>
 
  <script>
$(function() {
   $("#releasing_platform").change(function(){
        if($('#releasing_platform').val() == 'OTT') {
            $('#ott_platform_name').show(); 
        } else {
            $('#ott_platform_name').hide(); 
        } 
    });
});
 </script>
 
   </body>
  
</html>

