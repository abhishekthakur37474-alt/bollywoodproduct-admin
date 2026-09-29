<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }

if($_POST["add_film_screenplay_management"]) { 
    
    
    $film_id= mysqli_real_escape_string($con,$_POST['film_id']); 
    
    $film_screenplay_name= mysqli_real_escape_string($con,implode(",",$_POST['film_screenplay_name']));
    $film_screenplay_writer= mysqli_real_escape_string($con,implode(",",$_POST['writer']));
     $script_supervisor= mysqli_real_escape_string($con,implode(",",$_POST['script_supervisor']));
    $film_additional_screenplay_name= mysqli_real_escape_string($con,implode(",",$_POST['film_additional_screenplay_name']));
    $film_additional_dialogue_name= mysqli_real_escape_string($con,implode(",",$_POST['film_additional_dialogue_name']));
    $film_story_name= mysqli_real_escape_string($con,implode(",",$_POST['film_story_name']));
    $film_screenplay_adapted_name= mysqli_real_escape_string($con,implode(",",$_POST['film_screenplay_adapted_name']));
    $film_dialogue_name= mysqli_real_escape_string($con,implode(",",$_POST['film_dialogue_name']));
    $film_additional_screenplay_name= mysqli_real_escape_string($con,implode(",",$_POST['film_additional_screenplay_name']));
    $film_adapted_story_name= mysqli_real_escape_string($con,implode(",",$_POST['film_adapted_story_name']));
    $original_story= mysqli_real_escape_string($con,implode(",",$_POST['original_story']));
    $original_idea= mysqli_real_escape_string($con,implode(",",$_POST['original_idea']));
    $story_editor= mysqli_real_escape_string($con,implode(",",$_POST['story_editor']));
    $script_coordinator= mysqli_real_escape_string($con,implode(",",$_POST['script_coordinator']));
    $script_consultant= mysqli_real_escape_string($con,implode(",",$_POST['script_consultant']));
    $Concept= mysqli_real_escape_string($con,implode(",",$_POST['Concept']));
     $Based_on= mysqli_real_escape_string($con,implode(",",$_POST['Based_on']));


    $film_makeup="insert into film_screenplay_management_allot set film_id='$film_id',writer='$film_screenplay_writer',Concept='$Concept',Based_on='$Based_on',script_supervisor='$script_supervisor',film_screenplay_name='$film_screenplay_name',film_additional_screenplay_name='$film_additional_screenplay_name',film_additional_dialogue_name='$film_additional_dialogue_name',film_story_name='$film_story_name',film_screenplay_adapted_name='$film_screenplay_adapted_name',film_dialogue_name='$film_dialogue_name',film_adapted_story_name='$film_adapted_story_name',original_story='$original_story',original_idea='$original_idea',story_editor='$story_editor',script_coordinator='$script_coordinator',script_consultant='$script_consultant'";
mysqli_query($con,$film_makeup) or die(mysqli_error($con));
  
         echo "<script>alert('Film Screenplay Management Save Succesfully')</script>";
   echo "<script>window.location.href='film_screenplay_management.php'</script>";
         }
         ?>
         
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Add Film Screenplay Management</title>
      <!-- Favicon and touch icons -->
      <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css">
  <!-- select2 -->
  
  <style>
   .flexdatalist-alias
    {
       width:100%;
       height: 35px;
    }
  </style>


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
                  <h1>Film Screenplay Management</h1>
                  <small>Add Film Screenplay</small>
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
                                 <h4>Add Film Screenplay Management Here</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                             <form method="post" enctype="multipart/form-data"  >
          <div class="row">
              <div class="col-lg-12">
                  
                               <div class="form-group">
                                 <label>Select Film:</label>
                                <select class="form-control searchwithselect2" id="film_id" name="film_id"  style="width:100%:"  required>
                                    <option value="">-Select Film-</option>
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
                               <div class="form-group">
                                 <label>Screenplay</label>
                                   <input type='text'
       placeholder='Enter Film Screenplay'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_screenplay_name',
       data-value-property='value',
	   name='film_screenplay_name[]',
      multiple
       >
	   <datalist id="film_screenplay_name" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                          
                              </div>
                              <div class="form-group">
                                 <label>Writer</label>
                                 <input type='text'
       placeholder='Enter Film Writer'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='writer',
       data-value-property='value',
	   name='writer[]',
      multiple
       >
	   <datalist id="writer" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                            
                              </div>
                              <div class="form-group">
                                 <label>Additional Screenplay</label>
                                  <input type='text'
       placeholder='Enter Additional Screenplay'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_additional_screenplay_name',
       data-value-property='value',
	   name='film_additional_screenplay_name[]',
      multiple
       >
	   <datalist id="film_additional_screenplay_name" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                           
                                   </div>
                                   <div class="form-group">
                                 <label>Adapted Screenplay</label>
                                  <input type='text'
       placeholder='Enter Adapted Screenplay'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_screenplay_adapted_name',
       data-value-property='value',
	   name='film_screenplay_adapted_name[]',
      multiple
       >
	   <datalist id="film_screenplay_adapted_name" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                         
                                   </div>
                                    <div class="form-group">
                                 <label>Story</label>
                                 <input type='text'
       placeholder='Enter Story'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_story_name',
       data-value-property='value',
	   name='film_story_name[]',
      multiple
       >
	   <datalist id="film_story_name" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                            
                                   </div>
                                    <div class="form-group">
                                 <label>Original Story</label>
                                 <input type='text'
       placeholder='Enter Original Story'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='original_story',
       data-value-property='value',
	   name='original_story[]',
      multiple
       >
	   <datalist id="original_story" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                           
                              </div>
                               <div class="form-group">
                                 <label>Original Idea</label>
                                                   <input type='text'
       placeholder='Enter Original Idea'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='original_idea',
       data-value-property='value',
	   name='original_idea[]',
      multiple
       >
	   <datalist id="original_idea" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                              </div>
                                     <div class="form-group">
                                 <label>Adapted Story</label>
     <input type='text'
       placeholder='Enter Adapted Story'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_adapted_story_name',
       data-value-property='value',
	   name='film_adapted_story_name[]',
      multiple
       >
	   <datalist id="film_adapted_story_name" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                            
                                   </div>
                                    <div class="form-group">
                                 <label>Story Editor</label>
                                 <input type='text'
       placeholder='Enter Story Editor'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='story_editor',
       data-value-property='value',
	   name='story_editor[]',
      multiple
       >
	   <datalist id="story_editor" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                            
                              </div>
                                    <div class="form-group">
                                 <label>Dialogue</label>
                                 <input type='text'
       placeholder='Enter Dialogue'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_dialogue_name',
       data-value-property='value',
	   name='film_dialogue_name[]',
      multiple
       >
	   <datalist id="film_dialogue_name" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                           
                                   </div>
                                      <div class="form-group">
                                 <label>Additional Dialogue</label>
                                 <input type='text'
       placeholder='Enter Additional Dialogue'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='film_additional_dialogue_name',
       data-value-property='value',
	   name='film_additional_dialogue_name[]',
      multiple
       >
	   <datalist id="film_additional_dialogue_name" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                           
                                   </div>
                               <div class="form-group">
                                 <label>Script Supervisor</label>
                                 <input type='text'
       placeholder='Enter Script Supervisor'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='script_supervisor',
       data-value-property='value',
	   name='script_supervisor[]',
      multiple
       >
	   <datalist id="script_supervisor" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                          
                              </div>
                              <div class="form-group">
                                 <label>Script Coordinator</label>
                                 <input type='text'
       placeholder='Enter Script Coordinator'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='script_coordinator',
       data-value-property='value',
	   name='script_coordinator[]',
      multiple
       >
	   <datalist id="script_coordinator" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                             
                              </div>
                             <div class="form-group">
                                 <label>Script Consultant</label>
                                              <input type='text'
       placeholder='Enter Script Consultant'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='script_consultant',
       data-value-property='value',
	   name='script_consultant[]',
      multiple
       >
	   <datalist id="script_consultant" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                            
                              </div> 
                              <div class="form-group">
                                 <label>Concept</label>
                                 <input type='text'
       placeholder='Enter Concept'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='Concept',
       data-value-property='value',
	   name='Concept[]',
      multiple
       >
	   <datalist id="Concept" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                            
                              </div> 
                              <div class="form-group">
                                 <label>Based On</label>
                                 <input type='text'
       placeholder='Enter Concept'
       class="flexdatalist"
       data-min-length='1'
       style='width:100%;'
       list='Based_on',
       data-value-property='value',
	   name='Based_on[]',
      multiple
       >
	   <datalist id="Based_on" >
   <? $sqlfr=mysqli_query($con, "select * from screenplay order by id desc");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?>(Nick Name:<? echo $rowfr['nickname']; ?> ID:<? echo $rowfr['id']; ?>)</option>
                                  <? } ?>
   
</datalist>
                             
                              </div> 
                               
               
              </div>
              
          </div> 
                         <div class="reset-button">

                                   <input type="submit" name="add_film_screenplay_management"  class="btn btn-add"  value="Add Film Screenplay Manegement">
                            
                              </div>
        </form>  
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="jquery-flexdatalist-2.3.0/jquery.flexdatalist.min.js"></script>
      <!-- jquery-ui --> 
      <script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
      <!-- Bootstrap -->
      <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <!-- lobipanel -->
      <script src="assets/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
      <!-- Pace js -->
      <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
      <!-- table-export js -->

   
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
         
       
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script>
  $(document).ready(function() {
    $('.searchwithselect2').select2();
});
</script>
  
    <script>
$('.flexdatalist').flexdatalist({
     minLength: 1,
	 selectionRequired: true,
	  valueProperty: 'value'
});
</script>
 
   </body>
  
</html>

