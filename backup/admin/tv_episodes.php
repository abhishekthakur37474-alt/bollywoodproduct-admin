<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
 
      
if($_POST["Submit"]) {  

   $tv_channel_ids=mysqli_real_escape_string($con,implode(",",$_POST['tv_channel_ids']));
   $tv_series_id = $_POST['tv_series_id'];
   $tv_season_id = $_POST['tv_season_id'];
   $episode_no = $_POST['episode_no'];
   $name = $_POST['name'];
   $alias = sanitize($_POST['name']); 
   $language_id = $_POST['language_id']; 
   $genre_ids=mysqli_real_escape_string($con,implode(",",$_POST['genre_ids']));
   $anchor_ids=mysqli_real_escape_string($con,implode(",",$_POST['anchor_ids']));
   $actual_broadcast_date = $_POST['actual_broadcast_date'];
   $episode_duration = $_POST['episode_duration'];
   $details = $_POST['details'];  

 
mysqli_query($con,"INSERT INTO tv_episodes ( tv_channel_ids, tv_series_id, tv_season_id, episode_no, name, alias, language_id,  genre_ids, anchor_ids, actual_broadcast_date,  episode_duration, details)
VALUES (  '$tv_channel_ids','$tv_series_id', '$tv_season_id', '$episode_no', '$name', '$alias',  '$language_id','$genre_ids', '$anchor_ids',   '$actual_broadcast_date', '$episode_duration', '$details')") or die(mysqli_error($con));
  
            header('location:tv_episodes.php?msg=success');
         }



           if($_POST["Update"]) {




    $id= $_POST['id'];  
    $tv_channel_ids=mysqli_real_escape_string($con,implode(",",$_POST['tv_channel_ids']));
    $tv_series_id = $_POST['tv_series_id'];
    $tv_season_id = $_POST['tv_season_id'];
    $episode_no = $_POST['episode_no'];
    $name = $_POST['name'];
    $alias = sanitize($_POST['name']); 
    $language_id = $_POST['language_id']; 
    $genre_ids=mysqli_real_escape_string($con,implode(",",$_POST['genre_ids']));
    $anchor_ids=mysqli_real_escape_string($con,implode(",",$_POST['anchor_ids']));
    $actual_broadcast_date = $_POST['actual_broadcast_date'];
    $episode_duration = $_POST['episode_duration'];
    $details = $_POST['details'];  
 
 
            mysqli_query($con,"UPDATE tv_episodes SET
   
    tv_channel_ids = '$tv_channel_ids',
    tv_series_id = '$tv_series_id',
    tv_season_id = '$tv_season_id',
    episode_no = '$episode_no',
    name = '$name',
    alias = '$alias',
    language_id = '$language_id',
    genre_ids = '$genre_ids', 
    anchor_ids = '$anchor_ids',
    actual_broadcast_date = '$actual_broadcast_date',
    episode_duration = '$episode_duration',
    details = '$details'
WHERE id = '$id'") or die(mysqli_error($con));
             header('location:tv_episodes.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){  
mysqli_query($con, "delete from tv_episodes where id='$_REQUEST[id]'");

header("location:tv_episodes.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>TV Episodes Management</title>
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
                  <h1>TV Episodes</h1>
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
                                 <h4>Add TV Episodes</h4>
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
   <label>TV Series Name</label>

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
   <label>TV Season Name</label>

   <select name="tv_season_id" id="tv_season_id"  class="form-control select2"   style="width:100%;">
   <option value=""></option>

                                  <? $sqlfr=mysqli_query($con, "select * from tv_seasons order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>" <?php if(isset($_GET['season_id'])){
if($_GET['season_id']==$rowfr['id']){echo "selected"; }
} ?>><? echo $rowfr['name']; ?>: Season No: <? echo $rowfr['season_no']; ?></option>
                                  <? } ?>
                                 </select> 
</div>
                   
 

<div class="form-group">
    <label>Episode No</label>
    <input type="text" name="episode_no" class="form-control" value="<?php echo $row['episode_no']; ?>">
</div>

<div class="form-group">
    <label>Episode Name</label>
    <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">
</div>
 
        
 
<div class="form-group">
   <label>Language</label>

   <select name="language_id" id="language_id"  class="form-control select2"   style="width:100%;">
   <option value=""></option>

                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select> 
</div>





<div class="form-group">
                                 <label>Film Genre</label>
                                <select name="genre_ids[]" id="genre_ids"  class="form-control select2"   multiple="multiple" style="width:100%;">
                                  <? $sqlfr=mysqli_query($con, "select * from genre order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select>
                                 </div>
 
                    
<div class="form-group">
                                 <label>Anchors</label>
                              
 <select name="anchor_ids[]" id="anchor_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
        <?php 
        $anchor_ids = explode(",", $row["anchor_ids"]);
        if (!empty($anchor_ids)) {
            $anchor_ids_clean = array_map('intval', $anchor_ids);
            $ids_str = implode(",", $anchor_ids_clean); 
            $selected_anchors = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($ids_str)");
            while ($sel = mysqli_fetch_assoc($selected_anchors)) {
                echo '<option value="' . $sel['id'] . '" selected>' . $sel['name'] . '</option>';
            }
        }
        ?>
    </select>

                                 </div>

         

<div class="form-group">
    <label>Actual Broadcast Date</label>
    <input type="date" name="actual_broadcast_date" class="form-control" value="<?php echo $row['actual_broadcast_date']; ?>">
</div>
<div class="form-group">
    <label>Episode Duration (HH:MM:SS)</label>
    <div class="form-inline">
        <input type="number" class="form-control text-center" id="hours" placeholder="HH" min="0" max="23" style="width: 70px;">
        :
        <input type="number" class="form-control text-center" id="minutes" placeholder="MM" min="0" max="59" style="width: 70px;">
        :
        <input type="number" class="form-control text-center" id="seconds" placeholder="SS" min="0" max="59" style="width: 70px;">
        <input type="hidden" id="duration" name="episode_duration">
    </div>
</div>

<script>
    function pad(n) {
        return n.toString().padStart(2, '0');
    }

    function updateDuration() {
        const h = Math.min(document.getElementById('hours').value || 0, 23);
        const m = Math.min(document.getElementById('minutes').value || 0, 59);
        const s = Math.min(document.getElementById('seconds').value || 0, 59);

        document.getElementById('duration').value =
            pad(h) + ':' + pad(m) + ':' + pad(s);
    }

    document.getElementById('hours').addEventListener('input', updateDuration);
    document.getElementById('minutes').addEventListener('input', updateDuration);
    document.getElementById('seconds').addEventListener('input', updateDuration);
</script>
<div class="form-group">
    <label>Details</label>
    <textarea name="details" class="form-control"><?php echo $row['details']; ?></textarea>
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
$sql="select * from tv_episodes where id='$id2'";
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
                                 <h4>Update TV Episodes</h4>
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
   <label>TV Series </label>

   <select name="tv_series_id" id="tv_series_id"  class="form-control select2"   style="width:100%;">
   <option value=""></option>

                                  <? $sqlfr=mysqli_query($con, "select * from tv_series order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>" <?php if($rowfr['id']==$row['tv_series_id']){echo "selected";} ?>><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select> 
</div>
           


<div class="form-group">
   <label>TV Season </label>

   <select name="tv_season_id" id="tv_season_id"  class="form-control select2"   style="width:100%;">
   <option value=""></option>

                                  <? $sqlfr=mysqli_query($con, "select * from tv_seasons order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>" <?php if($rowfr['id']==$row['tv_season_id']){echo "selected";} ?>><? echo $rowfr['name']; ?>: Season No: <? echo $rowfr['season_no']; ?></option>
                                  <? } ?>
                                 </select> 
</div>
           
<div class="form-group">
    <label>Episode No</label>
    <input type="text" name="episode_no" class="form-control" value="<?php echo $row['episode_no']; ?>">
</div>

<div class="form-group">
    <label>Episode Name</label>
    <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>">
</div>
 
<div class="form-group">
   <label>Language</label>

   <select name="language_id" id="language_id"  class="form-control select2"   style="width:100%;">
   <option value=""></option>

                                  <? $sqlfr=mysqli_query($con, "select * from dubbing order by name");
                                  while($rowfr=mysqli_fetch_array($sqlfr)){ ?>

<option value="<? echo $rowfr['id']; ?>" <?php if($rowfr['id']==$row['language_id']){echo "selected";} ?>><? echo $rowfr['name']; ?></option>
                                  <? } ?>
                                 </select> 
</div>
 

<div class="form-group">
                                 <label>Genre</label>

                                 <select name="genre_ids[]" id="genre_ids" class="form-control select2" multiple="multiple" style="width:100%;">
    <?php 
    $genre_ids = explode(",", $row["genre_ids"]);

    // Fetch names of selected channels
    if (!empty($genre_ids)) {
        $genre_ids_clean = array_map('intval', $genre_ids); // Sanitize
        $ids_str = implode(",", $genre_ids_clean); 
        $selected_genres = mysqli_query($con, "SELECT id, name FROM genre WHERE id IN ($ids_str)");
        while ($sel = mysqli_fetch_assoc($selected_genres)) {
            echo '<option value="' . $sel['id'] . '" selected>' . $sel['name'] . '</option>';
        }
    }

    // Now fetch and show all remaining options
    $sqlfr = mysqli_query($con, "SELECT id, name FROM genre ORDER BY name");
    while ($rowfr = mysqli_fetch_array($sqlfr)) {
        if (!in_array($rowfr['id'], $genre_ids)) {
            echo '<option value="' . $rowfr['id'] . '">' . $rowfr['name'] . '</option>';
        }
    }
    ?>
</select>


                             
                                 </div>


                                 <div class="form-group">
                                 <label>Anchor</label>
<select name="anchor_ids[]" id="anchor_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
    <?php 
    $anchor_ids = !empty($row["anchor_ids"]) ? explode(",", $row["anchor_ids"]) : [];
    if (!empty($anchor_ids)) {
        $anchor_ids_clean = array_map('intval', $anchor_ids); // Clean integers
        $ids_str = implode(",", $anchor_ids_clean); 
        $selected_anchors = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($ids_str)");
        while ($sel = mysqli_fetch_assoc($selected_anchors)) {
            echo '<option value="' . $sel['id'] . '" selected>' . $sel['name'] . '</option>';
        }
    }
    ?>
</select>

                             
                                 </div>




      
<div class="form-group">
    <label>Actual Broadcast Date</label>
    <input type="date" name="actual_broadcast_date" class="form-control" value="<?php echo $row['actual_broadcast_date']; ?>">
</div>
<?php
// Split the existing duration into parts for default values
list($h, $m, $s) = explode(':', $row['episode_duration']);
?>

<div class="form-group">
  <label>Episode Duration (HH:MM:SS)</label>
  <div class="form-inline">
    <input type="number" class="form-control" name="hours" id="hours" placeholder="HH" min="0" value="<?php echo $h; ?>" style="width:70px;">
    :
    <input type="number" class="form-control" name="minutes" id="minutes" placeholder="MM" min="0" max="59" value="<?php echo $m; ?>" style="width:70px;">
    :
    <input type="number" class="form-control" name="seconds" id="seconds" placeholder="SS" min="0" max="59" value="<?php echo $s; ?>" style="width:70px;">
  </div>
  <input type="hidden" name="episode_duration" id="episode_duration" value="<?php echo $row['episode_duration']; ?>">
</div>

<script>
// Update the hidden input on change
function updateDurationField() {
  var hh = String(document.getElementById("hours").value).padStart(2, '0');
  var mm = String(document.getElementById("minutes").value).padStart(2, '0');
  var ss = String(document.getElementById("seconds").value).padStart(2, '0');
  document.getElementById("episode_duration").value = hh + ":" + mm + ":" + ss;
}

// Trigger on load and on input changes
window.onload = updateDurationField;
document.getElementById("hours").addEventListener("input", updateDurationField);
document.getElementById("minutes").addEventListener("input", updateDurationField);
document.getElementById("seconds").addEventListener("input", updateDurationField);
</script>

<div class="form-group">
    <label>Details</label>
    <textarea name="details" class="form-control"><?php echo $row['details']; ?></textarea>
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
                                 <h4>TV Episodes List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <!-- <a class="btn btn-add" href="tv_episodes.php?Action=Add"> <i class="fa fa-plus"></i> Add tv_episodes
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
    url: "search_tv_episodes.php",
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
<input type="text" class="search form-control" id="searchid" placeholder="Search for tv_episodes Film" style="width: 100%" />  
<div id="result"></div>
  -->
<div class="row">
<div class="col-md-4">

<select id="series" class="form-control select2">
    <option value="">Select Series</option>
    <?php
    $result = mysqli_query($con, "SELECT * FROM tv_series ORDER BY name");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='{$row['id']}'>{$row['name']}</option>";
    }
    ?>
</select>
</div>

<div class="col-md-4">
<select id="season" class="form-control select2" disabled>
    <option value="">Select Season</option>
</select>

</div>


<div class="col-md-4">



<select id="episode" class="form-control select2" disabled>
    <option value="">Select Episode</option>
</select>

</div>

</div>



 <br><br>
                           
                           <br/>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>TV Series (type) :> Season :> Episode</th>  
                                              
                                       <th>Language</th>    
                                       <th>Genre</th>    
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `tv_episodes`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `tv_episodes` order by id desc LIMIT $offset, $total_records_per_page");
 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           <td> 
                                       <span><? $tv_series_id= $row['tv_series_id'];
                                       $sqlts=mysqli_query($con, "select * from tv_series where id='$tv_series_id'");
                                       $rowts=mysqli_fetch_array($sqlts); echo $rowts['name']; ?>
                                    
                                   <span style="color:#F00">(<?php echo $rowts['series_type'];   ?>) </span> 
                                    :->
                                    <? $tv_season_id= $row['tv_season_id'];
                                       $sqltse=mysqli_query($con, "select * from tv_seasons where id='$tv_season_id'");
                                       $rowtse=mysqli_fetch_array($sqltse); ?>Season : <?php echo $rowtse['season_no']; ?> <?php echo $rowtse['name']; ?>
                                       :->
                                      <span style="color:#00F">Episode <? echo $row['episode_no']; ?> <? echo $row['name']; ?></span></td>  
                                        
                                       <td><? $language_id= $row['language_id'];
                                       $sqltsl=mysqli_query($con, "select * from dubbing where id='$language_id'");
                                       $rowtsl=mysqli_fetch_array($sqltsl); echo $rowtsl['name']; ?></td>
                                           <td><?  $genre_ids =  $row['genre_ids'];
                                        $ids_array = array_map('intval', explode(',', $genre_ids));
                                        $ids_string = implode(',', $ids_array);
                                        $sqlfr=mysqli_query($con, "select * from genre where id in ($ids_string) order by name");
                                        while($rowfr=mysqli_fetch_array($sqlfr)){  
                                        echo $rowfr['name']; ?>, <? } ?> </td> 

                                        <td>

                                        <a href="tv_episodes_links.php?Action=Add&series_id=<? echo $row['tv_series_id'];    ?>&season_id=<? echo $row['tv_season_id'];    ?>&episode_id=<? echo $row['id'];    ?>" target="_blank" class="btn btn-success btn-sm"    ><i class="fa fa-plus"></i> Episode Links</a>
                                      
                                      
                                       
                                        <?php  if( $rowts['series_type']=="chat-show" ){ ?>
                                        <a href="tv_season_realityshow_members.php?Action=Add&episode_id=<? echo $row['id'];    ?>" target="_blank" class="btn btn-primary btn-sm"    ><i class="fa fa-plus"></i> Members</a>
                                    
                                    <?php } ?>
                                          <a href="tv_episodes.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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


$(document).ready(function() {
    $('#anchor_ids').select2({
        ajax: {
            url: 'ajax/fetch_cast.php',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        minimumInputLength: 2,
        placeholder: "Search cast..."
    });
});


$(document).ready(function() {
    $('.select2').select2();

    $('#series').change(function() {
        let seriesId = $(this).val();
        $('#season').html('<option value="">Loading...</option>').prop('disabled', true);
        $('#episode').html('<option value="">Select Episode</option>').prop('disabled', true);

        if (seriesId) {
            $.get('ajax/get_seasons.php', { series_id: seriesId }, function(data) {
                $('#season').html(data).prop('disabled', false);
            });
        }
    });

    $('#season').change(function() {
        let seasonId = $(this).val();
        $('#episode').html('<option value="">Loading...</option>').prop('disabled', true);

        if (seasonId) {
            $.get('ajax/get_episodes.php', { season_id: seasonId }, function(data) {
                $('#episode').html(data).prop('disabled', false);
            });
        }
    });

    $('#episode').change(function() {
        let episodeId = $(this).val();
        if (episodeId) {
            window.location.href = "tv_episodes.php?Action=Update&id=" + episodeId;
        }
    });
});

</script>