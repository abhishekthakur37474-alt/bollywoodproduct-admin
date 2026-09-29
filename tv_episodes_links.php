<?
session_start();
include "config.php";
if ($_SESSION['admin'] == "") {
   header("location:index.php");
}


if ($_POST["Submit"]) { 
   $tv_series_id = $_POST['tv_series_id'];
   $tv_season_id = $_POST['tv_season_id'];
   $tv_episode_id = $_POST['tv_episode_id'];
   ;
   $ott_type = $_POST['ott_type'];
   ;
   $ott_platform_id = $_POST['ott_platform_id'];
   ;
   $music_label_id = $_POST['music_label_id'];
   ;
   $video_url = $_POST['video_url'];
   ;
   $upload_date = $_POST['upload_date'];
   ;




   mysqli_query($con, "INSERT INTO `tv_episode_links` (  tv_series_id, tv_season_id, tv_episode_id, ott_type, ott_platform_id,music_label_id, video_url, upload_date ) VALUES (  '$tv_series_id', '$tv_season_id', '$tv_episode_id', '$ott_type', '$ott_platform_id','$music_label_id','$video_url','$upload_date'     )") or die(mysqli_error($con));

   header('location:tv_episodes_links.php?msg=success');
}



if ($_POST["Update"]) {




   $id = $_POST['id']; 
   $tv_episode_id = $_POST['tv_episode_id'];
   ;
   $ott_type = $_POST['ott_type'];
   ;
   $ott_platform_id = $_POST['ott_platform_id'];
   ;
   $music_label_id = $_POST['music_label_id'];
   ;
   $video_url = $_POST['video_url'];
   ;
   $upload_date = $_POST['upload_date'];
   ;

   mysqli_query($con, "update tv_episode_links set  tv_episode_id='$tv_episode_id',ott_type='$ott_type',ott_platform_id='$ott_platform_id',music_label_id='$music_label_id',video_url='$video_url',upload_date='$upload_date'     where id='$id'") or die(mysqli_error($con));
   header('location:tv_episodes_links.php?msg=success');
}

if ($_REQUEST['remove'] == "yes") {
   mysqli_query($con, "delete from tv_episode_links where id='$_REQUEST[id]'");

   header("location:tv_episodes_links.php?msg=Deleted Successfully");
}



?><!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>TV Episodes Links Management</title>
   <!-- Favicon and touch icons -->
   <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
   <!-- Start Global Mandatory Style
         =====================================================================-->
   <!-- jquery-ui css -->
   <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css" />
   <!-- Bootstrap -->
   <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <!-- Bootstrap rtl -->
   <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
   <!-- Lobipanel css -->
   <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css" />
   <!-- Pace css -->
   <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css" />
   <!-- Font Awesome -->
   <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <!-- Pe-icon -->
   <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css" />
   <!-- Themify icons -->
   <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css" />
   <!-- dataTables css -->
   <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css" />
   <!-- End Global Mandatory Style
         =====================================================================-->
   <!-- Start Theme Layout Style
         =====================================================================-->
   <!-- Theme style -->
   <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css" />
   <!-- Theme style rtl -->
   <!--<link href="assets/dist/css/stylecrm-rtl.css" rel="stylesheet" type="text/css"/>-->
   <!-- End Theme Layout Style
         =====================================================================-->


   <script src="https://cdn.tiny.cloud/1/qyhq7trksx7i1gpmasi3h8szpuzmiuj9c3epa0k2hjpuszlk/tinymce/6/tinymce.min.js"
      referrerpolicy="origin"></script>

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
               <h1>TV Episodes Links</h1>
               <?php include "tv_topbarbuttons.php"; ?>
            </div>
         </section>
         <!-- Main content -->
         <section class="content">








            <? if ($_GET['Action'] == "Add") { ?>


               <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Add TV Episodes Links</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action="" enctype="multipart/form-data">

                           <div class="form-group">
                                 <label>Series : <?php $series_id=$_GET['series_id'];
                                 $sqlss=mysqli_query($con,"select * from tv_series where id='$series_id'");
                                 $rowss=mysqli_fetch_array($sqlss);
                                 echo $rowss['name']; ?></label><br> 
                                 <label>Season : <?php $season_id=$_GET['season_id']; 
                                 $sqlss=mysqli_query($con,"select * from tv_seasons where id='$season_id'");
                                 $rowss=mysqli_fetch_array($sqlss);  
                                 echo $rowss["name"];  
                                 ?>
                              </label><br>
<input type="hidden" name="tv_series_id" value="<?php echo $series_id; ?>">
<input type="hidden" name="tv_season_id" value="<?php echo $season_id; ?>">
                              </div>

                              <div class="form-group
</div>

                              <div class="form-group">
                                 <label>Episode </label>

                                 <select name="tv_episode_id" id="tv_episode_id" class="form-control select2"
                                    style="width:100%;">
   <option value=""></option>

                                    <? $sqlfr = mysqli_query($con, "select * from tv_episodes order by name");
                                    while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>

                                       <option value="<? echo $rowfr['id']; ?>" <?php if(isset($_GET['episode_id'])){
if($_GET['episode_id']==$rowfr['id']){echo "selected"; }
} ?>><? echo $rowfr['name']; ?> : Episode No: <? echo $rowfr['episode_no']; ?></option>
                                    <? } ?>
                                 </select>
                              </div>



                              <div class="form-group">
                                 <label>OTT Type </label>

                                 <select name="ott_type" id="ott_type" class="form-control select2" style="width:100%;">
                                 <option value=""></option>

                                    <option value="OTT">OTT</option>
                                    <option value="Youtube">Youtube</option>

                                 </select>
                              </div>


                              <div class="form-group">
                                 <label>Ott Platform </label>

                                 <select name="ott_platform_id" id="ott_platform_id" class="form-control select2"
                                    style="width:100%;">
   <option value=""></option>

                                    <? $sqlfr = mysqli_query($con, "select * from ott_platform order by name");
                                    while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>

                                       <option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['name']; ?></option>
                                    <? } ?>
                                 </select>
                              </div>



                              <div class="form-group">
                                 <label>Music Label (Youtube Channel)</label>

                                 <select name="music_label_id" id="music_label_id" class="form-control select2"
                                    style="width:100%;">
   <option value=""></option>

                                    <? $sqlfr = mysqli_query($con, "select * from music_label order by music_label");
                                    while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>

                                       <option value="<? echo $rowfr['id']; ?>"><? echo $rowfr['music_label']; ?></option>
                                    <? } ?>
                                 </select>
                              </div>



                              <div class="form-group">
                                 <label>Video URL</label>
                                 <input type="text" name="video_url" class="form-control" placeholder="Add Video URL"
                                    value="<? echo $row['video_url']; ?>">
                              </div>

                              <div class="form-group">
                                 <label>Upload Date</label>
                                 <input type="date" name="upload_date" class="form-control" placeholder="Add Upload Date"
                                    value="<? echo $row['upload_date']; ?>">
                              </div>



                              <div class="reset-button">

                                 <input type="submit" name="Submit" class="btn btn-add" value="Add Record">

                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>

            <? } ?>











            <? if ($_GET['Action'] == "Update") {
               $id2 = $_GET['id'];
               $sql = "select * from tv_episode_links where id='$id2'";
               $rs = mysqli_query($con, $sql);
               $row = mysqli_fetch_array($rs);
               ?>


               <div class="row">
                  <!-- Form controls -->
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Update TV Episodes Links</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action="" enctype="multipart/form-data">

 
                              <div class="form-group">
                                 <label>TV Episode</label>

                                 <select name="tv_episode_id" id="tv_episode_id" class="form-control select2"
                                    style="width:100%;">
   <option value=""></option>

                                    <? $sqlfr = mysqli_query($con, "select * from tv_episodes order by name");
                                    while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>

                                       <option value="<? echo $rowfr['id']; ?>" <?php if ($rowfr['id'] == $row['tv_episode_id']) {
                                             echo "selected";
                                          } ?>>
                                          <? echo $rowfr['name']; ?></option>
                                    <? } ?>
                                 </select>
                              </div>

                              
                              <div class="form-group">
                                 <label>OTT Type </label>

                                 <select name="ott_type" id="ott_type" class="form-control select2" style="width:100%;">
                                 <option value=""></option>

                                    <option value="OTT" <?php if($row['ott_type']=="OTT"){echo "selected"; }?>>OTT</option>
                                    <option value="Youtube" <?php if($row['ott_type']=="Youtube"){echo "selected"; }?>>Youtube</option>

                                 </select>
                              </div>



                              <div class="form-group">
                                 <label>OTT Platform</label>

                                 <select name="ott_platform_id" id="ott_platform_id" class="form-control select2"
                                    style="width:100%;">
   <option value=""></option>

                                    <? $sqlfr = mysqli_query($con, "select * from ott_platform order by name");
                                    while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>

                                       <option value="<? echo $rowfr['id']; ?>" <?php if ($rowfr['id'] == $row['ott_platform_id']) {
                                             echo "selected";
                                          } ?>>
                                          <? echo $rowfr['name']; ?></option>
                                    <? } ?>
                                 </select>
                              </div>


                              <div class="form-group">
                                 <label>Music Label (Youtube Channel)</label>

                                 <select name="music_label_id" id="music_label_id" class="form-control select2"
                                    style="width:100%;">
   <option value=""></option>

                                    <? $sqlfr = mysqli_query($con, "select * from music_label order by music_label");
                                    while ($rowfr = mysqli_fetch_array($sqlfr)) { ?>

                                       <option value="<? echo $rowfr['id']; ?>" <?php if ($rowfr['id'] == $row['music_label_id']) {
                                             echo "selected";
                                          } ?>>
                                          <? echo $rowfr['music_label']; ?></option>
                                    <? } ?>
                                 </select>
                              </div>


                              <div class="form-group">
                                 <label>Video URL</label>
                                 <input type="text" name="video_url" class="form-control" placeholder="Add Video URL"
                                    value="<? echo $row['video_url']; ?>">
                              </div>

                              <div class="form-group">
                                 <label>Upload Date</label>
                                 <input type="date" name="upload_date" class="form-control" placeholder="Add Upload Date"
                                    value="<? echo $row['upload_date']; ?>">
                              </div>


                              <input type="hidden" name="id" value="<? echo $row['id']; ?>">

                              <div class="reset-button">

                                 <input type="submit" name="Update" class="btn btn-add" value="Update">

                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>

            <? } ?>
















            <? if ($_GET['Action'] == "") { ?>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>TV Episodes Links List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist">
                                 <!-- <a class="btn btn-add" href="tv_episodes_links.php?Action=Add"> <i class="fa fa-plus"></i>
                                    Add TV Episodes Links
                                 </a> -->
                              </div>

                           </div>



                           <script type="text/javascript" src="jquery-1.8.0.min.js"></script>
                           <script type="text/javascript">
                              $(function () {
                                 $(".search").keyup(function () {
                                    var searchid = $(this).val();
                                    var dataString = 'search=' + searchid;
                                    if (searchid != '') {
                                       $.ajax({
                                          type: "POST",
                                          url: "search_tv_episodes_links.php",
                                          data: dataString,
                                          cache: false,
                                          success: function (html) {
                                             $("#result").html(html).show();
                                          }
                                       });
                                    } return false;
                                 });

                                 jQuery("#result").live("click", function (e) {
                                    var $clicked = $(e.target);
                                    var $name = $clicked.find('.name').html();
                                    var decoded = $("<div/>").html($name).text();
                                    $('#searchid').val(decoded);
                                 });
                                 jQuery(document).live("click", function (e) {
                                    var $clicked = $(e.target);
                                    if (!$clicked.hasClass("search")) {
                                       jQuery("#result").fadeOut();
                                    }
                                 });
                                 $('#searchid').click(function () {
                                    jQuery("#result").fadeIn();
                                 });
                              });
                           </script>
                           <!-- 
<input type="text" class="search form-control" id="searchid" placeholder="Search for tv_episodes_links Film" style="width: 100%" />  
<div id="result"></div>
  -->



                           <select class="form-control select2"
                              onChange="window.document.location.href=this.options[this.selectedIndex].value;">
                              <option value="">Search TV Episodes Links</option>
                              <?php $sqlfs = mysqli_query($con, "select * from tv_episodes_links");
                              while ($rowfs = mysqli_fetch_array($sqlfs)) {
                                 ?>

                                 <option value="tv_episodes_links.php?Action=Update&id=<?php echo $rowfs['id']; ?>">
                                    <?php echo $rowfs['year']; ?> - <?php echo $rowfs['broadcast_date1']; ?> </option>
                              <?php } ?>

                           </select><br><br>

                           <br />
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                        <th>Episode</th>
                                       <th>Ott Type</th>
                                       <th>Platform</th>
                                       <th>Youtube Channel</th>
                                       <th>Video URL</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>

                                    <?




                                    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                                       $page_no = $_GET['page_no'];
                                    } else {
                                       $page_no = 1;
                                    }

                                    $total_records_per_page = 10;
                                    $offset = ($page_no - 1) * $total_records_per_page;
                                    $previous_page = $page_no - 1;
                                    $next_page = $page_no + 1;
                                    $adjacents = "2";

                                    $result_count = mysqli_query($con, "SELECT COUNT(*) As total_records FROM `tv_episode_links`");
                                    $total_records = mysqli_fetch_array($result_count);
                                    $total_records = $total_records['total_records'];
                                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                                    $second_last = $total_no_of_pages - 1; // total page minus 1
                                 
                                    $result = mysqli_query($con, "SELECT * FROM `tv_episode_links` order by id desc LIMIT $offset, $total_records_per_page");

                                    while ($row = mysqli_fetch_array($result)) { ?>
                                       <tr>

                                       
                                          <td>
                                             
      <?php   
      $series_row = getRowById($con, "tv_series", $row['tv_series_id']);
      $season_row = getRowById($con, "tv_seasons", $row['tv_season_id']);
      echo $series_row['name']." - Season: ".$season_row['season_no'];     ?>                                  
                                             <? $tv_episode_id = $row['tv_episode_id'];
                                          $sqlts = mysqli_query($con, "select * from tv_episodes where id='$tv_episode_id'");
                                          $rowts = mysqli_fetch_array($sqlts); ?>
                                          Episode: <?php echo $rowts['episode_no']; ?> <?php echo $rowts['name']; ?></td>

                                          <td><? echo $row['ott_type']; ?></td>
                                          <td><? $ott_platform_id = $row['ott_platform_id'];
                                          $sqlts = mysqli_query($con, "select * from ott_platform where id='$ott_platform_id'");
                                          $rowts = mysqli_fetch_array($sqlts);
                                          echo $rowts['name']; ?></td>


                                          <td><? $music_label_id = $row['music_label_id'];
                                          $sqlts = mysqli_query($con, "select * from music_label where id='$music_label_id'");
                                          $rowts = mysqli_fetch_array($sqlts);
                                          echo $rowts['music_label']; ?></td>
                                          <td>
                                       <?php 
                                       if($row['ott_type']=="Youtube"){
                                          $video_url="https://www.youtube.com/watch?v=".$row['video_url'];
                                       } else {
                                          $video_url= $row['video_url'];
                                       }
                                       ?>

                                             <a href="<? echo $video_url; ?>" target="_blank">Watch</a>
                                          </td>

                                          <td>



                                             <a href="tv_episodes_links.php?Action=Update&id=<? echo $row['id']; ?>"
                                                class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                             <a href="javascript:resume_id('<? echo $row['id'] ?>')"
                                                class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> </a>
                                          </td>
                                       </tr>

                                    <? } ?>

                                 </tbody>
                              </table>



                              <div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
                                 <strong>Page <?php echo $page_no . " of " . $total_no_of_pages; ?></strong>
                              </div>

                              <ul class="pagination">
                                 <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>

                                 <li <?php if ($page_no <= 1) {
                                    echo "class='disabled'";
                                 } ?>>
                                    <a <?php if ($page_no > 1) {
                                       echo "href='?page_no=$previous_page'";
                                    } ?>>Previous</a>
                                 </li>

                                 <?php
                                 if ($total_no_of_pages <= 10) {
                                    for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                       if ($counter == $page_no) {
                                          echo "<li class='active'><a>$counter</a></li>";
                                       } else {
                                          echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                       }
                                    }
                                 } elseif ($total_no_of_pages > 10) {

                                    if ($page_no <= 4) {
                                       for ($counter = 1; $counter < 8; $counter++) {
                                          if ($counter == $page_no) {
                                             echo "<li class='active'><a>$counter</a></li>";
                                          } else {
                                             echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                          }
                                       }
                                       echo "<li><a>...</a></li>";
                                       echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                       echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                    } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                                       echo "<li><a href='?page_no=1'>1</a></li>";
                                       echo "<li><a href='?page_no=2'>2</a></li>";
                                       echo "<li><a>...</a></li>";
                                       for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                                          if ($counter == $page_no) {
                                             echo "<li class='active'><a>$counter</a></li>";
                                          } else {
                                             echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                          }
                                       }
                                       echo "<li><a>...</a></li>";
                                       echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                       echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                    } else {
                                       echo "<li><a href='?page_no=1'>1</a></li>";
                                       echo "<li><a href='?page_no=2'>2</a></li>";
                                       echo "<li><a>...</a></li>";

                                       for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                          if ($counter == $page_no) {
                                             echo "<li class='active'><a>$counter</a></li>";
                                          } else {
                                             echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                          }
                                       }
                                    }
                                 }
                                 ?>

                                 <li <?php if ($page_no >= $total_no_of_pages) {
                                    echo "class='disabled'";
                                 } ?>>
                                    <a <?php if ($page_no < $total_no_of_pages) {
                                       echo "href='?page_no=$next_page'";
                                    } ?>>Next</a>
                                 </li>
                                 <?php if ($page_no < $total_no_of_pages) {
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
   <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
   <script src="assets/plugins/jQuery/jquery-1.12.4.min.js" type="text/javascript"></script>
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


   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css"
      integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />



   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js"
      integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>


<script type="text/javascript">
   function resume_id(res_id) {

      var agree = confirm("This will record.  Are you sure you wish to continue?");
      if (agree) {
         window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?remove=yes&id=' + res_id;
         window.submit();
      }
      else {

      }
   }




   $(document).ready(function () {
      $('.select2').select2();
   });
</script>