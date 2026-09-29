<?php

$con=mysqli_connect("localhost","u171564966_bollywoodprodu","@oWO8+QvR", "u171564966_bollywoodprodu") or die(mysqli_connect_error()); 

$syssql=mysqli_query($con, "select * from `system` where id='1'") or die(mysqli_error($con));
$system=mysqli_fetch_array($syssql);

include_once "custom-functions.php";

?>