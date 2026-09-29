<?php
session_start();
include "config.php";

if($_SESSION['admin']==""){
    header("location:index.php");
    exit;
} 

/* =====================
    ADD COUPON LOGIC
===================== */
if(isset($_POST["add_coupon"])) { 
    $couponCode    = mysqli_real_escape_string($con, $_POST['couponCode']);
    $discountType  = mysqli_real_escape_string($con, $_POST['discountType']);
    $discountValue = mysqli_real_escape_string($con, $_POST['discountValue']);
    $minPurchase   = mysqli_real_escape_string($con, $_POST['minPurchase']);
    $startDate     = mysqli_real_escape_string($con, $_POST['startDate']);
    $expiryDate    = mysqli_real_escape_string($con, $_POST['expiryDate']);
    $usageLimit    = mysqli_real_escape_string($con, $_POST['usageLimit']);
    $status        = mysqli_real_escape_string($con, $_POST['status']);

    $check_already = mysqli_query($con, "SELECT count(*) as total FROM talent_coupon WHERE coupon_code='$couponCode'");
    $check_data    = mysqli_fetch_array($check_already);

    if($check_data["total"] < 1) {
        $sql = "INSERT INTO talent_coupon SET 
                coupon_code='$couponCode', 
                discount_type='$discountType', 
                discount_value='$discountValue', 
                minimum_value='$minPurchase', 
                start_date='$startDate', 
                expiry_date='$expiryDate', 
                usage_limit='$usageLimit', 
                status='$status'";
        
        mysqli_query($con, $sql) or die(mysqli_error($con));
        header('location:talent_coupon.php?msg=success');
    } else {
        echo '<script>alert("This Coupon Code Already Exists!")</script>';
    }
}

/* =====================
    UPDATE COUPON LOGIC
===================== */
if(isset($_POST["update_coupon"])) {
    $id            = $_GET['id'];
    $couponCode    = mysqli_real_escape_string($con, $_POST['couponCode']);
    $discountType  = mysqli_real_escape_string($con, $_POST['discountType']);
    $discountValue = mysqli_real_escape_string($con, $_POST['discountValue']);
    $minPurchase   = mysqli_real_escape_string($con, $_POST['minPurchase']);
    $startDate     = mysqli_real_escape_string($con, $_POST['startDate']);
    $expiryDate    = mysqli_real_escape_string($con, $_POST['expiryDate']);
    $usageLimit    = mysqli_real_escape_string($con, $_POST['usageLimit']);
    $status        = mysqli_real_escape_string($con, $_POST['status']);

    $sql = "UPDATE talent_coupon SET 
            coupon_code='$couponCode', 
            discount_type='$discountType', 
            discount_value='$discountValue', 
            minimum_value='$minPurchase', 
            start_date='$startDate', 
            expiry_date='$expiryDate', 
            usage_limit='$usageLimit', 
            status='$status' 
            WHERE id='$id'";
            
    mysqli_query($con, $sql) or die(mysqli_error($con));
    header('location:talent_coupon.php?msg=updated');
}

/* =====================
    DELETE COUPON LOGIC
===================== */
if(@$_REQUEST['remove']=="yes"){
    mysqli_query($con, "DELETE FROM talent_coupon WHERE id='$_REQUEST[id]'");
    header("location:talent_coupon.php?msg=deleted");
}      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Talent Coupon Management</title>
    <link rel="shortcut icon" href="assets/dist/img/ico/favicon.png" type="image/x-icon">
    <link href="assets/plugins/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet" type="text/css"/>
    <link href="assets/dist/css/stylecrm.css" rel="stylesheet" type="text/css"/>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include "topandleft.php"; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="header-icon"><i class="fa fa-ticket"></i></div>
                <div class="header-title">
                    <h1>Talent Coupon</h1>
                    <small>Manage Discounts</small>
                </div>
            </section>

            <section class="content">

                <?php if (@$_GET['Action'] == "Add") { ?>
                <div class="panel panel-bd">
                    <div class="panel-heading"><h4>Create New Coupon</h4></div>
                    <div class="panel-body">
                        <form method="post" class="row">
                            <div class="col-md-6 form-group">
                                <label>Coupon Code</label>
                                <input type="text" name="couponCode" class="form-control" placeholder="e.g. TALENT50" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Discount Type</label>
                                <select name="discountType" class="form-control" required>
                                    <option value="percentage">Percentage (%)</option>
                                    <option value="fixed">Fixed Amount</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Discount Value</label>
                                <input type="number" name="discountValue" class="form-control" step="0.01" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Min Purchase Amount</label>
                                <input type="number" name="minPurchase" class="form-control" value="0">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Start Date</label>
                                <input type="date" name="startDate" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Expiry Date</label>
                                <input type="date" name="expiryDate" class="form-control" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Usage Limit</label>
                                <input type="number" name="usageLimit" class="form-control" value="1">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="add_coupon" class="btn btn-primary">Create Coupon</button>
                                <a href="talent_coupon.php" class="btn btn-warning">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php } ?>

                <?php if (@$_GET['Action'] == "Update") { 
                    $id = $_GET['id'];
                    $res = mysqli_query($con, "SELECT * FROM talent_coupon WHERE id='$id'");
                    $row = mysqli_fetch_array($res);
                ?>
                <div class="panel panel-bd">
                    <div class="panel-heading"><h4>Update Coupon</h4></div>
                    <div class="panel-body">
                        <form method="post" class="row">
                            <div class="col-md-6 form-group">
                                <label>Coupon Code</label>
                                <input type="text" name="couponCode" class="form-control" value="<?php echo $row['coupon_code']; ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Discount Type</label>
                                <select name="discountType" class="form-control">
                                    <option value="percentage" <?php if($row['discount_type']=='percentage') echo 'selected'; ?>>Percentage (%)</option>
                                    <option value="fixed" <?php if($row['discount_type']=='fixed') echo 'selected'; ?>>Fixed Amount</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Discount Value</label>
                                <input type="number" name="discountValue" class="form-control" value="<?php echo $row['discount_value']; ?>" step="0.01" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Min Purchase</label>
                                <input type="number" name="minPurchase" class="form-control" value="<?php echo $row['minimum_value']; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Start Date</label>
                                <input type="date" name="startDate" class="form-control" value="<?php echo $row['start_date']; ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Expiry Date</label>
                                <input type="date" name="expiryDate" class="form-control" value="<?php echo $row['expiry_date']; ?>" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Usage Limit</label>
                                <input type="number" name="usageLimit" class="form-control" value="<?php echo $row['usage_limit']; ?>">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" <?php if($row['status']=='active') echo 'selected'; ?>>Active</option>
                                    <option value="inactive" <?php if($row['status']=='inactive') echo 'selected'; ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" name="update_coupon" class="btn btn-success">Update Coupon</button>
                                <a href="talent_coupon.php" class="btn btn-warning">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
                <?php } ?>

                <?php if (@$_GET['Action'] == "") { ?>
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="btn-group">
                            <a class="btn btn-add" href="talent_coupon.php?Action=Add"> <i class="fa fa-plus"></i> Add New Coupon </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr class="info">
                                        <th>Code</th>
                                        <th>Discount</th>
                                        <th>Min Value</th>
                                        <th>Validity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $result = mysqli_query($con, "SELECT * FROM talent_coupon ORDER BY id DESC");
                                    while($row = mysqli_fetch_array($result)){ 
                                    ?>
                                    <tr>
                                        <td><strong><?php echo $row['coupon_code']; ?></strong></td>
                                        <td><?php echo $row['discount_value']; ?> (<?php echo $row['discount_type']; ?>)</td>
                                        <td>₹<?php echo $row['minimum_value']; ?></td>
                                        <td><?php echo $row['start_date']; ?> to <?php echo $row['expiry_date']; ?></td>
                                        <td><span class="label label-<?php echo ($row['status']=='active')?'success':'danger'; ?>"><?php echo $row['status']; ?></span></td>
                                        <td>
                                            <a href="talent_coupon.php?Action=Update&id=<?php echo $row['id'];?>" class="btn btn-add btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:resume_id('<?php echo $row['id']?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </section>
        </div>
        <footer class="main-footer"><strong>Copyright &copy; Bollywood Product</strong></footer>
    </div>

    <script src="assets/plugins/jQuery/jquery-1.12.4.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/dist/js/custom.js"></script>
    <script>
    function resume_id(res_id){
        if (confirm("Are you sure you want to delete this coupon?")) {
            window.location.href='talent_coupon.php?remove=yes&id='+res_id;
        }
    }
    </script>
</body>
</html>