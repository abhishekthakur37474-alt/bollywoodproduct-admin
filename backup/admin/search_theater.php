<?php
include('config.php');
if($_POST)
{
$q=$_POST['search'];
$theater_name_data_query="select * from cinema_chain where name='$q'";
	 $theater_name_data_exe=mysqli_query($con,$theater_name_data_query);
	 $theater_name_read=mysqli_fetch_array($theater_name_data_exe);
     $theater_id=$theater_name_read['id'];
$sql_res=mysqli_query($con,"select id, chain_name from theater where  chain_name='$theater_id' order by id LIMIT 30")or die(mysqli_error($con));
while($row=mysqli_fetch_array($sql_res))
{
$id=$row['id'];
$name=$theater_name_read['name']; 
$b_name='<strong>'.$name.'</strong>'; 
$final_name = str_ireplace($q, $b_name, $name); 
?>
<div class="show" align="left">
 <span class="name"><a href="theater.php?Action=Update&id=<? echo $id; ?>"  style="color:#111111"><?php echo $name; ?></a></span>&nbsp;<br/><a href="theater.php?Action=Update&id=<? echo $id; ?>" style="color:#0044de">Edit</a>, <a href="javascript:resume_id('<? echo $id?>')"  style="color:#F00">Delete</a><br/>
</div>
<?php
}
}
?>