<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      } 


      function sanitize_ott($string, $force_lowercase = true, $anal = false) {
         $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
                       "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
                        "â€”", "â€“", ",", "<", ".", ">", "/", "?");
         $clean = trim(str_replace($strip, "", strip_tags($string)));
         $clean = preg_replace('/\s+/', "-", $clean);
         $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;
         return ($force_lowercase) ?
             (function_exists('mb_strtolower')) ?
                 mb_strtolower($clean, 'UTF-8') :
                 strtolower($clean) :
             $clean;
      }
      

if($_POST["Submit"]) { 
    $title= mysqli_real_escape_string($con,$_POST['title']) ;
  
    $details= mysqli_real_escape_string($con,$_POST['details']) ;  
 
$fname1=strtolower(str_replace(" ", "-", trim($title))); 

$alias=sanitize_ott($title);



    // ICON upload
    $iconResult = uploadFile('icon', $alias, 'image');
    if (isset($iconResult['error'])) {
        header("Location: ott_platform_list.php?msg=" . urlencode($iconResult['error']));
        exit;
    }
    $icon = isset($iconResult['filename']) ? $iconResult['filename'] : '';

    // PHOTO upload
    $photoResult = uploadFile('photo', $alias, 'image');
    if (isset($photoResult['error'])) {
        header("Location: ott_platform_list.php?msg=" . urlencode($photoResult['error']));
        exit;
    }
    $photo = isset($photoResult['filename']) ? $photoResult['filename'] : '';





mysqli_query($con,"INSERT INTO `ott_platform` (`name`,`alias`,`icon`,`photo`,`details`) VALUES ('$title' ,'$alias' ,'$icon','$photo','$details')") or die(mysqli_error($con));
  
            header('location:ott_platform_list.php?msg=success');
         }



           if($_POST["Update"]) {




    $id= $_POST['id'];
    $title= mysqli_real_escape_string($con,$_POST['title']) ;
  
    $details= mysqli_real_escape_string($con,$_POST['details']) ;  
 
 
$alias=sanitize_ott($title);



    $icon = $_POST['old_icon'];
    $photo = $_POST['old_photo'];

    // ICON upload (optional)
    $iconResult = uploadFile('icon', $alias, 'image');
    if (isset($iconResult['error'])) {
        header("Location: ott_platform_list.php?msg=" . urlencode($iconResult['error']));
        exit;
    } elseif (isset($iconResult['filename'])) {
        if (!empty($icon) && file_exists("../uploads/" . $icon)) {
            unlink("../uploads/" . $icon);
        }
        $icon = $iconResult['filename'];
    }

    // PHOTO upload (optional)
    $photoResult = uploadFile('photo', $alias, 'image');
    if (isset($photoResult['error'])) {
        header("Location: ott_platform_list.php?msg=" . urlencode($photoResult['error']));
        exit;
    } elseif (isset($photoResult['filename'])) {
        if (!empty($photo) && file_exists("../uploads/" . $photo)) {
            unlink("../uploads/" . $photo);
        }
        $photo = $photoResult['filename'];
    }




            mysqli_query($con,"update ott_platform set name='$title' ,alias='$alias' ,icon='$icon' ,photo='$photo' ,details='$details'   where id='$id'") or die(mysqli_error($con));
             header('location:ott_platform_list.php?msg=success');
         }
  
   if($_REQUEST['remove']=="yes"){
         
    $id = intval($_GET['id']); // Safely cast to integer

    // Fetch photo filename
    $result = mysqli_query($con, "SELECT icon FROM ott_platform WHERE id='$id'") or die(mysqli_error($con));
    $row = mysqli_fetch_assoc($result);

    if (!empty($row['photo']) && file_exists("../uploads/" . $row['photo'])) {
        unlink("../uploads/" . $row['photo']); // Delete file from server
    }


    mysqli_query($con, "DELETE FROM ott_platform WHERE id='$id'") or die(mysqli_error($con));  

header("location:ott_platform_list.php?msg=Deleted Successfully");
}     
         


if (isset($_GET['remove_file']) && $_GET['remove_file'] === "yes") {
    $id = intval($_GET['id']);
    $field = $_GET['field']; // 'icon' or 'photo'

    if (!in_array($field, ['icon', 'photo'])) {
        header("Location: ott_platform_list.php?msg=Invalid field type");
        exit;
    }

    $result = mysqli_query($con, "SELECT `$field` FROM ott_platform WHERE id='$id'") or die(mysqli_error($con));
    $row = mysqli_fetch_assoc($result);
    $filename = $row[$field];

    if (!empty($filename) && file_exists("../uploads/" . $filename)) {
        unlink("../uploads/" . $filename);
    }

    mysqli_query($con, "UPDATE ott_platform SET `$field`='' WHERE id='$id'") or die(mysqli_error($con));
    header("Location: ott_platform_list.php?msg=Deleted $field successfully");
    exit;
}

?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>OTT Platform Management</title>
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
                  <h1>OTT Platform Management</h1>
                  <small>OTT Platform List</small>
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
                                 <h4>Add OTT Platform</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <div class="form-group">
                                 <label>OTT Platform Name</label>
                                 <input type="text" class="form-control" name="title" placeholder="Enter title"  required>
                              </div>  

    <div class="form-group">
        <label>Upload Icon</label>
        <input type="file" name="icon" class="form-control" required>
    </div>
 

    <div class="form-group">
        <label>Upload Photo</label>
        <input type="file" name="photo" class="form-control" required>
    </div>


     <div class="form-group">
                                 <label>Details</label>
                                 <textarea name="details" rows="25"></textarea> 
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
$sql="select * from ott_platform where id='$id2'";
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
                                 <h4>Update OTT Platform</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <form class="col-sm-12" method="post" action=""   enctype="multipart/form-data"  >
                              <div class="form-group">
                                 <label>OTT Platform Name</label>
                                 <input type="text" name="title" class="form-control" placeholder="Update Title" value="<? echo $row['name'];?>"   >
                              </div>   
<div class="form-group">
    <label>Upload Icon</label>
    <input type="file" name="icon" class="form-control">
    <input type="hidden" name="old_icon" value="<?php echo htmlspecialchars($row['icon']); ?>">

    <?php if (!empty($row['icon'])) { ?>
        <a href="../uploads/<?php echo htmlspecialchars($row['icon']); ?>" data-lightbox="tv-gallery">
            <img src="../uploads/<?php echo htmlspecialchars($row['icon']); ?>" width="30" />
        </a>
        <a href="javascript:delete_file(<?php echo (int)$row['id']; ?>, 'icon')" class="btn btn-danger btn-sm">
            <i class="fa fa-trash-o"></i>
        </a>
    <?php } else { ?>
        <img src="https://www.bollywoodproduct.com/images/default.png" width="30">
    <?php } ?>
</div>


<div class="form-group">
    <label>Upload Photo</label>
    <input type="file" name="photo" class="form-control">
    <input type="hidden" name="old_photo" value="<?php echo htmlspecialchars($row['photo']); ?>">

    <?php if (!empty($row['photo'])) { ?>
        <a href="../uploads/<?php echo htmlspecialchars($row['photo']); ?>" data-lightbox="tv-gallery">
            <img src="../uploads/<?php echo htmlspecialchars($row['photo']); ?>" width="30" />
        </a>
        <a href="javascript:delete_file(<?php echo (int)$row['id']; ?>, 'photo')" class="btn btn-danger btn-sm">
            <i class="fa fa-trash-o"></i>
        </a>
    <?php } else { ?>
        <img src="https://www.bollywoodproduct.com/images/default.png" width="30">
    <?php } ?>
</div>

     <div class="form-group">
                                 <label>Details</label>
                                 <textarea name="details" rows="25"><? echo $row['details'];?></textarea> 
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
                                 <h4>OTT Platform List</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="ott_platform_list.php?Action=Add"> <i class="fa fa-plus"></i> Add OTT Platform
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
    url: "search_ottplatform.php",
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

<input type="text" class="search form-control" id="searchid" placeholder="Search for OTT Platform" style="width: 100%" />  
<div id="result"></div><br/>


<?php
$alertType = '';
$alertMsg = '';

if (isset($_GET['success']) && !empty($_GET['success'])) {
    $alertType = 'success'; // Green
    $alertMsg = htmlspecialchars($_GET['success']);
} elseif (isset($_GET['error']) && !empty($_GET['error'])) {
    $alertType = 'danger'; // Red
    $alertMsg = htmlspecialchars($_GET['error']);
} elseif (isset($_GET['msg']) && !empty($_GET['msg'])) {
    $alertType = 'info'; // Blue
    $alertMsg = htmlspecialchars($_GET['msg']);
}
?>

<?php if (!empty($alertMsg)): ?>
    <div class="alert alert-<?php echo $alertType; ?> alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php echo $alertMsg; ?>
    </div>
<?php endif; ?>
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info"> 
                                       <th>OTT Platform Name</th> 
                                       <th>OTT ICON</th> 
                                       <th>OTT PHOTO</th> 
                                       
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

  $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `ott_platform`");
  $total_records = mysqli_fetch_array($result_count);
  $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
  $second_last = $total_no_of_pages - 1; // total page minus 1

    $result = mysqli_query($con,"SELECT * FROM `ott_platform` order by id desc LIMIT $offset, $total_records_per_page");


 
                                    while($row=mysqli_fetch_array($result)){ ?>
                                    <tr>
                                           
                                       <td><? echo $row['name']; ?></td> 
                                     <td>
<?php if (!empty($row['icon'])) { ?>
    <a href="../uploads/<?php echo htmlspecialchars($row['icon']); ?>" data-lightbox="tv-gallery">
        <img src="../uploads/<?php echo htmlspecialchars($row['icon']); ?>" width="30" />
    </a>
    <a href="javascript:delete_file(<?php echo (int)$row['id']; ?>, 'icon')" class="btn btn-danger btn-sm">
        <i class="fa fa-trash-o"></i>
    </a>
<?php } else { ?>
    <img src="https://www.bollywoodproduct.com/images/default.png" width="30">
<?php } ?>
</td>

<td>
<?php if (!empty($row['photo'])) { ?>
    <a href="../uploads/<?php echo htmlspecialchars($row['photo']); ?>" data-lightbox="tv-gallery">
        <img src="../uploads/<?php echo htmlspecialchars($row['photo']); ?>" width="30" />
    </a>
    <a href="javascript:delete_file(<?php echo (int)$row['id']; ?>, 'photo')" class="btn btn-danger btn-sm">
        <i class="fa fa-trash-o"></i>
    </a>
<?php } else { ?>
    <img src="https://www.bollywoodproduct.com/images/default.png" width="30">
<?php } ?>
</td>
                                       <td>
                                         
                                          <a href="ott_platform_list.php?Action=Update&id=<? echo $row['id'];?>" class="btn btn-add btn-sm"    ><i class="fa fa-pencil"></i></a>
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



function delete_file(id, field) {
    if (confirm("This will delete the " + field + ". Are you sure you want to continue?")) {
        window.location.href = "<?php echo basename($_SERVER['PHP_SELF']); ?>?remove_file=yes&id=" + id + "&field=" + field;
    }
}

</script>