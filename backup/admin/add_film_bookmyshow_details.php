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
      <title>Add Film BookMyShow Details</title>
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
        border-bBookMyShowom:none;
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
                  <h1>BookMyShow Film Details Management</h1>
                  <small>Add BookMyShow Film Details</small>
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
                                 <h4>Add BookMyShow Film Details Here</h4>
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
                                    <option value="">-Select Film-</option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div> 
          <div class="field_wrapper6">
        	<a href="javascript:void(0);" class="add_button6 btn btn-success " title="Add More">Add More</a>
            <br>
      
      <div class="form-group  ">
                                <label>Main Lanaguage</label>
                                 
   <select class="main_language"  class="form-control" name="main_language_two[]" multiple="multiple" style="width:100%:" >
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 
                              </div>
                              
        <div class="form-group">
                                 <label>Bookmyshow Link</label>
                                 <input type="text" class="form-control" name="link_two[]" placeholder=""  >
                              </div>
                              
        <div class="form-group">
                                 <label>From</label>
                                 <input type="date" class="form-control" name="date_two[]" placeholder=""  >
                              </div>                      
       <div class="form-group">
                                 <label>To</label>
                                 <input type="date" class="form-control" name="date_three[]" placeholder=""  >
                              </div>    
                </div>
                </div>
                            <div class="reset-button">
                   <input type="submit" name="Updatebookshow_film" class="btn btn-add"   value="Add Bookmyshow" style="margin-top:10px;">       
        </div> 
                </div>
                </form>
                          <?php
               if(isset($_POST["Updatebookshow_film"]))
                  {
                      $film_id=mysqli_real_escape_string($con,$_POST["film_id"]);
                      $q="select * from film where id='$film_id'";
                                         $exe=mysqli_query($con,$q);
                                         $read=mysqli_fetch_array($exe);
                     $film_name=$read["name"]; 
                      $main_language_book=mysqli_real_escape_string($con,implode(",",$_POST["main_language_two"])); 
                      $link_two=mysqli_real_escape_string($con,implode(",",$_POST["link_two"]));
                      $date_two=mysqli_real_escape_string($con,implode(",",$_POST["date_two"]));
                      $date_three=mysqli_real_escape_string($con,implode(",",$_POST["date_three"]));
                       $book_my="insert into bookmyshow set name='$film_name',film_id='$film_id',main_lanaguage='$main_language_book',bookmyshow_link='$link_two',from_two='$date_two',to_bookshow='$date_three'";
                      mysqli_query($con,$book_my);
                      echo "<script>alert('Bookmyshow  Details Save Successfully')</script>";
                      echo "<script>window.location.href='film_bookmyshow_management.php'</script>";
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
$(document).ready(function(){

    var maxField6 = 10; //Input fields increment limitation
    var addButton6 = $('.add_button6'); //Add button selector
    var wrapper6 = $('.field_wrapper6'); //Input field wrapper
    var fieldHTML6 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                              
                            '<div class="form-group  ">'+
                                '<label>Main Lanaguage</label>'+
                                 
   '<select class="main_language"  class="form-control" name="main_language_two[]" multiple="multiple" style="width:100%:" >'+
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                              '</div>'+
                              
                              '<div class="form-group">'+
                                 '<label>Bookmyshow Link</label>'+
                                 '<input type="text" class="form-control" name="link_two[]" placeholder=""  >'+
                              '</div>'+
                              
        '<div class="form-group">'+
                                 '<label>From</label>'+
                                 '<input type="date" class="form-control" name="date_two[]" placeholder=""  >'+
                              '</div>'+
       '<div class="form-group">'+
                                 '<label>To</label>'+
                                 '<input type="date" class="form-control" name="date_three[]" placeholder=""  >'+
                              '</div>'+
                              
                              
                                '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
     
    // Once add button is clicked
    $(addButton6).click(function(){
        //Check maximum number of input fields
        if(x < maxField6){ 
            x++; //Increase field counter
            $(wrapper6).append(fieldHTML6); //Add field html
            $('.main_language').select2();
           
        }else{
            alert('A maximum of '+maxField2+' fields are allowed to be added. ');
        }
    });
    
    // Once remove button is clicked
    $(wrapper6).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrease field counter
    });
});
</script>
</body>
</html>