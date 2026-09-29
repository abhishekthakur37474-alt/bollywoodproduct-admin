<?php
include('config.php');
if($_POST)
{
$q=$_POST['search'];
$sql_res=mysqli_query($con,"select id, title,film_id  from film_song where  title like '%$q%'   order by id LIMIT 30")or die(mysqli_error($con));
while($row=mysqli_fetch_array($sql_res))
{
$id=$row['id'];
$film_id=$row['film_id'];
$name=$row['title']; 
$b_name='<strong>'.$q.'</strong>'; 
$final_name = str_ireplace($q, $b_name, $name); 

$ulang="";    
$sqlfsl=mysqli_query($con, "select * from songlanguage where song_id='$id'") or die(mysqli_error($con));
while($rowfsl=mysqli_fetch_array($sqlfsl)){
    $language_id=$rowfsl['language_id'];
     $sqll=mysqli_query($con, "select * from song_language where id='$language_id'");
 $rowl=mysqli_fetch_array($sqll);
 $ulang=strtolower($ulang.", ".$rowl['song_language']);
}

$ulang=substr($ulang, 1);
         //echo $ulang;

?>
<div class="show" align="left">
 <span class="name"><a href="film_song.php?Action=Update&id=<? echo $id; ?>"  style="color:#111111"><?php echo $final_name; ?> (<? echo $ulang;?>)</a></span>&nbsp;<br/><a href="film_song.php?Action=Update&id=<? echo $id; ?>" style="color:#0044de">Edit</a>, <a href="javascript:resume_id('<? echo $id?>')"  style="color:#F00">Delete</a><br/>
</div>
<?php
}
}
?>