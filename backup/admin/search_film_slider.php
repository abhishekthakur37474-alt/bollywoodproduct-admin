<?php
include('config.php');
if($_POST)
{
$q=$_POST['search'];
$sql_res=mysqli_query($con,"select id, film_id from slider where film_id like '%$q%' order by id LIMIT 30")or die(mysqli_error($con));
while($row=mysqli_fetch_array($sql_res))
{
$id=$row['id'];
$film_id=$row['film_id'];
$film_details="select * from film where id='$film_id'";
	$film_details_exe=mysqli_query($con,$film_details);
	$read_film_details=mysqli_fetch_array($film_details_exe);
   $name= $read_film_details['name']; 
//$name=$row['film_id']; 
$b_name='<strong>'.$q.'</strong>'; 
$final_name = str_ireplace($q, $b_name, $name); 
?>
<div class="show" align="left">
 <span class="name"><a href="edit_film_slider.php?Action=Update&id=<? echo $id; ?>"  style="color:#111111"><?php echo $final_name; ?></a></span>&nbsp;<br/><a href="edit_film_slider.php?Action=Update&id=<? echo $id; ?>" style="color:#0044de">Edit</a>, <a href="javascript:resume_id('<? echo $id?>')"  style="color:#F00">Delete</a><br/>
</div>
<?php
}
}
?>