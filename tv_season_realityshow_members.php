<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
 

if($_POST["Submit"]) { 
   
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0; // 0 = insert, otherwise update
$season_id           = isset($_POST['season_id']) ? (int)$_POST['season_id'] : 0;
$episode_id          = isset($_POST['episode_id']) ? (int)$_POST['episode_id'] : 0;
$profile_type_id     = isset($_POST['profile_type_id']) ? (int)$_POST['profile_type_id'] : 0;
$entry_type_id  = isset($_POST['entry_type_id']) ? (int)$_POST['entry_type_id'] : 0;
$exit_type_id  = isset($_POST['exit_type_id']) ? (int)$_POST['exit_type_id'] : 0;
$cast_id             = isset($_POST['cast_id']) ? (int)$_POST['cast_id'] : 0;
$supporter_cast_id   = isset($_POST['supporter_cast_id']) ? (int)$_POST['supporter_cast_id'] : 0;
    $film_ids = isset($_POST['film_ids']) ? implode(',', array_map('intval', $_POST['film_ids'])) : '';

$entry_date  = mysqli_real_escape_string($con, $_POST['entry_date']);
$entry_month = mysqli_real_escape_string($con, $_POST['entry_month']);
$entry_year  = mysqli_real_escape_string($con, $_POST['entry_year']);
$exit_date   = mysqli_real_escape_string($con, $_POST['exit_date']);
$exit_month  = mysqli_real_escape_string($con, $_POST['exit_month']);
$exit_year   = mysqli_real_escape_string($con, $_POST['exit_year']);

$total_duration = mysqli_real_escape_string($con, $_POST['total_duration']);
  $sql = "INSERT INTO tv_season_realityshow_members (
        season_id, episode_id, profile_type_id, entry_type_id, exit_type_id, cast_id, supporter_cast_id, film_ids,
        entry_date, entry_month, entry_year, exit_date, exit_month, exit_year, total_duration
    ) VALUES (
        $season_id, $episode_id, $profile_type_id, $entry_type_id, $exit_type_id, $cast_id, '$supporter_cast_id', '$film_ids',
        '$entry_date', '$entry_month', '$entry_year', '$exit_date', '$exit_month', '$exit_year', '$total_duration'
    )";
 
 
mysqli_query($con,$sql) or die(mysqli_error($con));
  
            header('location:tv_season_realityshow_members.php?msg=success');
         }



           if($_POST["Update"]) {


$id = isset($_POST['id']) ? (int)$_POST['id'] : 0; // 0 = insert, otherwise update
$season_id           = isset($_POST['season_id']) ? (int)$_POST['season_id'] : 0;
$episode_id          = isset($_POST['episode_id']) ? (int)$_POST['episode_id'] : 0;
$profile_type_id     = isset($_POST['profile_type_id']) ? (int)$_POST['profile_type_id'] : 0;
$entry_type_id  = isset($_POST['entry_type_id']) ? (int)$_POST['entry_type_id'] : 0;
$exit_type_id  = isset($_POST['exit_type_id']) ? (int)$_POST['exit_type_id'] : 0;
$cast_id             = isset($_POST['cast_id']) ? (int)$_POST['cast_id'] : 0;
$supporter_cast_id   = isset($_POST['supporter_cast_id']) ? (int)$_POST['supporter_cast_id'] : 0; 
$film_ids    = isset($_POST['film_ids'])    ? implode(',', array_map('intval', $_POST['film_ids']))    : '';

$entry_date  = mysqli_real_escape_string($con, $_POST['entry_date']);
$entry_month = mysqli_real_escape_string($con, $_POST['entry_month']);
$entry_year  = mysqli_real_escape_string($con, $_POST['entry_year']);
$exit_date   = mysqli_real_escape_string($con, $_POST['exit_date']);
$exit_month  = mysqli_real_escape_string($con, $_POST['exit_month']);
$exit_year   = mysqli_real_escape_string($con, $_POST['exit_year']);

$total_duration = mysqli_real_escape_string($con, $_POST['total_duration']);
 
           $sql = "UPDATE tv_season_realityshow_members SET 
        season_id = $season_id,
        episode_id = $episode_id,
        profile_type_id = $profile_type_id,
        entry_type_id = $entry_type_id,
        exit_type_id = $exit_type_id,
        cast_id = $cast_id,
        supporter_cast_id = $supporter_cast_id,
        `film_ids` = '$film_ids',
        entry_date = '$entry_date',
        entry_month = '$entry_month',
        entry_year = '$entry_year',
        exit_date = '$exit_date',
        exit_month = '$exit_month',
        exit_year = '$exit_year',
        total_duration = '$total_duration'
        WHERE id = $id
    ";
mysqli_query($con,$sql) or die(mysqli_error($con));

             header('location:tv_season_realityshow_members.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){  
mysqli_query($con, "delete from tv_season_realityshow_members where id='$_REQUEST[id]'");

header("location:tv_season_realityshow_members.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>TV Realityshow Members Management</title>
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


       <script src="https://cdn.tiny.cloud/1/qyhq7trksx7i1gpmasi3h8szpuzmiuj9c3epa0k2hjpuszlk/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
</script>
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
                  <h1>TV Realityshow Members</h1> 
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
                                 <h4>Add TV Realityshow Members</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">

                        
<?php if(isset($_GET["season_id"])) {
$season_id=$_GET['season_id'];
$rowseason=getRowById($con, "tv_seasons", $_GET['season_id']);
$rowseries=getRowById($con, "tv_series", $rowseason['tv_series_id']);
}

 if(isset($_GET["episode_id"])) {
$episode_id=$_GET['episode_id'];
$rowepisode=getRowById($con, "tv_episodes", $_GET['episode_id']);
$season_id=$rowepisode['tv_season_id'];
$rowseason=getRowById($con, "tv_seasons", $rowepisode['tv_season_id']);
$rowseries=getRowById($con, "tv_series", $rowseason['tv_series_id']);
}

?>
 <?php echo $rowseries['name']; ?> -> Season <?php echo $rowseason['season_no']; ?>
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              
                              <input type="hidden" name="season_id" value="<?php echo $_GET['season_id']; ?>" >
     
  <div class="form-group">
                                 <label>Episode</label>
                                
<select name="episode_id" class="form-control">
    <option value=""></option>
    <?php $sqle=mysqli_query($con, "select * from tv_episodes where tv_season_id='$season_id'");
    while($rowe=mysqli_fetch_array($sqle)) { 
      
      
      ?>
        <option value="<?php echo $rowe['id']; ?>" <?php if($rowe['id']==$episode_id){echo "selected";} ?>><?php echo $rowseries['name']; ?> -> Season <?php echo $rowseason['season_no']; ?> -> Episode <?php echo $rowe['episode_no']; ?> <?php echo $rowe['name']; ?></option>
    <?php } ?>
</select>   
                                 </div>
     
  <div class="form-group">
                                 <label>Profile Type</label>
                               <?php
$entry_exit_options = getAllRows($con, "tv_reality_profile_type");
?>

<select name="profile_type_id" class="form-control">
    <option value=""></option>
    <?php foreach ($entry_exit_options as $rowee) { ?>
        <option value="<?php echo $rowee['id']; ?>"><?php echo $rowee['name']; ?></option>
    <?php } ?>
</select>   
                              
                              </div>
  
     <div class="form-group">
    <label>Cast</label>
   <select name="cast_id" id="cast_id" class="form-control select2-ajax" style="width:100%;">
    <?php 
    $selected_id = (int)$row["cast_id"]; // Assuming the column is 'cast_id' now, storing a single value
    if ($selected_id > 0) {
        $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id = $selected_id");
        if ($sel = mysqli_fetch_assoc($res)) {
            echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
        }
    }
    ?>
</select>

</div>
     
  <div class="form-group">
                                 <label>Supporter Cast</label>
                               <select name="supporter_cast_id" id="supporter_cast_id" class="form-control select2-ajax" style="width:100%;">
    <?php 
    $selected_id = (int)$row["supporter_cast_id"]; // Assuming your column is 'supporter_cast_id'
    if ($selected_id > 0) {
        $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id = $selected_id");
        if ($sel = mysqli_fetch_assoc($res)) {
            echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
        }
    }
    ?>
</select>

                              </div>
        
  <div class="form-group">
                                 <label>Film </label>
         
<select name="film_ids[]" id="film_ids" class="form-control select2f-ajax" multiple="multiple" style="width:100%;">
    <?php 
    $ids = explode(",", $row["film_ids"]);
    if (!empty($ids)) {
        $clean_ids = array_map('intval', $ids);
        $id_str = implode(",", $clean_ids); 
        $res = mysqli_query($con, "SELECT id, name FROM film WHERE id IN ($id_str)");
        while ($sel = mysqli_fetch_assoc($res)) {
            echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
        }
    }
    ?>
</select>

                              </div>
  <div class="form-group">
                                 <label>Entry Type</label>
                               <?php
$filters = [    
    'type' => 'Entry'
];

$entry_exit_options = getRowsWhereMulti($con, 'tv_reality_entry_exit_type', $filters);

 
?>

<select name="entry_type_id" class="form-control">
    <option value=""></option>
    <?php foreach ($entry_exit_options as $rowee) { ?>
        <option value="<?php echo $rowee['id']; ?>"><?php echo $rowee['name']; ?></option>
    <?php } ?>
</select>
                              </div>

                              

  <div class="form-group">
                                 <label>Entry Date</label>
                                 <input type="text" name="entry_date" class="form-control" placeholder="Add Entry Date" value="<? echo $row['entry_date'];?>"   >
                              </div>
     

  <div class="form-group">
                                 <label>Entry Month</label>
                                 <input type="text" name="entry_month" class="form-control" placeholder="Add Entry Month" value="<? echo $row['entry_month'];?>"   >
                              </div>
     

  <div class="form-group">
                                 <label>Entry Year</label>
                                 <input type="text" name="entry_year" class="form-control" placeholder="Add Entry Year" value="<? echo $row['entry_year'];?>"   >
                              </div>
     
   
  <div class="form-group">
                                 <label>  Exit Type</label>
                                <?php
$filters = [    
    'type' => 'Exit'
];

$entry_exit_options = getRowsWhereMulti($con, 'tv_reality_entry_exit_type', $filters);

 
?>

<select name="exit_type_id" class="form-control">
    <option value=""></option>
    <?php foreach ($entry_exit_options as $rowee) { ?>
        <option value="<?php echo $rowee['id']; ?>"><?php echo $rowee['name']; ?></option>
    <?php } ?>
</select>
                              </div>
  <div class="form-group">
                                 <label>Exit Date</label>
                                 <input type="text" name="exit_date" class="form-control" placeholder="Add Exit Date" value="<? echo $row['exit_date'];?>"   >
                              </div>
     

  <div class="form-group">
                                 <label>Exit Month</label>
                                 <input type="text" name="exit_month" class="form-control" placeholder="Add Exit Month" value="<? echo $row['exit_month'];?>"   >
                              </div>
     

  <div class="form-group">
                                 <label>Exit Year</label>
                                 <input type="text" name="exit_year" class="form-control" placeholder="Add Exit Year" value="<? echo $row['exit_year'];?>"   >
                              </div>
     

  <div class="form-group">
                                 <label>Total Duration</label>
                                 <input type="text" name="total_duration" class="form-control" placeholder="Add Total Duration" value="<? echo $row['total_duration'];?>"   >
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
$sql="select * from tv_season_realityshow_members where id='$id2'";
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
                                 <h4>Update TV Realityshow Members</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                                       
<?php 
$season_id=$row['season_id'];
$rowseason=getRowById($con, "tv_seasons", $row['season_id']);
$rowseries=getRowById($con, "tv_series", $rowseason['tv_series_id']);

?>
 <?php echo $rowseries['name']; ?> -> Season <?php echo $rowseason['season_no']; ?> 
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <input type="hidden" name="season_id" value="<?php echo $_GET['season_id']; ?>" >
     
  <div class="form-group">
                                 <label>Episode</label>
                                
<?php echo $row['episode_id']; ?>
<select name="episode_id" class="form-control">
    <option value=""></option>
    <?php $sqle=mysqli_query($con, "select * from tv_episodes where tv_season_id='$season_id'");
    while($rowe=mysqli_fetch_array($sqle)) { 
      
      
      ?>
        <option value="<?php echo $rowe['id']; ?>" <?php if($rowe['id']==$row['episode_id']){ echo "selected"; } ?>><?php echo $rowseries['name']; ?> -> Season <?php echo $rowseason['season_no']; ?> -> Episode <?php echo $rowe['episode_no']; ?> <?php echo $rowe['name']; ?></option>
    <?php } ?>
</select>   
                                 </div>
     
  <div class="form-group">
                                 <label>Profile Type</label>
                               <?php
$entry_exit_options = getAllRows($con, "tv_reality_profile_type");
?>

<select name="profile_type_id" class="form-control">
    <option value=""></option>
    <?php foreach ($entry_exit_options as $rowee) { ?>
        <option value="<?php echo $rowee['id']; ?>" <?php if($rowee['id']==$row['profile_type_id']) { echo "selected"; } ?>><?php echo $rowee['name']; ?></option>
    <?php } ?>
</select>   
                              
                              </div>
  
     <div class="form-group">
    <label>Cast</label>
   <select name="cast_id" id="cast_id" class="form-control select2-ajax" style="width:100%;">
    <?php 
    $selected_id = (int)$row["cast_id"]; // Assuming the column is 'cast_id' now, storing a single value
    if ($selected_id > 0) {
        $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id = $selected_id");
        if ($sel = mysqli_fetch_assoc($res)) {
            echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
        }
    }
    ?>
</select>

</div>
     
  <div class="form-group">
                                 <label>Supporter Cast</label>
                               <select name="supporter_cast_id" id="supporter_cast_id" class="form-control select2-ajax" style="width:100%;">
    <?php 
    $selected_id = (int)$row["supporter_cast_id"]; // Assuming your column is 'supporter_cast_id'
    if ($selected_id > 0) {
        $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id = $selected_id");
        if ($sel = mysqli_fetch_assoc($res)) {
            echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
        }
    }
    ?>
</select>

                              </div>
        



<div class="form-group">
    <label>Film</label>
    <select name="film_ids[]" id="film_ids" class="form-control select2f-ajax" multiple="multiple" style="width:100%;">
        <?php 
        $ids = explode(",", $row["film_ids"]);
        if (!empty($ids)) {
            $clean_ids = array_map('intval', $ids);
            $id_str = implode(",", $clean_ids); 
            $res = mysqli_query($con, "SELECT id, name FROM film WHERE id IN ($id_str)");
            while ($sel = mysqli_fetch_assoc($res)) {
                echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
            }
        }
        ?>
    </select>
</div>



  <div class="form-group">
                                 <label>Entry Type</label>
                               <?php
$filters = [    
    'type' => 'Entry'
];

$entry_exit_options = getRowsWhereMulti($con, 'tv_reality_entry_exit_type', $filters);

 
?>

<select name="entry_type_id" class="form-control">
    <option value=""></option>
    <?php foreach ($entry_exit_options as $rowee) { ?>
        <option value="<?php echo $rowee['id']; ?>" <?php if($rowee['id']==$row['entry_type_id']) { echo "selected"; } ?>><?php echo $rowee['name']; ?></option>
    <?php } ?>
</select>
                              </div>

  <div class="form-group">
                                 <label>Entry Date</label>
                                 <input type="text" name="entry_date" class="form-control" placeholder="Add Entry Date" value="<? echo $row['entry_date'];?>"   >
                              </div>
     

  <div class="form-group">
                                 <label>Entry Month</label>
                                 <input type="text" name="entry_month" class="form-control" placeholder="Add Entry Month" value="<? echo $row['entry_month'];?>"   >
                              </div>
     

  <div class="form-group">
                                 <label>Entry Year</label>
                                 <input type="text" name="entry_year" class="form-control" placeholder="Add Entry Year" value="<? echo $row['entry_year'];?>"   >
                              </div>
     
   
  <div class="form-group">
                                 <label>  Exit Type</label>
                                <?php
$filters = [    
    'type' => 'Exit'
];

$entry_exit_options = getRowsWhereMulti($con, 'tv_reality_entry_exit_type', $filters);

 
?>
<select name="exit_type_id" class="form-control">
    <option value=""></option>
    <?php foreach ($entry_exit_options as $rowee) { ?>
        <option value="<?php echo $rowee['id']; ?>"  <?php if($rowee['id']==$row['exit_type_id']) { echo "selected"; } ?>><?php echo $rowee['name']; ?></option>
    <?php } ?>
</select>
                              </div>
  <div class="form-group">
                                 <label>Exit Date</label>
                                 <input type="text" name="exit_date" class="form-control" placeholder="Add Exit Date" value="<? echo $row['exit_date'];?>"   >
                              </div>
     

  <div class="form-group">
                                 <label>Exit Month</label>
                                 <input type="text" name="exit_month" class="form-control" placeholder="Add Exit Month" value="<? echo $row['exit_month'];?>"   >
                              </div>
     

  <div class="form-group">
                                 <label>Exit Year</label>
                                 <input type="text" name="exit_year" class="form-control" placeholder="Add Exit Year" value="<? echo $row['exit_year'];?>"   >
                              </div>
     

  <div class="form-group">
                                 <label>Total Duration</label>
                                 <input type="text" name="total_duration" class="form-control" placeholder="Add Total Duration" value="<? echo $row['total_duration'];?>"   >
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
                                 <h4>TV Realityshow Members List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <!-- <a class="btn btn-add" href="tv_season_realityshow_members.php?Action=Add"> <i class="fa fa-plus"></i> Add TV Realityshow Members
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
    url: "search_tv_season_realityshow_members.php",
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
<input type="text" class="search form-control" id="searchid" placeholder="Search for tv_season_realityshow_members Film" style="width: 100%" />  
<div id="result"></div>
  -->



 <select class="form-control select2"   onChange="window.document.location.href=this.options[this.selectedIndex].value;">
<option value="">Search TV Realityshow Members</option>
<?php $sqlfs=mysqli_query($con, "select * from tv_season_realityshow_members");
while($rowfs=mysqli_fetch_array($sqlfs)){  
 ?>

<option value="tv_season_realityshow_members.php?Action=Update&id=<?php echo $rowfs['id']; ?>"><?php echo $rowfs['year']; ?> - <?php echo $rowfs['broadcast_date1']; ?>   </option>
<?php } ?>

 </select><br><br>
                           
                           <br/>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>Episode</th>
                                       <th>Profile</th>
                                          
                                       <th>Cast/ Supporter </th>  
                                       <th>Film</th> 
                                       <th>Entry</th>   
                                       <th>Exit</th>   
                                       <th>Duration</th>  
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `tv_season_realityshow_members`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `tv_season_realityshow_members` order by id desc LIMIT $offset, $total_records_per_page");
 
                                    while($row=mysqli_fetch_array($result)){ 
                                        $rowepisode=getRowById($con, "tv_episodes", $row['episode_id']);
                                        $rowseason=getRowById($con, "tv_seasons", $rowepisode['tv_season_id']);
                                       $rowseries=getRowById($con, "tv_series", $rowepisode['tv_series_id']);
                                       $rowprofiletype=getRowById($con, "tv_reality_profile_type", $row['profile_type_id']);
                                       $rowentrytype=getRowById($con, "tv_reality_entry_exit_type", $row['entry_type_id']);
                                       $rowexittype=getRowById($con, "tv_reality_entry_exit_type", $row['exit_type_id']);
                                       $rowcast=getRowById($con, "cast", $row['cast_id']);
                                       $rowsupportercast=getRowById($con, "cast", $row['supporter_cast_id']);
                                       
                                       ?>
                                    <tr>
                                        <td> <?php echo $rowseries['name']; ?> -> Season <?php echo $rowseason['season_no']; ?> -> Episode <?php echo $row['episode_no']; ?>  <?php echo $row['name']; ?></td>
                                       <td><? echo $rowprofiletype['name']; ?></td>   
                                       <td><? echo $rowcast['name']; ?><br><? echo $rowsupportercast['name']; ?></td>   
                                        <td><? $film_ids = explode(",", $row['film_ids']);

foreach ($film_ids as $id) {
    $id = (int)$id;
    $film_row = getRowById($con, "film", $id);
    if ($film_row) {
        echo $film_row['name'] . "<br>";
    }
} ?></td>  
                                       <td>
                                       <? echo $row['rowentrytype']; ?><br>   
                                       <? echo $row['entry_date']; ?>-<? echo $row['entry_month']; ?>-<? echo $row['entry_year']; ?></td>  
                                       <td>
                                       <? echo $row['rowexittype']; ?><br>
                                       <? echo $row['exit_date']; ?>-<? echo $row['exit_month']; ?>-<? echo $row['exit_year']; ?></td>  
                                       <td><? echo $row['total_duration']; ?></td>  
                                     
                                         
                                        <td>


                                  
                                          <a href="tv_season_realityshow_members.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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
</script>
<script>

$(document).ready(function() {
    $('.select2-ajax').select2({
        ajax: {
            url: 'ajax/fetch_cast.php', // Update with your endpoint
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { q: params.term };
            },
            processResults: function (data) {
                return { results: data };
            },
            cache: true
        },
        minimumInputLength: 2,
        placeholder: "Search cast..."
    });
});

$(document).ready(function() {
    $('.select2f-ajax').select2({
        ajax: {
            url: 'ajax/fetch_film.php', // Update with your endpoint
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return { q: params.term };
            },
            processResults: function (data) {
                return { results: data };
            },
            cache: true
        },
        minimumInputLength: 2,
        placeholder: "Search film..."
    });
});

</script>