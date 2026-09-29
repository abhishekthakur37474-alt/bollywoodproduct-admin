<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
 


 if(isset($_POST["UpdateSequence"]) ) {
$id=$_POST['id'];
$sl_no=$_POST['sl_no'];
for($i = 0, $l = count($id); $i < $l; ++$i) {
  $idd= $id[$i];
  $sl= $sl_no[$i];
  $sql=mysqli_query($con, "update award_year set sl_no='$sl' where id='$idd'");
}
 header("location:award_year.php?Done");
 }

if($_POST["Submit"]) { 
    $award_year= $_POST['award_year'] ;  
    $award_name_id= $_POST['award_name_id'] ;  
    $no_of_award= $_POST['no_of_award'] ;  
    $venue_address= $_POST['venue_address'] ;  

    $venue_city_id= $_POST['venue_city_id'] ;  
    $venue_state_id= $_POST['venue_state_id'] ;  
    $venue_country_id= $_POST['venue_country_id'] ;

    $start_award_date= $_POST['start_award_date'] ;  
    $start_award_month= $_POST['start_award_month'] ;  
    $start_award_year= $_POST['start_award_year'] ; 

    $end_award_date= $_POST['end_award_date'] ;  
    $end_award_month= $_POST['end_award_month'] ;  
    $end_award_year= $_POST['end_award_year'] ; 


    $tv_broadcast= $_POST['tv_broadcast'] ;  
    $broadcast_date= $_POST['broadcast_date'] ;  
    $broadcast_month= $_POST['broadcast_month'] ;  
    $broadcast_year= $_POST['broadcast_year'] ;  

    $cast_hosts= $_POST['cast_hosts'] ;   
    $cast_hosts_id= $_POST['cast_hosts_id'] ;  

    $co_cast_hosts= $_POST['co_cast_hosts'] ;   
    $co_cast_hosts_id= $_POST['co_cast_hosts_id'] ;   
    $last_day_voting_date= $_POST['last_day_voting_date'] ;   
    $last_day_voting_month= $_POST['last_day_voting_month'] ;   
    $last_day_voting_year= $_POST['last_day_voting_year'] ;   
 

 
mysqli_query($con,"INSERT INTO `award_year` ( award_year, award_name_id, no_of_award, venue_address, venue_city_id, venue_state_id, venue_country_id, start_award_date, start_award_month, start_award_year, end_award_date, end_award_month, end_award_year, tv_broadcast, broadcast_date, broadcast_month, broadcast_year,  cast_hosts, cast_hosts_id, co_cast_hosts, co_cast_hosts_id, last_day_voting_date , last_day_voting_month , last_day_voting_year ) VALUES (  '$award_year', '$award_name_id' , '$no_of_award' , '$venue_address' , '$venue_city_id' , '$venue_state_id' , '$venue_country_id' , '$start_award_date' , '$start_award_month' , '$start_award_year' ,  '$end_award_date' , '$end_award_month' , '$end_award_year' ,'$tv_broadcast' , '$broadcast_date' , '$broadcast_month' , '$broadcast_year' , '$cast_hosts'  ,'$cast_hosts_id' ,'$co_cast_hosts' , '$co_cast_hosts_id' ,   '$last_day_voting_date' ,   '$last_day_voting_month' ,   '$last_day_voting_year'   )") or die(mysqli_error($con));
  
            header('location:award_year.php?msg=success');
         }



           if($_POST["Update"]) {




    $id= $_POST['id']; 

    $award_year= $_POST['award_year'] ;  
    $award_name_id= $_POST['award_name_id'] ;  
    $no_of_award= $_POST['no_of_award'] ;  
    $venue_address= $_POST['venue_address'] ;  

    $venue_city_id= $_POST['venue_city_id'] ;  
    $venue_state_id= $_POST['venue_state_id'] ;  
    $venue_country_id= $_POST['venue_country_id'] ;

    $start_award_date= $_POST['start_award_date'] ;  
    $start_award_month= $_POST['start_award_month'] ;  
    $start_award_year= $_POST['start_award_year'] ; 

    $end_award_date= $_POST['end_award_date'] ;  
    $end_award_month= $_POST['end_award_month'] ;  
    $end_award_year= $_POST['end_award_year'] ; 


    $tv_broadcast= $_POST['tv_broadcast'] ;  
    $broadcast_date= $_POST['broadcast_date'] ;  
    $broadcast_month= $_POST['broadcast_month'] ;  
    $broadcast_year= $_POST['broadcast_year'] ;  

    $cast_hosts= $_POST['cast_hosts'] ;   
    $cast_hosts_id= $_POST['cast_hosts_id'] ;  

    $co_cast_hosts= $_POST['co_cast_hosts'] ;   
    $co_cast_hosts_id= $_POST['co_cast_hosts_id'] ;  
    $last_day_voting_date= $_POST['last_day_voting_date'] ;   
    $last_day_voting_month= $_POST['last_day_voting_month'] ;   
    $last_day_voting_year= $_POST['last_day_voting_year'] ;     
 
 
            mysqli_query($con,"update award_year set   award_year='$award_year', award_name_id='$award_name_id' , no_of_award='$no_of_award' , venue_address='$venue_address' , venue_city_id='$venue_city_id' , venue_state_id='$venue_state_id' , venue_country_id='$venue_country_id' , start_award_date='$start_award_date' , start_award_month='$start_award_month' ,start_award_year='$start_award_year' , end_award_date='$end_award_date' , end_award_month='$end_award_month' ,end_award_year='$end_award_year' , tv_broadcast='$tv_broadcast' , broadcast_date='$broadcast_date' , broadcast_month='$broadcast_month' , broadcast_year='$broadcast_year' , cast_hosts='$cast_hosts' , cast_hosts_id='$cast_hosts_id' , co_cast_hosts='$co_cast_hosts' , co_cast_hosts_id='$co_cast_hosts_id' , last_day_voting_date='$last_day_voting_date' , last_day_voting_month='$last_day_voting_month' , last_day_voting_year='$last_day_voting_year'  where id='$id'") or die(mysqli_error($con));
             header('location:award_year.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){
mysqli_query($con, "delete from award_year where id='$_REQUEST[id]'");

header("location:award_year.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>award_year Management</title>
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

         <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>tinymce.init({
  selector: 'textarea',
  height: 300,
  theme: 'modern',
  plugins: 'print preview fullpage   searchreplace autolink directionality   visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc   advlist lists textcolor wordcount     imagetools      contextmenu colorpicker textpattern help',
  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });</script>

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
                  <h1>award_year</h1>
                  <small>award_year List</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">








<? if($_GET['Action']=="Add"){ ?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Add award_year</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                          <div class="form-group">
                                 <label>Award name</label>
<select name="award_name_id" class="form-control">
      <option value=""></option>
   <?php $sqla=mysqli_query($con, "select * from award_name order by name");
   while($rowa=mysqli_fetch_array($sqla)){ ?>

<option value="<?php echo $rowa['id']; ?>"><?php echo $rowa['name']; ?></option>
   <? } ?>
</select>
 
                              </div>

   <div class="form-group">
                                 <label>Award Year</label>
                                 <input type="text" name="award_year" class="form-control" placeholder="Add award_year" value="<? echo $row['award_year'];?>"   >
                              </div>
 
  <div class="form-group">
                                 <label>No of Award</label>
                                 <input type="text" name="no_of_award" class="form-control" placeholder="Add no_of_award" value="<? echo $row['no_of_award'];?>"   >
                              </div>
 
  <div class="form-group">
                                 <label>Venue Address</label>
                                 <input type="text" name="venue_address" class="form-control" placeholder="Add venue_address" value="<? echo $row['venue_address'];?>"   >
                              </div>
 
  <div class="form-group">
                                 <label>Venue City</label>
                                 <select name="venue_city_id" class="form-control select2">  
                                  <option value=""></option>
                                    <?php $sqlc=mysqli_query($con, "select * from city1 order by city");
                                    while($rowc=mysqli_fetch_array($sqlc)){ ?>

                                          <option value="<?php echo $rowc['id']; ?>"><?php echo $rowc['city']; ?></option>
                                       <?php } ?>
</select>
                              </div>
 
  <div class="form-group">
                                 <label>Venue State</label>
                                  <select name="venue_state_id" class="form-control select2">
                                       <option value=""></option>
                                    <?php $sqlc=mysqli_query($con, "select * from state1 order by state");
                                    while($rowc=mysqli_fetch_array($sqlc)){ ?>
                                          <option value="<?php echo $rowc['id']; ?>"><?php echo $rowc['state']; ?></option>
                                       <?php } ?>
</select>
                              </div>
 
  <div class="form-group">
                                 <label>Venue Country</label>
                                  <select name="venue_country_id" class="form-control select2">
                                       <option value=""></option>
                                    <?php $sqlc=mysqli_query($con, "select * from country1 order by country_name");
                                    while($rowc=mysqli_fetch_array($sqlc)){ ?>
                                          <option value="<?php echo $rowc['id']; ?>"><?php echo $rowc['country_name']; ?></option>
                                       <?php } ?>
</select>
                              </div>
 
  <div class="form-group">
                                 <label>Start Award Date</label>
                                 <input type="text" name="start_award_date" class="form-control" placeholder="Add award_date" value="<? echo $row['start_award_date'];?>"   >
                              </div>
 

  <div class="form-group">
                                 <label>Start Award Month</label>
                                 <input type="text" name="start_award_month" class="form-control" placeholder="Add award_month" value="<? echo $row['start_award_month'];?>"   >
                              </div>
 

  <div class="form-group">
                                 <label>Start Award Year</label>
                                 <input type="text" name="start_award_year" class="form-control" placeholder="Add award_year" value="<? echo $row['start_award_year'];?>"   >
                              </div>




 
  <div class="form-group">
                                 <label>End Award Date</label>
                                 <input type="text" name="end_award_date" class="form-control" placeholder="Add end_award_date" value="<? echo $row['end_award_date'];?>"   >
                              </div>
 

  <div class="form-group">
                                 <label>End Award Month</label>
                                 <input type="text" name="end_award_month" class="form-control" placeholder="Add end_award_month" value="<? echo $row['end_award_month'];?>"   >
                              </div>
 

  <div class="form-group">
                                 <label>End Award Year</label>
                                 <input type="text" name="end_award_year" class="form-control" placeholder="Add end_award_year" value="<? echo $row['end_award_year'];?>"   >
                              </div>
 
  <div class="form-group">
                                 <label>TV Broadcast</label>
                                 <input type="text" name="tv_broadcast" class="form-control" placeholder="Add tv_broadcast" value="<? echo $row['tv_broadcast'];?>"   >
                              </div>
  
  <div class="form-group">
                                 <label>Broadcast Date</label>
                                 <input type="text" name="broadcast_date" class="form-control" placeholder="Add broadcast_date" value="<? echo $row['broadcast_date'];?>"   >
                              </div> 

                              <div class="form-group">
                                 <label>Broadcast Month</label>
                                 <input type="text" name="broadcast_month" class="form-control" placeholder="Add broadcast_month" value="<? echo $row['broadcast_month'];?>"   >
                              </div> 

                              <div class="form-group">
                                 <label>Broadcast Year</label>
                                 <input type="text" name="broadcast_year" class="form-control" placeholder="Add broadcast_year" value="<? echo $row['broadcast_year'];?>"   >
                              </div>
 
                          

                              <div class="form-group">
                                 <label>Cast Hosts</label>
                                 <input type="text" name="cast_hosts" class="form-control" placeholder="Add cast_hosts" value="<? echo $row['cast_hosts'];?>"   >
                              </div>

                              <div class="form-group">
                                 <label>Cast Hosts ID</label>
                                 <select name="cast_hosts_id" class="form-control select2" >
                                       <option value=""></option>
                                    <?php $sqlc=mysqli_query($con, "select * from cast");
                                    while($rowc=mysqli_fetch_array($sqlc)){ ?>
                                       <option value="<?php echo $rowc['id']; ?>"><?php echo $rowc['name']; ?></option>
                                    <?php } ?>
                                 </select>
                              </div>

                              <div class="form-group">
                                 <label>Co Cast Hosts</label>
                                 <input type="text" name="co_cast_hosts" class="form-control" placeholder="Add co_cast_hosts" value="<? echo $row['co_cast_hosts'];?>"   >
                              </div>

                              <div class="form-group">
                                 <label>Co Cast Hosts ID</label>
                                 <select name="co_cast_hosts_id" class="form-control select2" >
                                       <option value=""></option>
                                    <?php $sqlc=mysqli_query($con, "select * from cast");
                                    while($rowc=mysqli_fetch_array($sqlc)){ ?>
                                       <option value="<?php echo $rowc['id']; ?>"><?php echo $rowc['name']; ?></option>
                                    <?php } ?>
                                 </select>
                              </div>

   <div class="form-group">
                                 <label>Last Day Voting Date</label>
                                 <input type="text" name="last_day_voting_date" class="form-control" placeholder="Add last_day_voting_date" value="<? echo $row['last_day_voting_date'];?>"   >
                              </div>


   <div class="form-group">
                                 <label>Last Day Voting Month</label>
                                 <input type="text" name="last_day_voting_month" class="form-control" placeholder="Add last_day_voting_month" value="<? echo $row['last_day_voting_month'];?>"   >
                              </div>


   <div class="form-group">
                                 <label>Last Day Voting Year</label>
                                 <input type="text" name="last_day_voting_year" class="form-control" placeholder="Add last_day_voting_year" value="<? echo $row['last_day_voting_year'];?>"   >
                              </div>



                              <div class="reset-button">

                                   <input type="submit" name="Submit"  class="btn btn-add"  value="Add Record">
                            
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>

<? } ?>











<? if($_GET['Action']=="Update"){  $id2=$_GET['id'];
$sql="select * from award_year where id='$id2'";
$rs=mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs);
?>


 <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                      <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Update Award Year</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                               <div class="form-group">
                                 <label>Award name</label>
<select name="award_name_id" class="form-control">
      <option value=""></option>
   <?php $sqla=mysqli_query($con, "select * from award_name order by name");
   while($rowa=mysqli_fetch_array($sqla)){ ?>

<option value="<?php echo $rowa['id']; ?>" <?php if($rowa['id']==$row['award_name_id']){echo "selected"; } ?>><?php echo $rowa['name']; ?></option>
   <? } ?>
</select>
 
                              </div>

   <div class="form-group">
                                 <label>Award Year</label>
                                 <input type="text" name="award_year" class="form-control" placeholder="Update award_year" value="<? echo $row['award_year'];?>"   >
                              </div>
 
  <div class="form-group">
                                 <label>No of Award</label>
                                 <input type="text" name="no_of_award" class="form-control" placeholder="Update no_of_award" value="<? echo $row['no_of_award'];?>"   >
                              </div>
 
  <div class="form-group">
                                 <label>Venue Address</label>
                                 <input type="text" name="venue_address" class="form-control" placeholder="Update venue_address" value="<? echo $row['venue_address'];?>"   >
                              </div>
 
  <div class="form-group">
                                 <label>Venue City</label>
                                 <select name="venue_city_id" class="form-control select2">
                                       <option value=""></option>
                                    <?php $sqlc=mysqli_query($con, "select * from city1 order by city");
                                    while($rowc=mysqli_fetch_array($sqlc)){ ?>
                                          <option value="<?php echo $rowc['id']; ?>" <?php if($rowc['id']==$row['venue_city_id']){echo "selected";} ?>><?php echo $rowc['city']; ?></option>
                                       <?php } ?>
</select>
                              </div>
 
  <div class="form-group">
                                 <label>Venue State</label>
                                  <select name="venue_state_id" class="form-control select2">
                                       <option value=""></option>
                                    <?php $sqlc=mysqli_query($con, "select * from state1 order by state");
                                    while($rowc=mysqli_fetch_array($sqlc)){ ?>
                                          <option value="<?php echo $rowc['id']; ?>" <?php if($rowc['id']==$row['venue_state_id']){echo "selected";} ?>><?php echo $rowc['state']; ?></option>
                                       <?php } ?>
</select>
                              </div>
 
  <div class="form-group">
                                 <label>Venue Country</label>
                                  <select name="venue_country_id" class="form-control select2">
                                       <option value=""></option>
                                    <?php $sqlc=mysqli_query($con, "select * from country1 order by country_name");
                                    while($rowc=mysqli_fetch_array($sqlc)){ ?>
                                          <option value="<?php echo $rowc['id']; ?>" <?php if($rowc['id']==$row['venue_country_id']){echo "selected";} ?>><?php echo $rowc['country_name']; ?></option>
                                       <?php } ?>
</select>
                              </div>
 
  <div class="form-group">
                                 <label>Start Award Date</label>
                                 <input type="text" name="start_award_date" class="form-control" placeholder="Update award_date" value="<? echo $row['start_award_date'];?>"   >
                              </div>
 

  <div class="form-group">
                                 <label>Start Award Month</label>
                                 <input type="text" name="start_award_month" class="form-control" placeholder="Update award_month" value="<? echo $row['start_award_month'];?>"   >
                              </div>
 

  <div class="form-group">
                                 <label>Start Award Year</label>
                                 <input type="text" name="start_award_year" class="form-control" placeholder="Update award_year" value="<? echo $row['start_award_year'];?>"   >
                              </div>




 
  <div class="form-group">
                                 <label>End Award Date</label>
                                 <input type="text" name="end_award_date" class="form-control" placeholder="Update end_award_date" value="<? echo $row['end_award_date'];?>"   >
                              </div>
 

  <div class="form-group">
                                 <label>End Award Month</label>
                                 <input type="text" name="end_award_month" class="form-control" placeholder="Update end_award_month" value="<? echo $row['end_award_month'];?>"   >
                              </div>
 

  <div class="form-group">
                                 <label>End Award Year</label>
                                 <input type="text" name="end_award_year" class="form-control" placeholder="Update end_award_year" value="<? echo $row['end_award_year'];?>"   >
                              </div>
 
  <div class="form-group">
                                 <label>TV Broadcast</label>
                                 <input type="text" name="tv_broadcast" class="form-control" placeholder="Update tv_broadcast" value="<? echo $row['tv_broadcast'];?>"   >
                              </div>
  
  <div class="form-group">
                                 <label>Broadcast Date</label>
                                 <input type="text" name="broadcast_date" class="form-control" placeholder="Update broadcast_date" value="<? echo $row['broadcast_date'];?>"   >
                              </div> 

                              <div class="form-group">
                                 <label>Broadcast Month</label>
                                 <input type="text" name="broadcast_month" class="form-control" placeholder="Update broadcast_month" value="<? echo $row['broadcast_month'];?>"   >
                              </div> 

                              <div class="form-group">
                                 <label>Broadcast Year</label>
                                 <input type="text" name="broadcast_year" class="form-control" placeholder="Update broadcast_year" value="<? echo $row['broadcast_year'];?>"   >
                              </div>
 
                          

                              <div class="form-group">
                                 <label>Cast Hosts</label>
                                 <input type="text" name="cast_hosts" class="form-control" placeholder="Update cast_hosts" value="<? echo $row['cast_hosts'];?>"   >
                              </div>

                              <div class="form-group">
                                 <label>Cast Hosts ID</label>
                                 <select name="cast_hosts_id" class="form-control select2" >
                                       <option value=""></option>
                                    <?php $sqlc=mysqli_query($con, "select * from cast");
                                    while($rowc=mysqli_fetch_array($sqlc)){ ?>
                                       <option value="<?php echo $rowc['id']; ?>" <?php if($rowc['id']==$row['cast_hosts_id']){echo "selected";} ?>><?php echo $rowc['name']; ?></option>
                                    <?php } ?>
                                 </select>
                              </div>

                              <div class="form-group">
                                 <label>Co Cast Hosts</label>
                                 <input type="text" name="co_cast_hosts" class="form-control" placeholder="Update co_cast_hosts" value="<? echo $row['co_cast_hosts'];?>"   >
                              </div>

                              <div class="form-group">
                                 <label>Co Cast Hosts ID</label>
                                 <select name="co_cast_hosts_id" class="form-control select2" >
                                       <option value=""></option>
                                    <?php $sqlc=mysqli_query($con, "select * from cast");
                                    while($rowc=mysqli_fetch_array($sqlc)){ ?>
                                       <option value="<?php echo $rowc['id']; ?>" <?php if($rowc['id']==$row['co_cast_hosts_id']){echo "selected";} ?>><?php echo $rowc['name']; ?></option>
                                    <?php } ?>
                                 </select>
                              </div>

   <div class="form-group">
                                 <label>Last Day Voting Date</label>
                                 <input type="text" name="last_day_voting_date" class="form-control" placeholder="Update last_day_voting_date" value="<? echo $row['last_day_voting_date'];?>"   >
                              </div>


   <div class="form-group">
                                 <label>Last Day Voting Month</label>
                                 <input type="text" name="last_day_voting_month" class="form-control" placeholder="Update last_day_voting_month" value="<? echo $row['last_day_voting_month'];?>"   >
                              </div>


   <div class="form-group">
                                 <label>Last Day Voting Year</label>
                                 <input type="text" name="last_day_voting_year" class="form-control" placeholder="Update last_day_voting_year" value="<? echo $row['last_day_voting_year'];?>"   >
                              </div>


                            
                              <input type="hidden" name="id" value="<? echo $row['id'];?>">
                             
                              <div class="reset-button">

                                 <input type="submit" name="Update" class="btn btn-add"   value="Update">
                                  
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>

<? } ?>
















<? if( $_GET['Action']==""){ ?>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>award_year List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="award_year.php?Action=Add"> <i class="fa fa-plus"></i> Add award_year
                                 </a>  
                              </div>
                            
                           </div>



 <script type="text/javascript" src="jquery-1.8.0.min.js"></script>
<script type="text/javascript">
$(function(){
$(".search").keyup(function() 
{ 
var searchid = $(this).val();
var dataString = 'search='+ searchid;
if(searchid!='')
{
    $.ajax({
    type: "POST",
    url: "search_award_year.php",
    data: dataString,
    cache: false,
    success: function(html)
    {
    $("#result").html(html).show();
    }
    });
}return false;    
});

jQuery("#result").live("click",function(e){ 
    var $clicked = $(e.target);
    var $name = $clicked.find('.name').html();
    var decoded = $("<div/>").html($name).text();
    $('#searchid').val(decoded);
});
jQuery(document).live("click", function(e) { 
    var $clicked = $(e.target);
    if (! $clicked.hasClass("search")){
    jQuery("#result").fadeOut(); 
    }
});
$('#searchid').click(function(){
    jQuery("#result").fadeIn();
});
});
</script>
<!-- 
<input type="text" class="search form-control" id="searchid" placeholder="Search for award_year Film" style="width: 100%" />  
<div id="result"></div> -->
 
<select name="" class="form-control select2"   onChange="window.document.location.href=this.options[this.selectedIndex].value;">
   <?php $sqls=mysqli_query($con, "select * from award_year");
   while($rows=mysqli_fetch_array($sqls)){ 
      $award_name_id=$rows['award_name_id'];
      $sqln=mysqli_query($con, "select * from award_name where id='$award_name_id'");
      $rown=mysqli_fetch_array($sqln);
      ?>
      <option value="award_year.php?Action=Update&id=<?php echo $rown['id']; ?>"><?php echo $rown['name']; ?> - <?php echo $rows['award_year']; ?></option>
   <?php } ?>

</select>
<br><br>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <form name="form1" method="post" action="">
                              
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 

                                          <th>Sl No.</th>
                                       <th>Award Name</th>  
                                       <th>Year</th>   
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                    <? 




if (isset($_GET['page_no']) && $_GET['page_no']!="") {
  $page_no = $_GET['page_no'];
  } else {
    $page_no = 1;
        }

  $total_records_per_page = 10;
    $offset = ($page_no-1) * $total_records_per_page;
  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;
  $adjacents = "2"; 

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `award_year`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `award_year` order by  sl_no asc LIMIT $offset, $total_records_per_page");
 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                            <td> <input type="text" name="sl_no[]" value="<?php    echo $row['sl_no'];   ?>" style="width: 30px;">

<input type="hidden" name="id[]" value="<?php    echo $row['id'];   ?>"></td> 
                                       <td><?php


                                       $award_name_id= $row['award_name_id'];
                                      // echo $award_id;
$sqla=mysqli_query($con, "select * from award_name where id='$award_name_id'");
$rowa=mysqli_fetch_array( $sqla);
echo $rowa['name'];

                                        ?></td> 
                                       <td><?php echo $row['award_year']; ?></td>  
                                        <td>


                                         

                                          <a href="award_year.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
                                          <a  href="javascript:resume_id('<? echo $row['id']?>')" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
                                       </td>
                                    </tr>

                                     <? } ?>
                                    
                                 </tbody>
                              </table>

 <input type="submit" name="UpdateSequence" value="UpdateSequence" class="btn btn-success">

 </form>
 


<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>

<ul class="pagination">
  <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
  <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
  </li>
       
    <?php 
  if ($total_no_of_pages <= 10){     
    for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
      if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }
        }
  }
  elseif($total_no_of_pages > 10){
    
  if($page_no <= 4) {     
   for ($counter = 1; $counter < 8; $counter++){     
      if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }
        }
    echo "<li><a>...</a></li>";
    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
    }

   elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {     
    echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {     
           if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }                  
       }
       echo "<li><a>...</a></li>";
     echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
     echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
    
    else {
        echo "<li><a href='?page_no=1'>1</a></li>";
    echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
       echo "<li class='active'><a>$counter</a></li>";  
        }else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
        }                   
                }
            }
  }
?>
    
  <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
  <a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
  </li>
    <?php if($page_no < $total_no_of_pages){
    echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
    } ?>
</ul>



                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            <? } ?>
               <!-- customer Modal1 -->
              
               <!-- /.modal -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <strong>Copyright &copy; 2016-2017 <a href="#">Bollywood Product</a>.</strong> All rights reserved.
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



$(document).ready(function() {
    $('.select2').select2();
});

</script>