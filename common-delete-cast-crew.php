<?php
include('config.php');
$id=$_GET["id"];
$profile=$_GET["profile"];
$profile_unique_id=$_GET["profile_unique_id"];
$delete_q="delete from $profile where id='$id'";
mysqli_query($con,$delete_q);
echo "<script>alert('Delete Successfully')</script>";
header("location:view-all-cast-crew.php?msg=Deleted Successfully");
?>