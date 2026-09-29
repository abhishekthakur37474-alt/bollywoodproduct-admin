<?php
include ("config.php");
$id=$_GET["delete"];
$x="delete from film_dubbed_management where id='$id'";
$exe=mysqli_query($con,$x);
if($exe==true){
    echo"<script>alert('Data deleted is successfully')</script>";
    echo"<script>window.location.href='film_dubbed_details.php'</script>";
}
else{
    echo"<script>alert('Data deleted is not successfully')</script>";   
        echo"<script>window.location.href='film_dubbed_details.php'</script>";
}

?>