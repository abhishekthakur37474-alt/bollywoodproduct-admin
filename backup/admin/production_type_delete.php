<?php
session_start();
include "config.php";

if ($_SESSION['admin'] == "") {
    header("location:index.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("location:production_type_management.php");
    exit;
}

$id = intval($_GET['id']);

/* CORRECT TABLE NAME */
mysqli_query($con, "DELETE FROM production_types WHERE id='$id'");

header("location:production_type_management.php");
exit;
