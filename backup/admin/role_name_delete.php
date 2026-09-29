<?php
session_start();
include "config.php";
if($_SESSION['admin']==""){ header("location:index.php"); exit; }

$id = intval($_GET['id']);
mysqli_query($con,"DELETE FROM role_name WHERE id='$id'");
header("location:role_name_management.php");
