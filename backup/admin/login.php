<?
session_start();
include "config.php";
if($_POST['submit']<>""){

$username=addslashes(trim($_POST['username']));
$password=addslashes(trim($_POST['password']));

$sql=mysqli_query($con,"select * from admin where username='$username' and password='$password'") or die(mysqli_error($con));
$cont=mysqli_num_rows($sql);
if($cont>0){

$row=mysqli_fetch_array($sql);

$username=$row['username'];
$password=$row['password'];

$_SESSION['admin']=$username;
$_SESSION['id']=$row['id'];
$_SESSION['role']=$row['role'];
$_SESSION['image']=$row['image'];
$_SESSION['email']=$row['email'];



header("location:dashboard.php");


}else{

header("location:index.php?msg=Username and Password does not match");

}










}else{


	header("location:index.php?msg=SecurityError");
}







?>