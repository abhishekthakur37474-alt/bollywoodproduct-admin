<?php
include('config.php');
if($_POST)
{
$q=$_POST['search'];
$film_name_data_query="select * from film where name='$q'";
	 $film_name_data_exe=mysqli_query($con,$film_name_data_query);
	 $film_name_read=mysqli_fetch_array($film_name_data_exe);
     $film_id=$film_name_read['id'];
$sql_res=mysqli_query($con,"select id, film_id from  film_makeup_management_allot where  film_id='$film_id' order by id LIMIT 5")or die(mysqli_error($con));
while($row=mysqli_fetch_array($sql_res))
{
$film_name_data_query="select * from film where id='$film_id'";
	 $film_name_data_exe=mysqli_query($con,$film_name_data_query);
	 $film_name_read=mysqli_fetch_array($film_name_data_exe);
$name=$film_name_read['name']; 
$id=$row['id'];
$b_name='<strong>'.$q.'</strong>'; 
$final_name = str_ireplace($q, $b_name, $name); 
?>
<div class="show" align="left">
 <span class="name"><a href="edit_film_makeup.php?id=<? echo $id; ?>"  style="color:#111111"><?php echo $final_name; ?></a></span>&nbsp;<br/><a href="edit_film_makeup.php?id=<? echo $id; ?>" style="color:#0044de">Edit</a>, <a href="delete_film_makeup.php?delete=<? echo $id; ?>"  style="color:#F00">Delete</a><br/>
</div>
<?php
}
}
?>