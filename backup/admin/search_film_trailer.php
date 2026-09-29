<?php
include('config.php');
if($_POST)
{
$q=$_POST['search'];
$sql_res=mysqli_query($con,"select id, name,trailer_category,trailer_release_date,trailer_release_month,trailer_release_year,trailer_lanaguage  from film_trailer_management where  name like '%$q%'   order by id LIMIT 30")or die(mysqli_error($con));
while($row=mysqli_fetch_array($sql_res))
{
$id=$row['id'];
$name=$row['name']; 
$b_name='<strong>'.$q.'</strong>'; 
$final_name = str_ireplace($q, $b_name, $name); 
$display_text =
    $name .
    ' - ' .
    $row['trailer_category'] .
    '/' .
    $row['trailer_release_date'] .
    '-' .
    $row['trailer_release_month'] .
    '-' .
    $row['trailer_release_year'] .
    ' (' .
    $row['trailer_lanaguage'] .
    ')';
?>
<div class="show" align="left">
 <span class="name"><a href="edit_film_trailer_details.php?id=<? echo $id; ?>"  style="color:#111111"><?php echo $display_text; ?></a></span>&nbsp;<br/><a href="edit_film_trailer_details.php?id=<? echo $id; ?>" style="color:#0044de">Edit</a>, <a href="delete_film_trailer_details.php?delete=<? echo $id; ?>"  style="color:#F00">Delete</a><br/>
</div>
<?php
}
}

?>
