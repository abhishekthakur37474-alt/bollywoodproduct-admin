<?
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      } 
 

// Handle form submission (Add or Update)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $slug = mysqli_real_escape_string($con, $_POST['slug']);
    $version = mysqli_real_escape_string($con, $_POST['version']);
    $effective_from = mysqli_real_escape_string($con, $_POST['effective_from']);
    $content = mysqli_real_escape_string($con, $_POST['content']);

    if ($id > 0) {
        // Update
        $sql = "UPDATE legal_documents SET 
                    title='$title', 
                    slug='$slug', 
                    version='$version', 
                    effective_from='$effective_from', 
                    content='$content' 
                WHERE id=$id";
    } else {
        // Insert
        $sql = "INSERT INTO legal_documents (title, slug, version, effective_from, content) 
                VALUES ('$title', '$slug', '$version', '$effective_from', '$content')";
    }

    mysqli_query($con, $sql);
    header("Location: legal_documents.php");
    exit;
}

// Handle delete
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    mysqli_query($con, "DELETE FROM legal_documents WHERE id = $delete_id");
    header("Location: legal_documents.php");
    exit;
}

// Fetch all records
$result = mysqli_query($con, "SELECT * FROM legal_documents ORDER BY id DESC");

// If editing, load that document
$edit = null;
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $res = mysqli_query($con, "SELECT * FROM legal_documents WHERE id = $edit_id");
    $edit = mysqli_fetch_assoc($res);
}
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Legal Documents</title>
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
 <script>
     function del()
     {
         var c=confirm('Are you sure delete this...?');
         if(c==true)
         {
             return true;
         }
         else{
             return false;
         }
     }
     
     
 </script>
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
                  <h1>Legal Documents</h1>
                  <small>Legal Documents</small>
               </div>
            </section>
            <!-- Main content -->
            <section class="content">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Legal Documents</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="btn-group">
                              <div class="buttonexport" id="buttonlist"> 
                                 <a class="btn btn-add" href="add-about-us-contant.php"> <i class="fa fa-plus"></i> Legal Documents
                                 </a>  
                              </div>
                            
                           </div> 
                            
 
        <h2 class="mb-4">📝 Manage Legal Documents</h2>

        <form method="POST" class="mb-5">
            <input type="hidden" name="id" value="<?= $edit ? $edit['id'] : 0 ?>">

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" required class="form-control" value="<?= $edit['title'] ?? '' ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" required class="form-control" value="<?= $edit['slug'] ?? '' ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Version</label>
                    <input type="text" name="version" required class="form-control" value="<?= $edit['version'] ?? '' ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Effective From</label>
                    <input type="date" name="effective_from" required class="form-control" value="<?= $edit['effective_from'] ?? date('Y-m-d') ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control" rows="6" required><?= $edit['content'] ?? '' ?></textarea>
            </div>

            <button type="submit" class="btn btn-success"><?= $edit ? 'Update' : 'Add' ?> Document</button>
            <?php if ($edit): ?>
                <a href="legal_documents.php" class="btn btn-secondary">Cancel</a>
            <?php endif; ?>
        </form>

        <h4>📚 Existing Legal Documents</h4>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Title</th> 
                    <th>Effective From</th>
                    <th>Created At</th>
                    <th width="170">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><a href="<?= $system['domain'] ?>/legal/<?= $row['slug'] ?>" target="_blank"><?= htmlspecialchars($row['title']) ?> (<?= $row['version'] ?>)<br>
                 </a>  
                </td>
                    
                    <td><?= $row['effective_from'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td>
                        <a href="legal_documents.php?edit=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="legal_documents.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this document?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if (mysqli_num_rows($result) == 0): ?>
                    <tr><td colspan="7" class="text-center">No legal documents found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
 
                     </div>
                  </div>
               </div>

           
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
   </body>
 
</html>
 
