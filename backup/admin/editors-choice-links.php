<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
 

      
if($_POST["Submit"]) { 
   $editors_choice_category_id = $_POST['editors_choice_category_id'];
   $title      = $_POST['title'];
   $url        = $_POST['url'];
   $start_date = !empty($_POST['start_date']) ? $_POST['start_date'] : null;
   $end_date   = !empty($_POST['end_date']) ? $_POST['end_date'] : null;
   
   $photo = '';
   if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
       $target_dir = "../uploads/";
   
       // Get file extension
       $file_ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
   
       // Create a unique filename
       $photo = 'editors_choice_link_' . time() . '_' . uniqid() . '.' . $file_ext;
   
       $target_file = $target_dir . $photo;
   
       // Move uploaded file
       move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
   }
   
   // Insert into editors_choice_links table
   $sql = "INSERT INTO `editors_choice_links` 
           (editors_choice_category_id, title, photo, url, start_date, end_date) 
           VALUES (
               '$editors_choice_category_id',
               '$title',
               '$photo',
               '$url',
               " . ($start_date ? "'$start_date'" : "NULL") . ",
               " . ($end_date ? "'$end_date'" : "NULL") . "
           )";
          
   
   mysqli_query($con, $sql) or die(mysqli_error($con));
            header('location:editors-choice-links.php?msg=success');
         }



           if($_POST["Update"]) {


            $id                          = $_POST['id'];
            $editors_choice_category_id  = $_POST['editors_choice_category_id'];
            $title                       = $_POST['title'];
            $url                         = $_POST['url'];
            $start_date                  = !empty($_POST['start_date']) ? $_POST['start_date'] : null;
            $end_date                    = !empty($_POST['end_date']) ? $_POST['end_date'] : null;
            
            $old_photo = $_POST['old_photo'];
            $photo     = $old_photo;
            
            // Handle file upload if a new file is chosen
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                $target_dir = "../uploads/";
            
                // Get file extension
                $file_ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
            
                // Generate a unique file name
                $photo = 'editors_choice_link_' . time() . '_' . uniqid() . '.' . $file_ext;
            
                $target_file = $target_dir . $photo;
            
                // Upload new photo
                move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
            
                // Optionally delete old photo
                if (!empty($old_photo) && file_exists("../uploads/" . $old_photo)) {
                    unlink("../uploads/" . $old_photo);
                }
            }
            
            // Update database
            $sql = "UPDATE `editors_choice_links` 
                    SET 
                        editors_choice_category_id = '$editors_choice_category_id',
                        title = '$title',
                        photo = '$photo',
                        url = '$url',
                        start_date = " . ($start_date ? "'$start_date'" : "NULL") . ",
                        end_date = " . ($end_date ? "'$end_date'" : "NULL") . "
                    WHERE id = '$id'";
            
            mysqli_query($con, $sql) or die(mysqli_error($con));
             header('location:editors-choice-links.php?msg=success');
         }
  

   if($_REQUEST['remove']=="yes"){  
      $id = intval($_GET['id']); // Safely cast to integer

      // Fetch photo filename
      $result = mysqli_query($con, "SELECT photo FROM editors_choice_links WHERE id='$id'") 
                or die(mysqli_error($con));
      $row = mysqli_fetch_assoc($result);
      
      // Delete photo from server if it exists
      if (!empty($row['photo']) && file_exists("../uploads/" . $row['photo'])) {
          unlink("../uploads/" . $row['photo']);
      }
      
      // Delete record from database
      mysqli_query($con, "DELETE FROM editors_choice_links WHERE id='$id'") 
          or die(mysqli_error($con));  

header("location:editors-choice-links.php?msg=Deleted Successfully");
}     
      




if($_GET['remove_photo']=="yes"){  
      
   $id = intval($_GET['id']); // Safely cast to integer

// Fetch photo filename
$result = mysqli_query($con, "SELECT photo FROM editors_choice_links WHERE id='$id'") 
          or die(mysqli_error($con));
$row = mysqli_fetch_assoc($result);

// Delete file from server if it exists
if (!empty($row['photo']) && file_exists("../uploads/" . $row['photo'])) {
    unlink("../uploads/" . $row['photo']);
}

// Update record to remove photo reference
mysqli_query($con, "UPDATE editors_choice_links SET photo='' WHERE id='$id'") 
    or die(mysqli_error($con));
header("location:editors-choice-links.php?msg=Deleted Successfully");
   }

 


?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Editors Choice Links Management</title>
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
                  <h1>Editors Choice Links</h1> 
                  <a href="editors-choice-categories.php" class="btn btn-success">Categories</a>
                  <a href="editors-choice-links.php" class="btn btn-warning">Links</a>
                   
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
                                 <h4>Add Editors Choice Links</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action="" enctype="multipart/form-data">
                           <div class="form-group">
    <label>Category</label>
    <select name="editors_choice_category_id" class="form-control" required>
        <option value="">-- Select Category --</option>
        <?php
        $cat_q = mysqli_query($con, "SELECT id, title FROM editors_choice_category ORDER BY title ASC") 
                 or die(mysqli_error($con));
        while ($cat = mysqli_fetch_assoc($cat_q)) {
            // If you are editing a record and want to preselect
            $selected = (isset($row['editors_choice_category_id']) && $row['editors_choice_category_id'] == $cat['id']) ? 'selected' : '';
            echo '<option value="' . $cat['id'] . '" ' . $selected . '>' . htmlspecialchars($cat['title']) . '</option>';
        }
        ?>
    </select>
</div>
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control" placeholder="Add title" value="<?php echo isset($row['title']) ? $row['title'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>URL</label>
        <input type="text" name="url" class="form-control" placeholder="Add URL" value="<?php echo isset($row['url']) ? $row['url'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>Start</label>
        <input type="datetime-local" name="start_date" class="form-control" placeholder="Add Start" value="<?php echo isset($row['start_date']) ? $row['start_date'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>End</label>
        <input type="datetime-local" name="end_date" class="form-control" placeholder="Add End" value="<?php echo isset($row['end_date']) ? $row['end_date'] : ''; ?>">
    </div>

    <div class="form-group">
        <label>Upload Photo</label>
        <input type="file" name="photo" class="form-control">
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











<? if($_GET['Action']=="Update"){  $id2=$_GET['id'];
$sql="select * from editors_choice_links where id='$id2'";
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
                                 <h4>Update Editors Choice Links</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <form class="col-sm-12" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group">
    <label>Category</label>
    <select name="editors_choice_category_id" class="form-control" required>
        <option value="">-- Select Category --</option>
        <?php
        $cat_q = mysqli_query($con, "SELECT id, title FROM editors_choice_category ORDER BY title ASC") 
                 or die(mysqli_error($con));
        while ($cat = mysqli_fetch_assoc($cat_q)) {
            // If you are editing a record and want to preselect
            $selected = (isset($row['editors_choice_category_id']) && $row['editors_choice_category_id'] == $cat['id']) ? 'selected' : '';
            echo '<option value="' . $cat['id'] . '" ' . $selected . '>' . htmlspecialchars($cat['title']) . '</option>';
        }
        ?>
    </select>
</div>
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control" placeholder="Add title" value="<?php echo isset($row['title']) ? $row['title'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>URL</label>
        <input type="text" name="url" class="form-control" placeholder="Add URL" value="<?php echo isset($row['url']) ? $row['url'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>Start</label>
        <input type="datetime-local" name="start_date" class="form-control" placeholder="Add Start" value="<?php echo isset($row['start_date']) ? $row['start_date'] : ''; ?>">
    </div>
    <div class="form-group">
        <label>End</label>
        <input type="datetime-local" name="end_date" class="form-control" placeholder="Add End" value="<?php echo isset($row['end_date']) ? $row['end_date'] : ''; ?>">
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
        <label>Details</label>
        <textarea name="details" class="form-control"><?php echo $row['details']; ?></textarea>
    </div>

    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

    <div class="reset-button">
        <input type="submit" name="Update" class="btn btn-add" value="Update">
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
                                 <h4>Editors Choice Links List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="editors-choice-links.php?Action=Add"> <i class="fa fa-plus"></i> Add Editors Choice Links
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
    url: "search_editors-choice-links.php",
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
<input type="text" class="search form-control" id="searchid" placeholder="Search for tv_channel Film" style="width: 100%" />  
<div id="result"></div>
  -->



 <select class="form-control select2"   onChange="window.document.location.href=this.options[this.selectedIndex].value;">
<option value="">Search Editors Choice Links</option>
<?php $sqlfs=mysqli_query($con, "select * from tv_channels");
while($rowfs=mysqli_fetch_array($sqlfs)){  
 ?>

<option value="editors-choice-links.php?Action=Update&id=<?php echo $rowfs['id']; ?>"><?php echo $rowfs['year']; ?> - <?php echo $rowfs['broadcast_date1']; ?>   </option>
<?php } ?>

 </select><br><br>
                           
                           <br/>
                           <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>Name</th>   
                                       <th>Category</th>   
                                       <th>URL</th>   
                                       <th>Date</th>   
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `editors_choice_links`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `editors_choice_links` order by id desc LIMIT $offset, $total_records_per_page");
 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                    <td><? echo $row['title']; ?></td>  
                                    <?php
$cat_id = $row['editors_choice_category_id'];
$cat_q = mysqli_query($con, "SELECT title FROM editors_choice_category WHERE id='$cat_id'") 
         or die(mysqli_error($con));
$cat   = mysqli_fetch_assoc($cat_q);
?>
<td><?php echo htmlspecialchars($cat['title']); ?></td>
                                    <td><? echo $row['url']; ?></td>  
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
                                          
                                    <td><? echo $row['start_date']; ?> <br>
                                    <? echo $row['end_date']; ?></td>  
                                        <td>


                                  
                                          <a href="editors-choice-links.php?Action=Update&id=<? echo $row['id'];    ?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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

var agree=confirm("This will delete record.  Are you sure you wish to continue?");
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

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('input[type="datetime-local"]').forEach(function(input) {
        if (!input.value) {
            let today = new Date();
            let yyyy = today.getFullYear();
            let mm = String(today.getMonth() + 1).padStart(2, '0');
            let dd = String(today.getDate()).padStart(2, '0');
            input.value = `${yyyy}-${mm}-${dd}T00:00`;
        }
    });
});
</script>