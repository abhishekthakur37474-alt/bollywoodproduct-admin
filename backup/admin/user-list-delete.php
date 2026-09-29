<?php
include('coon.php');
$id=$_GET["x"];
$q="delete from userform where id='$id'";
$exe=mysqli_query($con,$q);
if($exe==true)
{
	echo "<script>alert('Your Data Delete')</script>";
	echo "<script>window.location.href='user-list.php'</script>";
}
else
{
	echo "<script>alert('Your Data Not Delete')</script>";
	echo "<script>window.location.href='user-list.php'</script>";
}
?>