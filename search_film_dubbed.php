<?php
include('config.php');
if($_POST)
{
$q=$_POST['search'];
$sql_res=mysqli_query($con,"select id,name,dubbing_film_name,dubbing_lanaguage from film_dubbed_management where  name like '%$q%'   order by id LIMIT 30")or die(mysqli_error($con));
while($row=mysqli_fetch_array($sql_res))
{
$id=$row['id'];
$name="Dubbing Name: " . $row['dubbing_film_name'] . " (Language: " . $row['dubbing_lanaguage'] . ")"; 
$b_name='<strong>'.$q.'</strong>'; 
$final_name = str_ireplace($q, $b_name, $name); 
?>
<div class="show" align="left">
 <span class="name"><a href="edit_film_dubbed_details.php?id=<? echo $id; ?>"  style="color:#111111"><?php echo $final_name; ?></a></span>&nbsp;<br/><a href="edit_film_dubbed_details.php?id=<? echo $id; ?>" style="color:#0044de">Edit</a>, <a href="delete_film_dubbed_details.php?delete=<? echo $id; ?>"  style="color:#F00">Delete</a><br/>
</div>
<?php
}
}
?>