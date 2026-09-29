 <?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }



if($_POST["Submit"]) {  


	$profesion=mysqli_real_escape_string($con,$_POST['profesion']);
	$crew_id=mysqli_real_escape_string($con,$_POST['crew_id']);
	$social_media_name=mysqli_real_escape_string($con,implode(",",$_POST['social_media_name']));
	$social_media_link=mysqli_real_escape_string($con,implode(",",$_POST['link']));
	
 $check_data="select * from social_media_detail where profession='$profesion' and crew_id='$crew_id'";
$exe_crew_check=mysqli_query($con,$check_data);
$find_crew=mysqli_num_rows($exe_crew_check);

if($find_crew>=1)
{
echo "<script>alert('Crew Social Details already Exist,Please Go To Update Page')</script>";
}
else
{
  $insert_query="INSERT INTO social_media_detail set profession='$profesion',crew_id='$crew_id',social_media_name='$social_media_name',link='$social_media_link'";
mysqli_query($con,$insert_query);
  
 
}
echo "<script>alert('Crew Social Media Added Successful')</script>";
}

         
        


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Add Social Media of Cast-Crew</title>
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
      <!-- End Global Mandatory Style
         =====================================================================-->
      <!-- Start Theme Layout Style
         =====================================================================-->
      <!-- Theme style -->
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
      <!-- Theme style rtl -->
      <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
      <!-- End Theme Layout Style
	  
	  
         =====================================================================-->
		 
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


  <script src="https://cdn.tiny.cloud/1/qyhq7trksx7i1gpmasi3h8szpuzmiuj9c3epa0k2hjpuszlk/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>

<link href="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
<style>
.flexdatalist-alias
{
	width:100%;
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
                  <h1>Social Media Management</h1>
                  
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
                                 <h4>Add Social Media of Cast-Crew</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" enctype="multipart/form-data"  >
						   

	
<div id="cast" style="display: block;padding: 14px;">
<!-- <a href="javascript:void(0);" class="add_button_father btn btn-success pull-right" title="Add More" id="repeatDivBtn" data-increment="1">Add More Father</a>-->

  <div class="tab-content">
    <div id="mainfather" class="tab-pane fade in active">
    
     <div class="mb-12 repeatDiv" id="repeatDiv">

	    			 <div class="form-group">
                                 <label>Select Cast/Crew:</label> 
								
  
  <select class="form-control father_name_data" id="father_name_choice" name="profesion">
  <option>-Select Profession-</option>
   <? $choice=mysqli_query($con, "select * from profession order by profession_name");
                                  while($choice_exe=mysqli_fetch_array($choice)){ ?>

<option value="<? echo $choice_exe['table_name']; ?>"><? echo $choice_exe['profession_name']; ?></option>
                                  <? } ?>
  
  </select>
 
								 </div>
								  <div class="form-group">
								   <select class="form-control father father_data_from" id="father_name_select" name="crew_id" placeholder="Select Crew" style="display:none;" >
								
								 </select>
								  </div>
								  <div id="social" style="display:none;">
								   <a href="javascript:void(0);" class="add_button2 btn btn-success pull-right" title="Add More">Add More</a><br/>
								  <div class="form-group">
    <label for="social_media_name">Select Social Media Name:</label>
	<select class="form-control social_media_name" id="social_media_name" name="social_media_name[]">
  <option>-Select Social Media Name-</option>
   <? $social_media_name=mysqli_query($con, "select * from social_media_name order by name");
                                  while($choice_exe=mysqli_fetch_array($social_media_name)){ ?>

<option value="<? echo $choice_exe['id']; ?>"><? echo $choice_exe['name']; ?></option>
                                  <? } ?>
  
  </select>

  </div>   
  <div class="form-group">
    <label for="link">Social Media Link:</label>
    <input type="text" class="form-control" id="link" name="link[]" >
  </div>
   <div class="field_wrapper2"></div>
  </div>
								
							    
								 
								 
	    		</div>
				
    </div>
    
  </div>


</div>

		
 
                          
                              <div class="reset-button">

                                   <input type="submit" name="Submit"  class="btn btn-add"  value="Add Record">
                            
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- customer Modal1 -->
              
               <!-- /.modal -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <strong>Copyright &copy; 2018-22023 <a href="#">Bollywood Product</a>.</strong> All rights reserved.
         </footer>
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
   </body>
 
</html>


<script type="text/javascript">
function resume_id(res_id){

var agree=confirm("This will record.  Are you sure you wish to continue?");
if (agree) {
window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>?remove=yes&id='+res_id;
window.submit();
}
else {
   
}
}

</script>

<script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>
<script>
$('.flexdatalist').flexdatalist({
     minLength: 1,
	 selectionRequired: true,
	  valueProperty: 'value'
});
</script>

<script>
  $(document).ready(function() {
    $('.father_name_data').select2();
});
</script>
<script>
  $(document).ready(function() {
    $('.social_media_name').select2();
});
</script>

<script>
$(document).ready(function() {
   
   $("#father_name_choice").on('change', function() {
        var father_name_choice = $(this).val();

        $.ajax({
            method: "POST",
            url: "ajax_data_bind_social_media.php",
            data: {
                father_name_choice: father_name_choice
            },
            datatype: "html",
            success: function(data) {
				$('.father').select2();
				$('#father_name_select').attr('style', 'display: block !important');	
				$('#social').attr('style', 'display: block !important;width:100% !important');
                $('.select2').attr('style', 'width:100% !important');
				$("#father_name_select").html(data);
                

            }
        });
    });
	

	 
});


</script>

<script>
$(document).ready(function(){
    var maxField2 = 15; //Input fields increment limitation
    var addButton2 = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper2'); //Input field wrapper
    var fieldHTML2 = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
         
'<div class="form-group">'+
    '<label for="social_media_name">Select Social Media Name:</label>'+
	'<select class="form-control social_media_name" id="social_media_name" name="social_media_name[]">'+
	   '<option>-Select Social Media Name-</option>'+
           <? $social_media_name=mysqli_query($con, "select * from social_media_name order by name");
                                  while($choice_exe=mysqli_fetch_array($social_media_name)){ ?>

'<option value="<? echo $choice_exe['id']; ?>"><? echo $choice_exe['name']; ?></option>'+
                                  <? } ?>
	   '</select>'+

  '</div>'+
  '<div class="form-group">'+
    '<label for="link">Social Media Link:</label>'+
    '<input type="text" class="form-control" id="link" name="link[]" >'+
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
