<?php
include('config.php');
$id_delete=$_GET["x"];
echo $q_dele="delete from userform where id='$id_delete'";
$exe=mysqli_query($con,$q_dele);
if($exe==true)
{
	echo "<script>alert('Your Data Delete')</script>";
	echo "<script>window.location.href='user-list.php'</script>";
}
else
{
	echo "<script>alert('Your Data Not Delete')</script>";
	//echo "<script>window.location.href='user-list.php'</script>";
}
?>