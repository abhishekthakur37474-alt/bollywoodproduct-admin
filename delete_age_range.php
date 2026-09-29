<?
session_start();
include "config.php";

if($_SESSION['admin']==""){
    header("location:index.php");
    exit;
}

$id = intval($_GET['id']);
mysqli_query($con,"DELETE FROM age_ranges WHERE id='$id'");

header("location:age_range_management.php");
exit;
