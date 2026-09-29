<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
 


if($_POST["Submit"]) { 
   $tv_channel_ids=mysqli_real_escape_string($con,implode(",",$_POST['tv_channel_ids']));
   $tv_series_id = $_POST['tv_series_id'];
   $name = $_POST['name'];
   $alias = sanitize($_POST['name']);
   $season_no = $_POST['season_no'];
   $actual_broadcast_channel_id = $_POST['actual_broadcast_channel_id'];
   $season_start_date = $_POST['season_start_date'];
   $season_start_month = $_POST['season_start_month'];
   $season_start_year = $_POST['season_start_year'];
   $season_end_date = $_POST['season_end_date'];
   $season_end_month = $_POST['season_end_month'];
   $season_end_year = $_POST['season_end_year'];
   $season_duration = $_POST['season_duration'];
   $total_episodes = $_POST['total_episodes'];
   $language_ids=mysqli_real_escape_string($con,implode(",",$_POST['language_ids']));
   $details = $_POST['details'];
 
   $photo = '';
   if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
       $target_dir = "../uploads/";
   
       // Get file extension
       $file_ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
   
       // Create a unique filename
       $photo = 'tv_season_' . time() . '_' . uniqid() . '.' . $file_ext;
   
       $target_file = $target_dir . $photo;
   
       // Optional: validate file type and size here
   
       // Move uploaded file
       move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
   }


 
mysqli_query($con,"INSERT INTO `tv_seasons` ( tv_channel_ids,tv_series_id, name, alias,photo, season_no, actual_broadcast_channel_id, season_start_date, season_start_month, season_start_year, season_end_date, season_end_month, season_end_year, season_duration, total_episodes, language_ids, details ) VALUES (  '$tv_channel_ids', '$tv_series_id', '$name', '$alias', '$photo', '$season_no', '$actual_broadcast_channel_id', '$season_start_date', '$season_start_month', '$season_start_year', '$season_end_date', '$season_end_month',  '$season_end_year', '$season_duration',  '$total_episodes',  '$language_ids', '$details'    )") or die(mysqli_error($con));
  
            header('location:tv_seasons.php?msg=success');
         }



           if($_POST["Update"]) {




    $id= $_POST['id']; 
    
   $tv_channel_ids=mysqli_real_escape_string($con,implode(",",$_POST['tv_channel_ids']));
   $tv_series_id = $_POST['tv_series_id'];
   $name = $_POST['name'];
   $alias = sanitize($_POST['name']);
   $season_no = $_POST['season_no'];

   $actual_broadcast_channel_id = $_POST['actual_broadcast_channel_id'];
   $season_start_date = $_POST['season_start_date'];
   $season_start_month = $_POST['season_start_month'];
   $season_start_year = $_POST['season_start_year'];
   $season_end_date = $_POST['season_end_date'];
   $season_end_month = $_POST['season_end_month'];
   $season_end_year = $_POST['season_end_year'];
   $season_duration = $_POST['season_duration'];
   $total_episodes = $_POST['total_episodes'];
   $language_ids=mysqli_real_escape_string($con,implode(",",$_POST['language_ids']));
   $details = $_POST['details'];    
   $old_photo = $_POST['old_photo'];
   $photo = $old_photo;
// Handle file upload if a new file is chosen
if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
  $target_dir = "../uploads/";

  // Get file extension
  $file_ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);

  // Generate a unique file name
  $photo = 'tv_series_' . time() . '_' . uniqid() . '.' . $file_ext;

  $target_file = $target_dir . $photo;

  // Upload new photo
  move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

  // Optionally delete old photo
  if (!empty($old_photo) && file_exists("../uploads/" . $old_photo)) {
      unlink("../uploads/" . $old_photo);
  }
}

            mysqli_query($con,"
            
    UPDATE tv_seasons SET 
        name = '$name',
        alias = '$alias',
        photo = '$photo',
        tv_series_id = '$tv_series_id',
        season_no = '$season_no',
        actual_broadcast_channel_id = '$actual_broadcast_channel_id',
        season_start_date = '$season_start_date',
        season_start_month = '$season_start_month',
        season_start_year = '$season_start_year',
        season_end_date = '$season_end_date',
        season_end_month = '$season_end_month',
        season_end_year = '$season_end_year',
        season_duration = '$season_duration',
        total_episodes = '$total_episodes',
        tv_channel_ids = '$tv_channel_ids',
        language_ids = '$language_ids',
        details = '$details'
    WHERE id = '$id'
") or die(mysqli_error($con));
             header('location:tv_seasons.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){  
          
    $id = intval($_GET['id']); // Safely cast to integer

    // Fetch photo filename
    $result = mysqli_query($con, "SELECT photo FROM tv_seasons WHERE id='$id'") or die(mysqli_error($con));
    $row = mysqli_fetch_assoc($result);

    if (!empty($row['photo']) && file_exists("../uploads/" . $row['photo'])) {
        unlink("../uploads/" . $row['photo']); // Delete file from server
    }

    // Now delete from database
mysqli_query($con, "delete from tv_seasons where id='$_REQUEST[id]'");

header("location:tv_seasons.php?msg=Deleted Successfully");
}     
         

if($_GET['remove_photo']=="yes"){  
      
   $id = intval($_GET['id']); // Safely cast to integer

   // Fetch photo filename
   $result = mysqli_query($con, "SELECT photo FROM tv_seasons WHERE id='$id'") or die(mysqli_error($con));
   $row = mysqli_fetch_assoc($result);

   if (!empty($row['photo']) && file_exists("../uploads/" . $row['photo'])) {
       unlink("../uploads/" . $row['photo']); // Delete file from server
   }

   // Now delete from database
   mysqli_query($con, "UPDATE tv_seasons SET photo='' WHERE id='$id'") or die(mysqli_error($con));
   
header("location:tv_seasons.php?msg=Deleted Successfully");
  }


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>TV Seasons Management</title>
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
         <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />



         <?php include "tinymce.php"; ?>
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
                  <h1>TV Seasons</h1>
                  <?php include "tv_topbarbuttons.php"; ?>
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
                                 <h4>Add TV Seasons</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                             
                                    
<div class="form-group">
                                 <label>Channel</label>
                                <select name="tv_channel_ids[]" id="tv_channel_ids"  class="form-control select2"   multiple="multiple" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from tv_channels order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 </div>


                                 
<div class="form-group">
   <label>TV Series</label>

   <select name="tv_series_id" id="tv_series_id"  class="form-control select2"   style="width:100%;">
   <option value=""></option>

                                  <? $sqlfr=mysqli_query($con, "select * from tv_series order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>" <?php if(isset($_GET['series_id'])){
if($_GET['series_id']==$rowfr['id']){echo "selected"; }
} ?>><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select> 
</div>



                           
<div class="form-group">
                                 <label>Season Name</label>
                                 <input type="text" name="name" class="form-control" placeholder="Add name"    >
                              </div>
     
                           
                              <div class="form-group">
                                 <label>Season Number</label>
                                 <input type="text" name="season_no" class="form-control" placeholder="Add Season Number"    >
                              </div>
     
<div class="form-group">
        <label>Upload Photo</label>
        <input type="file" name="photo" class="form-control">
    </div>

                              <div class="form-group">
   <label>Actual Broadcast Channel</label>

   <select name="actual_broadcast_channel_id" id="actual_broadcast_channel_id"  class="form-control select2"   style="width:100%;">
   <option value=""></option>

                                  <? $sqlfr=mysqli_query($con, "select * from tv_channels order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select> 
</div>
<div class="form-group">
                                 <label>Season Start Date (DD)</label>
                                 <input type="text" name="season_start_date" class="form-control" placeholder="Add Season Start Date"    >
                              </div>
       
<div class="form-group">
                                 <label>Season Start Month (MM)</label>
                                 <input type="text" name="season_start_month" class="form-control" placeholder="Add Season Start Month"    >
                              </div>
       
<div class="form-group">
                                 <label>Season Start Year (YYYY)</label>
                                 <input type="text" name="season_start_year" class="form-control" placeholder="Add Season Start Year"    >
                              </div>
       
                           

                              <div class="form-group">
                                 <label>Season End Date (DD)</label>
                                 <input type="text" name="season_end_date" class="form-control" placeholder="Add Season End Date"    >
                              </div>
     

                              <div class="form-group">
                                 <label>Season End Month (MM)</label>
                                 <input type="text" name="season_end_month" class="form-control" placeholder="Add Season End Month"    >
                              </div>
     

                              <div class="form-group">
                                 <label>Season End Year (YYYY)</label>
                                 <input type="text" name="season_end_year" class="form-control" placeholder="Add Season End Year"    >
                              </div>
     
                              <div class="form-group">
                                 <label>Season Duration</label>
                                 <input type="text" name="season_duration" class="form-control" placeholder="Add Season Duration"    >
                              </div>
     
                              <div class="form-group">
                                 <label>Total Episodes</label>
                                 <input type="text" name="total_episodes" class="form-control" placeholder="Add Total Episodes"    >
                              </div>
     

                              <div class="form-group">
                                 <label>Language</label>
                                <select name="language_ids[]" id="language_ids"  class="form-control select2"   multiple="multiple" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 </div>

<div class="form-group">
   <label>  Details</label>
   <textarea name="details" class="form-control" placeholder="Enter Short Details"></textarea>
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
$sql="select * from tv_seasons where id='$id2'";
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
                                 <h4>Update TV Seasons</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                           <div class="form-group">
                                 <label>TV Channel</label>

                                 <select name="tv_channel_ids[]" id="tv_channel_ids" class="form-control select2" multiple="multiple" style="width:100%;">
    <?php 
    $tv_channel_ids = explode(",", $row["tv_channel_ids"]);

    // Fetch names of selected channels
    if (!empty($tv_channel_ids)) {
        $tv_channel_ids_clean = array_map('intval', $tv_channel_ids); // Sanitize
        $ids_str = implode(",", $tv_channel_ids_clean); 
        $selected_tv_channels = mysqli_query($con, "SELECT id, name FROM tv_channels WHERE id IN ($ids_str)");
        while ($sel = mysqli_fetch_assoc($selected_tv_channels)) {
            echo '<option value="' . $sel['id'] . '" selected>' . $sel['name'] . '</option>';
        }
    }

    // Now fetch and show all remaining options
    $sqlfr = mysqli_query($con, "SELECT id, name FROM tv_channels ORDER BY name");
    while ($rowfr = mysqli_fetch_array($sqlfr)) {
        if (!in_array($rowfr['id'], $tv_channel_ids)) {
            echo '<option value="' . $rowfr['id'] . '">' . $rowfr['name'] . '</option>';
        }
    }
    ?>
</select>


                             
                                 </div>


                                 <div class="form-group">
   <label>TV Series ID</label>

   <select name="tv_series_id" id="tv_series_id"  class="form-control select2"   style="width:100%;">
   <option value=""></option>

                                  <? $sqlfr=mysqli_query($con, "select * from tv_series order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>" <?php if($rowfr['id']==$row['tv_series_id']){echo "selected";} ?>><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select> 
</div>
 
                           
<div class="form-group">
                                 <label>Name</label>
                                 <input type="text" name="name" class="form-control" placeholder="Add name"  value="<? echo $row['name'];?>"    >
                              </div>
          
<div class="form-group">
                                 <label>Alias</label>
                                 <input type="text" name="alias" class="form-control" placeholder="Add alias"  value="<? echo $row['alias'];?>"    >
                              </div>
     
<div class="form-group">
        <label>Upload Photo</label>
        <input type="file" name="photo" class="form-control">
        <input type="hidden" name="old_photo" value="<?php echo $row['photo']; ?>">


        <? if($row['photo'] != "") { ?>
                                          <a href="../uploads/<? echo $row['photo']; ?>" data-lightbox="tv-gallery">
                                             <img src="../uploads/<? echo $row['photo']; ?>" width="30" />
                                          </a>
                                          <a  href="javascript:delete_photo_id('<? echo $row['id']?>')" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
                                          <? } else { ?>
                                             <img src="https://www.bollywoodproduct.com/images/default.png"width="30">
                                          <? } ?>
                                           
    </div>
                              <div class="form-group">
                                 <label>Season Number</label>
                                 <input type="text" name="season_no" class="form-control" placeholder="Add Season Number"     value="<? echo $row['season_no'];?>"  >
                              </div>

<div class="form-group">
   <label>Actual Broadcast Channel</label>

   <select name="actual_broadcast_channel_id" id="actual_broadcast_channel_id"  class="form-control select2"   style="width:100%;">
   <option value=""></option>

                                  <? $sqlfr=mysqli_query($con, "select * from tv_channels order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>" <?php if($rowfr['id']==$row['actual_broadcast_channel_id']){echo "selected";} ?>><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select> 
</div>
 
<div class="form-group">
                                 <label>Season Start Date (DD)</label>
                                 <input type="text" name="season_start_date" class="form-control" placeholder="Add Season Start Date"    value="<? echo $row['season_start_date'];?>"    >
                              </div>
       
<div class="form-group">
                                 <label>Season Start Month (MM)</label>
                                 <input type="text" name="season_start_month" class="form-control" placeholder="Add Season Start Month"    value="<? echo $row['season_start_month'];?>"    >
                              </div>
       
<div class="form-group">
                                 <label>Season Start Year (YYYY)</label>
                                 <input type="text" name="season_start_year" class="form-control" placeholder="Add Season Start Year"   value="<? echo $row['season_start_year'];?>"     >
                              </div>
       
                           

                              <div class="form-group">
                                 <label>Season End Date (DD)</label>
                                 <input type="text" name="season_end_date" class="form-control" placeholder="Add Season End Date"    value="<? echo $row['season_end_date'];?>"    >
                              </div>
     

                              <div class="form-group">
                                 <label>Season End Month (MM)</label>
                                 <input type="text" name="season_end_month" class="form-control" placeholder="Add Season End Month"    value="<? echo $row['season_end_month'];?>"    >
                              </div>
     

                              <div class="form-group">
                                 <label>Season End Year (YYYY)</label>
                                 <input type="text" name="season_end_year" class="form-control" placeholder="Add Season End Year"     value="<? echo $row['season_end_year'];?>"   >
                              </div>
     
     
                              <div class="form-group">
                                 <label>Season Duration</label>
                                 <input type="text" name="season_duration" class="form-control" placeholder="Add Season Duration"   value="<? echo $row['season_duration'];?>"    >
                              </div>
     
                              <div class="form-group">
                                 <label>Total Episodes</label>
                                 <input type="text" name="total_episodes" class="form-control" placeholder="Add Total Episodes"   value="<? echo $row['total_episodes'];?>"    >
                              </div>
     

                    
                                 
<div class="form-group">
                                 <label>Language</label>

                                 <select name="language_ids[]" id="language_ids" class="form-control select2" multiple="multiple" style="width:100%;">
    <?php 
    $language_ids = explode(",", $row["language_ids"]);

    // Fetch names of selected channels
    if (!empty($language_ids)) {
        $language_ids_clean = array_map('intval', $language_ids); // Sanitize
        $ids_str = implode(",", $language_ids_clean); 
        $selected_languages = mysqli_query($con, "SELECT id, name FROM dubbing WHERE id IN ($ids_str)");
        while ($sel = mysqli_fetch_assoc($selected_languages)) {
            echo '<option value="' . $sel['id'] . '" selected>' . $sel['name'] . '</option>';
        }
    }

    // Now fetch and show all remaining options
    $sqlfr = mysqli_query($con, "SELECT id, name FROM dubbing ORDER BY name");
    while ($rowfr = mysqli_fetch_array($sqlfr)) {
        if (!in_array($rowfr['id'], $language_ids)) {
            echo '<option value="' . $rowfr['id'] . '">' . $rowfr['name'] . '</option>';
        }
    }
    ?>
</select>


                             
                                 </div>



 
                                 <div class="form-group">
   <label>Details</label>
   <textarea name="details" class="form-control" placeholder="Enter Details"><?php echo $row['details']; ?></textarea>
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
                                 <h4>TV Seasons List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <!-- <a class="btn btn-add" href="tv_seasons.php?Action=Add"> <i class="fa fa-plus"></i> Add TV Seasons
                                 </a>   -->
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
    url: "search_tv_seasons.php",
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
<input type="text" class="search form-control" id="searchid" placeholder="Search for tv_seasons Film" style="width: 100%" />  
<div id="result"></div>
  -->



 <select class="form-control select2"   onChange="window.document.location.href=this.options[this.selectedIndex].value;">
<option value="">Search TV Seasons</option>
<?php $sqlfs=mysqli_query($con, "select * from tv_seasons");
while($rowfs=mysqli_fetch_array($sqlfs)){  
   $rowSeries=getRowById($con, "tv_series", $rowfs['tv_series_id']);
 ?>

<option value="tv_seasons.php?Action=Update&id=<?php echo $rowfs['id']; ?>"><?php echo $rowSeries['name']; ?> - Season  <?php echo $rowfs['season_no']; ?>   </option>
<?php } ?>

 </select><br><br>
                           
                           <br/>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                      
                                       <th>Series</th>   
                                       <th>Season</th>   
                                       <th>Photo</th>   
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `tv_seasons`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `tv_seasons` order by id desc LIMIT $offset, $total_records_per_page");
 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                  
                                        
                                        <td><? $tv_series_id= $row['tv_series_id'];
                                       $sqlts=mysqli_query($con, "select * from tv_series where id='$tv_series_id'");
                                       $rowts=mysqli_fetch_array($sqlts); echo $rowts['name']; ?></td>
                                        
                                       <td><? echo $row['season_no']; ?><? echo $row['name']; ?></td>  
                                        
<td>
                                          <? if($row['photo'] != "") { ?>
                                          <a href="../uploads/<? echo $row['photo']; ?>" data-lightbox="tv-gallery">
                                             <img src="../uploads/<? echo $row['photo']; ?>" width="30" />
                                          </a>
                                          <a  href="javascript:delete_photo_id('<? echo $row['id']?>')" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
                                          <? } else { ?>
                                             <img src="https://www.bollywoodproduct.com/images/default.png"width="30">
                                          <? } ?>
                                     
</td>   
                                        <td>


                                        <a href="tv_episodes.php?Action=Add&series_id=<? echo $row['tv_series_id'];    ?>&season_id=<? echo $row['id'];    ?>" target="_blank" class="btn btn-success btn-sm"    ><i class="fa fa-plus"></i> Episode</a>
                                          <?php if($rowts['series_type']=="reality-show" || $rowts['series_type']=="chat-show"){ ?>
                                        <?php 
                                        $season_id=$row['id'];
                                        $check = mysqli_query($con, "SELECT id FROM tv_season_realityshow WHERE season_id = $season_id");
if (mysqli_num_rows($check) > 0) { 
   $rws=mysqli_fetch_array($check);
   ?>
      <a href="tv_season_realityshow.php?Action=Update&id=<? echo $rws['id'];    ?>" target="_blank" class="btn btn-primary btn-sm"    ><i class="fa fa-pencil"></i> Reality / Chat Show</a>
                                    
      <?php } else { ?>
                                             <a href="tv_season_realityshow.php?Action=Add&season_id=<? echo $row['id'];    ?>" target="_blank" class="btn btn-primary btn-sm"    ><i class="fa fa-plus"></i> Reality / Chat Show</a>
                            <?php } ?>            
                                     
                                         <a href="tv_season_realityshow_members.php?Action=Add&season_id=<? echo $row['id'];    ?>" target="_blank" class="btn btn-success btn-sm"    ><i class="fa fa-plus"></i> Members</a>
                                    
                                    <?php } ?>
                                          <a href="tv_seasons.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
                                          <a  href="javascript:resume_id('<? echo $row['id']?>')" class="btn btn-danger btn-sm"  ><i class="fa fa-trash-o"></i> </a>
                                       </td>
                                    </tr>

                                     <? } ?>
                                    
                                 </tbody>
                              </table>



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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>  

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



function delete_photo_id(res_id){

var agree=confirm("This will delete photo.  Are you sure you wish to continue?");
if (agree) {
window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>?remove_photo=yes&id='+res_id;
window.submit();
}
else {
   
}
}




$(document).ready(function() {
    $('.select2').select2();
});
</script>