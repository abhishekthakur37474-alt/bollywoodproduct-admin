<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
       $edit_id=$_GET["id"];
$film_slider="select * from slider where id='$edit_id'";
$exe_edit=mysqli_query($con,$film_slider);
$read_slider=mysqli_fetch_array($exe_edit);
    
      
   
      ?>
   
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Slider</title>
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
                  <h1>Film Slider Management</h1>
                  <small>Edit Film Slider</small>
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
                                 <h4>Edit Film Slider Here</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                              <form method="post" enctype="multipart/form-data"  >
     
               
 
             <div class="form-group">
                                 <label>Select Film:</label>
                                <select   class="form-control search_with_select2" name="film_id" required>
                                <?
                               
                                $film_id=$read_slider["film_id"];
	$film_details="select * from film where id='$film_id'";
	$film_details_exe=mysqli_query($con,$film_details);
	$read_film_details=mysqli_fetch_array($film_details_exe);
   ?>
                                    <option value="<? echo $film_id;?>"><? echo $read_film_details["name"];?></option>
                                  <? $sqlfr=mysqli_query($con, "select * from film order by id desc");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                  
                              </div>   
                              
                              
                              
                               <div class="form-group" >
      
    <label class="l" for="exampleFormControlSelect1">Film Sequence No</label>
        <select class="form-control" name="film_sequence_no" id="exampleFormControlSelect1" required >
     <option value="<? echo $read_slider["film_sequence_no"];?>"><? echo $read_slider["film_sequence_no"];?></option>
       <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
       <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
      <option>10</option>
      <option>11</option>
      <option>12</option>
      <option>13</option>
      <option>14</option>
      <option>15</option>
      <option>16</option>
      <option>17</option>
      <option>18</option>
      <option>19</option>
      <option>20</option>
      <option>21</option>
      <option>22</option>
      <option>23</option>
      <option>24</option>
      <option>25</option>
    </select>
  </div>
              
                  </div>
                 
                  
                
                   </div>
   
                               <div class="reset-button">

                                   <input type="submit" name="edit_slider"  class="btn btn-add"  value="Update Slider">
                            
                              </div>
                             
                  </form>
                  
                    <?
                  
                  if(isset($_POST["edit_slider"]))
                  {
                      
                      $film_id=mysqli_real_escape_string($con,$_POST["film_id"]);
                      $film_sequence_no=mysqli_real_escape_string($con,$_POST["film_sequence_no"]);
                        $pre_sequence_number=$read_slider["film_sequence_no"];
                        if($film_sequence_no==$pre_sequence_number)
                        {
  $slider_management_query="update slider set film_id='$film_id',film_sequence_no='$film_sequence_no' where id='$edit_id'"; 
                  mysqli_query($con,$slider_management_query) or die(mysqli_error($con));
  echo "<script>alert('Slider Updated Succesfully')</script>";
  echo "<script>window.location.href='film_slider.php'</script>";
                        }
                        else{

                  
														$checking_sequence_number="SELECT id FROM slider where film_sequence_no='$film_sequence_no'";
                                                        $checking_sequence_number_exe=mysqli_query($con,$checking_sequence_number);
                                                        $result_count=mysqli_num_rows($checking_sequence_number_exe); 														
													if($result_count>0)
													{
													echo "<script>alert('This Sequnce Number Already Allot')</script>";
													}
                        }
												
													
                    
          
       
                
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

    var maxField2 = 10; //Input fields increment limitation
    var addButton2 = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper2'); //Input field wrapper
    var fieldHTML2 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
         '<div class="row">'+
              '<div class="col-lg-12">'+
                 '<div class="form-group">'+
                                 '<label>Trailer/Teaser Category</label>'+
                                 '<select class="form-control" name="trailer_catgories[]">'+
                                     '<option value="">-Please Select-</option>'+
                                      <? $sqlfr=mysqli_query($con, "select * from film_trailer_categories order by film_trailer_name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['film_trailer_name']; ?>"><? echo $rowfr['film_trailer_name']; ?></option>'+
                                  <? } ?>
                                '</select>'+
                              '</div>'+
            
            '<div class="form-group  ">'+
                                '<label>Lanaguage</label>'+
                                 
   '<select class="main_language"  class="form-control" name="trailer_language[]" multiple="multiple" style="width:100%:" >'+
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

'<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>'+
                                  <? } ?>
                                 '</select>'+
                                 
                              '</div>'+
                              
            '<div class="form-group">'+
                                 '<label>Trailer/Teaser</label>'+
                                 '<input type="text" class="form-control" name="teaser[]" >'+
                                  
                              '</div>'+
                            
            '<div class="form-group">'+
                                 '<label>Motional Poster</label>'+
                                   '<input type="file"  name="motion_poster[]"  class="form-control">'+
                                  
                              '</div>'+
                              
            '<div class="form-group">'+
                                 '<label>First Look Poster</label>'+
                                   '<input type="file"  name="first_look_poster[]"  class="form-control">'+
                                  
                              '</div>'+               
                  
                  '<div class="form-group">'+
                                 '<label> Trailer/Teaser Release Date</label>'+
                                 '<input type="text" class="form-control" name="trailer_date_release[]" placeholder="Enter  Date Release"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label> Trailer/Teaser Release Month</label>'+
                                 '<input type="text" class="form-control" name="trailer_month_release[]" placeholder="Enter  Month Release"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label> Trailer/Teaser Release Year</label>'+
                                 '<input type="text" class="form-control" name="trailer_year_release[]" placeholder="Enter  Year Release"  >'+
                              '</div>'+
                              
                              '<div class="form-group">'+
                                 '<label> YouTube upload Date</label>'+
                                 '<input type="text" class="form-control" name="trailer_youtube_date_release[]" placeholder="Enter  Date Release"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label> YouTube upload Month</label>'+
                                 '<input type="text" class="form-control" name="trailer_youtube_month_release[]" placeholder="Enter  Month Release"  >'+
                              '</div>'+
                          '<div class="form-group">'+
                                 '<label> YouTube upload Year</label>'+
                                 '<input type="text" class="form-control" name="trailer_youtube_year_release[]" placeholder="Enter  Year Release"  >'+
                              '</div>'+
                            '<div class="form-group">'+
                                 '<label> Views (Million/Billion)</label>'+
                                 '<input type="text" class="form-control" name="trailer_youtube_views[]">'+
                              '</div>'+    
                          
                  '</div>'+
                  '</div>'+
                  '</div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    // Once add button is clicked
    $(addButton2).click(function(){
        //Check maximum number of input fields
        if(x < maxField2){ 
            x++; //Increase field counter
            $(wrapper2).append(fieldHTML2); //Add field html
            $('.main_language').select2();
           
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
<script>
 $('.search_with_select2').select2();
</script>
</body>
</html>