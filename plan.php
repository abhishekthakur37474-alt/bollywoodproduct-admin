<?php
session_start();
include "config.php";

// Check Admin Session
if ($_SESSION['admin'] == "") {
    header("location:index.php");
    exit;
}

/* =====================
    ADD PLAN LOGIC
===================== */
if (isset($_POST["Submit"])) {
    $plan_name = mysqli_real_escape_string($con, $_POST['plan_name']);
    $plan_rate = mysqli_real_escape_string($con, $_POST['plan_rate']);
    $details   = mysqli_real_escape_string($con, $_POST['details']);
    $status    = mysqli_real_escape_string($con, $_POST['status']);

    // Fixed: Added the VALUES and column mapping
    $insert_query = "INSERT INTO talent_plan_user (plan_name, plan_rate, details, status) 
                     VALUES ('$plan_name', '$plan_rate', '$details', '$status')";
    
    mysqli_query($con, $insert_query);

    header("location:plan.php?msg=success");
    exit;
}

/* =====================
    UPDATE PLAN LOGIC
===================== */
if (isset($_POST["Update"])) {
    $id        = $_POST['id'];
    $plan_name = mysqli_real_escape_string($con, $_POST['plan_name']);
    $plan_rate = mysqli_real_escape_string($con, $_POST['plan_rate']);
    $details   = mysqli_real_escape_string($con, $_POST['details']);
    $status    = mysqli_real_escape_string($con, $_POST['status']);

    mysqli_query($con, "UPDATE talent_plan_user SET
        plan_name='$plan_name',
        plan_rate='$plan_rate',
        details='$details',
        status='$status'
        WHERE id='$id'
    ");

    header("location:plan.php?msg=updated");
    exit;
}

/* =====================
    DELETE PLAN LOGIC
===================== */
if (@$_REQUEST['remove'] == "yes") {
    $del_id = mysqli_real_escape_string($con, $_REQUEST['id']);
    mysqli_query($con, "DELETE FROM talent_plan_user WHERE id='$del_id'");
    header("location:plan.php?msg=deleted");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Plan Management</title>
    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/lobipanel/lobipanel.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/pace/flash.css" rel="stylesheet" type="text/css"/>
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
    <link href="assets/themify-icons/themify-icons.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
    <style>
        select { width:100%; }
        .mb-3 { margin-bottom: 15px; }
    </style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <?php include "topandleft.php"; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="header-icon"><i class="fa fa-credit-card"></i></div>
            <div class="header-title">
                <h1>Plans</h1>
                <small>Plan Management</small>
            </div>
        </section>

        <section class="content">

            <?php if (@$_GET['Action'] == "Add") { ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading"><h4>Add Plan</h4></div>
                        <div class="panel-body">
                            <form method="post">
                                <div class="form-group">
                                    <label>Plan Name</label>
                                    <input type="text" name="plan_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Price (₹)</label>
                                    <input type="number" name="plan_rate" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Validity/Details</label>
                                    <textarea name="details" class="form-control" rows="4" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                                <input type="submit" name="Submit" class="btn btn-add" value="Add Plan">
                                <a href="plan.php" class="btn btn-warning">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php if (@$_GET['Action'] == "Update") {
                $id = mysqli_real_escape_string($con, $_GET['id']);
                $q = mysqli_query($con, "SELECT * FROM talent_plan_user WHERE id='$id'");
                $row = mysqli_fetch_assoc($q);
            ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading"><h4>Update Plan</h4></div>
                        <div class="panel-body">
                            <form method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <div class="form-group">
                                    <label>Plan Name</label>
                                    <input type="text" name="plan_name" class="form-control" value="<?php echo $row['plan_name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Price (₹)</label>
                                    <input type="number" name="plan_rate" class="form-control" value="<?php echo $row['plan_rate']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Validity/Details</label>
                                    <textarea name="details" class="form-control" rows="4" required><?php echo $row['details']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Active" <?php if($row['status']=="Active") echo "selected"; ?>>Active</option>
                                        <option value="Inactive" <?php if($row['status']=="Inactive") echo "selected"; ?>>Inactive</option>
                                    </select>
                                </div>
                                <input type="submit" name="Update" class="btn btn-add" value="Update Plan">
                                <a href="plan.php" class="btn btn-warning">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php if (@$_GET['Action'] == "") { ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading"><h4>Plan List</h4></div>
                        <div class="panel-body">
                            <a href="plan.php?Action=Add" class="btn btn-add mb-3"><i class="fa fa-plus"></i> Add Plan</a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="info">
                                            <th>Plan Name</th>
                                            <th>Price</th>
                                            <th>Details</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result = mysqli_query($con, "SELECT * FROM talent_plan_user ORDER BY id DESC");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['plan_name']; ?></td>
                                            <td>₹<?php echo $row['plan_rate']; ?></td>
                                            <td><?php echo nl2br($row['details']); ?></td>
                                            <td>
                                                <span class="label label-<?php echo ($row['status']=="Active")?'success':'danger'; ?>">
                                                    <?php echo $row['status']; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="plan.php?Action=Update&id=<?php echo $row['id']; ?>" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                                <a href="javascript:remove_id('<?php echo $row['id']; ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </section>
    </div>

    <footer class="main-footer"><strong>© Bollywood Product</strong></footer>
</div>

<script>
function remove_id(id){
    if(confirm("Are you sure you want to delete this plan?")){
        window.location.href="plan.php?remove=yes&id="+id;
    }
}
</script>

<script src="assets/plugins/jQuery/jquery-1.12.4.min.js"></script>
<script src="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/pace/pace.min.js"></script>
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="assets/dist/js/custom.js"></script>
</body>
</html>