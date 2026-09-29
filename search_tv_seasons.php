<?php
include('config.php');
if($_POST)
{
$q=$_POST['search'];
$sql_res=mysqli_query($con,"select id,   name from tv_series where  name like '%$q%'   order by id LIMIT 30")or die(mysqli_error($con));
while($row=mysqli_fetch_array($sql_res))
{
$id=$row['id'];
$name=$row['name']; 
$b_name='<strong>'.$q.'</strong>'; 
$final_name = str_ireplace($q, $b_name, $name); 
?>
<div class="show" align="left">
 <span class="name"><a href="tv_seasons.php?Action=Update&id=<? echo $id; ?>"  style="color:#111111"><?php echo $final_name; ?></a></span>&nbsp;<br/><a href="edit_film_trivia_details.php?id=<? echo $id; ?>" style="color:#0044de">Edit</a>, <a href="delete_film_trivia_management.php?delete=<? echo $id; ?>"  style="color:#F00">Delete</a><br/>
</div>
<?php
}
}
?>