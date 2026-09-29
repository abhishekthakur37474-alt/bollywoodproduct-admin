<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
 

if($_POST["Submit"]) {  
   
   $season_id = (int) $_POST['season_id'];


$check = mysqli_query($con, "SELECT id FROM tv_season_realityshow WHERE season_id = $season_id");
if (mysqli_num_rows($check) > 0) {
            header('location:tv_season_realityshow.php?msg=Already Exists');
            exit();

}


 
    $winner_cast_ids    = isset($_POST['winner_cast_ids'])    ? implode(',', array_map('intval', $_POST['winner_cast_ids']))    : '';
    $runnerup1_cast_ids = isset($_POST['runnerup1_cast_ids']) ? implode(',', array_map('intval', $_POST['runnerup1_cast_ids'])) : '';
    $runnerup2_cast_ids = isset($_POST['runnerup2_cast_ids']) ? implode(',', array_map('intval', $_POST['runnerup2_cast_ids'])) : '';
    $runnerup3_cast_ids = isset($_POST['runnerup3_cast_ids']) ? implode(',', array_map('intval', $_POST['runnerup3_cast_ids'])) : '';
    $runnerup4_cast_ids = isset($_POST['runnerup4_cast_ids']) ? implode(',', array_map('intval', $_POST['runnerup4_cast_ids'])) : '';
    $runnerup5_cast_ids = isset($_POST['runnerup5_cast_ids']) ? implode(',', array_map('intval', $_POST['runnerup5_cast_ids'])) : '';

    $query = mysqli_query($con, "INSERT INTO `tv_season_realityshow` 
        ( `season_id`,   `winner_cast_ids`, `runnerup1_cast_ids`, `runnerup2_cast_ids`, `runnerup3_cast_ids`, `runnerup4_cast_ids`, `runnerup5_cast_ids`) 
        VALUES 
        (  $season_id,   '$winner_cast_ids', '$runnerup1_cast_ids', '$runnerup2_cast_ids', '$runnerup3_cast_ids', '$runnerup4_cast_ids', '$runnerup5_cast_ids')");

            header('location:tv_season_realityshow.php?msg=success');
         }



           if($_POST["Update"]) {




    $id= $_POST['id']; 

$season_id = (int) $_POST['season_id'];
$realityshow_id = (int) $_POST['id']; // ID of the row to update

$winner_cast_ids    = isset($_POST['winner_cast_ids'])    ? implode(',', array_map('intval', $_POST['winner_cast_ids']))    : '';
$runnerup1_cast_ids = isset($_POST['runnerup1_cast_ids']) ? implode(',', array_map('intval', $_POST['runnerup1_cast_ids'])) : '';
$runnerup2_cast_ids = isset($_POST['runnerup2_cast_ids']) ? implode(',', array_map('intval', $_POST['runnerup2_cast_ids'])) : '';
$runnerup3_cast_ids = isset($_POST['runnerup3_cast_ids']) ? implode(',', array_map('intval', $_POST['runnerup3_cast_ids'])) : '';
$runnerup4_cast_ids = isset($_POST['runnerup4_cast_ids']) ? implode(',', array_map('intval', $_POST['runnerup4_cast_ids'])) : '';
$runnerup5_cast_ids = isset($_POST['runnerup5_cast_ids']) ? implode(',', array_map('intval', $_POST['runnerup5_cast_ids'])) : '';

$query = mysqli_query($con, "UPDATE `tv_season_realityshow` SET
    `season_id` = $season_id,
    `winner_cast_ids` = '$winner_cast_ids',
    `runnerup1_cast_ids` = '$runnerup1_cast_ids',
    `runnerup2_cast_ids` = '$runnerup2_cast_ids',
    `runnerup3_cast_ids` = '$runnerup3_cast_ids',
    `runnerup4_cast_ids` = '$runnerup4_cast_ids',
    `runnerup5_cast_ids` = '$runnerup5_cast_ids'
    WHERE id = $realityshow_id
") or die(mysqli_error($con));
             header('location:tv_season_realityshow.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){  
mysqli_query($con, "delete from tv_season_realityshow where id='$_REQUEST[id]'");

header("location:tv_season_realityshow.php?msg=Deleted Successfully");
}     
         


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>TV Realityshow Management</title>
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
                  <h1>TV Realityshow</h1> 
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
                                 <h4>Add TV Realityshow</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
<?php 
$rowseason=getRowById($con, "tv_seasons", $_GET['season_id']);
$rowseries=getRowById($con, "tv_series", $rowseason['tv_series_id']);

?>
 <?php echo $rowseries['name']; ?> -> Season <?php echo $rowseason['season_no']; ?>

                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <input type="hidden" name="season_id" value="<?php echo $_GET['season_id']; ?>" >
                             <div class="form-group">
                                 <label>Winner Cast</label>
          <label>Winner Cast</label>
<select name="winner_cast_ids[]" id="winner_cast_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
    <?php 
    $winner_ids = explode(",", $row["winner_cast_ids"]);
    if (!empty($winner_ids)) {
        $clean_ids = array_map('intval', $winner_ids);
        $id_str = implode(",", $clean_ids); 
        $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($id_str)");
        while ($sel = mysqli_fetch_assoc($res)) {
            echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
        }
    }
    ?>
</select>

                              </div>
     
  <div class="form-group">
                                 <label>Runnerup 1 Cast</label>
            
<select name="runnerup1_cast_ids[]" id="runnerup1_cast_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
    <?php 
    $ids = explode(",", $row["runnerup1_cast_ids"]);
    if (!empty($ids)) {
        $clean_ids = array_map('intval', $ids);
        $id_str = implode(",", $clean_ids); 
        $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($id_str)");
        while ($sel = mysqli_fetch_assoc($res)) {
            echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
        }
    }
    ?>
</select>

                              </div>
     
  <div class="form-group">
                                 <label>Runnerup 2 Cast</label>
         
<select name="runnerup2_cast_ids[]" id="runnerup2_cast_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
    <?php 
    $ids = explode(",", $row["runnerup2_cast_ids"]);
    if (!empty($ids)) {
        $clean_ids = array_map('intval', $ids);
        $id_str = implode(",", $clean_ids); 
        $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($id_str)");
        while ($sel = mysqli_fetch_assoc($res)) {
            echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
        }
    }
    ?>
</select>


                              </div>
     
  <div class="form-group">
                                 <label>Runnerup 3 Cast</label>
     
<select name="runnerup3_cast_ids[]" id="runnerup3_cast_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
    <?php 
    $ids = explode(",", $row["runnerup3_cast_ids"]);
    if (!empty($ids)) {
        $clean_ids = array_map('intval', $ids);
        $id_str = implode(",", $clean_ids); 
        $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($id_str)");
        while ($sel = mysqli_fetch_assoc($res)) {
            echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
        }
    }
    ?>
</select>

                              </div>
     
  <div class="form-group">
                                 <label>Runnerup 4 Cast</label>
               
<select name="runnerup4_cast_ids[]" id="runnerup4_cast_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
    <?php 
    $ids = explode(",", $row["runnerup4_cast_ids"]);
    if (!empty($ids)) {
        $clean_ids = array_map('intval', $ids);
        $id_str = implode(",", $clean_ids); 
        $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($id_str)");
        while ($sel = mysqli_fetch_assoc($res)) {
            echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
        }
    }
    ?>
</select>


                              </div>
     
  <div class="form-group">
                                 <label>Runnerup 5 Cast</label>
         
<select name="runnerup5_cast_ids[]" id="runnerup5_cast_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
    <?php 
    $ids = explode(",", $row["runnerup5_cast_ids"]);
    if (!empty($ids)) {
        $clean_ids = array_map('intval', $ids);
        $id_str = implode(",", $clean_ids); 
        $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($id_str)");
        while ($sel = mysqli_fetch_assoc($res)) {
            echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
        }
    }
    ?>
</select>

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
$sql="select * from tv_season_realityshow where id='$id2'";
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
                                 <h4>Update TV Realityshow</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <input type="hidden" name="season_id" value="<?php echo $row['season_id']; ?>" >

                          <div class="form-group">
    <label>Winner Cast</label>
    <select name="winner_cast_ids[]" id="winner_cast_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
        <?php 
        $ids = explode(",", $row["winner_cast_ids"]);
        if (!empty($ids)) {
            $clean_ids = array_map('intval', $ids);
            $id_str = implode(",", $clean_ids); 
            $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($id_str)");
            while ($sel = mysqli_fetch_assoc($res)) {
                echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
            }
        }
        ?>
    </select>
</div>

<div class="form-group">
    <label>Runnerup 1 Cast</label>
    <select name="runnerup1_cast_ids[]" id="runnerup1_cast_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
        <?php 
        $ids = explode(",", $row["runnerup1_cast_ids"]);
        if (!empty($ids)) {
            $clean_ids = array_map('intval', $ids);
            $id_str = implode(",", $clean_ids); 
            $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($id_str)");
            while ($sel = mysqli_fetch_assoc($res)) {
                echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
            }
        }
        ?>
    </select>
</div>

<div class="form-group">
    <label>Runnerup 2 Cast</label>
    <select name="runnerup2_cast_ids[]" id="runnerup2_cast_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
        <?php 
        $ids = explode(",", $row["runnerup2_cast_ids"]);
        if (!empty($ids)) {
            $clean_ids = array_map('intval', $ids);
            $id_str = implode(",", $clean_ids); 
            $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($id_str)");
            while ($sel = mysqli_fetch_assoc($res)) {
                echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
            }
        }
        ?>
    </select>
</div>


<div class="form-group">
    <label>Runnerup 3 Cast</label>
    <select name="runnerup3_cast_ids[]" id="runnerup3_cast_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
        <?php 
        $ids = explode(",", $row["runnerup3_cast_ids"]);
        if (!empty($ids)) {
            $clean_ids = array_map('intval', $ids);
            $id_str = implode(",", $clean_ids); 
            $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($id_str)");
            while ($sel = mysqli_fetch_assoc($res)) {
                echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
            }
        }
        ?>
    </select>
</div>

<div class="form-group">
    <label>Runnerup 4 Cast</label>
    <select name="runnerup4_cast_ids[]" id="runnerup4_cast_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
        <?php 
        $ids = explode(",", $row["runnerup4_cast_ids"]);
        if (!empty($ids)) {
            $clean_ids = array_map('intval', $ids);
            $id_str = implode(",", $clean_ids); 
            $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($id_str)");
            while ($sel = mysqli_fetch_assoc($res)) {
                echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
            }
        }
        ?>
    </select>
</div>


<div class="form-group">
    <label>Runnerup 5 Cast</label>
    <select name="runnerup5_cast_ids[]" id="runnerup5_cast_ids" class="form-control select2-ajax" multiple="multiple" style="width:100%;">
        <?php 
        $ids = explode(",", $row["runnerup5_cast_ids"]);
        if (!empty($ids)) {
            $clean_ids = array_map('intval', $ids);
            $id_str = implode(",", $clean_ids); 
            $res = mysqli_query($con, "SELECT id, name FROM cast WHERE id IN ($id_str)");
            while ($sel = mysqli_fetch_assoc($res)) {
                echo '<option value="' . $sel['id'] . '" selected>' . htmlspecialchars($sel['name']) . '</option>';
            }
        }
        ?>
    </select>
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
                                 <h4>TV Realityshow List</h4>
                              </a>
                              <h5 style="color:#F00"><?php if(isset($_GET['msg'])){ echo $_GET['msg'];} ?></h5>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <!-- <a class="btn btn-add" href="tv_season_realityshow.php?Action=Add"> <i class="fa fa-plus"></i> Add TV Realityshow
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
    url: "search_tv_season_realityshow.php",
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
<input type="text" class="search form-control" id="searchid" placeholder="Search for tv_season_realityshow Film" style="width: 100%" />  
<div id="result"></div>
  -->



 <select class="form-control select2"   onChange="window.document.location.href=this.options[this.selectedIndex].value;">
<option value="">Search TV Realityshow</option>
<?php $sqlfs=mysqli_query($con, "select * from tv_season_realityshow");
while($rowfs=mysqli_fetch_array($sqlfs)){  
 ?>

<option value="tv_season_realityshow.php?Action=Update&id=<?php echo $rowfs['id']; ?>"><?php echo $rowfs['year']; ?> - <?php echo $rowfs['broadcast_date1']; ?>   </option>
<?php } ?>

 </select><br><br>
                           
                           <br/>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>Season</th>
                                       <th>Winner</th>
                                       <th>Runnerup 1</th>   
                                       <th>Runnerup 2</th>   
                                       <th>Runnerup 3</th>   
                                       <th>Runnerup 4</th>   
                                       <th>Runnerup 5</th>  
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `tv_season_realityshow`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `tv_season_realityshow` order by id desc LIMIT $offset, $total_records_per_page");
 
                                    while($row=mysqli_fetch_array($result)){ 
                                       $rowseason=getRowById($con, "tv_seasons", $row['season_id']);
                                       $rowseries=getRowById($con, "tv_series", $rowseason['tv_series_id']);
                                       
                                       
                                       
                                       ?>
                                    <tr>
                                           
                                       <td><?php echo $rowseries['name']; ?> -> Season <?php echo $rowseason['season_no']; ?></td>  
                                       <td><? $winner_ids = explode(",", $row['winner_cast_ids']);

foreach ($winner_ids as $id) {
    $id = (int)$id;
    $cast_row = getRowById($con, "cast", $id);
    if ($cast_row) {
        echo $cast_row['name'] . "<br>";
    }
} ?></td>  
                                       <td><? $runnerup1_ids = explode(",", $row['runnerup1_cast_ids']);

foreach ($runnerup1_ids as $id) {
    $id = (int)$id;
    $cast_row = getRowById($con, "cast", $id);
    if ($cast_row) {
        echo $cast_row['name'] . "<br>";
    }
}?></td>  
                                       <td><? $runnerup2_ids = explode(",", $row['runnerup2_cast_ids']);

foreach ($runnerup2_ids as $id) {
    $id = (int)$id;
    $cast_row = getRowById($con, "cast", $id);
    if ($cast_row) {
        echo $cast_row['name'] . "<br>";
    }
} ?></td>  
                                       <td><?$runnerup3_ids = explode(",", $row['runnerup3_cast_ids']);

foreach ($runnerup3_ids as $id) {
    $id = (int)$id;
    $cast_row = getRowById($con, "cast", $id);
    if ($cast_row) {
        echo $cast_row['name'] . "<br>";
    }
} ?></td>  
                                       <td><? $runnerup4_ids = explode(",", $row['runnerup4_cast_ids']);

foreach ($runnerup4_ids as $id) {
    $id = (int)$id;
    $cast_row = getRowById($con, "cast", $id);
    if ($cast_row) {
        echo $cast_row['name'] . "<br>";
    }
} ?></td>  
                                       <td><? $runnerup5_ids = explode(",", $row['runnerup5_cast_ids']);

foreach ($runnerup5_ids as $id) {
    $id = (int)$id;
    $cast_row = getRowById($con, "cast", $id);
    if ($cast_row) {
        echo $cast_row['name'] . "<br>";
    }
}?></td>  
                                         
                                        <td>


                                  
                                          <a href="tv_season_realityshow.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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

</script>