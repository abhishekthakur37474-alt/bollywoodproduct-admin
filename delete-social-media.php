<?php
session_start();
include "config.php";
if($_SESSION['admin']==""){
     header("location:index.php");
      }
$delete=$_GET["delete"];
$q_delete_social="delete from social_media_detail where id='$delete'";
$exe_delete_social=mysqli_query($con,$q_delete_social);
if($exe_delete_social>0)
{
    echo "<script>alert('Crew Social Media Deleted Successful')</script>";
echo "<script>window.location.href='cast-crew-soical-media.php'</script>";
}
else
{
     echo "<script>alert('Crew Social Media Not Deleted Successful')</script>";
echo "<script>window.location.href='cast-crew-soical-media.php'</script>";
}



?>