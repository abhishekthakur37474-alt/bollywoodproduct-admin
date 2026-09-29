<?php
session_start();
include "config.php";
echo $film_id=$_POST["film_id"];
echo $genre_id=implode(",",$_POST["genre_id"]);

echo $q="insert into film_genre set film_id='$film_id',genre_id='$genre_id'";
mysqli_query($con,$q);


?>