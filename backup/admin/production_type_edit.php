<?php
session_start();
include "config.php";

if ($_SESSION['admin'] == "") {
    header("location:index.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("location:production_type_management.php");
    exit;
}

$id = intval($_GET['id']);

$res = mysqli_query($con, "SELECT * FROM production_type WHERE id='$id'");
$row = mysqli_fetch_assoc($res);

if (!$row) {
    header("location:production_type_management.php");
    exit;
}

// UPDATE LOGIC
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $status = $_POST['status'];

    mysqli_query($con, "
        UPDATE production_type 
        SET name='$name', status='$status' 
        WHERE id='$id'
    ");

    echo "<script>
        alert('Production Type Updated Successfully');
        window.location='production_type_management.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Edit Production Type</title>

<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/dist/css/stylecrm.css" rel="stylesheet">

<style>
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 1.4em !important;
    margin-bottom: 20px !important;
}
legend.scheduler-border {
    font-size: 18px !important;
    font-weight: bold !important;
}
</style>
</head>

<body class="hold-transition sidebar-mini">

<div class="wrapper">
<?php include "topandleft.php"; ?>

<div class="content-wrapper">
<section class="content-header">
    <div class="header-icon">
        <i class="fa fa-edit"></i>
    </div>
    <div class="header-title">
        <h1>Edit Production Type</h1>
        <small>Update Production Type Details</small>
    </div>
</section>

<section class="content">
<div class="row">
<div class="col-sm-12">
<div class="panel panel-bd lobidrag">
<div class="panel-heading">
    <h4>Edit Production Type</h4>
</div>

<div class="panel-body">

<form method="post" class="col-sm-6">

<fieldset class="scheduler-border">
<legend class="scheduler-border">Production Type Info</legend>

<div class="form-group">
    <label>Production Type Name</label>
    <input type="text" name="name" class="form-control" 
           value="<?= htmlspecialchars($row['name']) ?>" required>
</div>

<div class="form-group">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="1" <?= $row['status']==1?'selected':'' ?>>Active</option>
        <option value="0" <?= $row['status']==0?'selected':'' ?>>Inactive</option>
    </select>
</div>

<div class="form-group">
    <input type="submit" name="update" class="btn btn-primary" value="Update">
    <a href="production_type_management.php" class="btn btn-danger">Cancel</a>
</div>

</fieldset>
</form>

</div>
</div>
</div>
</div>
</section>
</div>

<?php include "footer.php"; ?>
</div>

<script src="assets/plugins/jQuery/jquery-1.12.4.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
