<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
	  $id=$_GET["id"];
	  $query_fetch_mul="select * from multiple_roles_details where id='$id'";
	  $query_exe=mysqli_query($con,$query_fetch_mul);
	  $read_multiple_data=mysqli_fetch_array($query_exe);
	  
      ?>
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Edit Film Multiple Roles</title>
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
		 <link href="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
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
                  <h1>Film Multiple Roles Management</h1>
                  <small>Edit Film Multiple Roels Details</small>
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
                                 <h4>Edit Multiple Roles Details Here</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                  
              <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                    <div class="form-group">
                                 <label>Select Film:</label>
								 <?
								 $film_id=$read_multiple_data["film_id"];
								 $q_film_deatils="select * from film where id='$film_id'";
								 $q_film_exe=mysqli_query($con,$q_film_deatils);
								 $q_film_det=mysqli_fetch_array($q_film_exe);
								 
								 
								 ?>
                                <select class="main_language"  class="form-control" name="film_id"  style="width:100%:"  required>
                                    <option value="<? echo $read_multiple_data["film_id"];?>"><? echo $q_film_det["name"];?></option>
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
                 <div class="field_wrapper_multiple_role">
                                <!--<a href="javascript:void(0);" class="add_button_multiple_role btn btn-success pull-right" title="Add More">Add More</a>-->
                                     <div class="form-group">
                                <label>Actors Name:</label>
                               			
														 <input type='text'
       placeholder='Enter Cast Name'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='other_cast',
       data-value-property='value',
	   name='multiple_actor_name',
	   value='<? echo $read_multiple_data["multiple_actor_id"];?>'
       style="width:100%;"
      
       />
	   <datalist id="other_cast" >
	    
	
   <? $sqlfr=mysqli_query($con, "select * from cast order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(ID:<? echo $rowfr['id']; ?>) Nick Name:<? echo $rowfr['nickname']; ?>)</option>
                                  <? } ?>
   
</datalist>						
                                </div>
                                <div class="form-group">
                                <label>Character  Name:</label>
                                <input type="text" name="multiple_character_name" value="<? echo $read_multiple_data["multiple_character_name"];?>" class="form-control"/>
                                </div>
                                <div class="form-group">
                                <label>Number of Roles:</label>
                                <input type="number" name="number_of_roles" value="<? echo $read_multiple_data["multiple_roles_number"];?>"  class="form-control"/>
                                </div>
                                <div class="form-group">
                                <label>Remarks:</label>
                                <input type="text" name="multiple_remarks" value="<? echo $read_multiple_data["multiple_remarks"];?>" class="form-control"/>
                                </div>
                                </div>
                    
    </div>
    <div class="reset-button">

                                   <input type="submit" name="multiple_roles_details"  class="btn btn-add"  value="Update Multiple Roles Details">
                            
                              </div>
    </div>
    </form>
    
    <?
    if(isset($_POST["multiple_roles_details"]))
    {   
   $film_id=mysqli_real_escape_string($con,$_POST['film_id']);
          $number_of_roles=mysqli_real_escape_string($con,$_POST['number_of_roles']);
    $multiple_actor_name=mysqli_real_escape_string($con,$_POST['multiple_actor_name']);
    $multiple_character_name=mysqli_real_escape_string($con,$_POST['multiple_character_name']);
    $multiple_remarks=mysqli_real_escape_string($con,$_POST['multiple_remarks']);
	
	 $film_multiple_roles_details="update multiple_roles_details set film_id='$film_id',multiple_roles_number='$number_of_roles',multiple_actor_id='$multiple_actor_name',multiple_character_name='$multiple_character_name',multiple_remarks='$multiple_remarks' where id='$id'";
mysqli_query($con,$film_multiple_roles_details) or die(mysqli_error($con));
                      echo "<script>alert('Multiple Roles Save Successfully')</script>";
                      echo "<script>window.location.href='mutliple-roles-details.php'</script>";
    
	}
    
    ?>
               <script>
                   function findTotal(){
    var arr = document.getElementsByClassName('amount');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseFloat(arr[i].value))
            tot += parseFloat(arr[i].value);
    }
    document.getElementById('totalordercost').value = tot;
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
    $('.main_language').select2();
});
</script>

<?php
$sqlfr = mysqli_query($con, "select * from cast order by name");
$options = '';
while ($rowfr = mysqli_fetch_array($sqlfr)) {
    $new_string = str_replace("'", "", $rowfr["name"]);
    $nick_name = str_replace("'", "", $rowfr["nickname"]);
    $showing='(ID:"'.$rowfr['id'].'"Nick Name:"'.$nick_name.'")';
    $options .= '<option value="' . $rowfr["id"] . '">' . $new_string . $showing.'</option>';
}
?>
<script>
$(document).ready(function(){
    var maxField_multiple_role = 10; //Input fields increment limitation
    var addButton_multiple_role = $('.add_button_multiple_role'); //Add button selector
    var wrapper_multiple_role = $('.field_wrapper_multiple_role'); //Input field wrapper
    var fieldHTML_multiple_role = '<div><hr/><a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a>'+
                               '<br/>'+
                              
                             '<div class="form-group">'+
                               '<label>Actors Name:</label>'+
    '<input type="text" placeholder="Enter Cast Name" class="flexdatalist" data-min-length="1" style="width:100%;" list="other_cast", data-value-property="value"  name="multiple_actor_name[]" value="" style="width:100%;" />'+
	   '<datalist id="other_cast" >'+
	    
                             '<? echo $options ?>'+
                                 
'</datalist>'+						
                                '</div>'+

                                '<div class="form-group">'+
                                '<label>Character  Name:</label>'+
                                '<input type="text" name="multiple_character_name[]" class="form-control"/>'+
                                '</div>'+
								 '<div class="form-group">'+
                                '<label>Number of Roles:</label>'+
                                '<input type="number" name="number_of_roles[]" class="form-control"/>'+
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
			$('.flexdatalist').flexdatalist({
     minLength: 1
});
           
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
$('.flexdatalist').flexdatalist({
     minLength: 1,
	 selectionRequired: true
});
   
</script>

 
</body>
</html>