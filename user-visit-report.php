<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include "config.php";
 
if($_SESSION['admin']==""){
     header("location:index.php");
      } 
 
      

?><!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Today's Unique Visitors</title>
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
                  <h1>Today's Unique Visitors</h1>
                   
               </div>
            </section>
            <!-- Main content -->
            <section class="content">

<?php 

// Validate user_id from GET
if (isset($_GET['user_id']) ) {
   
$user_id = (int) $_GET['user_id'];

// Optional: fetch user name for heading
$userSql = "SELECT name, email FROM users WHERE id = $user_id LIMIT 1";
$userResult = mysqli_query($con, $userSql);
if (!$userResult || mysqli_num_rows($userResult) === 0) {
    die("User not found.");
}
$user = mysqli_fetch_assoc($userResult);

// Fetch visits ordered oldest to newest (ASC)
$sql = "SELECT page_url, visit_time, ip_address
        FROM user_page_visits
        WHERE user_id = $user_id
        ORDER BY visit_time ASC";

$result = mysqli_query($con, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

$visits = [];
while ($row = mysqli_fetch_assoc($result)) {
    $visits[] = $row;
}
?>

<div class="container">
    <h3>Page Visits for User: <?php echo htmlspecialchars($user['name']); ?> (<?php echo htmlspecialchars($user['email']); ?>)</h3>
<a href="user-visit-report.php" class="btn btn-danger">Back</a>
    <?php if (count($visits) > 0): ?>
    <div class="table-responsive mt-3">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Page URL</th>
                    <th>Visit Time</th>
                    <th>Duration on Page</th>
                    <th>IP Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($visits); $i++):
                    $current = $visits[$i];
                    $currentTime = strtotime($current['visit_time']);

                    if (isset($visits[$i + 1])) {
                        $nextTime = strtotime($visits[$i + 1]['visit_time']);
                        $durationSec = $nextTime - $currentTime;
                        // Sanity check: no negative durations
                        if ($durationSec < 0) {
                            $durationSec = 0;
                        }
                    } else {
                        // For last visit, assume fixed duration, e.g. 0 seconds or 1 minute
                        $durationSec = 0;
                    }

                    // Format duration nicely
                    if ($durationSec < 60) {
                        $duration = $durationSec . ' sec';
                    } else {
                        $duration = floor($durationSec / 60) . ' min ' . ($durationSec % 60) . ' sec';
                    }
                ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td><?php echo htmlspecialchars($current['page_url']); ?></td>
                    <td><?php echo htmlspecialchars($current['visit_time']); ?></td>
                    <td><?php echo $duration; ?></td>
                    <td><?php echo htmlspecialchars($current['ip_address']); ?></td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="alert alert-info mt-3">No page visits recorded for this user.</div>
    <?php endif; ?>
</div>
<?php
die("Invalid or missing user_id.");
}
?>


 


 









<? if(!isset($_GET['Action'])){ ?>
    <?php 
$todayStart = date('Y-m-d 00:00:00');
$todayEnd = date('Y-m-d 23:59:59');

// Query unique users with pages visited, min/max visit times
$sql = "
SELECT 
    u.id,
    u.name,
    COUNT(upv.page_url) AS pages_visited,
    MIN(upv.visit_time) AS start_time,
    MAX(upv.visit_time) AS end_time,
    TIMESTAMPDIFF(MINUTE, MIN(upv.visit_time), MAX(upv.visit_time)) AS duration_minutes
FROM user_page_visits upv
JOIN users u ON upv.user_id = u.id
WHERE upv.visit_time BETWEEN '$todayStart' AND '$todayEnd'
GROUP BY u.id, u.name
ORDER BY pages_visited DESC, duration_minutes DESC
LIMIT 100
";

$result = mysqli_query($con, $sql);
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}
?>

<div class="container my-4">
    <h4>Today's Unique Visitors</h4>
    <?php if (mysqli_num_rows($result) > 0): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover ">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>User Name</th> 
                    <th>Time Duration</th>  
                    <th>View Log</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)):
                ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?><br>
                    Pages: <?php echo (int)$row['pages_visited']; ?></td>
                    <td><?php echo htmlspecialchars($row['start_time']); ?><br>
                    <?php echo htmlspecialchars($row['end_time']); ?><br>
                    Duration: <?php echo (int)$row['duration_minutes']; ?> min</td>
                    <td>
                        <a href="user-visit-report.php?user_id=<?php echo urlencode($row['id']); ?>" 
                           class="btn btn-sm btn-primary" target="_blank">
                            View Log
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="alert alert-info">No visitors recorded today.</div>
    <?php endif; ?>
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












