<?php
session_start();
include "config.php";

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == "") {
    header("location:index.php");
    exit;
}

$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'payment';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Manage Audition Payments | Admin</title>
 
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
            <!--textaera------css-->
            <link href="/admin/richtext.min.css" rel="stylesheet" type="text/css"/>
            <link href="/admin/site.css" rel="stylesheet" type="text/css"/>
      <!-- End Global Mandatory Style
         =====================================================================-->
      <!-- Start Theme Layout Style
         =====================================================================-->
      <!-- Theme style -->
      <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>

     
  <!-- select2 -->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
    <style>
        .label-created { background-color: #777; }
        .text-small { font-size: 11px; color: #888; }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include "topandleft.php"; ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="header-title"><h1>Audition Payment & Post Management</h1></div>
        </section>

        <section class="content">
            <div class="panel panel-bd">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="paymentTable" class="table table-bordered table-striped">
                            <thead>
                                <tr class="info">
                                    <th>User ID (Talent)</th>
                                    <th>Project Details</th>
                                    <th>Hiring Company</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // JOIN logic to get details from 5 tables
                                // Group by razorpay_order_id to prevent duplicate rows for multiple attempts
                                $query = "SELECT 
                                            p.*, 
                                            r.full_name AS talent_name, 
                                            ap.project_title, 
                                            rn.role_name AS master_role_name,
                                            cp.company_name,
                                            cp.user_subscriber_id AS company_uid
                                          FROM talent_audition_payment p
                                          LEFT JOIN talent_registration r ON p.user_id = r.user_subscriber_id
                                          LEFT JOIN audition_posts ap ON p.audition_id = ap.id
                                          LEFT JOIN role_name rn ON ap.hiring_categories = rn.id
                                          LEFT JOIN hiring_company_profile cp ON ap.hiring_company_id = cp.user_subscriber_id
                                          GROUP BY p.razorpay_order_id 
                                          ORDER BY p.id DESC";
                                
                                $p_res = mysqli_query($con, $query);
                                
                                while ($row = mysqli_fetch_assoc($p_res)) {
                                    $amount_in_rupee = number_format($row['amount'] / 100, 2);
                                    $status = $row['payment_status'];
                                    $label_class = ($status == 'success') ? 'success' : (($status == 'failed') ? 'danger' : 'warning');
                                ?>
                                <tr>
                                    <td>
                                        <strong>ID: <?php echo $row['user_id']; ?></strong><br>
                                        <span class="text-small"><?php echo $row['talent_name']; ?></span>
                                    </td>
                                    <td>
                                        <strong><?php echo $row['project_title']; ?></strong><br>
                                        <small class="text-primary">Role: <?php echo $row['master_role_name']; ?></small>
                                    </td>
                                    <td>
                                        <?php echo !empty($row['company_name']) ? $row['company_name'] : "N/A"; ?><br>
                                        <small class="text-muted">CID: <?php echo $row['company_uid']; ?></small>
                                    </td>
                                    <td><strong>₹<?php echo $amount_in_rupee; ?></strong></td>
                                    <td><span class="label label-<?php echo $label_class; ?>"><?php echo strtoupper($status); ?></span></td>
                                    <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                                    <td>
                                        <button class="btn btn-info btn-xs" 
                                            onclick="showFullDetails(<?php echo htmlspecialchars(json_encode($row)); ?>)">
                                            <i class="fa fa-eye"></i> View
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div id="viewModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Transaction & Audition Details</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 style="border-bottom:1px solid #ddd; padding-bottom:5px;">Payment Info</h5>
                            <table class="table table-bordered">
                                <tr><th width="40%">Order ID</th><td id="m_order"></td></tr>
                                <tr><th>Payment ID</th><td id="m_payment"></td></tr>
                                <tr><th>Method</th><td id="m_method"></td></tr>
                                <tr><th>Bank</th><td id="m_bank"></td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 style="border-bottom:1px solid #ddd; padding-bottom:5px;">Audition & Company Info</h5>
                            <table class="table table-bordered">
                                <tr><th width="40%">Project</th><td id="m_project"></td></tr>
                                <tr><th>Role</th><td id="m_role"></td></tr>
                                <tr><th>Company Name</th><td id="m_company"></td></tr>
                                <tr><th>Company ID</th><td id="m_comp_id"></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="assets/plugins/jQuery/jquery-1.12.4.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/datatables/dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#paymentTable').DataTable({ "order": [[ 5, "desc" ]] });
});

function showFullDetails(data) {
    document.getElementById('m_order').innerText = data.razorpay_order_id;
    document.getElementById('m_payment').innerText = data.razorpay_payment_id || 'Not Generated';
    document.getElementById('m_method').innerText = (data.payment_method || 'N/A').toUpperCase();
    document.getElementById('m_bank').innerText = data.bank || 'N/A';
    
    document.getElementById('m_project').innerText = data.project_title || 'N/A';
    document.getElementById('m_role').innerText = data.master_role_name || 'N/A';
    document.getElementById('m_company').innerText = data.company_name || 'N/A';
    document.getElementById('m_comp_id').innerText = data.company_uid || 'N/A';
    
    $('#viewModal').modal('show');
}
</script>
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

</script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

 

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>